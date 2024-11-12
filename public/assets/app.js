window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.order-image');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                observer.unobserve(img);
            }
        });
    });
    images.forEach(img => imageObserver.observe(img));
});


// js logic for login.php
function togglePanel() {
    const loginPanel = document.getElementById('loginPanel');
    const registerPanel = document.getElementById('registerPanel');
    loginPanel.classList.toggle('active');
    registerPanel.classList.toggle('active');
}

function showLoading() {
    const loadingSpinner = document.getElementById('loadingSpinner');
    loadingSpinner.classList.add('show');
}

function showNotification(message) {
    const notificationPopup = document.getElementById('notificationPopup');
    notificationPopup.innerText = message;
    notificationPopup.style.display = 'block';
    notificationPopup.classList.add('notification');
    setTimeout(() => {
        notificationPopup.style.display = 'none';
    }, 3000);
}

// js logic for productdetails.php
    $(document).ready(function() {
        $('#addToCartBtn').on('click', function() {
            var productId = $(this).data('product-id');
            var $btn = $(this);
            var originalText = $btn.html();

            $btn.html('<i class="fas fa-spinner fa-spin"></i> Adding...').prop('disabled', true);
            
            $.ajax({
                type: 'POST',
                url: '/addtoCart',
                data: { product_id: productId },
                success: function(response) {
                    if (response.success) {
                        showToast(response.message || 'Item added to cart successfully');
                    } else {
                        showToast(response.message || 'Failed to add item to cart');
                    }
                },
                error: function() {
                    showToast('Unable to add item to cart');
                },
                complete: function() {
                    $btn.html(originalText).prop('disabled', false);
                }
            });
        });

        function showToast(message) {
            $('#toastContent').text(message);
            $('#toast').fadeIn().addClass('show');
            
            setTimeout(function() {
                $('#toast').removeClass('show').fadeOut();
            }, 3000);
        }
    });

        function closeFlashMessageModal() {
            document.getElementById('flashMessageModal').classList.remove('active');
        }

        document.getElementById('feedbackForm').addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            const text = button.querySelector('.button-text');
            const spinner = button.querySelector('.spinner');
            
            if (this.checkValidity()) {
                button.disabled = true;
                text.style.opacity = '0';
                spinner.style.display = 'block';
            }
        });

        function openDeleteModal(feedbackId, orderId) {
            document.getElementById('deleteModal').classList.add('active');
            
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            confirmBtn.onclick = function() {
                const text = this.querySelector('.button-text');
                const spinner = this.querySelector('.spinner');
                this.disabled = true;
                text.style.opacity = '0';
                spinner.style.display = 'block';
                window.location.href = '/deletefeedback/' + feedbackId + '/' + orderId;
            };
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
        }

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feedback-item').forEach(item => {
            observer.observe(item);
        });

        document.querySelectorAll('.custom-button').forEach(button => {
            if (!button.id.includes('confirmDeleteBtn') && button.type !== 'submit') {
                button.addEventListener('click', function() {
                    if (this.tagName.toLowerCase() === 'a') {
                        const text = this.querySelector('.button-text');
                        const spinner = this.querySelector('.spinner');
                        this.style.pointerEvents = 'none';
                        text.style.opacity = '0';
                        spinner.style.display = 'block';
                    }
                });
            }
        });
        function openEditModal(feedbackId, feedbackText, starRating) {
            document.getElementById('editFeedbackModal').classList.add('active');
            document.getElementById('editComment').value = feedbackText;
            starRating = parseInt(starRating);
            for (let i = 1; i <= 5; i++) {
                document.getElementById('editStar' + i).checked = (i === starRating);
            }

            const form = document.getElementById('editFeedbackForm');
            form.setAttribute('data-feedback-id', feedbackId);

            form.onsubmit = function(e) {
                e.preventDefault();
                submitEditedFeedback(feedbackId);
            };
        }

        function submitEditedFeedback(feedbackId) {
            const form = document.getElementById('editFeedbackForm');
            const formData = new FormData(form);
            
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = 'Updating...';

            fetch('/submiteditedfeedback/' + feedbackId, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); 
            })
            .then(data => {
                try {
                    const jsonData = JSON.parse(data);
                    if (jsonData.success) {
                        closeEditModal();
                        window.location.reload();
                    } else {
                        alert('Error updating feedback: ' + (jsonData.message || 'Unknown error'));
                    }
                } catch (e) {
                    closeEditModal();
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                closeEditModal();
                window.location.reload();
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = 'Update Feedback';
            });
        }

        function closeEditModal() {
            document.getElementById('editFeedbackModal').classList.remove('active');
        }

// js logic for viewprofile

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
                    success: function(data) { 
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