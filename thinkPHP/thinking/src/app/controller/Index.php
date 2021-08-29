<?php
namespace app\controller;

use app\BaseController;

class Index extends BaseController
{
    public function index()
    {
        return $this->register();
    }

    public function register()
    {
        return View('index/register',[
            'greeting'          => 'emmm, a shabby website...',
            'greeting_register' => 'Please register first.',
        ]);
    }

    public function login()
    {
        return View('index/login',[
            'greeting'          => 'emmm, a shabby website...',
            'greeting_login'    => 'Please login.',
        ]);
    }
}