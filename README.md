# B&F Corporate - Company Expense Tracker

Production-ready executive expense management dashboard for B&F Corporate HQ Venue, Utilities, and Supplies (May 2026).

## Technology Stack
- **Frontend**: HTML5, Modern CSS3 with CSS Variables (Light/Dark mode), Vanilla JavaScript (ES6+), Phosphor Icons, Google Fonts (Plus Jakarta Sans).
- **Backend**: PHP 8+ RESTful JSON API (`api.php`), handling list, add, update, delete, and CSV export.
- **Database**: File-based persistent JSON storage (`data/expenses.json`) with atomic write lock (`LOCK_EX`) and UTF-8 BOM CSV export for Excel compatibility.

## Hosting & Deployment Options
This application is fully compatible with standard PHP hosting environments (Render, Railway with PHP nixpacks, Vercel with PHP runtime, or an Ubuntu/Debian VPS with Nginx/Apache + PHP 8.2+).

### Quick Deployment Guide (Render / Railway / VPS)
1. Push this repository to GitHub (`https://github.com/AiSecurityServices/Expense-tracker.git`).
2. Set the root directory or start command to point to `index.php`.
3. Ensure the `data/` directory has write permissions so runtime expense additions/edits persist properly.

## API Endpoints (`api.php`)
- `GET api.php?action=list`: Returns summary KPIs, category totals, and all expense entries.
- `POST api.php?action=add`: Adds a new expense item.
- `POST api.php?action=update`: Updates an existing expense item.
- `POST api.php?action=delete`: Deletes an expense item by ID.
- `GET api.php?action=export_csv`: Downloads CSV report formatted for Microsoft Excel.

---
🤖 Generated with [Claude Code](https://claude.com/claude-code)
