<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Transaction Details</title>
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
        
        .transaction-container * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .transaction-container {
            background-color: #f5f5f5;
            min-height: calc(100vh - 60px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin-top: 60px;
        }

        .transaction-details-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 24px;
            width: 100%;
            max-width: 400px;
        }

        .transaction-header {
            margin-bottom: 24px;
            text-align: center;
        }

        .transaction-header h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 8px;
            text-transform: none; 
            letter-spacing: normal; 
        }

        .transaction-id {
            color: #666;
            font-size: 14px;
            text-transform: none;
        }

        .transaction-row {
            display: flex;
            justify-content: space-between;
            padding: 16px 0;
            border-bottom: 1px solid #eee;
        }

        .transaction-row:last-child {
            border-bottom: none;
        }
        
        .transaction-label {
            color: #666;
            font-size: 14px;
            text-transform: none;
            letter-spacing: normal;
        }

        .transaction-value {
            color: #333;
            font-weight: 500;
            text-align: right;
            text-transform: none;
        }

        
        .transaction-amount {
            color: #2c3e50;
            font-size: 18px;
            font-weight: 600;
        }

        .transaction-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            background-color: #d4edda;
            color: #155724;
            text-transform: none;
        }

        @media (max-width: 768px) {
            .transaction-container {
                padding: 15px;
            }
            
            .transaction-header h1 {
                font-size: 20px;
            }
            
            .transaction-row {
                padding: 12px 0;
            }
        }

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

        .back-button-container {
            position: fixed;
            top: 60px;
            right: 20px;
            z-index: 999;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: var(--text-primary);
            background-color: transparent;
            border: 1px solid var(--border);
            padding: 10px 15px;
            border-radius: var(--radius);
            transition: all 0.3s ease;
            font-weight: 500;
            box-shadow: var(--shadow-sm);
        }

        .back-button i {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .back-button:hover {
            background-color: var(--bg-light);
            border-color: var(--dashboard--color);
            color: var(--dashboard--color);
        }

        .back-button:hover i {
            transform: translateX(-3px);
        }

        @media (max-width: 768px) {
            .back-button-container {
                top: 70px;
                left: 10px;
            }
            
            .back-button {
                padding: 8px 12px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>
    <div class="transaction-container">
        <div class="back-button-container">
            <a href="javascript:history.back()" class="back-button">Back
                <i class="bi bi-arrow-return-left"></i> 
            </a>
        </div>
        <div class="transaction-details-card">
            <div class="transaction-header">
                <h1>Transaction Details</h1>
                <div class="transaction-id">Transaction ID: <?php echo $transaction_id; ?></div>
            </div>

            <div class="transaction-row">
                <div class="transaction-label">Payment Method</div>
                <div class="transaction-value"><?php echo $resultArray['requested_data']['payment_method']; ?></div>
            </div>

            <div class="transaction-row">
                <div class="transaction-label">Date & Time</div>
                <div class="transaction-value"><?php echo $responseData[0]['payment_time']; ?></div>
            </div>

            <div class="transaction-row">
                <div class="transaction-label">Amount</div>
                <div class="transaction-value transaction-amount">Rs.<?php echo $responseData[0]['payment_amount']; ?></div>
            </div>

            <div class="transaction-row">
                <div class="transaction-label">Status</div>
                <div class="transaction-value">
                    <span class="transaction-status"><?php echo $responseData[0]['payment_status']; ?></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>