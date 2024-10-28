<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }
        .panel-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            max-width: 800px;
            width: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .panel-header {
            padding: 2rem;
            text-align: center;
            background-color: #2575fc;
            color: #fff;
        }
        .panel-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .form-container {
            padding: 2rem 3rem;
        }
        .form-label {
            font-weight: 500;
            color: #333;
        }
        .form-control {
            border-radius: 0.5rem;
            padding: 1rem;
            border: 1px solid #ced4da;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #2575fc;
            box-shadow: none;
        }
        .btn-custom {
            background-color: #2575fc;
            color: white;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #1a5db8;
            color: #fff;
        }
        .panel-footer {
            text-align: center;
            padding: 1.5rem;
            font-size: 0.9rem;
            background: #f9fafb;
        }
        .toggle-link {
            color: #2575fc;
            font-weight: 500;
            text-decoration: none;
        }
        .toggle-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .form-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="panel-container">
        <div class="panel" id="loginPanel">
            <div class="panel-header">
                <h2 class="panel-title">Login</h2>
                <p>Welcome back! Please login to your account.</p>
            </div>
            <div class="form-container">
                <form action="/loginUser" method="post">
                    <div class="mb-4">
                        <label for="loginEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-4">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom">Login</button>
                    </div>
                    <span><?php if(isset($message)){ echo $message; } ?></span>
                </form>
            </div>
            <div class="panel-footer">
                Don’t have an account? <a href="/register" class="toggle-link">Register here</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
