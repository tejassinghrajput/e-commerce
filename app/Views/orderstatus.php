<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .order-status {
            margin: 20px 0;
            font-size: 1.2em;
            color: #28a745;
        }

        .order-details {
            margin: 20px 0;
            font-size: 1em;
            color: #555;
        }

        .status {
            font-weight: bold;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 1em;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Confirmation</h1>
        <?php 
        $orderData = session()->getFlashdata('orderData');
        $status = session()->getFlashdata('status');
        ?>
        <div class="order-status" id="order-status">Transaction Status: <span class="status" id="status"><?php echo session()->getFlashdata('status'); ?></span></div>
        <div class="order-details">
            <p>Order ID: <span id="order-id">#123456</span></p>
            <p>Total Amount: <span id="order-amount">₹<?php echo $orderData->total; ?></span></p>
        </div>
        <div id="countdown" style="margin: 20px 0; color: #666;">
            Redirecting to cart in <span id="timer">5</span> seconds...
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>

        let timeLeft = 5;
                const timerElement = document.getElementById('timer');
                
                function redirectToDashboard() {
                    window.location.href = '/ordersInfo';
                }

                const countdown = setInterval(function() {
                    timeLeft--;
                    timerElement.textContent = timeLeft;
                    
                    if (timeLeft <= 0) {
                        clearInterval(countdown);
                        redirectToDashboard();
                    }
                }, 1000);
    </script>
</body>
</html>