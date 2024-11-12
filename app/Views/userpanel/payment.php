<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Assistant', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #333;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .payment-method {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .payment-option {
            position: relative;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-option input {
            display: none;
        }

        .payment-option .icon {
            font-size: 2em;
            margin-right: 15px;
            transition: color 0.3s ease;
        }

        .payment-option label {
            display: flex;
            align-items: center;
            cursor: pointer;
            width: 100%;
            justify-content: center;
        }

        .payment-option:hover {
            transform: scale(1.03);
        }

        .payment-option.selected {
            border-color: #28a745;
            background-color: rgba(40, 167, 69, 0.1);
        }

        .payment-option.selected .icon {
            color: #28a745;
        }

        .confirm-button {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            background-color: #28a745;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1em;
            width: 100%;
        }

        .confirm-button:hover {
            background-color: #218838;
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .confirm-button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .amount-display {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #28a745;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Payment Gateway</h1>
    <form action="/payment/processPayment" method="POST">
    <input type="hidden" name="orderData" value='<?php echo htmlspecialchars(json_encode($orderData), ENT_QUOTES, 'UTF-8'); ?>'>
        
        <div class="amount-display">
            Total Amount: <span id="amount"><?php echo number_format($orderData['total'], 2); ?></span>
        </div>
        
        <div class="payment-options">
            <h3>Select Payment Method:</h3>
            <div class="payment-method">
                <?php if(getenv('cashfree')=='active'): ?>
                
                <div class="payment-option" data-method="cashfree">
                    <input type="radio" name="payment_method" id="cashfree" value="cashfree">
                    <label for="cashfree">
                        <i class="icon fab fa-stripe"></i>
                        Cash Free
                    </label>
                </div>
                <?php endif; ?>
                <?php if(getenv('razorpay')== 'active'): ?>
                <div class="payment-option" data-method="razorpay">
                    <input type="radio" name="payment_method" id="razorpay" value="razorpay">
                    <label for="razorpay">
                        <i class="icon fas fa-money-check-alt"></i>
                        Razorpay
                    </label>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <button type="submit" class="confirm-button" disabled>Confirm Payment</button>
    </form>
</div>

<script>
    const paymentOptions = document.querySelectorAll('.payment-option');
    const confirmButton = document.querySelector('.confirm-button');
    console.log("Order Data:", document.querySelector('input[name="orderData"]').value);

    paymentOptions.forEach(option => {
        option.addEventListener('click', () => {
            paymentOptions.forEach(opt => opt.classList.remove('selected'));
            
            option.classList.add('selected');
            
            option.querySelector('input[type="radio"]').checked = true;
            
            confirmButton.disabled = false;
        });
    });
</script>
</body>
</html>