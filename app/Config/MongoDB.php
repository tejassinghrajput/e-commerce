<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use MongoDB\Client;

class MongoDB{

    public $client;
    public $database;

    public function __construct(){
        $uri = 'mongodb://root:root@localhost:27017/';
        $db_name = 'test';

        $this->client = new Client($uri);
        $this->database = $this->client->selectDatabase($db_name);
    }

}
