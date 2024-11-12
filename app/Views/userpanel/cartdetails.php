<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Shopping Cart</title>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideOut {
            to { opacity: 0; transform: translateX(30px); }
        }
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

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 10px;
        }

        .cart-container {
            background-color: #ffffff;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
            animation: fadeIn 0.3s ease-out;
        }

        .cart-items {
            flex: 2;
            padding: 15px;
            border-right: 1px solid #eaeaec;
        }

        .cart-header {
            padding: 10px 0;
            border-bottom: 1px solid #eaeaec;
        }

        .cart-header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .cart-item {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #eaeaec;
            animation: fadeIn 0.3s ease-out;
        }

        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 12px;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .item-price {
            font-size: 14px;
            font-weight: bold;
            color: #282c3f;
            margin: 2px 0;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            margin: 6px 0;
        }

        .quantity-btn {
            background: #f0f0f0;
            color: #282c3f;
            border: 1px solid #d4d5d9;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: background-color 0.2s;
        }

        .quantity-btn:hover {
            background-color: #e0e0e0;
        }

        .quantity-value {
            font-size: 14px;
            margin: 0 8px;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #ff3e6c;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            margin-top: 6px;
            transition: color 0.2s;
        }

        .delete-btn:hover {
            color: #ff1744;
        }

        .summary-card {
            flex: 1;
            padding: 15px;
        }

        .summary-card h5 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .checkout-btn {
            width: 100%;
            padding: 12px;
            background-color: #ff3e6c;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 12px;
            transition: background-color 0.2s;
        }

        .checkout-btn:hover {
            background-color: #ff527b;
        }

        .removing {
            animation: slideOut 0.3s ease-out forwards;
        }

        @media (max-width: 768px) {
            .cart-container {
                flex-direction: column;
            }

            .cart-items {
                border-right: none;
                border-bottom: 1px solid #eaeaec;
            }

            .item-image {
                width: 70px;
                height: 70px;
            }
        }

        .toast-container {
            z-index: 1050;
        }

        .toast {
            min-width: 300px;
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

</style>
</head>
<?php
include('header.php');
?>
<body>
    <div class="main-content">
        <div class="container-fluid">
            <h4 class="mb-4">Shopping Cart</h4>
            <?php if(isset($result)&& !empty($result)): ?>
            <div class="cart-container">
                <div class="cart-items">
                <?php foreach($result as $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo base_url('imagecontroller/show/'.$item['image']); ?>" class="item-image" alt="<?php echo $item['product_name']; ?>">
                        <div class="item-details">
                            <h5 class="item-title"><?php echo $item['product_name']; ?></h5>
                            <p class="text-secoindary mb-2">Color: Black</p>
                            <div class="item-price"><?php echo 'Rs. '.$item['price']; ?></div>
                            <span> Quantity : <?php echo $item['quantity']; ?></span>
                            <button class="delete-btn" data-product-id="<?php echo $item['product_id']; ?>" data-cart-id="<?php echo $item['cart_id']; ?>" data-quantity-id="<?php echo $item['quantity']; ?>">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                <div class="cart-summary">
                    <div class="summary-card">
                        <h5 class="mb-4">Order Summary</h5>
                        <div class="summary-item">
                            <span>Subtotal</span>
                            <span></span>
                        </div>
                        <div class="summary-item">
                            <span>Shipping</span>
                            <span></span>
                        </div>
                        <div class="summary-item">
                            <span>Tax</span>
                            <span></span>
                        </div>
                        <hr>
                        <div class="summary-item">
                            <strong>Total</strong>
                            <strong></strong>
                        </div>
                        <div class="mb-3">
                            <label for="addressSelect" class="form-label">Select Delivery Address</label>
                            <select id="addressSelect" class="form-select">
                                <option value="">Loading addresses...</option>
                            </select>
                        </div>
                        <button id="proceedToCheckout" class="checkout-btn">Proceed to Checkout</button>
                    </div>
                </div>
                <?php else: ?>
                    <div class="empty-cart-message text-center py-5">
                        <h3>Your cart is empty</h3>
                        <p>Add items to your cart to continue shopping.</p>
                        <a href="/dashboard" class="btn btn-primary mt-3">Continue Shopping</a>
                    </div>
                <?php endif; ?>
            </div>
            </div>
         </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Checkout completed successfully!
            </div>
        </div>

        <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Something went wrong during checkout.
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        class ShoppingCart {
        constructor() {
            this.items = this.getItemsFromHTML();
            this.shippingCost = 9.99;
            this.taxRate = 0.08;
            this.selectedAddressId = null;

            this.init();
        }

        init() {
            this.renderCart();
            this.updateSummary();
            this.attachEventListeners();
            this.setupToasts();
            this.fetchAddresses();
        }
        
        getItemsFromHTML() {
            const items = [];
            $('.cart-item').each(function() {
                const deleteBtn = $(this).find('.delete-btn');
                const itemTitle = $(this).find('.item-title').text().trim();
                const imageSrc = $(this).find('.item-image').attr('src'); 
                const item = {
                    id: deleteBtn.data('product-id'),
                    cart_id: deleteBtn.data('cart-id'),
                    product_name: itemTitle,
                    price: $(this).find('.item-price').text().replace('Rs. ', ''),
                    image: imageSrc,
                    quantity: deleteBtn.data('quantity-id')
                };
                items.push(item);
            });
            return items;
        }
        updateSummary() {
            const subtotal = this.items.reduce((sum, item) => {
                return sum + (parseFloat(item.price) * parseInt(item.quantity));
            }, 0);

            const shipping = this.shippingCost;
            const tax = subtotal * this.taxRate;
            const total = subtotal + shipping + tax;

            $('.summary-item:eq(0) span:eq(1)').text(`Rs. ${subtotal.toFixed(2)}`);
            $('.summary-item:eq(1) span:eq(1)').text(`Rs. ${shipping.toFixed(2)}`);
            $('.summary-item:eq(2) span:eq(1)').text(`Rs. ${tax.toFixed(2)}`);
            $('.summary-item:eq(3) strong:eq(1)').text(`Rs. ${total.toFixed(2)}`);
        }

        renderCart() {
                const cartItemsContainer = $('.cart-items');
                cartItemsContainer.empty();
                console.log(this.items);
                this.items.forEach(item => {
                    const itemHtml = `
                        <div class="cart-item" data-id="${item.id}">
                            <img src="${item.image}" class="item-image" alt="${item.name}">
                            <div class="item-details">
                                <h5 class="item-title">${item.product_name || 'Unknown Product'}</h5>
                                <p class="text-secondary mb-2">Color: Black</p>
                                <div class="item-price">${item.price}</div>
                                <span> Quantity : ${item.quantity}</span>
                                <button class="delete-btn" data-id="${item.id}" data-cart-id="${item.cart_id}">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    `;
                    cartItemsContainer.append(itemHtml);
                });

                this.attachEventListeners();
            }
        setupToasts() {
            if (!document.getElementById('cartToasts')) {
                const toastContainer = document.createElement('div');
                toastContainer.id = 'cartToasts';
                toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
                const successToast = `
                    <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-success text-white">
                            <strong class="me-auto">Success</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body"></div>
                    </div>
                `;
                
                const errorToast = `
                    <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-danger text-white">
                            <strong class="me-auto">Error</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body"></div>
                    </div>
                `;
                
                toastContainer.innerHTML = successToast + errorToast;
                document.body.appendChild(toastContainer);
            }
        }

        proceedToCheckout() {
            if (!this.selectedAddressId) {
                this.showToast('error', 'Please select a delivery address');
                return;
            }
            const subtotal = this.items.reduce((sum, item) => {
                return sum + (parseFloat(item.price) * parseInt(item.quantity));
            }, 0);

            const shipping = this.shippingCost;
            const tax = subtotal * this.taxRate;
            const total = subtotal + shipping + tax;
            
            const orderData = {
                items: this.items.map(item => ({
                    product_id: item.id,
                    cart_id: item.cart_id,
                    product_name: item.product_name,
                    price: item.price,
                    image: item.image
                })),
                subtotal: subtotal.toFixed(2),
                shipping: shipping.toFixed(2),
                tax: tax.toFixed(2),
                total: total.toFixed(2),
                addressId: this.selectedAddressId
            };
            console.log(orderData);
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/payment';
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = 'orderData';
            hiddenField.value = JSON.stringify(orderData);
            form.appendChild(hiddenField);

            document.body.appendChild(form);
            form.submit();
        }

        attachEventListeners() {
            
            $(document).off('click', '.delete-btn');

            $('#proceedToCheckout').on('click', () => {
                this.proceedToCheckout();
            });

            $(document).on('click', '.delete-btn', (e) => {
                e.preventDefault();
                const itemId = $(e.currentTarget).data('id');
                const cartId = $(e.currentTarget).data('cart-id');
                this.removeItem(itemId, cartId);
            });
        }

        removeItem(itemId, cartId) {
            console.log(cartId);
            $.ajax({
                url: 'cart/remove',
                type: 'POST',
                dataType: 'json',
                data: {
                    cart_id: cartId

                },
                beforeSend: () => {
                    $(`.cart-item[data-id="${itemId}"]`).css('opacity', '0.5');
                },
                success: (response) => {
                    if (response.success) {
                        
                        const $allItems = $('.cart-item[data-id="' + itemId + '"]');
                    let animationsComplete = 0;
                    
                    $allItems.fadeOut(300, () => {
                        animationsComplete++;
                        if (animationsComplete === $allItems.length) {
                            this.showToast('success', 'Item removed successfully');
                            this.updateCartFromServer();
                        }
                    });
                    } else {
                        this.showToast('error', response.message || 'Failed to remove item');
                        $(`.cart-item[data-id="${itemId}"]`).css('opacity', '1');
                    }
                },
                error: (xhr, status, error) => {
                    this.showToast('error', 'Failed to remove item from cart');
                    $(`.cart-item[data-id="${itemId}"]`).css('opacity', '1');
                }
            });
        }

        updateCartFromServer() {
            $.ajax({
                url: 'cart/get-items',
                type: 'GET',
                dataType: 'json',
                data: {
                    user_id: '0'
                },
                success: (response) => {
                    if (response.success) {
                        this.items = response.items;
                        this.renderCart();
                        this.updateSummary();
                        
                        if (!this.items || this.items.length === 0) {
                            this.handleEmptyCart();
                        }
                    } else {
                        this.showToast('error', response.message || 'Failed to update cart');
                    }
                }
            });
        }

        handleEmptyCart() {
            const cartContainer = document.querySelector('.cart-container');
            if (cartContainer) {
                cartContainer.innerHTML = `
                    <div class="text-center py-5">
                        <h3>Your cart is empty</h3>
                        <p>Add items to your cart to continue shopping.</p>
                        <a href="/dashboard" class="btn btn-primary">Continue Shopping</a>
                    </div>
                `;
            }
        }

        /*proceedToCheckout() {
            if (!this.selectedAddressId) {
                this.showToast('error', 'Please select a delivery address');
                return;
            }
            const orderData = {
                items: this.items,
                subtotal: this.calculateSubtotal(),
                shipping: this.shippingCost,
                tax: this.calculateTax(),
                total: this.calculateTotal(),
                addressId: this.selectedAddressId
            };
            const $checkoutBtn = $('.checkout-btn');
            $checkoutBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
            console.log(orderData); 
            $.ajax({
                url: 'cart/checkout',
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify(orderData),
                contentType: 'application/json',
                success: (response) => {
                    if (response.success) {
                        this.showToast('success', 'Checkout completed successfully!');
                        this.clearCart();
                    } else {
                        this.showToast('error', response.message || 'Checkout failed. Please try again.');
                    }
                },
                error: (xhr, status, error) => {
                    this.showToast('error', 'An error occurred during checkout. Please try again.');
                    console.error('Checkout error:', error);
                },
                complete: () => {
                    $checkoutBtn.prop('disabled', false).html('Proceed to Checkout');
                }
            });
        } */

        calculateSubtotal() {
            return this.items.reduce((sum, item) => sum + parseFloat(item.price), 0);
        }

        calculateTax() {
            return this.calculateSubtotal() * this.taxRate;
        }

        calculateTotal() {
            return this.calculateSubtotal() + this.shippingCost + this.calculateTax();
        }
        showToast(type, message) {
            const toastEl = document.getElementById(`${type}Toast`);
            if (!toastEl) return;

            const toastBody = toastEl.querySelector('.toast-body');
            if (toastBody) {
                toastBody.textContent = message;
            }

            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }

        fetchAddresses() {
        $.ajax({
            url: '/getSavedAddresses',
            type: 'GET',
            dataType: 'json',
            success: (response) => {
                if (response.success) {
                    this.populateAddressDropdown(response.addresses);
                } else {
                    this.showToast('error', 'Failed to fetch addresses');
                }
            },
            error: () => {
                this.showToast('error', 'Error fetching addresses');
            }
        });
    }

    populateAddressDropdown(addresses) {
        const $select = $('#addressSelect');
        $select.empty();
        $select.append('<option value="">Select an address</option>');
        addresses.forEach(address => {
            $select.append(`<option value="${address.address_id}">${address.street}, ${address.city}, ${address.pincode}</option>`);
        });

        $select.on('change', (e) => {
            this.selectedAddressId = e.target.value;
        });
    }
    clearCart() {
        $.ajax({
            url: 'cart/clear',
            type: 'POST',
            dataType: 'json',
            success: (response) => {
                if (response.success) {
                    this.items = [];
                    this.renderCart();
                    this.updateSummary();
                    this.handleEmptyCart();
                } else {
                    this.showToast('error', 'Failed to clear cart');
                }
            },
            error: () => {
                this.showToast('error', 'Error clearing cart');
            }
        });
    }
    }


    $(document).ready(() => {
        window.cart = new ShoppingCart();
    });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html> 