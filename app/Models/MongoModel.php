<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\MongoDB;

class MongoModel extends Model{

    protected $collection;
    public $timestamp;
    public $curretTime;
    protected $paymentCollection;


    public function __construct(){
        $mongoDB = new MongoDB();
        $this->collection = $mongoDB->database->userLogs;

        $this->paymentCollection = $mongoDB->database->transactionStatus;
        $this->timestamp = time();
        $this->curretTime = date("Y-m-d H:i:s", $this->timestamp);
    }

    public function insertLoginLogbyuserId($userId, $loginSession){
        $data =[
            'user_id' => $userId,
            'login_session' => $loginSession,
            'login_timestamp' => $this->curretTime,
            'actions' => [
                [
                'action' => 'login',
                'timestamp' => $this->curretTime,
                'description' => 'user_login'
                ]
            ]
        ];
        $this->collection->insertOne($data);
    }

    public function updatelogbyLogidforLogout($loginSession){

        $document = $this->collection->findOne(['login_session' => $loginSession]);
        if (isset($document['actions']) && is_object($document['actions'])) {
            $this->collection->updateOne(
                ['login_session' => $loginSession],
                ['$set' => ['actions' => [$document['actions']]]]
            );
        }

        $data = [
                'action' => 'logout',
                'timestamp' => $this->curretTime,
                'description' => 'user_logout'
        ];
        $this->collection->updateOne(['login_session' => $loginSession],['$push' => ['actions' => $data]]);
    }

    public function addAction($uri, $metadata){
        $loginSessionId = session()->get('login_session_id');
        
        $document = $this->collection->findOne(['login_session' => $loginSessionId]);
        
        if (empty($metadata)) {
            $data = [
                'action' => $uri,
                'timestamp' => $this->curretTime,
                'description' => $uri . ' was opened',
            ];
        } else {
            $data = [
                'action' => $uri,
                'timestamp' => $this->curretTime,
                'description' => $uri . ' was opened',
                'metadata' => $metadata,
            ];
        }

        if ($document) {
            $this->collection->updateOne(
                ['login_session' => $loginSessionId],
                ['$push' => ['actions' => $data]]
            );
            
        } else {
            $this->collection->insertOne([
                'login_session' => $loginSessionId,
                'actions' => [$data],
            ]);
        }
    }
    

    public function addTransaction($paymentID, $payment_data, $requestData, $userId){

        $data = [
            'user_id' => $userId,
            'payment_id' => $paymentID,
            'requested_data' => $requestData,
            'response_data' => $payment_data

        ];
        $this->paymentCollection->insertOne($data);
        
    }

    public function findbypaymentId($payment_id){
        return $this->paymentCollection->findOne(['payment_id'=> $payment_id]);
    }
}
