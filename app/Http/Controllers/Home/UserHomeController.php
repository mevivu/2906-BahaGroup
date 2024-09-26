<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class UserHomeController extends Controller
{
    public function getView()
    {
        return [
            'index' => 'user.home.index',
            'information' => 'user.information.index',
            'contact' => 'user.contact.index',
        ];
    }
    public function index(){
        return view($this->view['index']);
    }

    public function information(){
        return view($this->view['information']);
    }

    public function contact(){
        return view($this->view['contact']);
    }
}
