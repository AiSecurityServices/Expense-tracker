<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>B&F Corporate - Expense Tracker 2026</title>
  <meta name="description" content="Executive Expense Management Dashboard for B&F Corporate HQ Venue, Utilities, and Supplies.">

  <!-- Google Fonts: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Phosphor Icons -->
  <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>

  <!-- Custom Styles -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <!-- App Header -->
  <header class="app-header">
    <div class="header-inner">
      <div class="brand-wrapper">
        <div class="brand-icon">
          <i class="ph ph-wallet"></i>
        </div>
        <div>
          <div class="brand-title">
            B&F Corporate
            <span class="brand-badge">May 2026</span>
          </div>
          <div class="brand-subtitle">Venue: Probotok Office (HQ) - 8th Floor</div>
        </div>
      </div>

      <div class="header-actions">
        <button id="themeToggleBtn" class="btn-icon" title="Toggle Light / Dark mode" aria-label="Toggle theme">
          <i class="ph ph-moon"></i>
        </button>
        <button id="exportCsvBtn" class="btn btn-secondary" title="Export Excel / CSV">
          <i class="ph ph-file-csv"></i>
          <span>Export CSV</span>
        </button>
        <button id="addExpenseBtn" class="btn btn-primary">
          <i class="ph ph-plus-circle"></i>
          <span>Add Expense</span>
        </button>
      </div>
    </div>
  </header>

  <!-- Main Content Container -->
  <main class="main-container">

    <!-- KPI Summary Row -->
    <section class="stats-grid" aria-label="Key Performance Indicators">
      
      <div class="glass-card stat-card" style="--card-accent: #4f46e5; --stat-icon-bg: #e0e7ff;">
        <div class="stat-header">
          <span class="stat-title">Total May Expenditure</span>
          <div class="stat-icon-wrap"><i class="ph ph-chart-pie-slice"></i></div>
        </div>
        <div class="stat-value" id="totalAmount">৳ 0</div>
        <div class="stat-sub" id="totalCount">0 Entries Recorded</div>
      </div>

      <div class="glass-card stat-card" style="--card-accent: #6366f1; --stat-icon-bg: rgba(99, 102, 241, 0.15);">
        <div class="stat-header">
          <span class="stat-title">Venue (HQ 8th)</span>
          <div class="stat-icon-wrap"><i class="ph ph-buildings"></i></div>
        </div>
        <div class="stat-value" id="venueTotal">৳ 0</div>
        <div class="stat-sub">Rent, Power & Service</div>
      </div>

      <div class="glass-card stat-card" style="--card-accent: #10b981; --stat-icon-bg: rgba(16, 185, 129, 0.15);">
        <div class="stat-header">
          <span class="stat-title">Groceries & Supplies</span>
          <div class="stat-icon-wrap"><i class="ph ph-shopping-cart"></i></div>
        </div>
        <div class="stat-value" id="groceriesTotal">৳ 0</div>
        <div class="stat-sub">Pantry & Daily Water</div>
      </div>

      <div class="glass-card stat-card" style="--card-accent: #f59e0b; --stat-icon-bg: rgba(245, 158, 11, 0.15);">
        <div class="stat-header">
          <span class="stat-title">Cleaning & Janitorial</span>
          <div class="stat-icon-wrap"><i class="ph ph-broom"></i></div>
        </div>
        <div class="stat-value" id="cleaningTotal">৳ 0</div>
        <div class="stat-sub">Office Cleaning - Krishno</div>
      </div>

      <div class="glass-card stat-card" style="--card-accent: #0ea5e9; --stat-icon-bg: rgba(14, 165, 233, 0.15);">
        <div class="stat-header">
          <span class="stat-title">Utility & Equipment</span>
          <div class="stat-icon-wrap"><i class="ph ph-wrench"></i></div>
        </div>
        <div class="stat-value" id="utilityTotal">৳ 0</div>
        <div class="stat-sub">ISP, Hardware & AC</div>
      </div>

    </section>

    <!-- Visual Dashboard: Donut Chart + Category Breakdown -->
    <section class="dashboard-grid">
      
      <!-- Chart Card -->
      <div class="glass-card chart-card">
        <div class="card-title-row">
          <h2 class="card-title">
            <i class="ph ph-chart-donut" style="color: var(--primary);"></i>
            Category Distribution
          </h2>
        </div>
        <div class="chart-container">
          <canvas id="expenseDonutChart" width="300" height="280"></canvas>
        </div>
      </div>

      <!-- Breakdown Bars Card -->
      <div class="glass-card chart-card">
        <div class="card-title-row">
          <h2 class="card-title">
            <i class="ph ph-chart-bar" style="color: var(--primary);"></i>
            Category Allocations
          </h2>
        </div>
        <div class="category-bars" id="categoryBars">
          <!-- Filled dynamically by JavaScript -->
        </div>
      </div>

    </section>

    <!-- Filter & Toolbar Section -->
    <section class="glass-card toolbar-section">
      <div class="category-tabs" id="categoryTabs">
        <button class="tab-btn active" data-category="all">All Expenses</button>
        <button class="tab-btn" data-category="Venue - Probotok Office (HQ)">Venue (HQ)</button>
        <button class="tab-btn" data-category="Groceries & Supplies">Groceries</button>
        <button class="tab-btn" data-category="Office Cleaning - Krishno">Cleaning</button>
        <button class="tab-btn" data-category="Utility/service & office equipment">Utility & Equipment</button>
      </div>

      <div class="search-wrap">
        <i class="ph ph-magnifying-glass search-icon"></i>
        <input type="text" id="searchInput" class="search-input" placeholder="Search item, vendor, service...">
      </div>
    </section>

    <!-- Expenses Table Card -->
    <section class="glass-card table-card">
      <div class="table-header-bar">
        <h2 class="card-title">
          <i class="ph ph-receipt" style="color: var(--primary);"></i>
          Ledger Transactions
        </h2>
      </div>

      <div class="table-responsive">
        <table class="custom-table" id="expensesTable">
          <thead>
            <tr>
              <th>Date</th>
              <th>Category</th>
              <th>Item / Description</th>
              <th>Vendor / Payee</th>
              <th>Qty</th>
              <th>Amount (BDT)</th>
              <th style="text-align: right;">Actions</th>
            </tr>
          </thead>
          <tbody id="expensesTableBody">
            <!-- Dynamically populated -->
          </tbody>
        </table>
      </div>

      <!-- Empty State -->
      <div id="emptyState" class="empty-state" style="display: none;">
        <i class="ph ph-clipboard-text empty-icon"></i>
        <h3>No expense records found</h3>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Try adjusting your search query or category filters.</p>
      </div>
    </section>

  </main>

  <!-- Add / Edit Modal -->
  <div class="modal-overlay" id="expenseModal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Add New Expense</h3>
        <button class="modal-close" id="modalCloseBtn">&times;</button>
      </div>

      <form id="expenseForm">
        <div class="modal-body">
          <div class="form-group">
            <label class="form-label" for="inputCategory">Category *</label>
            <select id="inputCategory" class="form-select" required>
              <option value="Venue - Probotok Office (HQ)">Venue - Probotok Office (HQ)</option>
              <option value="Groceries & Supplies">Groceries & Supplies</option>
              <option value="Office Cleaning - Krishno">Office Cleaning - Krishno</option>
              <option value="Utility/service & office equipment">Utility/service & office equipment</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="inputItemName">Item / Expense Name *</label>
            <input type="text" id="inputItemName" class="form-input" placeholder="e.g. Electricity Bill, Coffee Supplies" required>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="inputAmount">Amount (BDT) *</label>
              <input type="number" id="inputAmount" class="form-input" placeholder="0.00" step="any" required min="1">
            </div>
            <div class="form-group">
              <label class="form-label" for="inputQty">Quantity</label>
              <input type="number" id="inputQty" class="form-input" value="1" min="1">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="inputDate">Date *</label>
              <input type="date" id="inputDate" class="form-input" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="inputServiceType">Service / Expense Type</label>
              <input type="text" id="inputServiceType" class="form-input" placeholder="e.g. Utility, Hardware, Pantry">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="inputVendor">Vendor / Person Name</label>
            <input type="text" id="inputVendor" class="form-input" placeholder="e.g. Dot Internet, Krishno, Ryans">
          </div>

          <div class="form-group">
            <label class="form-label" for="inputNotes">Notes / Description</label>
            <textarea id="inputNotes" class="form-textarea" rows="2" placeholder="Optional notes..."></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
          <button type="submit" class="btn btn-primary" id="saveExpenseBtn">
            <i class="ph ph-floppy-disk"></i>
            <span>Save Expense</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Toast Notification Container -->
  <div class="toast-container" id="toastContainer"></div>

  <!-- Footer -->
  <footer class="app-footer">
    <div>B&F Corporate Expense Tracker &bull; Powered by PHP 8 & Local Server &bull; Data synchronized with <code>Expense -  2026.xlsx</code></div>
  </footer>

  <!-- App Script -->
  <script src="assets/js/app.js"></script>
</body>
</html>
