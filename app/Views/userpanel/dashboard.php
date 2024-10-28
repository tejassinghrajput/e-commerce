<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<?php
$orderdata=session()->getFlashdata('orderdata');
?>
<body>
    <div class="container">
        <h2 class="text-center">User Dashboard</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Order Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($orderdata): ?>
                                    <?php foreach($orderdata as $order): ?>
                                        <tr>
                                            <td><?php echo $order['order_id_for_users']; ?></td>
                                            <td><?php echo $order['product_name']; ?></td>
                                            <td><?php echo $order['order_date']; ?></td>
                                            <td><?php echo $order['category']; ?></td>
                                            <td><?php echo $order['image']; ?></td>
                                            <td><a href="/vieworderdetail/<?php echo $order['order_id']; ?>" class="btn btn-success">View</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr> No order data found.</tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <a href="/logoutUser" class="btn btn-warning">Logout</a>
    </div>
</body>
</html>
