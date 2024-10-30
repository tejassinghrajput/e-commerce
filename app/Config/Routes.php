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

//logout
$routes->get('/logoutUser','UserController::logout');

//dashboard
$routes->get('/dashboard','dashboardController::viewDashboard');

//search order
$routes->get('/searchOrders','dashboardController::searchOrder');

//orderdetails
$routes->get('/vieworderdetail/(:num)','dashboardController::orderDetails/$1');

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
