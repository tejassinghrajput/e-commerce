<?php $productinfo = session()->getFlashdata('productinfo'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $productinfo['product_name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-btn-color: #4a90e2;
            --primary-btn-hover: #357abd;
            --submit-btn-color: #00a389;
            --submit-btn-hover: #008571;
            --text-white: #ffffff;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 4px 8px rgba(0, 0, 0, 0.15);
            --primary-color: #33ccff;
            --secondary-color: #3e4152;
            --border-color: #d4d5d9;
            --success-color: #03a685;
            --star-color: #ffc107;
            --hover-color: #0066ff;
        }

        
        body {
            background-color: var(--bg-light);
            font-family: 'Assistant', sans-serif;
            margin: 0;
            color: var(--text-primary);
            overflow-x: hidden;
        }


        .container {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-top: 32px;
            max-width: 1000px;
            transition: filter 0.3s ease;
        }

        .product-card {
            display: flex;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 24px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .product-image {
            width: 180px;
            height: 240px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 24px;
        }

        .product-info {
            flex: 1;
            padding: 12px 0;
        }

        .product-info h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 16px;
            color: var(--secondary-color);
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-list li {
            margin-bottom: 12px;
            color: #696b79;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .info-list li i {
            margin-right: 8px;
            color: var(--primary-color);
        }

        .rating-section {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .star-rating {
            direction: rtl;
            display: flex;
            justify-content: center;
            margin: 20px 0;
            gap: 8px;
        }

        .star-rating input {
            display: none;
        }

        .star {
            font-size: 40px;
            color: #d4d5d9;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .action-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .edit-button {
            color: #3498db;
        }

        .edit-button:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }

        .delete-button {
            color: #e74c3c;
        }

        .delete-button:hover {
            background-color: rgba(231, 76, 60, 0.1);
        }

        .action-button i {
            font-size: 16px;
        }
        .star:hover,
        .star:hover ~ .star,
        .star-rating input:checked ~ .star {
            color: var(--star-color);
            transform: scale(1.1);
        }

        .custom-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 100px;
            margin-top: 10px;
        }

        .custom-button:hover {
            background-color: var(--hover-color);
            transform: translateY(-1px);
        }

        .custom-button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .button-text {
            transition: opacity 0.2s ease;
        }

        .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.8s linear infinite;
            position: absolute;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .feedback-list {
            margin-top: 32px;
        }

        .feedback-item {
            background: #fff;
            position: relative;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 16px;
            border-left: 4px solid var(--primary-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .feedback-item.visible {
            transform: translateY(0);
            opacity: 1;
        }

        .feedback-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .user-name {
            font-weight: 600;
            color: var(--secondary-color);
        }

        .rating-stars {
            color: var(--star-color);
            font-size: 16px;
        }

        .feedback-content {
            color: #696b79;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .feedback-actions {
            position: absolute;
            right: 20px;
            bottom: 20px;
            display: flex;
            gap: 10px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.active {
            display: flex;
            opacity: 1;
            justify-content: center;
            align-items: center;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 999;
        }

        .modal-content {
            position: relative;
            background: white;
            padding: 24px;
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            z-index: 1001;
        }

        .modal.active .modal-content {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .close-button {
            background: none;
            border: none;
            font-size: 24px;
            color: #696b79;
            cursor: pointer;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .toast {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            background-color: #333;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            opacity: 1;
            transform:translate(-50%, -20px);
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }
        .toast-content {
            max-width: 350px;
        }
        textarea.form-control {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 12px;
            resize: none;
            transition: all 0.2s ease;
            font-size: 14px;
            line-height: 1.6;
        }

        textarea.form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255,63,108,0.1);
            outline: none;
        }
        
        .price-cart-container {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .product-price {
            font-size: 22px;
            font-weight: bold;
            color: var(--secondary-color);
            display: flex;
            align-items: center;
        }

        .add-to-cart-btn {
            background-color: var(--submit-btn-color);
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            width: 100%; 
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .add-to-cart-btn:hover {
            background-color: var(--submit-btn-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .add-to-cart-btn i {
            margin-right: 10px;
            font-size: 20px;
        }

        .product-card {
            position: relative;
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


        .reaction-link {
            padding: 10px 20px;
            border: 2px solid transparent;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
            text-decoration: none;
        }

        .like-button {
            color: #4CAF50;
        }

        .dislike-button {
            color: #f44336;
        }

        .like-button.active {
            background-color: #4CAF50;
            color: white;
        }

        .dislike-button.active {
            background-color: #f44336;
            color: white;
        }

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border-radius: 5px;
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s, transform 0.5s;
            z-index: 9999;
        }

        .toast.success {
            background-color: #4CAF50;
        }

        .toast.error {
            background-color: #f44336;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        
    </style>
</head>
<?php
$productinfo = session()->getFlashdata('productinfo');
$feedbackinfo = session()->getFlashdata('feedbackinfo');
$successMessage = session()->getFlashdata('successMessage');
$sum = session()->getFlashdata('sum');
?>
<body>
    <?php include("header.php"); ?>
    <div id="mainContainer" class="container">
        <h2 class="page-title">Order Feedback</h2>
        
        <?php if ($successMessage): ?>
            <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                <?php echo $successMessage; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-5">
                <div class="product-card">
                    <img src="<?php echo base_url('imagecontroller/show/'.$productinfo['image']); ?>" class="product-image" alt="Product Image">
                    <div class="product-info">
                        <h3><?php echo isset($productinfo['product_name']) ? $productinfo['product_name'] : "Product Name"; ?></h3>
                        <ul class="info-list">
                            <li><i class="fas fa-box"></i> Product ID: <?php echo isset($productinfo['product_id_for_users']) ? $productinfo['product_id_for_users'] : "No data"; ?></li>
                            <li><i class="fas fa-tag"></i> Category: <?php echo isset($productinfo['category']) ? $productinfo['category'] : "No data"; ?></li>
                            <li><i class="fas fa-calendar"></i> Added on: <?php echo isset($productinfo['order_date']) ? date('d M Y', strtotime($productinfo['order_date'])) : "No data"; ?></li>
                            <li><i class="fas fa-star"></i> Average Rating: <?php echo isset($sum) ? number_format($sum, 1) : "No data"; ?></li>
                        </ul>
                        <div class="price-cart-container">
                            <div class="product-price">
                                Rs. <?php echo isset($productinfo['price']) ? number_format($productinfo['price'], 2) : "N/A"; ?>
                            </div>
                            <button id="addToCartBtn" class="add-to-cart-btn" data-product-id="<?php echo $productinfo['product_id']; ?>">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="feedback-list">
                    <h4>Previous Reviews</h4>
                    <?php if($feedbackinfo): ?>
                        <?php foreach ($feedbackinfo as $feedback): ?>
                            <div class="feedback-item">
                                <div class="feedback-header">
                                    <span class="user-name"><?php echo isset($feedback['user_name']) ? $feedback['user_name'] : 'Anonymous'; ?></span>
                                    <div class="rating-stars">
                                        <?php
                                        if(isset($feedback['star'])) {
                                            for($i = 1; $i <= 5; $i++) {
                                                echo $i <= $feedback['star'] ? '★' : '☆';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="feedback-content">
                                    <?php echo isset($feedback['feedback_text']) ? $feedback['feedback_text'] : 'No comments provided.'; ?>
                                </div>
                                <?php if(session()->get('id') == $feedback['user_id']): ?>
                                    <div class="feedback-actions">
                                        <button onclick="openDeleteModal('<?php echo $feedback['feedback_id']; ?>', '<?php echo $productinfo['product_id']; ?>')" 
                                            class="action-button delete-button" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button type="button" onclick="openEditModal('<?php echo $feedback['feedback_id']; ?>', '<?php echo $feedback['feedback_text']; ?>', '<?php echo $feedback['star']; ?>')" class="action-button delete-button" title="Delete">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                    <div class="feedback-reactions">
                                        <a href="javascript:void(0);" id="like-button-<?php echo $feedback['feedback_id']; ?>" class="reaction-link like-button" onclick="handleReaction('<?php echo $feedback['feedback_id']; ?>', 'like')">
                                            <i class="fas fa-thumbs-up"></i> <span class="like-count">1</span>
                                        </a>
                                        <a href="javascript:void(0);" id="dislike-button-<?php echo $feedback['feedback_id']; ?>" class="reaction-link dislike-button" onclick="handleReaction('<?php echo $feedback['feedback_id']; ?>', 'dislike')">
                                            <i class="fas fa-thumbs-down"></i> <span class="dislike-count">1</span>
                                        </a>
                                    </div>

                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center text-muted py-4">
                            <p>No reviews yet. Be the first to share your experience!</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="rating-section">
                    <h4>Rate Your Experience</h4>
                    <form id="feedbackForm" method="post" action="/submitfeedback/<?php echo $productinfo['product_id']; ?>">
                        <div class="star-rating">
                            <input type="radio" name="rating" id="star5" value="5" required>
                            <label for="star5" class="star">★</label>
                            <input type="radio" name="rating" id="star4" value="4">
                            <label for="star4" class="star">★</label>
                            <input type="radio" name="rating" id="star3" value="3">
                            <label for="star3" class="star">★</label>
                            <input type="radio" name="rating" id="star2" value="2">
                            <label for="star2" class="star">★</label>
                            <input type="radio" name="rating" id="star1" value="1">
                            <label for="star1" class="star">★</label>
                        </div>
                        
                        <div class="form-group">
                            <textarea class="form-control" id="comment" name="text" rows="4" 
                                placeholder="Share your experience about this product..." required></textarea>
                        </div>
                        
                        <button type="submit" class="custom-button">
                            <span class="button-text">Submit Review</span>
                            <span class="spinner"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Review</h5>
                <button type="button" class="close-button" onclick="closeDeleteModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this review? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="custom-button" onclick="closeDeleteModal()">
                    <span class="button-text">Cancel</span>
                </button>
                <button type="button" id="confirmDeleteBtn" class="custom-button">
                    <span class="button-text">Delete Review</span>
                    <span class="spinner"></span>
                </button>
            </div>
        </div>
    </div>
    <div id="editFeedbackModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Your Feedback</h5>
                <button type="button" class="close-button" onclick="closeEditModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editFeedbackForm" method="post" action="">
                    <div class="form-group">
                        <label for="editRating">Edit Your Rating:</label>
                        <div class="star-rating">
                            <input type="radio" name="rating" id="editStar5" value="5">
                            <label for="editStar5" class="star">★</label>
                            <input type="radio" name="rating" id="editStar4" value="4">
                            <label for="editStar4" class="star">★</label>
                            <input type="radio" name="rating" id="editStar3" value="3">
                            <label for="editStar3" class="star">★</label>
                            <input type="radio" name="rating" id="editStar2" value="2">
                            <label for="editStar2" class="star">★</label>
                            <input type="radio" name="rating" id="editStar1" value="1">
                            <label for="editStar1" class="star">★</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editComment">Edit Your Comments:</label>
                        <textarea class="form-control" id="editComment" name="text" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="custom-button">Update Feedback</button>
                </form>
            </div>
        </div>
</div>
<div id="toast" class="toast" style="display: none;">
    <div class="toast-content" id="toastContent"></div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/your-kit-code.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="<?= base_url('assets/app.js') ?>"></script>
    <script>
        const flashMessage = "<?php echo session()->getFlashdata('info'); ?>";
            if (flashMessage) {
                const toast = document.getElementById('toast');
                const toastContent = document.getElementById('toastContent');
                toastContent.textContent = flashMessage;
                toast.style.display = 'block';
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => {
                        toast.style.display = 'none';
                        toast.style.opacity = '1';
                    }, 500);
                }, 3000);
            }

        function handleReaction(feedbackId, action) {
            $.ajax({
                url: 'feedback_reaction',
                method: 'POST',
                data: { feedback_id: feedbackId, action: action },
                success: function(response) {
                    console.log("AJAX response: ",response);
                    var data = response;
                    console.log(data);
                    if (data.status == 'success') {
                        showToast(data.message);
                        updateUI(feedbackId, action);
                    } else {
                        showToast(data.message);
                    }
                },
                error: function() {
                    showToast('An error occurred. Please try again later.');
                }
            });
        }
        function updateUI(feedbackId, action) {
            var likeButton = $('#like-button-' + feedbackId);
            var dislikeButton = $('#dislike-button-' + feedbackId);

            if (action === 'like') {
                if (likeButton.hasClass('active')) {
                    likeButton.removeClass('active');
                } else {
                    likeButton.addClass('active');
                    dislikeButton.removeClass('active');
                }
            } else if (action === 'dislike') {
                if (dislikeButton.hasClass('active')) {
                    dislikeButton.removeClass('active');
                } else {
                    dislikeButton.addClass('active');
                    likeButton.removeClass('active');
                }
            }
        }

        
        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastContent = document.getElementById('toastContent');
            toastContent.textContent = message;
            toast.style.display = 'block';
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 300);
            }, 3000);
        }
</script>

</body>
</html>