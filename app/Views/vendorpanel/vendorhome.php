<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
    <?php include('vendornavandside.php'); ?>
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

        body {
            font-family: 'Assistant', sans-serif;
            background-color: var(--bg-light);
            margin: 0;
            min-height: 100vh;
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

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .dashboard-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            background: rgba(51, 204, 255, 0.1);
            color: var(--dashboard-color);
        }

        .card-title {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-bottom: 5px;
        }

        .card-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
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

        .custom-table {
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
        }

        .custom-table th {
            background: rgba(51, 204, 255, 0.1);
            color: var(--text-primary);
            font-weight: 600;
        }

        .custom-table td {
            vertical-align: middle;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .btn-action {
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .btn-view {
            background: var(--dashboard-color);
            color: white;
        }

        .btn-view:hover {
            background: var(--dashboard-color-hover);
            color: white;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                        </div>
                        <div class="card-title">Total Orders</div>
                        <div class="card-value">1,234</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-box fa-lg"></i>
                        </div>
                        <div class="card-title">Products</div>
                        <div class="card-value">56</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-rupee-sign fa-lg"></i>
                        </div>
                        <div class="card-title">Revenue</div>
                        <div class="card-value">₹45,678</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-star fa-lg"></i>
                        </div>
                        <div class="card-title">Rating</div>
                        <div class="card-value">4.8</div>
                    </div>
                </div>
            </div>
            <div class="dashboard-card">
                <h5 class="mb-4">Recent Orders</h5>
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#ORD-123</td>
                                <td>John Doe</td>
                                <td>Product Name</td>
                                <td>₹1,299</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td>
                                    <button class="btn btn-action btn-view">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ORD-124</td>
                                <td>Jane Smith</td>
                                <td>Product Name</td>
                                <td>₹2,499</td>
                                <td><span class="status-badge status-completed">Completed</span></td>
                                <td>
                                    <button class="btn btn-action btn-view">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            try {
                const navigation = new NavigationComponents();
            } catch(e) {
                console.error('Navigation initialization error:', e);
            }
        });
    </script>
</body>
</html>
