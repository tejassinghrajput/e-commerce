<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//login and register
$routes->get('/', 'UserController::login');
$routes->get('/login','UserController::login');
$routes->get('/register','UserController::register');
$routes->post('/registerUser','registerController::registerUser');
$routes->post('/loginUser','loginController::userLogin');

//change password
$routes->get('/changepassword', 'UserController::changepassword');
$routes->post('updatePassword', 'dashboardController::updatePassword');
//logout
$routes->get('/logoutUser','UserController::logout');

//dashboard
$routes->get('/dashboard','dashboardController::viewDashboard');
$routes->get('/viewprofile','dashboardController::viewProfile');

//search order
$routes->get('/searchOrders','dashboardController::searchOrder');

//orderdetails
$routes->get('/vieworderdetail/(:num)','dashboardController::productDetails/$1');

//submission of feedback

$routes->post('/submitfeedback/(:num)','feedbackController::submitfeedback/$1');
$routes->post('/submiteditedfeedback/(:num)','feedbackController::submitedit/$1');

//editing feedbackpage
$routes->get('/editfeedback/(:num)','feedbackController::editFeedback/$1');

//delete feedback
$routes->get('/deletefeedback/(:num)/(:num)','feedbackController::deleteFeedback/$1/$2');

$routes->get('/applyFilters','dashboardController::filterOrders');

// Image Controller
$routes->get('imagecontroller/show/(:any)', 'ImageController::show/$1');

//address
$routes->post('/addAddress', 'addressController::add');
$routes->get('/getSavedAddresses', 'addressController::showall');
$routes->post('/makeDefaultAddress', 'addressController::makedefault');
$routes->post('/editAddress', 'addressController::edit');
$routes->post('/deleteAddress', 'addressController::delete');


$routes->get('/category/(:any)/(:any)', 'categoryController::displaysubCategory/$1/$2');
$routes->get('/category/(:any)', 'categoryController::displayCategory/$1');

$routes->get('/admin', 'AdminController::adminHome');

// cart options
$routes->get('/cart','cartController::viewCart');
$routes->post('/addtoCart', 'cartController::addtoCart');
$routes->post('cart/remove', 'cartController::removeItem');
$routes->get('cart/get-items', 'cartController::getAll');
$routes->post('cart/checkout', 'cartController::checkout');
$routes->post('cart/clear', 'cartController::clearCart');
$routes->post('/payment', 'paymentController::view');
$routes->post('/payment/processPayment', 'PaymentController::processPayment');
$routes->get('/orderinfo', 'PaymentController::vieworderInfo');
$routes->get('/ordersInfo', 'PaymentController::viewOrderPage');

//razorpay
$routes->get('razorpay', 'PaymentController::view');
$routes->get('/payment-success', 'paymentController::success');
$routes->get('/payment-failed', 'paymentController::failed');
$routes->post('/store_payment_id', 'PaymentController::storePaymentid');

//cashfree

$routes->get('/fetch_payment_status', 'PaymentController::fetch');

//vendor routes
$routes->get('/vendor', '\App\Controllers\vendorController\vendorHome::vendorHome');
$routes->get('/products', '\App\Controllers\vendorController\vendorHome::products');
$routes->get('/orders', '\App\Controllers\vendorController\vendorHome::orders');
