# Mobile Responsive Enhancement — Samhah Farm Admin Panel

**Date:** 2026-06-01
**Scope:** Admin panel frontend (Laravel Blade + custom CSS)
**Approach:** Targeted fixes — patch specific gaps, preserve existing solid foundation

---

## Context

The admin panel at `resources/views/admin/` uses a custom CSS layout in `layouts/app.blade.php`. It already has responsive foundations: sidebar toggle on mobile, stats grid collapsing, and basic media queries. This spec addresses the remaining gaps for smartphones (360–430px) and tablets (768px).

---

## Changes

### 1. CSS Fixes in `app.blade.php`

**1a. Define missing `form-actions` class**

`form-actions` is used in `transactions/create.blade.php` but has no CSS definition. Buttons are unstyled/unlaid-out on all screens.

```css
.form-actions {
  display: flex;
  gap: 0.75rem;
  margin-top: 1.5rem;
  flex-wrap: wrap;
}
@media (max-width: 480px) {
  .form-actions { flex-direction: column; }
  .form-actions .btn { width: 100%; justify-content: center; }
}
```

**1b. `btn-group` mobile stacking**

The Submit + Cancel button group in `stocks/create.blade.php` should stack full-width on very small screens.

```css
@media (max-width: 480px) {
  .btn-group { flex-direction: column; }
  .btn-group .btn { width: 100%; justify-content: center; }
}
```

**1c. `page-header-actions` side-by-side on mobile**

On pages with two action buttons (Export + Tambah), keep them side-by-side on mobile instead of full-width stacked. Tambah (last button) gets flex: 1 to be more prominent.

```css
@media (max-width: 768px) {
  .page-header-actions {
    display: flex;
    gap: 0.5rem;
    width: 100%;
  }
  .page-header-actions .btn:last-child {
    flex: 1;
    justify-content: center;
  }
}
```

---

### 2. Table Column Hiding (hide-mobile)

Add `class="hide-mobile"` to `<th>` and corresponding `<td>` elements for non-essential columns at ≤480px. The `hide-mobile` class is already defined in base CSS as `display: none !important`.

| File | Columns to hide |
|------|----------------|
| `stocks/index.blade.php` | `#`, `Catatan` |
| `transactions/index.blade.php` | `Kode` |
| `configs/index.blade.php` | `Deskripsi`, `Dibuat` |

Essential columns kept visible: Produk/Customer, type info, quantity, price/total, Aksi.

---

### 3. Dashboard Chart Height

Reduce chart container height at ≤480px from 300px to 220px. This fix goes in `dashboard.blade.php` via `@push('styles')`, not in the shared CSS.

```css
@media (max-width: 480px) {
  .chart-container { height: 220px !important; }
}
```

---

## Out of Scope

- Login page — already responsive, no changes needed
- Table layout approach — keeping horizontal scroll (not card-based)
- CSS architecture refactor — deferred, existing structure is sufficient
- Swipe gesture hints, touch target enlargement — deferred

---

## Files to Change

1. `resources/views/admin/layouts/app.blade.php` — add CSS for `form-actions`, `btn-group` mobile, `page-header-actions` mobile
2. `resources/views/admin/stocks/index.blade.php` — add `hide-mobile` to `#` and `Catatan` columns
3. `resources/views/admin/transactions/index.blade.php` — add `hide-mobile` to `Kode` column
4. `resources/views/admin/configs/index.blade.php` — add `hide-mobile` to `Deskripsi` and `Dibuat` columns
5. `resources/views/admin/dashboard.blade.php` — add chart height media query
