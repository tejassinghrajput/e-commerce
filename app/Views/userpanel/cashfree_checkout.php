<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Cashfree Checkout</title>
    <?php session()->set('orderData',$orderData); ?>
</head>
<body>
    <h1>Redirecting to payment gateway...</h1>
    
    <?php 
        $paymentLink = $data->cfOrder->getPaymentlink();
    ?>
    
    <script>
        console.log('Starting redirect');
        var paymentLink = "<?php echo htmlspecialchars($paymentLink, ENT_QUOTES, 'UTF-8'); ?>";
        console.log('Redirecting to:', paymentLink);
        window.location.href = paymentLink;
        

    </script>
</body>
</html>