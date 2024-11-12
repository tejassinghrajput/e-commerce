
<nav class="navbar" style="height: 60px;">
        <div class="d-flex justify-content-between align-items-center w-100 h-100">
            <div>
                <a href="/dashboard" class="nav-link me-3">
                    <i class="bi bi-house me-2"></i>Home
                </a>
            </div>
            <div class="categories-container">
                <div class="d-flex justify-content-center">
                    <div class="nav-link dropdown">
                        <a href="/category/men"><b>Mens</b></a>
                        <div class="dropdown-content">
                            <a href="/category/men/shirt">Shirts</a>
                            <a href="/category/men/jeans">Jeans</a>
                            <a href="/category/men/shoes">Shoes</a>
                        </div>
                    </div><br>
                    <div class="nav-link dropdown">
                        <a href="/category/women"><b>Womens</b></a>
                        <div class="dropdown-content">
                            <a href="/category/women/saree">Saree</a>
                            <a href="/category/women/skirt">Skirts</a>
                            <a href="/category/women/heels">Heels</a>
                        </div>
                    </div><br>
                    <div class="nav-link dropdown">
                        <a href="/category/kids"><b>Kids</b></a>
                        <div class="dropdown-content">
                            <a href="/category/kids/t-shirt">T-Shirts</a>
                            <a href="/category/kids/jacket">Jacket</a>
                            <a href="/category/kids/shorts">Shorts</a>
                        </div>
                    </div><br>
                    <div class="nav-link dropdown">
                        <a href="/category/beauty"><b>Beauty</b></a>
                        <div class="dropdown-content">
                            <a href="/category/beauty/kajal">Kajal</a>
                            <a href="/category/beauty/lipstick">Lipstick</a>
                            <a href="/category/beauty/nail-polish">Nail-Polish</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <form action="/searchOrders" method="get" class="search-bar me-2 d-flex align-items-center" style="height: 100%;">
                    <input type="text" name="search" class="search-input" placeholder="Search for orders..." value="<?= isset($_GET['search']) ? esc($_GET['search']) : '' ?>" style="height: 40px;">
                    <button type="submit" class="search-btn" style="height: 40px;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <div class="dropdown">
                    <a href="/viewprofile" class="btn-lg me-2 custom-btn d-flex align-items-center" style="height: 100%;">
                        <i class="bi bi-person"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="/viewprofile">View Profile</a>
                        <a href="/logoutUser  ">Logout</a>
                        <a href="/changepassword">Change Password</a>
                        <a href="/ordersInfo">Your Orders</a>
                    </div>
                </div>
                <a href="/cart" class="custom-btn d-flex align-items-center" style="height: 100%;">
                    <i class="fas fa-shopping-cart mr-2"></i>
                </a>
            </div>
        </div>
    </nav>