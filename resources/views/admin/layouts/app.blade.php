<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#2E7D32">
    <title>@yield('title', 'Admin') - Samhah Farm</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <style>
        /* =========================================
           CSS Variables & Reset
           ========================================= */
        :root {
            --primary-green: #2E7D32;
            --soft-green: #81C784;
            --light-green: #E8F5E9;
            --primary-orange: #E65100;
            --soft-orange: #FFB74D;
            --light-orange: #FFF3E0;
            --white: #FFFFFF;
            --off-white: #FAFAFA;
            --light-gray: #F5F5F5;
            --border-gray: #E5E7EB;
            --gray: #9E9E9E;
            --dark-gray: #424242;
            --text-dark: #1F2937;
            --text-muted: #6B7280;
            --danger: #DC2626;
            --danger-light: #FEF2F2;
            --success: #16A34A;
            --success-light: #F0FDF4;
            --warning: #F59E0B;
            --warning-light: #FFFBEB;
            --info: #0EA5E9;
            --info-light: #F0F9FF;
            
            --shadow-xs: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 14px;
            --radius-xl: 18px;
            
            --sidebar-width: 260px;
            --topbar-height: 64px;
            
            --transition-fast: 150ms ease;
            --transition-normal: 250ms ease;
        }

        * { 
            box-sizing: border-box; 
            margin: 0; 
            padding: 0; 
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #F3F4F6;
            min-height: 100vh;
            color: var(--text-dark);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        /* =========================================
           Layout Structure
           ========================================= */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* =========================================
           Sidebar
           ========================================= */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-green) 0%, #1B5E20 100%);
            color: var(--white);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 200;
            display: flex;
            flex-direction: column;
            transition: transform var(--transition-normal);
        }

        .sidebar-header {
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            min-height: 64px;
        }

        .sidebar-header img {
            height: 36px;
            width: auto;
            filter: brightness(0) invert(1);
        }

        .sidebar-header .brand-text {
            display: flex;
            flex-direction: column;
        }

        .sidebar-header .brand-name {
            font-weight: 700;
            font-size: 1rem;
            color: var(--white);
            line-height: 1.2;
        }

        .sidebar-header .brand-subtitle {
            font-size: 0.7rem;
            color: var(--soft-orange);
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
            overflow-y: auto;
        }

        .nav-section {
            padding: 0.5rem 1.5rem;
            margin-top: 0.5rem;
        }

        .nav-section-title {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.5);
            margin-bottom: 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            transition: all var(--transition-fast);
            border-left: 3px solid transparent;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.08);
            color: var(--white);
        }

        .nav-item.active {
            background: rgba(255,255,255,0.12);
            color: var(--white);
            border-left-color: var(--soft-orange);
        }

        .nav-item .nav-icon {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .nav-item .nav-badge {
            margin-left: auto;
            background: var(--soft-orange);
            color: var(--text-dark);
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.15rem 0.5rem;
            border-radius: 9999px;
        }

        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.1);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .sidebar-user-avatar {
            width: 36px;
            height: 36px;
            background: var(--soft-orange);
            color: var(--text-dark);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .sidebar-user-info {
            flex: 1;
            min-width: 0;
        }

        .sidebar-user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--white);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.6);
        }

        /* =========================================
           Mobile Overlay
           ========================================= */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 150;
            opacity: 0;
            transition: opacity var(--transition-normal);
        }

        .sidebar-overlay.active {
            opacity: 1;
        }

        /* =========================================
           Main Content
           ========================================= */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left var(--transition-normal);
        }

        /* =========================================
           Topbar
           ========================================= */
        .topbar {
            background: var(--white);
            height: var(--topbar-height);
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            box-shadow: var(--shadow-xs);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border-gray);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mobile-menu-btn {
            display: none;
            width: 40px;
            height: 40px;
            border: none;
            background: var(--light-gray);
            border-radius: var(--radius-sm);
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: background var(--transition-fast);
        }

        .mobile-menu-btn:hover {
            background: var(--border-gray);
        }

        .mobile-menu-btn svg {
            width: 20px;
            height: 20px;
            color: var(--text-dark);
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .topbar-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: transparent;
            border-radius: var(--radius-sm);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background var(--transition-fast);
            color: var(--text-muted);
            position: relative;
        }

        .topbar-btn:hover {
            background: var(--light-gray);
            color: var(--text-dark);
        }

        .topbar-btn svg {
            width: 20px;
            height: 20px;
        }

        /* =========================================
           Content Area
           ========================================= */
        .content-area {
            flex: 1;
            padding: 1.5rem;
        }

        /* =========================================
           Page Header
           ========================================= */
        .page-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .page-header-left h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .page-header-left p {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .breadcrumb a {
            color: var(--primary-green);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* =========================================
           Cards
           ========================================= */
        .card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-gray);
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-gray);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            background: var(--off-white);
        }

        .card-header h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-body.p-0 {
            padding: 0;
        }

        .card-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-gray);
            background: var(--off-white);
        }

        /* =========================================
           Stats Grid
           ========================================= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-gray);
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: all var(--transition-fast);
        }

        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .stat-icon.green { 
            background: linear-gradient(135deg, var(--light-green), #C8E6C9);
        }
        .stat-icon.orange { 
            background: linear-gradient(135deg, var(--light-orange), #FFE0B2);
        }
        .stat-icon.blue {
            background: linear-gradient(135deg, var(--info-light), #BAE6FD);
        }

        .stat-content {
            flex: 1;
            min-width: 0;
        }

        .stat-content h4 {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 0.25rem;
        }

        .stat-content .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .stat-content .stat-change {
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-top: 0.25rem;
        }

        .stat-change.up { color: var(--success); }
        .stat-change.down { color: var(--danger); }

        /* =========================================
           Table
           ========================================= */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.875rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-gray);
            white-space: nowrap;
        }

        th {
            background: var(--off-white);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
        }

        td {
            font-size: 0.875rem;
            color: var(--text-dark);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tbody tr {
            transition: background var(--transition-fast);
        }

        tbody tr:hover {
            background: var(--off-white);
        }

        .table-product {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .table-product-icon {
            width: 40px;
            height: 40px;
            background: var(--light-green);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .table-product-info {
            min-width: 0;
        }

        .table-product-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        .table-product-meta {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* =========================================
           Buttons
           ========================================= */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: var(--radius-sm);
            border: none;
            cursor: pointer;
            transition: all var(--transition-fast);
            text-decoration: none;
            white-space: nowrap;
            font-family: inherit;
        }

        .btn-primary {
            background: var(--primary-green);
            color: var(--white);
        }

        .btn-primary:hover {
            background: #1B5E20;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
        }

        .btn-secondary {
            background: var(--white);
            color: var(--text-dark);
            border: 1px solid var(--border-gray);
        }

        .btn-secondary:hover {
            background: var(--light-gray);
            border-color: var(--gray);
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-muted);
        }

        .btn-ghost:hover {
            background: var(--light-gray);
            color: var(--text-dark);
        }

        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background: #B91C1C;
        }

        .btn-danger-outline {
            background: transparent;
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        .btn-danger-outline:hover {
            background: var(--danger-light);
        }

        .btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
        }

        .btn-lg {
            padding: 0.875rem 1.5rem;
            font-size: 1rem;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
        }

        .btn-icon.btn-sm {
            width: 32px;
            height: 32px;
        }

        .btn-group {
            display: flex;
            gap: 0.5rem;
        }

        /* =========================================
           Forms
           ========================================= */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            color: var(--text-dark);
        }

        .form-label .required {
            color: var(--danger);
            margin-left: 0.25rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-gray);
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 0.9375rem;
            color: var(--text-dark);
            background: var(--white);
            transition: all var(--transition-fast);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.15);
        }

        .form-control::placeholder {
            color: var(--gray);
        }

        .form-control.error {
            border-color: var(--danger);
        }

        .form-control.error:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.15);
        }

        select.form-control {
            appearance: none;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23424242' d='M6 8L1 3h10z'/%3E%3C/svg%3E") no-repeat right 1rem center;
            background-color: var(--white);
            padding-right: 2.5rem;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-hint {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.375rem;
        }

        .form-error {
            font-size: 0.75rem;
            color: var(--danger);
            margin-top: 0.375rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        /* =========================================
           Alerts
           ========================================= */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.875rem;
        }

        .alert-icon {
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .alert-content {
            flex: 1;
        }

        .alert-success {
            background: var(--success-light);
            color: var(--success);
            border: 1px solid #BBF7D0;
        }

        .alert-danger {
            background: var(--danger-light);
            color: var(--danger);
            border: 1px solid #FECACA;
        }

        .alert-warning {
            background: var(--warning-light);
            color: #B45309;
            border: 1px solid #FDE68A;
        }

        .alert-info {
            background: var(--info-light);
            color: #0369A1;
            border: 1px solid #BAE6FD;
        }

        /* =========================================
           Badges
           ========================================= */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            font-size: 0.7rem;
            font-weight: 600;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .badge-green {
            background: var(--light-green);
            color: var(--primary-green);
        }

        .badge-orange {
            background: var(--light-orange);
            color: var(--primary-orange);
        }

        .badge-gray {
            background: var(--light-gray);
            color: var(--text-muted);
        }

        .badge-success {
            background: var(--success-light);
            color: var(--success);
        }

        .badge-danger {
            background: var(--danger-light);
            color: var(--danger);
        }

        /* =========================================
           Action Buttons
           ========================================= */
        .actions {
            display: flex;
            gap: 0.375rem;
        }

        /* =========================================
           Empty State
           ========================================= */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }

        .empty-state-icon {
            font-size: 4rem;
            display: block;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* =========================================
           Pagination
           ========================================= */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.375rem;
            padding: 1.25rem;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 0.75rem;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            text-decoration: none;
            font-weight: 500;
            min-width: 36px;
            text-align: center;
        }

        .pagination a {
            background: var(--white);
            color: var(--text-dark);
            border: 1px solid var(--border-gray);
            transition: all var(--transition-fast);
        }

        .pagination a:hover {
            background: var(--light-gray);
            border-color: var(--gray);
        }

        .pagination span.current {
            background: var(--primary-green);
            color: var(--white);
            border: 1px solid var(--primary-green);
        }

        .pagination span.disabled {
            background: var(--light-gray);
            color: var(--gray);
            cursor: not-allowed;
        }

        /* =========================================
           Modal / Confirm Dialog
           ========================================= */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            z-index: 300;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-normal);
        }

        .modal-backdrop.active {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background: var(--white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            max-width: 400px;
            width: 100%;
            transform: scale(0.9) translateY(20px);
            transition: transform var(--transition-normal);
            overflow: hidden;
        }

        .modal-backdrop.active .modal {
            transform: scale(1) translateY(0);
        }

        .modal-header {
            padding: 1.5rem 1.5rem 0;
            text-align: center;
        }

        .modal-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
        }

        .modal-icon.danger {
            background: var(--danger-light);
            color: var(--danger);
        }

        .modal-icon.warning {
            background: var(--warning-light);
            color: var(--warning);
        }

        .modal-icon.success {
            background: var(--success-light);
            color: var(--success);
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .modal-body {
            padding: 0.5rem 1.5rem 1.5rem;
            text-align: center;
        }

        .modal-body p {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .modal-body .item-name {
            font-weight: 600;
            color: var(--text-dark);
            background: var(--light-gray);
            padding: 0.25rem 0.5rem;
            border-radius: var(--radius-sm);
            display: inline-block;
            margin-top: 0.5rem;
        }

        .modal-footer {
            padding: 0 1.5rem 1.5rem;
            display: flex;
            gap: 0.75rem;
        }

        .modal-footer .btn {
            flex: 1;
            justify-content: center;
            padding: 0.875rem 1rem;
        }

        /* =========================================
           Toast Notifications
           ========================================= */
        .toast-container {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 400;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            max-width: 380px;
            width: calc(100% - 3rem);
            pointer-events: none;
        }

        .toast {
            background: var(--white);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: flex-start;
            gap: 0.875rem;
            padding: 1rem 1.25rem;
            pointer-events: auto;
            animation: slideInRight 0.3s ease-out;
            position: relative;
            overflow: hidden;
        }

        .toast.hiding {
            animation: slideOutRight 0.3s ease-in forwards;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        .toast-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        .toast-content {
            flex: 1;
            min-width: 0;
        }

        .toast-title {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 0.125rem;
        }

        .toast-message {
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.4;
        }

        .toast-close {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.25rem;
            color: var(--gray);
            transition: color var(--transition-fast);
            flex-shrink: 0;
        }

        .toast-close:hover {
            color: var(--text-dark);
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            animation: progressBar 4s linear forwards;
        }

        @keyframes progressBar {
            from { width: 100%; }
            to { width: 0%; }
        }

        .toast.success .toast-icon {
            background: var(--success-light);
            color: var(--success);
        }
        .toast.success .toast-progress {
            background: var(--success);
        }

        .toast.error .toast-icon {
            background: var(--danger-light);
            color: var(--danger);
        }
        .toast.error .toast-progress {
            background: var(--danger);
        }

        .toast.warning .toast-icon {
            background: var(--warning-light);
            color: var(--warning);
        }
        .toast.warning .toast-progress {
            background: var(--warning);
        }

        .toast.info .toast-icon {
            background: var(--info-light);
            color: var(--info);
        }
        .toast.info .toast-progress {
            background: var(--info);
        }

        @media (max-width: 480px) {
            .toast-container {
                top: 1rem;
                right: 1rem;
                left: 1rem;
                max-width: none;
                width: auto;
            }
        }

        /* =========================================
           Responsive - Mobile Menu
           ========================================= */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: flex;
            }

            .content-area {
                padding: 1rem;
            }

            .page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .page-header-actions {
                width: 100%;
            }

            .page-header-actions .btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 0.75rem;
            }

            .stat-card {
                padding: 0.875rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .stat-icon {
                width: 36px;
                height: 36px;
                font-size: 1.125rem;
            }

            .stat-content h4 {
                font-size: 0.7rem;
            }

            .stat-content .stat-value {
                font-size: 1.25rem;
            }

            .stat-content .stat-change {
                font-size: 0.7rem;
            }

            .card-header {
                padding: 1rem;
                flex-direction: column;
                align-items: stretch;
                gap: 0.75rem;
            }

            .card-header h3 {
                font-size: 0.9rem;
            }

            .card-header .btn {
                width: 100%;
                justify-content: center;
            }

            .card-body {
                padding: 1rem;
            }

            .card-body.p-0 {
                padding: 0 !important;
            }

            th, td {
                padding: 0.625rem 0.5rem;
                font-size: 0.75rem;
            }

            .table-product {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }

            .table-product-icon {
                width: 28px;
                height: 28px;
                font-size: 0.875rem;
            }

            .table-product-name {
                font-size: 0.8rem;
            }

            .table-product-meta {
                font-size: 0.7rem;
            }

            .actions {
                flex-direction: row;
                gap: 0.25rem;
            }

            .btn-icon.btn-sm {
                width: 28px;
                height: 28px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding: 0 1rem;
                height: 56px;
            }

            .page-title {
                font-size: 1rem;
            }

            .page-header {
                gap: 0.75rem;
                margin-bottom: 1rem;
            }

            .page-header h1 {
                font-size: 1.25rem;
            }

            .page-header p {
                font-size: 0.8rem;
            }

            .breadcrumb {
                font-size: 0.75rem;
                flex-wrap: wrap;
            }

            .empty-state {
                padding: 2rem 1rem;
            }

            .empty-state-icon {
                font-size: 3rem;
            }

            .empty-state h3 {
                font-size: 1rem;
            }

            .empty-state p {
                font-size: 0.8rem;
            }

            .badge {
                font-size: 0.65rem;
                padding: 0.2rem 0.5rem;
            }

            .alert {
                padding: 0.75rem;
                font-size: 0.8rem;
            }

            .btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.8rem;
            }

            .btn-lg {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 0.625rem;
            }

            .stat-card {
                flex-direction: row;
                align-items: center;
            }

            .content-area {
                padding: 0.75rem;
            }

            .pagination {
                gap: 0.25rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .pagination a,
            .pagination span {
                padding: 0.375rem 0.5rem;
                font-size: 0.75rem;
                min-width: 28px;
            }

            /* Hide non-essential columns on very small screens */
            .hide-mobile {
                display: none !important;
            }

            .card-footer {
                padding: 0.75rem;
            }
        }

        /* =========================================
           Utility Classes
           ========================================= */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-muted { color: var(--text-muted); }
        .text-success { color: var(--success); }
        .text-danger { color: var(--danger); }
        .font-bold { font-weight: 700; }
        .whitespace-nowrap { white-space: nowrap; }
        .mt-1 { margin-top: 0.25rem; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-4 { margin-top: 1rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-4 { margin-bottom: 1rem; }
        .hidden { display: none; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Mobile Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logo-transparent.png') }}" alt="Samhah Farm">
                <div class="brand-text">
                    <span class="brand-name">Samhah Farm</span>
                    <span class="brand-subtitle">Admin Panel</span>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Menu Utama</div>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">📊</span>
                    Dashboard
                </a>
                <a href="{{ route('admin.stocks.index') }}" class="nav-item {{ request()->routeIs('admin.stocks.*') ? 'active' : '' }}">
                    <span class="nav-icon">🐔</span>
                    Manajemen Stok
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="nav-item {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                    <span class="nav-icon">💰</span>
                    Transaksi
                </a>
                <a href="{{ route('admin.configs.index') }}" class="nav-item {{ request()->routeIs('admin.configs.*') ? 'active' : '' }}">
                    <span class="nav-icon">⚙️</span>
                    Konfigurasi
                </a>
                
                <div class="nav-section">
                    <div class="nav-section-title">Lainnya</div>
                </div>
                <a href="/" class="nav-item" target="_blank">
                    <span class="nav-icon">🌐</span>
                    Lihat Website
                </a>
            </nav>
            
            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <div class="sidebar-user-avatar">
                        {{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}
                    </div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">{{ Auth::guard('admin')->user()->name }}</div>
                        <div class="sidebar-user-role">Administrator</div>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-secondary" style="width: 100%;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 12h18M3 6h18M3 18h18"/>
                        </svg>
                    </button>
                    <h1 class="page-title">@yield('title', 'Dashboard')</h1>
                </div>
                <div class="topbar-right">
                    <a href="/" target="_blank" class="topbar-btn" title="Lihat Website">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
                        </svg>
                    </a>
                </div>
            </header>

            <div class="content-area">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal-backdrop" id="deleteModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-icon danger">
                    🗑️
                </div>
                <h3 class="modal-title">Hapus Data</h3>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="item-name" id="deleteItemName"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <script>
        // Mobile Menu Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');

        function openSidebar() {
            sidebar.classList.add('open');
            sidebarOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        mobileMenuBtn.addEventListener('click', openSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeSidebar();
                closeDeleteModal();
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 1024) closeSidebar();
        });

        // Delete Modal Functions
        let deleteForm = null;

        function openDeleteModal(formElement, itemName) {
            deleteForm = formElement;
            document.getElementById('deleteItemName').textContent = itemName || 'Item ini';
            document.getElementById('deleteModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
            document.body.style.overflow = '';
            deleteForm = null;
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteForm) {
                deleteForm.submit();
            }
        });

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // Toast Notification Functions
        function showToast(type, title, message, duration = 4000) {
            const container = document.getElementById('toastContainer');
            const icons = {
                success: '✓',
                error: '✕',
                warning: '⚠',
                info: 'ℹ'
            };
            
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <div class="toast-icon">${icons[type] || icons.info}</div>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </button>
                <div class="toast-progress"></div>
            `;
            
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.add('hiding');
                setTimeout(() => toast.remove(), 300);
            }, duration);
        }

        // Show session toasts on page load
        @if(session('success'))
            showToast('success', 'Berhasil!', @json(session('success')));
        @endif

        @if(session('error'))
            showToast('error', 'Error!', @json(session('error')));
        @endif
    </script>
    @stack('scripts')
</body>
</html>
