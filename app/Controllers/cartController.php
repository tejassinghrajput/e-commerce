<?php

namespace App\Controllers;
use App\Models\ProductsModel;
use App\Models\FeedbackModel;
use App\Models\UserModel;
use App\Models\CartModel;
use App\Models\MongoModel;

class cartController extends BaseController{


    protected $productsModel;
    protected $mongoModel;
    protected $feedbackModel;
    protected $userModel;
    protected $cartModel;

    public function __construct(){
        parent::__construct();
        $this->productsModel = new ProductsModel();
        $this->feedbackModel = new FeedbackModel();
        $this->userModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->mongoModel = new MongoModel();
    }

    public function addtoCart(){
        $productId = $this->request->getPost('product_id');
        $userId = session()->get('id');
        
        $checkAlreadyExists = $this->cartModel->getAllcartfromuserId($userId);

        $productExistsInCart = false;
        foreach ($checkAlreadyExists as $item) {
            if ($item['product_id'] == $productId) {
                $productExistsInCart = true;
                break;
            }
        }

        
        $metadata['product_id'] = $productId; 
        
        if($productExistsInCart){
            $result = $this->cartModel->updateCartbyproductidanduserId($productId, $userId);
            if ($result) {
                $metadata['info'] = 'User added a product to cart.';
                $this->mongoModel->addAction("/addtoCart", $metadata);
                return $this->response->setJSON(['success' => true, 'message' => 'Item added to cart successfully']);
            } else {
                $metadata['info'] = 'User added a product to cart but failed.';
                $this->mongoModel->addAction("/addtoCart", $metadata);
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to add item to cart']);
            }
        }
        else{
            $result = $this->cartModel->insertintocartbyproductidanduserId($productId, $userId);

            if ($result) {
                $metadata['info'] = 'User added a product to cart.';
                $this->mongoModel->addAction("/addtoCart", $metadata);
                return $this->response->setJSON(['success' => true, 'message' => 'Item added to cart successfully']);
            } else {
                $metadata['info'] = 'User added a product to cart but failed.';
                $this->mongoModel->addAction("/addtoCart", $metadata);
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to add item to cart']);
            }
        }
    }

    public function viewCart(){
        $userId = session()->get('id');
        $status = session()->getFlashdata('status');
        $results = $this->cartModel->getAllcartfromuserId($userId);
        foreach ($results as $key => $result) {
            $product_id = $result['product_id'];
            $productinfo = $this->cartModel->getproductnameimageandpricebyproductid($product_id);
            $results[$key]['product_name'] = $productinfo->product_name;
            $results[$key]['price'] = $productinfo->price;
            $results[$key]['image'] = $productinfo->image;
            $results[$key]['user_id'] = session()->get('id');
        }
        return view("/userpanel/cartdetails",['result'=> $results]);
    }

    public function removeItem(){
        $cartId = $this->request->getPost('cart_id');

        $query = $this->cartModel->removeItembycartId($cartId);

        if($query){
            return $this->response->setJSON(['success' => true, 'message' => 'item removed']);
        }
        else{
            return $this->response->setJSON(['success' => false, 'message' => 'unable to remove']);
        }
    }

    public function getAll(){
        $userId = session()->get('id');

        $results = $this->cartModel->getAllcartfromuserId($userId);
        foreach ($results as $key => $result) {
            $product_id = $result['product_id'];
            $productinfo = $this->cartModel->getproductnameimageandpricebyproductid($product_id);
            $results[$key]['product_name'] = $productinfo->product_name;
            $results[$key]['price'] = $productinfo->price;
            $results[$key]['image'] = $productinfo->image;
            $results[$key]['user_id'] = session()->get('id');
        }
        return $this->response->setJSON(['success' => true, 'items' => $results]);
    }

    public function checkout(){

       
        return redirect()->to('/payment');
    }

    public function clearCart(){
        $userId = session()->get('id');

        $query = $this->cartModel->deletitembyuserId($userId);
        if($query){
            return $this->response->setJSON(['success' => true]);
        }
    }
}