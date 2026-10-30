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
          <div class="brand-subtitle">Venue: Probotok Office (HQ) - 8th Floor (GitHub Pages Static Version)</div>
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
        <button id="addExpenseBtn" class="btn btn-primary" style="display: none;" title="Static demo mode">
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
          Ledger Transactions (May 2026)
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

  <!-- Toast Notification Container -->
  <div class="toast-container" id="toastContainer"></div>

  <!-- Footer -->
  <footer class="app-footer">
    <div>B&F Corporate Expense Tracker &bull; Published on GitHub Pages &bull; Public Financial Ledger</div>
  </footer>

  <!-- Static Data & App Script for GitHub Pages -->
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      let allExpenses = [];
      let currentCategory = 'all';
      let searchQuery = '';

      const themeToggleBtn = document.getElementById('themeToggleBtn');
      const searchInput = document.getElementById('searchInput');
      const categoryTabs = document.getElementById('categoryTabs');
      const expensesTableBody = document.getElementById('expensesTableBody');
      const emptyState = document.getElementById('emptyState');
      const toastContainer = document.getElementById('toastContainer');
      const exportCsvBtn = document.getElementById('exportCsvBtn');

      const totalAmountEl = document.getElementById('totalAmount');
      const totalCountEl = document.getElementById('totalCount');
      const venueTotalEl = document.getElementById('venueTotal');
      const groceriesTotalEl = document.getElementById('groceriesTotal');
      const cleaningTotalEl = document.getElementById('cleaningTotal');
      const utilityTotalEl = document.getElementById('utilityTotal');
      const categoryBarsEl = document.getElementById('categoryBars');

      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-theme', savedTheme);
      updateThemeIcon(savedTheme);

      themeToggleBtn.addEventListener('click', () => {
        const current = document.documentElement.getAttribute('data-theme') || 'light';
        const next = current === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', next);
        localStorage.setItem('theme', next);
        updateThemeIcon(next);
        renderDonutChart(allExpenses);
      });

      function updateThemeIcon(theme) {
        themeToggleBtn.innerHTML = theme === 'dark'
          ? '<i class="ph ph-sun"></i>'
          : '<i class="ph ph-moon"></i>';
      }

      function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        const icon = type === 'success' ? 'ph-check-circle' : 'ph-warning-circle';
        toast.innerHTML = `<i class="ph ${icon}"></i><span>${message}</span>`;
        toastContainer.appendChild(toast);
        setTimeout(() => {
          toast.style.opacity = '0';
          toast.style.transform = 'translateY(10px)';
          toast.style.transition = 'all 0.3s ease';
          setTimeout(() => toast.remove(), 300);
        }, 3200);
      }

      // Load expenses from static JSON file for GitHub Pages
      async function loadStaticExpenses() {
        try {
          const res = await fetch('data/expenses.json');
          const expenses = await res.json();
          allExpenses = Array.isArray(expenses) ? expenses : [];

          let totalAmount = 0;
          let categoryTotals = {};

          allExpenses.forEach(item => {
            const amt = parseFloat(item.amount || 0);
            const cat = item.category || 'Uncategorized';
            totalAmount += amt;
            categoryTotals[cat] = (categoryTotals[cat] || 0) + amt;
          });

          const summary = {
            totalAmount,
            totalCount: allExpenses.length,
            categoryTotals,
            data: allExpenses
          };

          updateDashboard(summary);
          renderFilteredTable();
          renderDonutChart(allExpenses);
          renderCategoryProgress(categoryTotals, totalAmount);
        } catch (err) {
          console.error('Failed to load static expenses:', err);
          showToast('Error loading expense records', 'error');
        }
      }

      function formatCurrency(num) {
        return '৳ ' + Number(num || 0).toLocaleString('en-IN', { maximumFractionDigits: 0 });
      }

      function updateDashboard(summary) {
        totalAmountEl.textContent = formatCurrency(summary.totalAmount);
        totalCountEl.textContent = summary.totalCount + ' Entries';

        const catTotals = summary.categoryTotals || {};
        venueTotalEl.textContent = formatCurrency(catTotals['Venue - Probotok Office (HQ)'] || 0);
        groceriesTotalEl.textContent = formatCurrency(catTotals['Groceries & Supplies'] || 0);
        cleaningTotalEl.textContent = formatCurrency(catTotals['Office Cleaning - Krishno'] || 0);
        utilityTotalEl.textContent = formatCurrency(catTotals['Utility/service & office equipment'] || 0);
      }

      function renderCategoryProgress(categoryTotals, totalAmount) {
        if (!categoryBarsEl) return;
        categoryBarsEl.innerHTML = '';
        const safeTotal = totalAmount > 0 ? totalAmount : 1;

        const categoryMeta = [
          { name: 'Venue - Probotok Office (HQ)', color: '#6366f1' },
          { name: 'Groceries & Supplies', color: '#10b981' },
          { name: 'Office Cleaning - Krishno', color: '#f59e0b' },
          { name: 'Utility/service & office equipment', color: '#0ea5e9' }
        ];

        categoryMeta.forEach(cat => {
          const amt = categoryTotals[cat.name] || 0;
          const pct = Math.round((amt / safeTotal) * 100);

          const barItem = document.createElement('div');
          barItem.className = 'bar-item';
          barItem.innerHTML = `
            <div class="bar-info">
              <span class="bar-name">
                <span class="bar-dot" style="background: ${cat.color}"></span>
                ${cat.name}
              </span>
              <span class="bar-amount">${formatCurrency(amt)} (${pct}%)</span>
            </div>
            <div class="progress-track">
              <div class="progress-fill" style="width: ${pct}%; background: ${cat.color}"></div>
            </div>
          `;
          categoryBarsEl.appendChild(barItem);
        });
      }

      function renderDonutChart(expenses) {
        const canvas = document.getElementById('expenseDonutChart');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const width = canvas.width;
        const height = canvas.height;
        ctx.clearRect(0, 0, width, height);

        const categories = {
          'Venue - Probotok Office (HQ)': { amount: 0, color: '#6366f1' },
          'Groceries & Supplies': { amount: 0, color: '#10b981' },
          'Office Cleaning - Krishno': { color: '#f59e0b' },
          'Utility/service & office equipment': { color: '#0ea5e9' }
        };

        // Re-map colors correctly
        const catMap = {
          'Venue - Probotok Office (HQ)': { amount: 0, color: '#6366f1' },
          'Groceries & Supplies': { amount: 0, color: '#10b981' },
          'Office Cleaning - Krishno': { amount: 0, color: '#f59e0b' },
          'Utility/service & office equipment': { amount: 0, color: '#0ea5e9' }
        };

        let total = 0;
        expenses.forEach(item => {
          const cat = item.category;
          const amt = parseFloat(item.amount || 0);
          if (catMap[cat]) {
            catMap[cat].amount += amt;
            total += amt;
          }
        });

        const centerX = width / 2;
        const centerY = height / 2 - 15;
        const radius = Math.min(centerX, centerY) - 20;
        const cutout = radius * 0.65;

        if (total === 0) {
          ctx.beginPath();
          ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
          ctx.fillStyle = document.documentElement.getAttribute('data-theme') === 'dark' ? '#334155' : '#e2e8f0';
          ctx.fill();
          return;
        }

        let startAngle = -0.5 * Math.PI;
        Object.values(catMap).forEach(item => {
          if (item.amount <= 0) return;
          const sliceAngle = (item.amount / total) * (2 * Math.PI);
          const endAngle = startAngle + sliceAngle;

          ctx.beginPath();
          ctx.arc(centerX, centerY, radius, startAngle, endAngle);
          ctx.arc(centerX, centerY, cutout, endAngle, startAngle, true);
          ctx.closePath();
          ctx.fillStyle = item.color;
          ctx.fill();

          startAngle = endAngle;
        });

        // Center text
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.font = '700 15px "Plus Jakarta Sans", sans-serif';
        ctx.fillStyle = document.documentElement.getAttribute('data-theme') === 'dark' ? '#f8fafc' : '#1e293b';
        ctx.fillText('May 2026', centerX, centerY - 8);

        ctx.font = '600 12px "Plus Jakarta Sans", sans-serif';
        ctx.fillStyle = document.documentElement.getAttribute('data-theme') === 'dark' ? '#94a3b8' : '#64748b';
        ctx.fillText('HQ Budget', centerX, centerY + 12);
      }

      function renderFilteredTable() {
        const filtered = allExpenses.filter(item => {
          const matchCat = currentCategory === 'all' || item.category === currentCategory;
          const q = searchQuery.toLowerCase();
          const matchSearch = !q ||
            (item.itemName && item.itemName.toLowerCase().includes(q)) ||
            (item.vendorOrPerson && item.vendorOrPerson.toLowerCase().includes(q)) ||
            (item.serviceType && item.serviceType.toLowerCase().includes(q)) ||
            (item.category && item.category.toLowerCase().includes(q)) ||
            (item.notes && item.notes.toLowerCase().includes(q));
          return matchCat && matchSearch;
        });

        expensesTableBody.innerHTML = '';
        if (filtered.length === 0) {
          emptyState.style.display = 'block';
          return;
        }
        emptyState.style.display = 'none';

        filtered.forEach(item => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td><span class="date-badge">${item.date || ''}</span></td>
            <td><span class="cat-pill">${item.category || ''}</span></td>
            <td><strong>${item.itemName || ''}</strong>${item.notes ? '<br><small style="color:var(--text-muted)">'+item.notes+'</small>' : ''}</td>
            <td>${item.vendorOrPerson || '-'}</td>
            <td>${item.qty || 1}</td>
            <td><strong>${formatCurrency(item.amount)}</strong></td>
          `;
          expensesTableBody.appendChild(tr);
        });
      }

      // Category tab clicks
      categoryTabs.addEventListener('click', (e) => {
        const btn = e.target.closest('.tab-btn');
        if (!btn) return;
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentCategory = btn.getAttribute('data-category');
        renderFilteredTable();
      });

      // Search input
      searchInput.addEventListener('input', (e) => {
        searchQuery = e.target.value.trim();
        renderFilteredTable();
      });

      // Export CSV
      exportCsvBtn.addEventListener('click', () => {
        let csv = '﻿ID,Date,Category,Item Name,Quantity,Amount (BDT),Vendor / Person,Service Type,Notes\n';
        allExpenses.forEach(exp => {
          csv += `"${exp.id || ''}","${exp.date || ''}","${exp.category || ''}","${exp.itemName || ''}",${exp.qty || 1},${exp.amount || 0},"${exp.vendorOrPerson || ''}","${exp.serviceType || ''}","${exp.notes || ''}"\n`;
        });
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'BF_Corporate_Expenses_2026.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        showToast('CSV export downloaded successfully', 'success');
      });

      // Initial load
      loadStaticExpenses();
    });
  </script>
</body>
</html>
