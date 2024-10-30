<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #a1c4fd, #c2e9fb);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }
        .panel-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            max-width: 450px;
            width: 100%;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
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
            transition: border-color 0.3s ease;
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
    </style>
</head>
<body>
    <div class="panel-container">
        <div class="panel">
            <div class="panel-header">
                <h2 class="panel-title">Create Your Account</h2>
                <p>Join us for exclusive offers and updates!</p>
            </div>
            <div class="form-container">
                <form action="/registerUser" method="post">
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="registerName" name="fullname" placeholder="Enter Full Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="registerUsername" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="registerEmail" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-4">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Enter your password" required>
                        <i id="toggleRegisterPassword" class="fa fa-eye" style="cursor: pointer;"></i>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom">Sign Up</button>
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                Already have an account? <a href="/login" class="toggle-link">Login here</a>
            </div>
        </div>
    </div>

    <!-- Modal for Flash Message -->
    <div class="modal fade" id="flashMessageModal" tabindex="-1" aria-labelledby="flashMessageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="alert alert-warning" role="alert">
                        <?php 
                            $message = session()->getFlashdata('message');
                            if (isset($message)): 
                                echo $message; 
                            endif; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const message = <?php echo json_encode($message); ?>;
            if (message) {
                const modal = new bootstrap.Modal(document.getElementById('flashMessageModal'));
                modal.show();

                setTimeout(() => {
                    modal.hide();
                }, 3000);
            }
            const togglePassword = document.getElementById('toggleRegisterPassword');
            togglePassword.addEventListener('click', function () {
                const passwordField = document.getElementById('registerPassword');
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>
