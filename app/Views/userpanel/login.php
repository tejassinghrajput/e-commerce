<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            background: linear-gradient(120deg, #a1c4fd, #c2e9fb);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow: hidden;
        }
        .panel-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            max-width: 450px;
            width: 100%;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeIn 0.5s forwards;
        }
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .panel-container:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        }
        .panel-header {
            padding: 1.5rem;
            text-align: center;
            background-color: #2575fc;
            color: #fff;
        }
        .panel-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }
        .form-container {
            padding: 2rem;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .form-control {
            border-radius: 0.4rem;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            font-size: 0.95rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 8px rgba(37, 117, 252, 0.2);
        }
        .btn-custom {
            background-color: #2575fc;
            color: #fff;
            border-radius: 0.4rem;
            padding: 0.65rem;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 8px rgba(37, 117, 252, 0.3);
        }
        .btn-custom:hover {
            background-color: #1a5db8;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 117, 252, 0.3);
        }
        .panel-footer {
            text-align: center;
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            background: #f9fafb;
            color: #666;
        }
        .toggle-link {
            color: #2575fc;
            font-weight: 600;
            text-decoration: none;
        }
        .toggle-link:hover {
            text-decoration: underline;
            color: #1a5db8;
        }
        @media (max-width: 576px) {
            .form-container {
                padding: 1.5rem;
            }
        }
        .panel {
            display: none;
        }
        .panel.active {
            display: block;
        }
        .loading {
            display: none;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;
        }
        .loading.show {
            display: block;
        }
        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: none;
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px 20px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            z-index: 999;
            animation: slideIn 0.5s forwards, slideOut 0.5s 2.5s forwards;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }
        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
            to {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
        }
    </style>
</head>
<body>
    <div class="panel-container">
        <div class="panel active" id="loginPanel">
            <div class="panel-header">
                <h2 class="panel-title">Login</h2>
                <p>Welcome back! Please login to your account.</p>
            </div>
            <div class="form-container">
                <form action="/loginUser" method="post" onsubmit="showLoading()">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-4">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom">Login</button><br>
                    </div>
                </form>
            </div>
            
            <div class="panel-footer">
                Don’t have an account? <a href="/register" class="toggle-link" onclick="togglePanel()">Register here</a>
            </div>
        </div>
    </div>

    <div class="loading" id="loadingSpinner">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="notification" id="notificationPopup"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        <?php
            $message=session()->getFlashdata('message');
            if (isset($message) && !empty($message)) { ?>
            showNotification("<?php echo $message; ?>");
        <?php } ?>
    </script>
    <script src="<?= base_url('assets/app.js') ?>"></script>
</body>
</html>
