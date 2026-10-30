// B&F Corporate Expense Tracker - App Logic
document.addEventListener('DOMContentLoaded', () => {
  let allExpenses = [];
  let currentCategory = 'all';
  let searchQuery = '';
  let editingId = null;

  // DOM Elements
  const themeToggleBtn = document.getElementById('themeToggleBtn');
  const addExpenseBtn = document.getElementById('addExpenseBtn');
  const expenseModal = document.getElementById('expenseModal');
  const modalCloseBtn = document.getElementById('modalCloseBtn');
  const cancelBtn = document.getElementById('cancelBtn');
  const expenseForm = document.getElementById('expenseForm');
  const modalTitle = document.getElementById('modalTitle');
  const searchInput = document.getElementById('searchInput');
  const categoryTabs = document.getElementById('categoryTabs');
  const expensesTableBody = document.getElementById('expensesTableBody');
  const emptyState = document.getElementById('emptyState');
  const toastContainer = document.getElementById('toastContainer');
  const exportCsvBtn = document.getElementById('exportCsvBtn');

  // KPI elements
  const totalAmountEl = document.getElementById('totalAmount');
  const totalCountEl = document.getElementById('totalCount');
  const venueTotalEl = document.getElementById('venueTotal');
  const groceriesTotalEl = document.getElementById('groceriesTotal');
  const cleaningTotalEl = document.getElementById('cleaningTotal');
  const utilityTotalEl = document.getElementById('utilityTotal');
  const categoryBarsEl = document.getElementById('categoryBars');

  // Initialize Theme
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

  // Toast notifications
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

  // Fetch data from api.php
  async function loadExpenses() {
    try {
      const res = await fetch('api.php?action=list');
      const data = await res.json();
      if (data.status === 'success') {
        allExpenses = data.data || [];
        updateDashboard(data);
        renderFilteredTable();
        renderDonutChart(allExpenses);
        renderCategoryProgress(data.categoryTotals, data.totalAmount);
      }
    } catch (err) {
      console.error('Failed to load expenses:', err);
      showToast('Error loading expense records', 'error');
    }
  }

  function formatCurrency(num) {
    return '৳ ' + Number(num || 0).toLocaleString('en-IN', { maximumFractionDigits: 0 });
  }

  // Update summary KPI metrics
  function updateDashboard(summary) {
    totalAmountEl.textContent = formatCurrency(summary.totalAmount);
    totalCountEl.textContent = summary.totalCount + ' Entries';

    const catTotals = summary.categoryTotals || {};
    venueTotalEl.textContent = formatCurrency(catTotals['Venue - Probotok Office (HQ)'] || 0);
    groceriesTotalEl.textContent = formatCurrency(catTotals['Groceries & Supplies'] || 0);
    cleaningTotalEl.textContent = formatCurrency(catTotals['Office Cleaning - Krishno'] || 0);
    utilityTotalEl.textContent = formatCurrency(catTotals['Utility/service & office equipment'] || 0);
  }

  // Render Category Breakdown Bars
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

  // Render Donut Chart using HTML5 Canvas
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
      'Office Cleaning - Krishno': { amount: 0, color: '#f59e0b' },
      'Utility/service & office equipment': { amount: 0, color: '#0ea5e9' }
    };

    let total = 0;
    expenses.forEach(e => {
      const amt = parseFloat(e.amount) || 0;
      if (categories[e.category]) {
        categories[e.category].amount += amt;
      } else {
        categories['Utility/service & office equipment'].amount += amt;
      }
      total += amt;
    });

    const centerX = width / 2;
    const centerY = height / 2;
    const outerRadius = Math.min(centerX, centerY) - 20;
    const innerRadius = outerRadius * 0.62;

    if (total === 0) {
      // Empty placeholder ring
      ctx.beginPath();
      ctx.arc(centerX, centerY, outerRadius, 0, 2 * Math.PI);
      ctx.arc(centerX, centerY, innerRadius, 2 * Math.PI, 0, true);
      ctx.fillStyle = '#e2e8f0';
      ctx.fill();
      return;
    }

    let startAngle = -Math.PI / 2;
    Object.values(categories).forEach(cat => {
      const sliceAngle = (cat.amount / total) * 2 * Math.PI;
      if (sliceAngle > 0) {
        ctx.beginPath();
        ctx.arc(centerX, centerY, outerRadius, startAngle, startAngle + sliceAngle);
        ctx.arc(centerX, centerY, innerRadius, startAngle + sliceAngle, startAngle, true);
        ctx.closePath();
        ctx.fillStyle = cat.color;
        ctx.fill();
        startAngle += sliceAngle;
      }
    });

    // Inner text summary
    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    ctx.fillStyle = isDark ? '#94a3b8' : '#64748b';
    ctx.font = '600 12px Plus Jakarta Sans, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('TOTAL EXPENDITURE', centerX, centerY - 10);

    ctx.fillStyle = isDark ? '#f8fafc' : '#0f172a';
    ctx.font = 'bold 18px Plus Jakarta Sans, sans-serif';
    ctx.fillText(formatCurrency(total), centerX, centerY + 16);
  }

  // Filter and display expenses table
  function renderFilteredTable() {
    let filtered = allExpenses.filter(item => {
      const matchesCat = currentCategory === 'all' || item.category === currentCategory;
      const q = searchQuery.toLowerCase();
      const matchesSearch = !q || 
        (item.itemName && item.itemName.toLowerCase().includes(q)) ||
        (item.vendorOrPerson && item.vendorOrPerson.toLowerCase().includes(q)) ||
        (item.serviceType && item.serviceType.toLowerCase().includes(q)) ||
        (item.notes && item.notes.toLowerCase().includes(q));
      return matchesCat && matchesSearch;
    });

    expensesTableBody.innerHTML = '';

    if (filtered.length === 0) {
      emptyState.style.display = 'flex';
      return;
    }
    emptyState.style.display = 'none';

    filtered.forEach(exp => {
      const tr = document.createElement('tr');

      let badgeClass = 'badge-venue';
      if (exp.category === 'Groceries & Supplies') badgeClass = 'badge-groceries';
      else if (exp.category === 'Office Cleaning - Krishno') badgeClass = 'badge-cleaning';
      else if (exp.category === 'Utility/service & office equipment') badgeClass = 'badge-utility';

      tr.innerHTML = `
        <td style="white-space: nowrap; font-weight: 500; color: var(--text-muted);">${exp.date || '-'}</td>
        <td>
          <span class="badge ${badgeClass}">${exp.category}</span>
        </td>
        <td>
          <div style="font-weight: 600; color: var(--text-main);">${escapeHtml(exp.itemName)}</div>
          ${exp.notes ? `<div style="font-size: 0.78rem; color: var(--text-muted);">${escapeHtml(exp.notes)}</div>` : ''}
        </td>
        <td style="color: var(--text-muted);">${escapeHtml(exp.vendorOrPerson || '-')}</td>
        <td style="color: var(--text-muted);">${exp.qty || 1}</td>
        <td style="font-weight: 700; color: var(--text-main);">${formatCurrency(exp.amount)}</td>
        <td>
          <div class="action-btn-group">
            <button class="table-btn edit-btn" data-id="${exp.id}" title="Edit Expense">
              <i class="ph ph-pencil-simple"></i>
            </button>
            <button class="table-btn delete-btn" data-id="${exp.id}" title="Delete Expense">
              <i class="ph ph-trash"></i>
            </button>
          </div>
        </td>
      `;

      expensesTableBody.appendChild(tr);
    });

    // Attach row events
    document.querySelectorAll('.edit-btn').forEach(b => {
      b.addEventListener('click', () => openEditModal(b.dataset.id));
    });
    document.querySelectorAll('.delete-btn').forEach(b => {
      b.addEventListener('click', () => confirmDelete(b.dataset.id));
    });
  }

  function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }

  // Tabs filtering
  categoryTabs.addEventListener('click', e => {
    if (e.target.classList.contains('tab-btn')) {
      document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
      e.target.classList.add('active');
      currentCategory = e.target.dataset.category;
      renderFilteredTable();
    }
  });

  // Search input
  searchInput.addEventListener('input', e => {
    searchQuery = e.target.value.trim();
    renderFilteredTable();
  });

  // Modal open/close
  function openModal(isEdit = false) {
    editingId = isEdit ? editingId : null;
    modalTitle.textContent = isEdit ? 'Edit Expense Record' : 'Add New Expense';
    expenseModal.classList.add('active');
  }

  function closeModal() {
    expenseModal.classList.remove('active');
    expenseForm.reset();
    editingId = null;
  }

  addExpenseBtn.addEventListener('click', () => {
    expenseForm.reset();
    document.getElementById('inputDate').value = new Date().toISOString().split('T')[0];
    openModal(false);
  });

  modalCloseBtn.addEventListener('click', closeModal);
  cancelBtn.addEventListener('click', closeModal);

  expenseModal.addEventListener('click', e => {
    if (e.target === expenseModal) closeModal();
  });

  function openEditModal(id) {
    const item = allExpenses.find(x => x.id === id);
    if (!item) return;

    editingId = id;
    document.getElementById('inputCategory').value = item.category;
    document.getElementById('inputItemName').value = item.itemName;
    document.getElementById('inputAmount').value = item.amount;
    document.getElementById('inputQty').value = item.qty || 1;
    document.getElementById('inputDate').value = item.date;
    document.getElementById('inputVendor').value = item.vendorOrPerson || '';
    document.getElementById('inputServiceType').value = item.serviceType || '';
    document.getElementById('inputNotes').value = item.notes || '';

    openModal(true);
  }

  // Handle Form Submit (Add or Update)
  expenseForm.addEventListener('submit', async e => {
    e.preventDefault();

    const payload = {
      category: document.getElementById('inputCategory').value,
      itemName: document.getElementById('inputItemName').value,
      amount: parseFloat(document.getElementById('inputAmount').value),
      qty: parseInt(document.getElementById('inputQty').value, 10) || 1,
      date: document.getElementById('inputDate').value,
      vendorOrPerson: document.getElementById('inputVendor').value,
      serviceType: document.getElementById('inputServiceType').value,
      notes: document.getElementById('inputNotes').value
    };

    try {
      let res;
      if (editingId) {
        payload.id = editingId;
        res = await fetch('api.php?action=update', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });
      } else {
        res = await fetch('api.php?action=add', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });
      }

      const result = await res.json();
      if (result.status === 'success') {
        showToast(editingId ? 'Expense updated successfully!' : 'New expense added successfully!');
        closeModal();
        await loadExpenses();
      } else {
        showToast(result.message || 'Operation failed', 'error');
      }
    } catch (err) {
      console.error(err);
      showToast('Network error, please try again', 'error');
    }
  });

  // Handle Delete
  async function confirmDelete(id) {
    if (!confirm('Are you sure you want to delete this expense record?')) return;

    try {
      const res = await fetch('api.php?action=delete', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
      });
      const result = await res.json();
      if (result.status === 'success') {
        showToast('Expense record deleted');
        await loadExpenses();
      } else {
        showToast(result.message || 'Failed to delete', 'error');
      }
    } catch (err) {
      console.error(err);
      showToast('Error deleting item', 'error');
    }
  }

  // CSV Export Trigger
  exportCsvBtn.addEventListener('click', () => {
    window.location.href = 'api.php?action=export_csv';
  });

  // Initial Load
  loadExpenses();
});
