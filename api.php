<?php
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$dataPath = __DIR__ . '/data/expenses.json';

function getExpenses($path) {
    if (!file_exists($path)) {
        return [];
    }
    $content = file_get_contents($path);
    $data = json_decode($content, true);
    return is_array($data) ? $data : [];
}

function saveExpenses($path, $expenses) {
    $json = json_encode($expenses, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($path, $json, LOCK_EX);
}

$action = $_GET['action'] ?? ($_POST['action'] ?? 'list');

// Export CSV handler
if ($action === 'export_csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="BF_Corporate_Expenses_2026.csv"');
    
    $expenses = getExpenses($dataPath);
    $output = fopen('php://output', 'w');
    // Add UTF-8 BOM for Excel compatibility
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    fputcsv($output, ['ID', 'Date', 'Category', 'Item Name', 'Quantity', 'Amount (BDT)', 'Vendor / Person', 'Service Type', 'Notes']);
    foreach ($expenses as $exp) {
        fputcsv($output, [
            $exp['id'] ?? '',
            $exp['date'] ?? '',
            $exp['category'] ?? '',
            $exp['itemName'] ?? '',
            $exp['qty'] ?? 1,
            $exp['amount'] ?? 0,
            $exp['vendorOrPerson'] ?? '',
            $exp['serviceType'] ?? '',
            $exp['notes'] ?? ''
        ]);
    }
    fclose($output);
    exit;
}

if ($action === 'list') {
    $expenses = getExpenses($dataPath);

    // Compute stats
    $totalAmount = 0;
    $categoryTotals = [];
    $categoryCounts = [];

    foreach ($expenses as $item) {
        $amount = (float)($item['amount'] ?? 0);
        $cat = $item['category'] ?? 'Uncategorized';
        
        $totalAmount += $amount;
        $categoryTotals[$cat] = ($categoryTotals[$cat] ?? 0) + $amount;
        $categoryCounts[$cat] = ($categoryCounts[$cat] ?? 0) + 1;
    }

    echo json_encode([
        'status' => 'success',
        'company' => 'B&F Corporate',
        'venue' => 'Venue - Probotok Office (HQ) - 8th Floor',
        'month' => 'May 2026',
        'currency' => 'BDT (৳)',
        'totalAmount' => $totalAmount,
        'totalCount' => count($expenses),
        'categoryTotals' => $categoryTotals,
        'categoryCounts' => $categoryCounts,
        'data' => array_values($expenses)
    ]);
    exit;
}

// Read raw JSON body if POST
$rawInput = file_get_contents('php://input');
$inputData = json_decode($rawInput, true) ?? $_POST;

if ($action === 'add') {
    $expenses = getExpenses($dataPath);

    $itemName = trim($inputData['itemName'] ?? '');
    $category = trim($inputData['category'] ?? '');
    $amount = (float)($inputData['amount'] ?? 0);
    $qty = (int)($inputData['qty'] ?? 1);
    $date = trim($inputData['date'] ?? date('Y-m-d'));
    $vendor = trim($inputData['vendorOrPerson'] ?? '');
    $serviceType = trim($inputData['serviceType'] ?? '');
    $notes = trim($inputData['notes'] ?? '');

    if ($itemName === '' || $amount <= 0 || $category === '') {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Please provide a valid item name, category, and positive amount.']);
        exit;
    }

    $newExpense = [
        'id' => 'exp-' . time() . '-' . rand(100, 999),
        'category' => $category,
        'itemName' => $itemName,
        'vendorOrPerson' => $vendor,
        'serviceType' => $serviceType,
        'qty' => $qty > 0 ? $qty : 1,
        'amount' => $amount,
        'date' => $date,
        'notes' => $notes
    ];

    // Prepend new expense
    array_unshift($expenses, $newExpense);
    saveExpenses($dataPath, $expenses);

    echo json_encode(['status' => 'success', 'message' => 'Expense added successfully', 'item' => $newExpense]);
    exit;
}

if ($action === 'update') {
    $expenses = getExpenses($dataPath);
    $id = trim($inputData['id'] ?? '');

    if (!$id) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing expense ID.']);
        exit;
    }

    $found = false;
    foreach ($expenses as &$item) {
        if ($item['id'] === $id) {
            if (isset($inputData['category'])) $item['category'] = trim($inputData['category']);
            if (isset($inputData['itemName'])) $item['itemName'] = trim($inputData['itemName']);
            if (isset($inputData['vendorOrPerson'])) $item['vendorOrPerson'] = trim($inputData['vendorOrPerson']);
            if (isset($inputData['serviceType'])) $item['serviceType'] = trim($inputData['serviceType']);
            if (isset($inputData['qty'])) $item['qty'] = max(1, (int)$inputData['qty']);
            if (isset($inputData['amount'])) $item['amount'] = (float)$inputData['amount'];
            if (isset($inputData['date'])) $item['date'] = trim($inputData['date']);
            if (isset($inputData['notes'])) $item['notes'] = trim($inputData['notes']);
            $found = true;
            break;
        }
    }
    unset($item);

    if (!$found) {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Expense record not found.']);
        exit;
    }

    saveExpenses($dataPath, $expenses);
    echo json_encode(['status' => 'success', 'message' => 'Expense updated successfully']);
    exit;
}

if ($action === 'delete') {
    $expenses = getExpenses($dataPath);
    $id = trim($inputData['id'] ?? '');

    if (!$id) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing expense ID.']);
        exit;
    }

    $initialCount = count($expenses);
    $expenses = array_values(array_filter($expenses, function($item) use ($id) {
        return ($item['id'] ?? '') !== $id;
    }));

    if (count($expenses) === $initialCount) {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Expense record not found.']);
        exit;
    }

    saveExpenses($dataPath, $expenses);
    echo json_encode(['status' => 'success', 'message' => 'Expense deleted successfully']);
    exit;
}

http_response_code(400);
echo json_encode(['status' => 'error', 'message' => 'Unknown action requested.']);
