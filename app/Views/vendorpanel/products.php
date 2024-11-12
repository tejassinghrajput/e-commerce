<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Vendor Dashboard</title>
    <?php include('vendornavandside.php'); ?>
    <style>
        :root {
            --dashboard-color: #33ccff;
            --dashboard-color-hover: #0066ff;
            --text-primary: #282c3f;
            --text-secondary: #94969f;
            --bg-light: #f5f5f6;
            --shadow-sm: 0 0 4px rgba(40, 44, 63, 0.08);
            --shadow-lg: 0 2px 16px rgba(40, 44, 63, 0.15);
        }

        body {
            font-family: 'Assistant', sans-serif;
            background-color: var(--bg-light);
            margin: 0;
            min-height: 100vh;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .product-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .product-details {
            padding: 15px;
        }

        .product-title {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 5px;
        }

        .product-category {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .product-status {
            font-size: 0.8rem;
            padding: 3px 8px;
            border-radius: 12px;
            display: inline-block;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .modal-content {
            border-radius: 8px;
        }

        .modal-header {
            background: rgba(51, 204, 255, 0.1);
            border-bottom: none;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #ddd;
            padding: 8px 12px;
        }

        .form-control:focus {
            border-color: var(--dashboard-color);
            box-shadow: 0 0 0 0.2rem rgba(51, 204, 255, 0.25);
        }

        .btn-add-product {
            background: var(--dashboard-color);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-add-product:hover {
            background: var(--dashboard-color-hover);
            color: white;
        }

        .sorting-controls {
            margin-bottom: 20px;
        }
        
    </style>
</head>
<body>
    
    <div class="main-content">
        <div class="container-fluid">
            <div class="sorting-controls d-flex justify-content-between align-items-center">
                <h4 class="mb-0">My Products</h4>
                <div class="d-flex gap-3">
                    <select class="form-select" id="sortProducts">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="product-card">
                        <img src="https://via.placeholder.com/300x200" class="product-image" alt="Product">
                        <div class="product-details">
                            <h5 class="product-title">Product Name</h5>
                            <p class="product-category">Category > Subcategory</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="product-status status-active">Active</span>
                                <button class="btn btn-danger btn-sm" onclick="deleteProduct(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProductModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm">
                        <div class="mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" class="form-control" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Category</label>
                                <select class="form-select" id="categorySelect">
                                    <option value="">Select Category</option>
                                    <option value="new">+ Add New Category</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label">Subcategory</label>
                                <select class="form-select" id="subcategorySelect">
                                    <option value="">Select Subcategory</option>
                                    <option value="new">+ Add New Subcategory</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Schedule Publication (Optional)</label>
                            <input type="datetime-local" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-add-product">Add Product</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <p class="text-muted small">Note: New categories require admin approval before they become active.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-add-product">Submit for Approval</button>
                </div>
            </div>
        </div>
    </div>
    <script>
         document.addEventListener('DOMContentLoaded', () => {
            try {
                const navigation = new NavigationComponents();
            } catch(e) {
                console.error('Navigation initialization error:', e);
            }
        });

        document.getElementById('categorySelect').addEventListener('change', function() {
            if (this.value === 'new') {
                const newCategoryModal = new bootstrap.Modal(document.getElementById('newCategoryModal'));
                newCategoryModal.show();
                this.value = '';
            }
        });

        function deleteProduct(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                console.log('Deleting product:', productId);
            }
        }

        document.getElementById('sortProducts').addEventListener('change', function() {
            console.log('Sorting by:', this.value);
        });


        class ProductManagement {
            constructor() {
                this.products = [];
                this.pendingCategories = new Set();
                this.init();
            }

            init() {
                this.initFormListeners();
                this.loadProducts();
            }

            initFormListeners() {
                const addProductForm = document.getElementById('addProductForm');
                const addProductBtn = document.querySelector('.modal-footer .btn-add-product');
                
                addProductBtn.addEventListener('click', () => {
                    if (addProductForm.checkValidity()) {
                        this.handleAddProduct(new FormData(addProductForm));
                    } else {
                        addProductForm.reportValidity();
                    }
                });

                const imageInput = addProductForm.querySelector('input[type="file"]');
                imageInput.addEventListener('change', (e) => this.handleImagePreview(e));

                this.initCategoryManagement();
            }

            handleImagePreview(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        console.log('Image loaded:', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }

            handleAddProduct(formData) {
                const scheduledTime = formData.get('datetime-local');
                
                const product = {
                    id: Date.now(),
                    name: formData.get('text'),
                    category: formData.get('categorySelect'),
                    subcategory: formData.get('subcategorySelect'),
                    image: formData.get('file'),
                    scheduledTime: scheduledTime || null,
                    status: 'active',
                    addedDate: new Date().toISOString()
                };

                if (scheduledTime) {
                    this.scheduleProduct(product);
                } else {
                    this.addProduct(product);
                }

                const modal = bootstrap.Modal.getInstance(document.getElementById('addProductModal'));
                modal.hide();
                document.getElementById('addProductForm').reset();
            }

            scheduleProduct(product) {
                const now = new Date().getTime();
                const scheduleTime = new Date(product.scheduledTime).getTime();
                const delay = scheduleTime - now;

                if (delay > 0) {
                    setTimeout(() => {
                        this.addProduct(product);
                    }, delay);

                    product.status = 'scheduled';
                    this.products.push(product);
                    this.updateProductsDisplay();
                }
            }

            addProduct(product) {
                this.products.push(product);
                this.updateProductsDisplay();
            }

            deleteProduct(productId) {
                this.products = this.products.filter(p => p.id !== productId);
                this.updateProductsDisplay();
            }

            sortProducts(criteria) {
                switch(criteria) {
                    case 'newest':
                        this.products.sort((a, b) => new Date(b.addedDate) - new Date(a.addedDate));
                        break;
                    case 'oldest':
                        this.products.sort((a, b) => new Date(a.addedDate) - new Date(b.addedDate));
                        break;
                }
                this.updateProductsDisplay();
            }

            initCategoryManagement() {
                const categorySelect = document.getElementById('categorySelect');
                const newCategoryForm = document.querySelector('#newCategoryModal form');

                document.querySelector('#newCategoryModal .btn-add-product').addEventListener('click', () => {
                    const categoryName = newCategoryForm.querySelector('input').value;
                    if (categoryName) {
                        this.submitNewCategory(categoryName);
                        const modal = bootstrap.Modal.getInstance(document.getElementById('newCategoryModal'));
                        modal.hide();
                        newCategoryForm.reset();
                    }
                });
            }

            submitNewCategory(categoryName) {
                this.pendingCategories.add(categoryName);
                
                console.log('Submitting new category for approval:', categoryName);
                
                this.updateCategorySelects();
            }

            updateCategorySelects() {
                const categorySelect = document.getElementById('categorySelect');
                
                while (categorySelect.options.length > 2) {
                    categorySelect.remove(2);
                }

                this.pendingCategories.forEach(category => {
                    const option = new Option(`${category} (Pending Approval)`, category);
                    option.disabled = true;
                    categorySelect.add(option);
                });
            }

            updateProductsDisplay() {
                const productsContainer = document.querySelector('.row');
                productsContainer.innerHTML = this.products.map(product => this.createProductCard(product)).join('');
            }

            createProductCard(product) {
                return `
                    <div class="col-md-4 col-lg-3">
                        <div class="product-card">
                            <img src="${product.image || 'https://via.placeholder.com/300x200'}" class="product-image" alt="${product.name}">
                            <div class="product-details">
                                <h5 class="product-title">${product.name}</h5>
                                <p class="product-category">${product.category} > ${product.subcategory}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="product-status status-${product.status}">${product.status}</span>
                                    <button class="btn btn-danger btn-sm" onclick="productManager.deleteProduct(${product.id})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }

            loadProducts() {
                this.products = [
                    {
                        id: 1,
                        name: "Sample Product 1",
                        category: "Electronics",
                        subcategory: "Smartphones",
                        image: "https://via.placeholder.com/300x200",
                        status: "active",
                        addedDate: "2024-01-01"
                    },
                    {
                        id: 2,
                        name: "Sample Product 2",
                        category: "Fashion",
                        subcategory: "Accessories",
                        image: "https://via.placeholder.com/300x200",
                        status: "scheduled",
                        addedDate: "2024-01-02"
                    }
                ];
                this.updateProductsDisplay();
            }
        }

        const productManager = new ProductManagement();

        document.getElementById('sortProducts').addEventListener('change', function() {
            productManager.sortProducts(this.value);
        });
    </script>
    </body>
    </html>