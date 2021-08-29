<?php
declare (strict_types = 1);
namespace app\validate;

use think\Validate;

class User extends Validate
{
    protected $rule =   [
        'username'              =>       'require|max:25|token|isAdmin:admin',
        'password'              =>       'require|max:25',
        'password_confirm'      =>       'require|confirm:password',
        'text'                  =>       'max:25',
    ];

    protected $message  =   [
        'username.require'               =>           'username is necessary.',
        'username.max'                   =>           'username is too long...',
        'password.require'               =>           'password is necessary...',
        'password.max'                   =>           'password is too long...',
        'password_confirm.require'       =>           'why not write something?',
        'text.max'                       =>           'text is too long...',
    ];

    public function sceneLogin()
    {
        return $this->only(['username','password'])
            ->remove('username', 'isAdmin');
    }

    protected function isAdmin($value, $rule)
    {
        return $value != $rule ? true : 'the NAME : '. $value.' is forbidden....';
    }
}