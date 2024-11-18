<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        
        :root {
            --primary: #2563eb;
            --dashboard--color: #33ccff;
            --dashboard--color-hover: #0066ff;
            --primary-hover: #1d4ed8;
            --bg-light: #f8f9fa;
            --text-primary: #212529;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 2px 4px rgba(0, 0, 0, 0.1);
            --text-secondary: #6c757d;
            --secondary: #64748b;
            --danger: #dc2626;
            --success: #16a34a;
            --background: #f8fafc;
            --foreground: #0f172a;
            --muted: #94a3b8;
            --border: #e2e8f0;
            --ring: rgba(37, 99, 235, 0.2);
            --radius: 0.5rem;
        }
        body {
            background-color: var(--bg-light);
            font-family: 'Assistant', sans-serif;
            margin: 0;
            color: var(--text-primary);
            overflow-x: hidden;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            font-size: 1em;
            display: block;
            margin: 20px auto;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .order-summary {
            margin-top: 20px;
            text-align: center;
            font-size: 1.2em;
        }

        .order-summary span {
            font-weight: bold;
            color: #007bff;
        }

        /* yahan se navbar */
        .navbar {
            background-color: #ffffff;
            padding: 12px 40px;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            height: 60px !important;
        }

        .navbar.scrolled {
            padding: 8px 40px;
            box-shadow: var(--shadow-lg);
        }

        .navbar a {
            color: var(--text-primary);
            font-weight: 500;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
            text-decoration: none;
            margin-right: 25px;
            transition: all 0.3s ease;
            position: relative;
            padding: 5px 0;
        }

        .navbar a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--dashboard--color);
            transition: width 0.3s ease;
        }

        .navbar a:hover::after {
            width: 100%;
        }
        .search-bar {
            position: relative;
            width: 100% !important;
            max-width: 400px !important;
            transform: scale(0.98);
            transition: all 0.3s ease;
        }

        .search-bar:focus-within {
            transform: scale(1);
        }

        .search-input {
            width: 100%;
            padding: 15px 45px 15px 20px;
            border: 1px solid #d4d5d9;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #ffffff;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--dashboard--color);
            box-shadow: 0 0 0 3px rgba(255, 62, 108, 0.1);
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 12px;
            color: var(--text-secondary);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .search-btn:hover {
            color: var(--dashboard--color);
            transform: translateY(-50%) scale(1.1);
        }

        .nav-link.dropdown {
            position: relative;
            margin-right: 20px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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

        .nav-link:hover .dropdown-content {
            display: block;
        }

        .nav-link:hover .dropbtn {
            background-color: #3e8e41;
        }
        .custom-btn {
            padding: 8px !important;
            font-size: 1.25rem !important;
            border-radius: 50% !important;
            transition: all 0.3s ease !important;
            background: transparent !important;
            border: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 40px !important;
            height: 40px !important;
        }

        .custom-btn:hover {
            background-color: rgba(0, 123, 255, 0.1) !important;
            color: var(--dashboard--color) !important;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 8px 20px;
            }
            .navbar a {
                font-size: 12px;
            }
            .search-bar {
                max-width: 100% !important;
            }
            .search-input {
                padding: 12px;
            }
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
            top: 100%;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <h1>Your Transactions</h1>
        <?php if(isset($info)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Status</th>
                        <th>Total Amount</th>
                        <th>More Info</th>
                    </tr>
                </thead>
                <tbody id="order-table-body">
                    <?php foreach($info as $orderinfo): ?>
                    <tr>
                        <td><?php echo $orderinfo['payment_id']; ?></td>
                        <td><?php echo strtoupper($orderinfo['status']); ?></td>
                        <td><?php echo "Rs. ".$orderinfo['total_amount']; ?></td>
                        <td><a href="/paymentDetails/<?php echo $orderinfo['payment_id']; ?>" class="btn btn-success">View Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="order-summary">No orders found.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        const orders = [
            { orderId: "#123456", status: "Completed", amount: "₹1000" },
            { orderId: "#123457", status: "Pending", amount: "₹1500" },
            { orderId: "#123458", status: "Shipped", amount: "₹2000" },
            { orderId: "#123459", status: "Delivered", amount: "₹2500" }
        ];

        document.getElementById('fetch-orders').addEventListener('click', function() {
            const orderTableBody = document.getElementById('order-table-body');
            orderTableBody.innerHTML = ''; 
            orders.forEach(order => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${order.orderId}</td>
                    <td>${order.status}</td>
                    <td>${order.amount}</td>
                `;
                orderTableBody.appendChild(row);
            });

            toastr.success('Orders fetched successfully!');
        });
    </script>
</body>
</html>