<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Checkout</title>
</head>
<body>
    <h1>Payment Processing...</h1>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <?php session()->set('orderData',$orderData); ?>
    <?php session()->set('requestData',$requestData); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                "key": "<?php echo $data['key']; ?>",
                "amount": "<?php echo $data['amount']; ?>",
                "currency": "<?php echo $data['currency']; ?>",
                "order_id": "<?php echo $data['order_id']; ?>",
                "name": "<?php echo $data['name']; ?>",
                "description": "<?php echo $data['description']; ?>",
                "image": "<?php echo $data['image']; ?>",
                "prefill": {
                    "name": "<?php echo $data['prefill']['name']; ?>",
                    "email": "<?php echo $data['prefill']['email']; ?>",
                    "contact": "<?php echo $data['prefill']['contact']; ?>"
                },
                "notes": {
                    "address": "<?php echo $data['notes']['address']; ?>",
                    "merchant_order_id": "<?php echo $data['notes']['merchant_order_id']; ?>"
                },
                "theme": {
                    "color": "<?php echo $data['theme']['color']; ?>"
                },
                "handler": function(response) {
                    fetch('/store_payment_id', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            razorpay_payment_id: response.razorpay_payment_id,
                            payment_method: 'razorpay',
                        })
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        setTimeout(() => {
                            if (data.status === 'success') {
                                window.location.href = '/payment-success';
                            } else {
                                window.location.href = '/payment-failed';
                            }
                        }, 0);
                    })
                    .catch(error => {
                        console.error("Error while saving payment ID to session: ", error);
                        window.location.href = '/payment-failed';
                    });
                },
                "modal": {
                    "ondismiss": function() {
                        window.location.href = '/payment-failed';
                    }
                }
            };
            
            try {
                var rzp1 = new Razorpay(options);
                rzp1.open();
            } catch (err) {
                console.error("Error opening Razorpay checkout: ", err);
            }
        });
    </script>
</body>
</html>