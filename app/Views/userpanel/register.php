<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Professional Registration Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fb;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }
        .registration-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            padding: 2rem;
            width: 100%;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 1s ease-out forwards;
        }

        /* Entrance Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .registration-header {
            margin-bottom: 1.5rem;
            text-align: left;
            opacity: 0;
            animation: fadeIn 1.2s ease-out forwards;
        }

        .registration-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: #343a40;
        }
        
        .registration-subtitle {
            font-size: 1rem;
            color: #6c757d;
        }

        /* Form Styles */
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            transition: border-color 0.3s, box-shadow 0.3s;
            opacity: 0;
            animation: slideIn 1s ease-out forwards;
        }

        /* Slide-in Animation */
        @keyframes slideIn {
            0% { opacity: 0; transform: translateX(-20px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        /* Animation Delay */
        .form-control:nth-child(1) { animation-delay: 0.2s; }
        .form-control:nth-child(2) { animation-delay: 0.4s; }
        .form-control:nth-child(3) { animation-delay: 0.6s; }
        .form-control:nth-child(4) { animation-delay: 0.8s; }

        /* Button Styles */
        .btn-custom {
            background-color: #0d6efd;
            color: #ffffff;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 500;
            width: 100%;
            margin-top: 1rem;
            opacity: 0;
            transform: translateY(15px);
            transition: background-color 0.3s, transform 0.3s ease-out;
            animation: fadeIn 1.2s ease-out forwards;
            animation-delay: 1s;
        }

        .btn-custom:hover {
            background-color: #0a58ca;
            transform: scale(1.02);
        }

        /* Footer Styles */
        .panel-footer {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #6c757d;
            text-align: left;
            opacity: 0;
            animation: fadeIn 1.5s ease-out forwards;
            animation-delay: 1.2s;
        }
        
        .toggle-link {
            color: #0d6efd;
            font-weight: 500;
            text-decoration: none;
        }
        
        .toggle-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <div class="registration-header">
            <h2 class="registration-title">Create Account</h2>
            <p class="registration-subtitle">Sign up to access your account</p>
        </div>
        <form action="/registerUser" method="post">
            <div class="mb-3">
                <label for="registerName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="registerName" name="fullname" placeholder="John Doe" required>
            </div>
            <div class="mb-3">
                <label for="registerUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="registerUsername" name="username" placeholder="johndoe" required>
            </div>
            <div class="mb-3">
                <label for="registerEmail" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="registerEmail" name="email" placeholder="name@example.com" required>
            </div>
            <div class="mb-4">
                <label for="registerPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="registerPassword" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-custom">Sign Up</button>
            <span><?php if (isset($message)){ echo $message; }?></span>
        </form>
        <div class="panel-footer">
            Already have an account? <a href="/login" class="toggle-link">Login</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>