<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Feedback</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .star-rating {
            direction: rtl;
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .star-rating input {
            display: none;
        }
        .star {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
        }
        .star:hover,
        .star:hover ~ .star {
            color: #f39c12;
        }
        .star-rating input:checked ~ .star {
            color: #f39c12;
        }
    </style>
</head>
<?php
    $info1=session()->getFlashdata('info1');
?>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Your Feedback</h2>
        <form action="/submiteditedfeedback/<?php echo $feedbackdata['feedback_id']; ?>" method="post">
            <div class="form-group">
                <label for="rating">Edit Your Rating:</label>
                <div class="star-rating">
                    <input type="radio" name="rating" id="star5" value="5" <?php if ($feedbackdata['star'] == 5) echo 'checked'; ?>>
                    <label for="star5" class="star">★</label>
                    <input type="radio" name="rating" id="star4" value="4" <?php if ($feedbackdata['star'] == 4) echo 'checked'; ?>>
                    <label for="star4" class="star">★</label>
                    <input type="radio" name="rating" id="star3" value="3" <?php if ($feedbackdata['star'] == 3) echo 'checked'; ?>>
                    <label for="star3" class="star">★</label>
                    <input type="radio" name="rating" id="star2" value="2" <?php if ($feedbackdata['star'] == 2) echo 'checked'; ?>>
                    <label for="star2" class="star">★</label>
                    <input type="radio" name="rating" id="star1" value="1" <?php if ($feedbackdata['star'] == 1) echo 'checked'; ?>>
                    <label for="star1" class="star">★</label>
                </div>
            </div>

            <div class="form-group">
                <label for="comment">Edit Your Comments:</label>
                <textarea class="form-control" id="comment" name="text" rows="4"><?php echo $feedbackdata['feedback_text']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Feedback</button>
            <a href="/vieworderdetail/<?php echo $feedbackdata['order_id']; ?>" class="btn btn-link">Cancel</a>
        </form>
        <span style="color:red;">
            <?php
                if($info1){
                    echo $info1;
                }
            ?>
        </span>
    </div>
</body>
</html>
