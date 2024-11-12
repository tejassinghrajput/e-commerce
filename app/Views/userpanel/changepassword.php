<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        .change-password-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
    </style>
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <div class="change-password-container">
            <h2 class="text-center mb-4">Change Password</h2>
            <form id="changePasswordForm" action="/updatePassword" method="post">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    <div class="form-text">Password must be at least 8 characters long</div>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="statusToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastMessage"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault();

                var currentPassword = $('#currentPassword').val();
                var newPassword = $('#newPassword').val();
                var confirmPassword = $('#confirmPassword').val();

                $.ajax({
                    url: '/updatePassword',
                    type: 'POST',
                    data: {
                        currentPassword: currentPassword,
                        newPassword: newPassword,
                        confirmPassword: confirmPassword
                    },
                    success: function(response) {
                        console.log(response);
                        var toastElement = $('#statusToast');
                        var toastMessage = $('#toastMessage');
                        toastMessage.text(response.data.message);
                        console.log(response.data.message);
                        if (response.data.status) {
                            toastElement.removeClass('bg-danger').addClass('bg-success');
                        } else {
                            toastElement.removeClass('bg-success').addClass('bg-danger');
                        }

                        var toast = new bootstrap.Toast(toastElement);
                        toast.show();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request failed:', error);
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>