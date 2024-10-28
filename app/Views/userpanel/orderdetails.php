<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Feedback</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f1f3f6;
            font-family: Arial, sans-serif;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            max-width: 900px; /* Increased width to accommodate two columns */
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .order-details {
            margin-bottom: 30px;
        }
        .star-rating {
            direction: rtl;
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }
        .star-rating input {
            display: none;
        }
        .star {
            font-size: 32px;
            color: #e0e0e0;
            cursor: pointer;
            transition: color 0.3s;
        }
        .star:hover,
        .star:hover ~ .star {
            color: #ffbf00;
        }
        .star-rating input:checked ~ .star {
            color: #ffbf00;
        }
        .form-group label {
            font-weight: bold;
            color: #555;
        }
        .previous-feedback {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .feedback-item {
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff;
            border-left: 4px solid #007bff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-radius: 5px;
        }
        .btn-primary, .btn-success {
            width: 50%%;
            margin-top: 10px;
        }
        .product-info img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }
        .product-info ul {
            padding: 0;
            list-style-type: none;
        }
        .btn-sm {
            font-size: 0.85rem;
        }
        .alert {
            display: none;
        }
    </style>
</head>
<?php
$orderinfo = session()->getFlashdata('orderinfo');
$feedbackinfo = session()->getFlashdata('feedbackinfo');
$successMessage = session()->getFlashdata('successMessage');
$sum = session()->getFlashdata('sum');
?>
<body>
    <div class="container">
        <h2>Order Feedback</h2>
        <?php if ($successMessage): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $successMessage; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-4">
                <div class="product-info d-flex align-items-center">
                    <img src="<?php echo isset($orderinfo['product_image']) ? $orderinfo['product_image'] : 'placeholder.jpg'; ?>" alt="Product Image">
                    <ul>
                        <li><strong>Order ID:</strong> <?php echo isset($orderinfo['orderidforusers']) ? $orderinfo['orderidforusers'] : "No data"; ?></li>
                        <li><strong>Product:</strong> <?php echo isset($orderinfo['productname']) ? $orderinfo['productname'] : "No data"; ?></li>
                        <li><strong>Category:</strong> <?php echo isset($orderinfo['category']) ? $orderinfo['category'] : "No data"; ?></li>
                        <li><strong>Order Date:</strong> <?php echo isset($orderinfo['orderdate']) ? $orderinfo['orderdate'] : "No data"; ?></li>
                        <li><strong>Average Rating:</strong> <?php echo isset($sum) ? $sum : "No data"; ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="order-details">
                    <h5>Rate Your Experience:</h5>
                    <form method="post" action="/submitfeedback/<?php echo $orderinfo['order_id']; ?>">
                        <div class="form-group">
                            <div class="star-rating">
                                <input type="radio" name="rating" id="star5" value="5">
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
                        </div>
                        <div class="form-group">
                            <label for="comment">Your Comments:</label>
                            <textarea class="form-control" id="comment" name="text" rows="4" placeholder="Write your feedback here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                    <span style="color: red;"><?php if(session()->getFlashdata() != null) { echo session()->getFlashdata('info'); } ?></span>
                </div>

                <div class="previous-feedback">
                    <h5>Previous Feedback:</h5>
                    <?php if($feedbackinfo): ?>
                        <?php foreach ($feedbackinfo as $feedback): ?>
                            <p><strong>User:</strong> <?php echo isset($feedback['user_name']) ? $feedback['user_name'] : 'No Name provided.'; ?></p>
                            <div class="feedback-item">
                                <p><strong>Rating:</strong>
                                    <?php
                                    if(isset($feedback['star'])) {
                                        for($i = 1; $i <= 5; $i++) {
                                            echo $i <= $feedback['star'] ? '<span style="color: #ffbf00;">★</span>' : '<span style="color: #e0e0e0;">☆</span>';
                                        }
                                    }
                                    ?>
                                </p>
                                <p><strong>Comments:</strong> <?php echo isset($feedback['feedback_text']) ? $feedback['feedback_text'] : 'No comments provided.'; ?></p>
                                
                                <?php if(session()->get('id') == $feedback['user_id']): ?>
                                    <a href="javascript:void(0);" onclick="openDeleteModal('<?php echo $feedback['feedback_id']; ?>', '<?php echo $orderinfo['order_id']; ?>')" class="btn btn-danger btn-sm">Delete</a>
                                    <a href="/editfeedback/<?php echo $feedback['feedback_id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No feedback yet!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <a href="/dashboard" class="btn btn-success mt-3">Go Back</a>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this feedback? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function openDeleteModal(feedbackId, orderId) {
            $('#confirmDeleteBtn').off('click').on('click', function() {
                window.location.href = '/deletefeedback/' + feedbackId + '/' + orderId;
            });
            $('#deleteConfirmationModal').modal('show');
        }
    </script>
</body>
</html>
