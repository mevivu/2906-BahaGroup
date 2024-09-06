<?php

namespace App\Admin\Http\Controllers\Home;

use App\Admin\Http\Controllers\Controller;

class UserHomeController extends Controller
{
    public function getView()
    {
        return [
            'index' => 'user.home.index'
        ];
    }
    public function index(){
        return view($this->view['index']);
    }
}
