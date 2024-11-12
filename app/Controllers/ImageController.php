<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class ImageController extends Controller{

    public function show($filename){
        $path = APPPATH . 'images/' . $filename;

        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound($filename);
        }
        $this->response->setHeader('Content-Type', 'image/jpg');
        return $this->response->setBody(file_get_contents($path));
    }
}
