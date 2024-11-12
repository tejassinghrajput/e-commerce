<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<style>
    :root {
        --dashboard-color: #33ccff;
        --dashboard-color-hover: #0066ff;
        --text-primary: #282c3f;
        --text-secondary: #94969f;
        --bg-light: #f5f5f6;
        --shadow-sm: 0 0 4px rgba(40, 44, 63, 0.08);
        --shadow-lg: 0 2px 16px rgba(40, 44, 63, 0.15);
    }

    .sidebar {
        width: 250px;
        background: white;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .sidebar-brand {
        color: var(--dashboard-color);
        font-size: 1.5rem;
        font-weight: 700;
        text-decoration: none;
    }

    .sidebar-menu {
        padding: 20px 0;
    }

    .menu-item {
        padding: 12px 20px;
        display: flex;
        align-items: center;
        color: var(--text-primary);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .menu-item:hover, .menu-item.active {
        background: rgba(51, 204, 255, 0.1);
        color: var(--dashboard-color);
    }

    .menu-item i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .navbar {
        background: white;
        padding: 15px 100px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 30px;
    }

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
        }
    }

    .navbar-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
        transition: all 0.3s ease;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(220, 53, 69, 0.2);
    }

    .navbar .btn-outline-danger {
        padding: 0.375rem 1rem;
        font-weight: 500;
    }
    .dropbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }

    .nav-link {
        position: relative;
    }

    .nav-link.dropdown {
        margin-right: 20px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .nav-link:hover .dropdown-content {
        display: block;
    }

    #current-page-title {
        font-size: 1.5rem;
        color: var(--text-primary);
        margin-right: 20px;
    }
</style>
<template id="sidebarTemplate">
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">Vendor Panel</a>
        </div>
        <div class="sidebar-menu">
            <a href="/vendor" class="menu-item">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
            <a href="/products" class="menu-item">
                <i class="fas fa-box"></i>
                Products
            </a>
            <a href="/orders" class="menu-item">
                <i class="fas fa-shopping-cart"></i>
                Orders
            </a>
            <a href="/analytics.php" class="menu-item">
                <i class="fas fa-chart-bar"></i>
                Analytics
            </a>
            <a href="/settings.php" class="menu-item">
                <i class="fas fa-cog"></i>
                Settings
            </a>
        </div>
    </div>
</template>

<template id="navbarTemplate">
    <div class="navbar">
        <div class="navbar-content">
            <h1 id="current-page-title" class="mb-0">Current Page</h1>
            <div class="d-flex align-items-center ms-auto">
                <div class="dropdown ms-2">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="/vendor/profile">Profile</a>
                        <a href="/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
class NavigationComponents {
    constructor() {
        this.init();
    }

    init() {
        this.insertNavigationComponents();
        this.setupEventListeners();
        this.initializeDropdowns();
        this.checkWidth();
        this.setPageTitle(); 
    }

    insertNavigationComponents() {
        const sidebarTemplate = document.getElementById('sidebarTemplate');
        const sidebarContent = sidebarTemplate.content.cloneNode(true);
        document.body.insertBefore(sidebarContent, document.body.firstChild);

        const navbarTemplate = document.getElementById('navbarTemplate');
        const navbarContent = navbarTemplate.content.cloneNode(true);
        const mainContent = document.querySelector('.main-content');
        if (mainContent) {
            mainContent.insertBefore(navbarContent, mainContent.firstChild);
        }

        this.setActiveMenuItem();
    }

    setPageTitle() {
        const currentPath = window.location.pathname;
        let pageTitle = 'Dashboard';

        if (currentPath.includes('/products')) {
            pageTitle = 'Products';
        } else if (currentPath.includes('/orders')) {
            pageTitle = 'Orders';
        } else if (currentPath.includes('/analytics')) {
            pageTitle = 'Analytics';
        } else if (currentPath.includes('/settings')) {
            pageTitle = 'Settings';
        }

        const pageTitleElement = document.getElementById('current-page-title');
        if (pageTitleElement) {
            pageTitleElement.textContent = pageTitle;
        }
    }

    setupEventListeners() {
        const sidebarToggle = document.getElementById('sidebar-toggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                document.querySelector('.sidebar').classList.toggle('active');
            });
        }

        window.addEventListener('resize', () => this.checkWidth());
    }

    initializeDropdowns() {
        document.addEventListener('DOMContentLoaded', () => {
            const dropdownElementList = document.querySelectorAll('[data-bs-toggle="dropdown"]');
            dropdownElementList.forEach(dropdownToggle => {
                new bootstrap.Dropdown(dropdownToggle, {
                    autoClose: true
                });
            });
        });
    }

    checkWidth() {
        const sidebar = document.querySelector('.sidebar');
        if (sidebar) {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('active');
            } else {
                sidebar.classList.add('active');
            }
        }
    }

    setActiveMenuItem() {
        const currentPath = window.location.pathname;
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.classList.remove('active');
            if (item.getAttribute('href') === currentPath) {
                item.classList.add('active');
            }
        });
    }
}
</script>
