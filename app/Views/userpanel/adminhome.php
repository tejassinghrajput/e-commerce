<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --admin-primary: #33ccff;
            --admin-secondary: #0066ff;
            --admin-success: #28a745;
            --admin-warning: #ffc107;
            --admin-danger: #dc3545;
            --text-primary: #282c3f;
            --text-secondary: #94969f;
            --bg-light: #f5f5f6;
            --shadow-sm: 0 0 4px rgba(40, 44, 63, 0.08);
            --shadow-lg: 0 2px 16px rgba(40, 44, 63, 0.15);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Assistant', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #ffffff;
            padding: 12px 40px;
            box-shadow: var(--shadow-sm);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: var(--transition);
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--admin-primary);
            font-size: 1.5rem;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: #ffffff;
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 80px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            z-index: 999;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: var(--text-primary);
            text-decoration: none;
            transition: var(--transition);
            border-left: 3px solid transparent;
        }

        .sidebar-link i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: rgba(51, 204, 255, 0.1);
            color: var(--admin-primary);
            border-left-color: var(--admin-primary);
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 260px;
            padding: 90px 30px 30px;
            transition: var(--transition);
        }

        /* Card Styles */
        .stat-card {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            margin-bottom: 20px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card .icon {
            font-size: 2.5rem;
            color: var(--admin-primary);
            margin-bottom: 15px;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 5px;
        }

        .stat-card .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Table Styles */
        .data-table {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .data-table thead th {
            background-color: rgba(51, 204, 255, 0.1);
            color: var(--text-primary);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            padding: 15px;
            border: none;
        }

        .data-table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        /* Button Styles */
        .btn-admin {
            padding: 8px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: var(--transition);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        .btn-admin-primary {
            background-color: var(--admin-primary);
            color: #ffffff;
            border: none;
        }

        .btn-admin-primary:hover {
            background-color: var(--admin-secondary);
            transform: translateY(-2px);
        }

        /* Search Bar Styles */
        .search-bar {
            position: relative;
            max-width: 300px;
            margin-bottom: 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 15px;
            padding-left: 40px;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 4px;
            transition: var(--transition);
        }

        .search-bar i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .search-bar input:focus {
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 3px rgba(51, 204, 255, 0.1);
            outline: none;
        }

        /* Status Badge Styles */
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--admin-warning);
        }

        .status-badge.completed {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--admin-success);
        }

        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .navbar {
                padding: 12px 20px;
            }
        }

          .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" id="sidebar-toggle">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="sidebar">
        <a class="sidebar-link active" href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a class="sidebar-link" href="#users"><i class="fas fa-users"></i> Users</a>
        <a class="sidebar-link" href="#products"><i class="fas fa-box"></i> Products</a>
        <a class="sidebar-link" href="#orders"><i class="fas fa-shopping-cart"></i> Orders</a>
        <a class="sidebar-link" href="#settings"><i class="fas fa-cog"></i> Settings</a>
    </div>

    <div class="main-content">
        <div id="dashboard" class="content-section fade-in">
            <h2>Dashboard</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <div class="stat-value">150</div>
                        <div class="stat-label">Total Users</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="icon"><i class="fas fa-box"></i></div>
                        <div class="stat-value">85</div>
                        <div class="stat-label">Total Products</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                        <div class="stat-value">200</div>
                        <div class="stat-label">Total Orders</div>
                    </div>
                </div>
            </div>
        </div>

        <div id="users" class="content-section fade-in" style="display: none;">
            <h2>User Management</h2>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search users...">
            </div>
            <div class="data-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td><span class="status-badge pending">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>jane@example.com</td>
                            <td><span class="status-badge completed">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-admin btn-admin-primary">Add New User</button>
        </div>

        <div id="products" class="content-section fade-in" style="display: none;">
            <h2>Product Management</h2>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search products...">
            </div>
            <div class="data-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Product A</td>
                            <td>$10.00</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Product B</td>
                            <td>$15.00</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-admin btn-admin-primary">Add New Product</button>
        </div>

        <div id="orders" class="content-section fade-in" style="display: none;">
            <h2>Order Management</h2>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search orders...">
            </div>
            <div class="data-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1001</td>
                            <td>John Doe</td>
                            <td><span class="status-badge pending">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-info">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>1002</td>
                            <td>Jane Smith</td>
                            <td><span class="status-badge completed">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-info">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="settings" class="content-section fade-in" style="display: none;">
            <h2>Settings</h2>
            <p>Manage your site settings here.</p>
            <button class="btn btn-admin btn-admin-primary">Update Settings</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
            const mainContent = document.querySelector('.main-content');
            mainContent.classList.toggle('active');
        });

        const navLinks = document.querySelectorAll('.sidebar-link');
        const contentSections = document.querySelectorAll('.content-section');

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(l => l.classList.remove('active'));
                contentSections.forEach(section => section.style.display = 'none');

                this.classList.add('active');
                const targetId = this.getAttribute('href').substring(1);
                document.getElementById(targetId).style.display = 'block';
            });
        });
    </script>
</body>
</html> ⬤