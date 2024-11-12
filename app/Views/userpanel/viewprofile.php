<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | E-commerce</title>
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

        .profile-section {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .profile-header {
            background: white;
            border-radius: var(--radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .profile-image-wrapper {
            position: relative;
            width: 150px;
            height: 150px;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .upload-overlay {
            position: absolute;
            bottom: 0;
            right: 0;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .upload-overlay:hover {
            background: var(--primary-hover);
            transform: scale(1.1);
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .profile-meta {
            color: var(--muted);
            font-size: 0.875rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-card {
            background: white;
            padding: 1.5rem;
            border-radius: var(--radius);
            border: 1px solid var(--border);
        }

        .info-label {
            color: var(--muted);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-weight: 500;
        }

        .info-value.empty {
            color: var(--muted);
            font-weight: normal;
        }

        .addresses-section {
            background: white;
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .address-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .address-card {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            position: relative;
            transition: all 0.2s;
        }

        .address-card:hover {
            border-color: var(--primary);
            box-shadow: 0 2px 4px var(--ring);
        }

        .address-card.default::before {
            content: 'Default';
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--success);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
        }

        .address-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            font-weight: 500;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-secondary {
            background: var(--secondary);
            color: white;
        }

        .modal-content {
            border-radius: var(--radius);
            border: none;
        }

        .modal-header {
            border-bottom: 1px solid var(--border);
            padding: 1.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .form-control {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 0.75rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px var(--ring);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-image-wrapper {
                margin: 0 auto;
            }

            .section-header {
                flex-direction: column;
                gap: 1rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
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

        .nav-link.dropdown{
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
        
        <?php
        $userdetails=session()->getFlashdata('userdetails');
        ?>
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="defaulttoast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                Hello
            </div>
        </div>
    </div>
    <div class="profile-section">
        <div class="profile-header">
            <div class="profile-image-wrapper">
                <img src="<?php echo $profile_picture ?? 'https://ui-avatars.com/api/?name=Tejas+Singh&background=2563eb&color=fff' ?>" 
                     alt="Profile" class="profile-image">
                <label class="upload-overlay" for="profile-upload">
                    <i class="fas fa-camera"></i>
                    <input type="file" id="profile-upload" hidden accept="image/*">
                </label>
            </div>
            <div class="profile-info">
                <h1 class="profile-name"><?php echo $userdetails['fullname']; ?></h1>
                <p class="profile-meta">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Member since <?php echo $userdetails['reg_date']; ?>
                </p>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">Mobile Number</div>
                <div class="info-value">7652050611</div>
            </div>
            <div class="info-card">
                <div class="info-label">Email Address</div>
                <div class="info-value empty"><?php echo $userdetails['email']; ?></div>
            </div>
            <div class="info-card">
                <div class="info-label">Gender</div>
                <div class="info-value"><?php echo $userdetails['gender']; ?></div>
            </div>
            <div class="info-card">
                <div class="info-label">Date of Birth</div>
                <div class="info-value empty"><?php echo $userdetails['dob']; ?></div>
            </div>
            <div class="info-card">
                <div class="info-label">Location</div>
                <div class="info-value empty">Not added</div>
            </div>
            <div class="info-card">
                <div class="info-label">Alternate Mobile</div>
                <div class="info-value empty"><?php if(isset($userdetails['alt_number'])) { echo $userdetails['alt_number']; } else { echo "Not Set"; } ?></div>
            </div>
        </div>

        <div class="addresses-section">
            <div class="section-header">
                <h2 class="m-0">Saved Addresses</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal" id="toggleAddressForm">
                    <i class="fas fa-plus"></i>
                    <span>Add New Address</span>
                </button>
            </div>

            <div id="savedAddresses" class="address-grid">
                <div class="empty-state">
                    <i class="fas fa-map-marker-alt"></i>
                    <p class="mb-0">No addresses saved yet</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addAddressModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                <div id="addressForm">
                    <form id="addAddressForm" >
                        <div class="mb-3">
                            <label class="form-label">Street Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control" name="state" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pincode</label>
                            <input type="text" class="form-control" name="pincode" required pattern="[0-9]{6}">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Address</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAddressModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editAddressForm">
                        <div class="mb-3">
                            <label class="form-label">Street Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control" name="state" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pincode</label>
                            <input type="text" class="form-control" name="pincode" required pattern="[0-9]{6}">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script>

        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        $(document).ready(function() {
            loadAddresses();
            $('#profile-upload').change(function() {
                const file = this.files[0];
                if (file) {
                    const formData = new FormData();
                    formData.append('profile_picture', file);
                    
                    $.ajax({
                        type: 'POST',
                        url: '/uploadProfilePicture',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('.profile-image').attr('src', response.url);
                        }
                    });
                }
            });

            function loadAddresses() {
                $.ajax({
                    type: 'GET',
                    url: '/getSavedAddresses',
                    success: function(response) { 
                        let data = response.addresses || [];
                        $('#savedAddresses').empty();
                        if (data.length === 0) {
                            $('#savedAddresses').html(`
                                <div class="empty-state">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p class="mb-0">No addresses saved yet</p>
                                </div>
                            `);
                            return;
                        }

                        data.forEach(function(address) {
                            $('#savedAddresses').append(`
                                <div class="address-card ${address.is_default ? 'default' : ''}" data-address-id="${address.address_id}">
                                    <h5 class="mb-2">${address.street}</h5>
                                    <p class="mb-3 text-muted">${address.city}, ${address.state} - ${address.pincode}</p>
                                    <div class="address-actions">
                                        <button class="btn btn-primary btn-sm edit-address" data-bs-toggle="modal" data-bs-target="#editAddressModal">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </button>
                                        <button class="btn btn-danger btn-sm delete-address">
                                            <i class="fas fa-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                        ${!address.is_default ?`
                                            <button class="btn btn-secondary btn-sm make-default">
                                                <i class="fas fa-check"></i>
                                                <span>Set Default</span>
                                            </button>
                                        ` : ''}
                                    </div>
                                </div>
                            `);
                        });
                    }
                });
            }

            loadAddresses();

            $(document).ready(function() {
                $('#toggleAddressForm').click(function() {
                    $('#addressForm').toggle();
                    $('#addressForm').show(); 
                });

                $('#addAddressForm').submit(function(e) {
                    e.preventDefault();
                    $('#addressMessage').hide();
                    $.ajax({
                        type: 'POST',
                        url: '/addAddress',
                        data: $(this).serialize(),
                        success: function(response) {
                            const toast = new bootstrap.Toast(document.getElementById('defaulttoast'));
                            $('#defaulttoast .toast-body').text(response.message); 
                            toast.show();
                            loadAddresses();
                            $('#addAddressForm')[0].reset();
                            $('#addressForm').hide();
                            $('#addAddressModal').modal('hide');
                        },
                        error: function(xhr) {
                            $('#addressMessage').removeClass('alert-success').addClass('alert-danger');
                            $('#addressMessage').text('Failed to save address. Please try again.').show();
                        }
                    });
                });
            });
            setTimeout(function() {
                $('#addressMessage').fadeOut();
            }, 3000);

            $(document).on('click', '.edit-address', function() {
                const card = $(this).closest('.address-card');
                const addressId = card.data('address-id');
                $('#editAddressForm').data('address-id', addressId);
                
                $('#editAddressForm input[name="address"]').val(card.find('h5').text().trim());
                const cityStatePin = card.find('p').text().split(', ');
                $('#editAddressForm input[name="city"]').val(cityStatePin[0]);
                $('#editAddressForm input[name="state"]').val(cityStatePin[1].split(' - ')[0]);
                $('#editAddressForm input[name="pincode"]').val(cityStatePin[1].split(' - ')[1]);
            });

            $('#editAddressForm').submit(function(e) {
                e.preventDefault();
                const addressId = $(this).data('address-id');
                $.ajax({
                    type: 'POST',
                    url: '/editAddress',
                    data: $(this).serialize() + '&address_id=' + addressId,
                    success: function(response) {
                        $('#editAddressModal').modal('hide');
                        const toast = new bootstrap.Toast(document.getElementById('defaulttoast'));
                        $('#defaulttoast .toast-body').text(response.message); 
                        toast.show();
                        loadAddresses();
                    }
                });
            });

            $(document).on('click', '.delete-address', function() {
                    const addressId = $(this).closest('.address-card').data('address-id');
                    $.ajax({
                        type: 'POST',
                        url: '/deleteAddress',
                        data: { address_id: addressId },
                        success: function(response) {
                            if (response.success) {
                                const toast = new bootstrap.Toast(document.getElementById('defaulttoast'));
                                $('#defaulttoast .toast-body').text(response.message); 
                                toast.show();
                                loadAddresses();
                            }
                        }
                    });
            });

            $(document).on('click', '.make-default', function() {
                const addressId = $(this).closest('.address-card').data('address-id');
                $.ajax({
                    type: 'POST',
                    url: '/makeDefaultAddress',
                    data: { address_id: addressId },
                    success: function(response) {
                            loadAddresses();
                            const toast = new bootstrap.Toast(document.getElementById('defaulttoast'));
                            $('#defaulttoast .toast-body').text(response.message); 
                            toast.show();
                    }
                });
            });
        });
    </script>
</body>
</html>