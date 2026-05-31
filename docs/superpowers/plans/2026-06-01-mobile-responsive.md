# Mobile Responsive Enhancement Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Fix mobile responsiveness gaps in the Samhah Farm admin panel across all pages for smartphones (360–430px) and tablets (768px).

**Architecture:** All changes are pure CSS and HTML attribute additions to existing Blade templates. No new files, no backend changes, no build step required — Blade templates serve inline CSS and the `hide-mobile` utility class is already defined in the shared layout.

**Tech Stack:** Laravel Blade templates, custom inline CSS (in `layouts/app.blade.php`), Chart.js (dashboard only)

---

## File Map

| File | Change |
|------|--------|
| `resources/views/admin/layouts/app.blade.php` | Add `form-actions` CSS, update `page-header-actions` mobile rule, add `btn-group` + `form-actions` 480px rules |
| `resources/views/admin/stocks/index.blade.php` | Add `hide-mobile` to `#` and `Catatan` columns (th + td) |
| `resources/views/admin/transactions/index.blade.php` | Add `hide-mobile` to `Kode` column (th + td) |
| `resources/views/admin/configs/index.blade.php` | Add `hide-mobile` to `Deskripsi` and `Dibuat` columns (th + td) |
| `resources/views/admin/dashboard.blade.php` | Add `@push('styles')` with chart height 480px override |

---

## Task 1: Add `form-actions` base CSS class

**Files:**
- Modify: `resources/views/admin/layouts/app.blade.php`

`form-actions` is used in `transactions/create.blade.php` but has no CSS definition — buttons render unstyled on all screen sizes.

- [ ] **Step 1: Locate insertion point**

  Open `resources/views/admin/layouts/app.blade.php`. Find the `.btn-group` block (around line 699):
  ```css
  .btn-group {
      display: flex;
      gap: 0.5rem;
  }
  ```

- [ ] **Step 2: Add `form-actions` class immediately after `.btn-group`**

  Insert this block right after the closing `}` of `.btn-group`:
  ```css
  .form-actions {
      display: flex;
      gap: 0.75rem;
      margin-top: 1.5rem;
      flex-wrap: wrap;
  }
  ```

- [ ] **Step 3: Verify the class exists**

  Grep to confirm:
  ```bash
  grep -n "form-actions" resources/views/admin/layouts/app.blade.php
  ```
  Expected: at least one result showing the new CSS definition.

- [ ] **Step 4: Commit**

  ```bash
  git add resources/views/admin/layouts/app.blade.php
  git commit -m "fix: add missing form-actions CSS class"
  ```

---

## Task 2: Update `page-header-actions` mobile rule

**Files:**
- Modify: `resources/views/admin/layouts/app.blade.php`

Currently at `max-width: 1024px`, each button in `page-header-actions` is forced to 100% width and stacks vertically. Pages with two buttons (Export + Tambah) should keep them side-by-side — Tambah takes remaining space.

- [ ] **Step 1: Locate the existing rule**

  In `app.blade.php`, find the `@media (max-width: 1024px)` block. It contains:
  ```css
  .page-header-actions {
      width: 100%;
  }

  .page-header-actions .btn {
      width: 100%;
      justify-content: center;
  }
  ```

- [ ] **Step 2: Replace those two rules**

  Replace both rules above with:
  ```css
  .page-header-actions {
      width: 100%;
      display: flex;
      gap: 0.5rem;
  }

  .page-header-actions .btn:last-child {
      flex: 1;
      justify-content: center;
  }
  ```

  Note: The selector changes from `.btn` (all buttons) to `.btn:last-child` (primary action only). This makes Export keep its natural width while Tambah expands to fill remaining space.

- [ ] **Step 3: Verify the change**

  ```bash
  grep -A4 "page-header-actions" resources/views/admin/layouts/app.blade.php
  ```
  Expected: new rules with `display: flex` and `btn:last-child`.

- [ ] **Step 4: Commit**

  ```bash
  git add resources/views/admin/layouts/app.blade.php
  git commit -m "fix: keep page-header action buttons side-by-side on mobile"
  ```

---

## Task 3: Add `btn-group` and `form-actions` 480px mobile rules

**Files:**
- Modify: `resources/views/admin/layouts/app.blade.php`

On very small screens (360–480px), form submit/cancel button groups should stack full-width for easier tapping.

- [ ] **Step 1: Locate the `@media (max-width: 480px)` block**

  In `app.blade.php`, find the `@media (max-width: 480px)` block. It currently ends with `.card-footer { padding: 0.75rem; }`.

- [ ] **Step 2: Add rules at the end of that block, before the closing `}`**

  ```css
  .btn-group,
  .form-actions {
      flex-direction: column;
  }

  .btn-group .btn,
  .form-actions .btn {
      width: 100%;
      justify-content: center;
  }
  ```

- [ ] **Step 3: Verify**

  ```bash
  grep -n "btn-group\|form-actions" resources/views/admin/layouts/app.blade.php
  ```
  Expected: definitions in the base section and in the 480px media query.

- [ ] **Step 4: Commit**

  ```bash
  git add resources/views/admin/layouts/app.blade.php
  git commit -m "fix: stack form button groups full-width on small screens"
  ```

---

## Task 4: Hide non-essential columns in Stocks table

**Files:**
- Modify: `resources/views/admin/stocks/index.blade.php`

At ≤480px, hide `#` (row number) and `Catatan` columns. The `hide-mobile` class (`display: none !important`) is already defined in `app.blade.php`.

- [ ] **Step 1: Update the `<thead>` row**

  Find:
  ```html
  <th>#</th>
  ```
  Replace with:
  ```html
  <th class="hide-mobile">#</th>
  ```

  Find:
  ```html
  <th>Catatan</th>
  ```
  Replace with:
  ```html
  <th class="hide-mobile">Catatan</th>
  ```

- [ ] **Step 2: Update the `<tbody>` rows**

  Find:
  ```html
  <td class="text-muted">{{ $stocks->firstItem() + $index }}</td>
  ```
  Replace with:
  ```html
  <td class="text-muted hide-mobile">{{ $stocks->firstItem() + $index }}</td>
  ```

  Find:
  ```html
  <td class="text-muted">{{ Str::limit($stock->notes, 25) ?: '-' }}</td>
  ```
  Replace with:
  ```html
  <td class="text-muted hide-mobile">{{ Str::limit($stock->notes, 25) ?: '-' }}</td>
  ```

- [ ] **Step 3: Verify both th and td have hide-mobile**

  ```bash
  grep -n "hide-mobile" resources/views/admin/stocks/index.blade.php
  ```
  Expected: 4 lines (2 `<th>`, 2 `<td>`).

- [ ] **Step 4: Commit**

  ```bash
  git add resources/views/admin/stocks/index.blade.php
  git commit -m "fix: hide non-essential columns on mobile in stocks table"
  ```

---

## Task 5: Hide non-essential columns in Transactions table

**Files:**
- Modify: `resources/views/admin/transactions/index.blade.php`

At ≤480px, hide `Kode` column (transaction code). Customer name + Total are the essential info.

- [ ] **Step 1: Update the `<thead>` row**

  Find:
  ```html
  <th>Kode</th>
  ```
  Replace with:
  ```html
  <th class="hide-mobile">Kode</th>
  ```

- [ ] **Step 2: Update the `<tbody>` rows**

  Find:
  ```html
  <td>
                                          <code style="background: var(--light-gray); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">
                                              {{ $transaction->transaction_code }}
                                          </code>
                                      </td>
  ```
  Replace with:
  ```html
  <td class="hide-mobile">
                                          <code style="background: var(--light-gray); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">
                                              {{ $transaction->transaction_code }}
                                          </code>
                                      </td>
  ```

- [ ] **Step 3: Verify**

  ```bash
  grep -n "hide-mobile" resources/views/admin/transactions/index.blade.php
  ```
  Expected: 2 lines (1 `<th>`, 1 `<td>`).

- [ ] **Step 4: Commit**

  ```bash
  git add resources/views/admin/transactions/index.blade.php
  git commit -m "fix: hide transaction code column on mobile"
  ```

---

## Task 6: Hide non-essential columns in Configs table

**Files:**
- Modify: `resources/views/admin/configs/index.blade.php`

At ≤480px, hide `Deskripsi` and `Dibuat` columns. Key, Label, Status, and Aksi are sufficient.

- [ ] **Step 1: Update the `<thead>` row**

  Find:
  ```html
  <th>Deskripsi</th>
  ```
  Replace with:
  ```html
  <th class="hide-mobile">Deskripsi</th>
  ```

  Find:
  ```html
  <th>Dibuat</th>
  ```
  Replace with:
  ```html
  <th class="hide-mobile">Dibuat</th>
  ```

- [ ] **Step 2: Update the `<tbody>` rows**

  Find:
  ```html
  <td class="text-muted">{{ $config->description ?: '-' }}</td>
  ```
  Replace with:
  ```html
  <td class="text-muted hide-mobile">{{ $config->description ?: '-' }}</td>
  ```

  Find:
  ```html
  <td class="text-muted whitespace-nowrap">{{ $config->created_at->format('d M Y') }}</td>
  ```
  Replace with:
  ```html
  <td class="text-muted whitespace-nowrap hide-mobile">{{ $config->created_at->format('d M Y') }}</td>
  ```

- [ ] **Step 3: Verify**

  ```bash
  grep -n "hide-mobile" resources/views/admin/configs/index.blade.php
  ```
  Expected: 4 lines (2 `<th>`, 2 `<td>`).

- [ ] **Step 4: Commit**

  ```bash
  git add resources/views/admin/configs/index.blade.php
  git commit -m "fix: hide description and date columns on mobile in configs table"
  ```

---

## Task 7: Reduce dashboard chart height on small screens

**Files:**
- Modify: `resources/views/admin/dashboard.blade.php`

The chart container is fixed at 300px. At 360–480px, 220px gives enough chart space without dominating the screen.

- [ ] **Step 1: Add `@push('styles')` block before `@push('scripts')`**

  In `dashboard.blade.php`, find the line:
  ```blade
  @push('scripts')
  ```

  Insert this block immediately before it:
  ```blade
  @push('styles')
  <style>
      @media (max-width: 480px) {
          .chart-container { height: 220px !important; }
      }
  </style>
  @endpush
  ```

  Note: Blade does not treat `@media` as a directive, so no escaping needed in modern Laravel.

- [ ] **Step 2: Verify**

  ```bash
  grep -n "push\|chart-container" resources/views/admin/dashboard.blade.php
  ```
  Expected: `@push('styles')` block with `chart-container` rule, followed by `@push('scripts')`.

- [ ] **Step 3: Commit**

  ```bash
  git add resources/views/admin/dashboard.blade.php
  git commit -m "fix: reduce chart height on small mobile screens"
  ```

---

## Task 8: Final verification

- [ ] **Step 1: Start the dev server**

  ```bash
  php artisan serve
  ```

- [ ] **Step 2: Open browser DevTools → Toggle device toolbar**

  Test each page at these widths: **375px** (iPhone SE), **430px** (iPhone 15 Pro Max), **768px** (iPad).

- [ ] **Step 3: Verify per page**

  | Page | What to check |
  |------|--------------|
  | `/admin/login` | Card fits without overflow, fields full-width |
  | `/admin/dashboard` | Stats grid 1-col at 375px, chart shorter at 375px |
  | `/admin/stocks` | Header buttons side-by-side, `#` and `Catatan` columns hidden at 375px |
  | `/admin/stocks/create` | Form buttons stack full-width at 375px |
  | `/admin/transactions` | Header buttons side-by-side, `Kode` column hidden at 375px |
  | `/admin/transactions/create` | form-actions buttons display correctly and stack at 375px |
  | `/admin/configs` | `Deskripsi` and `Dibuat` columns hidden at 375px |

- [ ] **Step 4: No visual regressions at 1280px desktop**

  Widen browser to 1280px and spot-check each page — layout should be identical to before.
