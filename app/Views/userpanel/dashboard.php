<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <style>
        :root {
            --dashboard--color: #33ccff;
            --dashboard--color-hover: #0066ff;
            --text-primary: #282c3f;
            --text-secondary: #94969f;
            --bg-light: #f5f5f6;
            --shadow-sm: 0 0 4px rgba(40, 44, 63, 0.08);
            --shadow-lg: 0 2px 16px rgba(40, 44, 63, 0.15);
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Assistant', sans-serif;
            margin: 0;
            color: var(--text-primary);
            overflow-x: hidden;
        }
        .navbar {
            background-color: #ffffff;
            padding: 12px 40px;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
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
        .container {
            margin-top: 20px;
            padding: 20px;
            width: 100%;
            background: transparent;
            border-radius: 0;
            box-shadow: none;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
        .category-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 0;
            box-shadow: var(--shadow-sm);
            margin-bottom: 0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .category-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--dashboard--color), var(--dashboard--color-hover));
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }

        .category-container:hover::before {
            transform: scaleX(1);
        }

        .category-container:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }
        .category-containerone {
            background: #ffffff;
            padding: 20px;
            border-radius: 0;
            box-shadow: var(--shadow-sm);
            margin-bottom: 0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .category-containerone::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--dashboard--color), var(--dashboard--color-hover));
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }

        .category-containerone:hover::before {
            transform: scaleX(1);
        }

        .category-containerone:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }
        .btn-view-details {
            background-color: var(--dashboard--color);
            color: white;
            border: none;
            border-radius: 3px;
            padding: 4px 8px;
            font-size: 10px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            white-space: nowrap;
        }

        .btn-view-details:hover {
            background-color: var(--dashboard--color-hover);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }
        .filter-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--text-primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            padding-bottom: 10px;
        }

        .filter-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--dashboard--color);
        }
        .category-item {
            margin-bottom: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
        }

        .category-item:hover {
            background-color: rgba(255, 62, 108, 0.05);
            transform: translateX(5px);
        }

        .category-checkbox {
            margin-left: 8px;
            color: var(--text-secondary);
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .category-item:hover .category-checkbox {
            color: var(--text-primary);
        }
        .form-check-input {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .form-check-input:checked {
            background-color: var(--dashboard--color);
            border-color: var(--dashboard--color);
            transform: scale(1.1);
        }
        .btn-submit {
            background-color: var(--dashboard--color);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            width: auto;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-submit:hover {
            background-color: var(--dashboard--color-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn-submit:hover::before {
            width: 300px;
            height: 300px;
        }
        .order-card {
            background: #ffffff;
            border: none;
            border-radius: 0;
            box-shadow: var(--shadow-sm);
            margin-bottom: 20px;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .order-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                45deg,
                transparent 0%,
                rgba(255, 255, 255, 0.1) 50%,
                transparent 100%
            );
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .order-card:hover::after {
            transform: translateX(100%);
        }

        .order-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-3px);
        }

        .order-image {
            height: 280px;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .order-card:hover .order-image {
            transform: scale(1.08);
        }
        .card-body {
            padding: 12px;
            background: linear-gradient(
                180deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 1) 15%
            );
        }

        .order-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-primary);
            margin-right: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .card-text {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logout-btn:hover {
            background-color: #c82333;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite linear;
        }
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
        }

        .empty-state i {
            font-size: 48px;
            color: var(--text-secondary);
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 12px 20px;
            }
            
            .container {
                padding: 10px;
            }

            .order-image {
                height: 200px;
            }

            .category-container {
                margin-bottom: 15px;
            }
        }
        .navbar .custom-btn {
            padding: 0.25rem 0.5rem;
            font-size: 1.25rem;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        .custom-btn:hover {
            background-color: rgba(0, 123, 255, 0.1);
            color: var(--dashboard--color);
        }
        
        .dropbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
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

    </style>
</head>
<?php 
if(isset($orderdata)){
    $orderdata = $orderdata;
}else{
    $orderdata=[];
}
if(isset($averageRatings)){
    $averageRatings = $averageRatings;
}else{
    $averageRatings=null;
}
if(isset($selectedCategories)){
    $selectedCategories = $selectedCategories;
}else{
    $selectedCategories=[];
}
?>
<body>
    <nav class="navbar" style="height: 60px;">
        <div class="d-flex justify-content-between align-items-center w-100 h-100">
            <div>
                <a href="/dashboard" class="nav-link me-3">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </div>
            <div class="d-flex align-items-center">
                <form action="/searchOrders" method="get" class="search-bar me-2 d-flex align-items-center" style="height: 100%;">
                    <input type="text" name="search" class="search-input" placeholder="Search for orders..." value="<?= isset($_GET['search']) ? esc($_GET['search']) : '' ?>" style="height: 40px;">
                    <button type="submit" class="search-btn" style="height: 40px;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <div class="dropdown">
                    <a href="#" class="btn-lg me-2 custom-btn d-flex align-items-center" style="height: 100%;">
                        <i class="bi bi-person"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="/viewprofile">View Profile</a>
                        <a href="/logoutUser  ">Logout</a>
                        <a href="#">Change Password</a>
                    </div>
                </div>
                <a href="#" class="custom-btn d-flex align-items-center" style="height: 100%;">
                    <i class="fas fa-shopping-cart mr-2"></i>
                </a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="category-container">
                    <h4 class="filter-title">Filters</h4>
                    <form action="/applyFilters" method="get" id="filterForm">
                        <div class="category-item">
                            <input class="form-check-input" type="checkbox" value="Electronics" id="category1" name="categories[]"
                                <?php echo in_array('Electronics', $selectedCategories) ? 'checked' : ''; ?>>
                            <label class="category-checkbox" for="category1">Electronics</label>
                        </div>
                        <div class="category-item">
                            <input class="form-check-input" type="checkbox" value="Accessories" id="category2" name="categories[]"
                                <?php echo in_array('Accessories', $selectedCategories) ? 'checked' : ''; ?>>
                            <label class="category-checkbox" for="category2">Accessories</label>
                        </div>
                        <div class="category-item">
                            <input class="form-check-input" type="checkbox" value="Furniture" id="category3" name="categories[]"
                                <?php echo in_array('Furniture', $selectedCategories) ? 'checked' : ''; ?>>
                            <label class="category-checkbox" for="category3">Furniture</label>
                        </div>
                        <div class="category-item">
                            <input class="form-check-input" type="checkbox" value="Fitness" id="category4" name="categories[]"
                                <?php echo in_array('Fitness', $selectedCategories) ? 'checked' : ''; ?>>
                            <label class="category-checkbox" for="category4">Fitness</label>
                        </div>
                        <button type="submit" class="btn-submit" id="filterSubmitBtn">
                            <span>Apply Filters</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <?php if (is_array($orderdata) && !empty($orderdata)): ?>
                        <?php if (isset($orderdata['no_results'])): ?>
                            <div class="col-12">
                                <div class="empty-state">
                                    <i class="fas fa-search"></i>
                                    <p class="mb-0"><?php $message=session()->getFlashdata('message'); echo $message; ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                        <div class="col-12">
                            <div class="category-containerone">
                                <div class="row">
                                    <?php foreach ($orderdata as $order ): ?>
                                        <div class="col-md-3">
                                            <div class="card order-card">
                                                <div class="position-relative overflow-hidden">
                                                <a href="/vieworderdetail/<?php echo $order['order_id']; ?>" style="text-decoration: none;">
                                                <img src="" data-src="<?php echo base_url('imagecontroller/show/' . $order['image']); ?>" class="card-img-top order-image" alt="<?php echo $order['product_name']; ?>">
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5 class="order-title mb-0"><?php echo $order['product_name']; ?></h5>
                                                        <div class="product-rating">
                                                            <?php 
                                                                $averageRating = isset($averageRatings[$order['order_id']]) ? $averageRatings[$order['order_id']] : 0;
                                                                $fullStars = floor($averageRating);
                                                                $halfStar = $averageRating - $fullStars >= 0.5;
                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    if ($i <= $fullStars) {
                                                                        echo '<i class="fas fa-star" style="color: gold;"></i>';
                                                                    }
                                                                    else if($i==$fullStars + 1 && $halfStar){
                                                                        echo '<i class="fas fa-star-half-alt" style="color: gold;"></i>';
                                                                    }
                                                                    else {
                                                                        echo '<i class="far fa-star" style="color: gold;"></i>';
                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                        <?php else: ?>
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="fas fa-shopping-bag"></i>
                                <p class="mb-0"><?php $message=session()->getFlashdata('message'); echo $message; ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.order-image');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        observer.unobserve(img);
                    }
                });
            });
            images.forEach(img => imageObserver.observe(img));
        });
    </script>
</body>
</html>
