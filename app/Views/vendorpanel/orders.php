<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('vendornavandside.php'); ?>
</head>
<body>
    
    <div class="main-content" style="margin-left: 250px; padding: 20px;">
        
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
            try {
                const navigation = new NavigationComponents();
            } catch(e) {
                console.error('Navigation initialization error:', e);
            }
        });
</script>
</html>