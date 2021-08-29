<?php
namespace app\controller;

use app\validate\User;
use think\exception\ValidateException;
use think\facade\Db;
use think\facade\Request;

class Register
{
    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\Exception
     * @throws \Exception
     */
    public function index(){
        error_reporting(0);
        $username = Request::post('username', '', 'addslashes');
        $password = Request::post('password', '', 'addslashes');
        $passwordConfirm = Request::post('confirm', '', 'addslashes');
        $text = Request::post('text', 'hello...', 'addslashes');

        try {
            validate(User::class)->batch(true)->check([
                'username'             =>           $username,
                'password'             =>           $password,
                'password_confirm'     =>           $passwordConfirm,
                'text'                 =>           $text,
                '__token__'            =>           Request::post('__token__'),
            ]);
        } catch (ValidateException $e){
            return json($e->getError());
        }

        $status = $this->isRegistered($username);
        if (!$status) {
            $in = [
                'username'      =>      $username,
                'password'      =>      md5($password),
                'text'          =>      $text,
            ];
            Db::name('tp_table')->save($in);
        }

        return View('index/jump', [
            'greeting'          => 'emmm, a shabby website...',
            'status'            => $status? 'The username has been registered already. ' : 'The account has been created! Now login!',
            'url_path'          => $status? url('index/register') : url('index/login'),
        ]);
    }

    protected function isRegistered($username)
    {
        return Db::table('tp_table')
            ->where('username', $username)
            ->find();
    }
}