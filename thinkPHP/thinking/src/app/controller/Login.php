<?php
namespace app\controller;

use app\validate\User;
use think\exception\ValidateException;
use think\facade\Db;
use think\facade\Request;

class Login
{
    protected $all;
    protected $username;
    protected $password;

    public function index()
    {
        error_reporting(0);
        $this->username = Request::post('username', '', 'addslashes');
        $this->password = Request::post('password', '', 'addslashes');
        try {
            validate(User::class)->sceneLogin()->batch(true)->check([
                'username'             =>           $this->username,
                'password'             =>           $this->password,
                '__token__'            =>           Request::post('__token__'),
            ]);
        } catch (ValidateException $e){
            return json($e->getError(), 403);
        }

        $this->all = $this->combine();
        $check = $this->check();
        if (!$check){
            return json('wrong username/password!');
        }

        $information = Db::name("tp_table")
            ->where('username', $this->username)
            ->value("text");
        return $this->username." says ".$information;
    }

    protected function combine(){
        $a = array(0 => 'username', 1 => '=');
        $a[] = $this->username;
        $b = (md5($this->password))? '=' : $this->password;
        $b = array_merge((array)'password', (array)$b ,(array)md5($this->password));
        return [$a,$b];
    }

    protected function check(){
        return Db::name('tp_table')
            ->where($this->all)
            ->find();
    }
}
