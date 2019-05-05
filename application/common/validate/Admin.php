<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/19 0019
 * Time: 上午 12:06
 */
namespace app\common\validate;
use think\Validate;
class Admin extends Validate
{
    protected $rule = [
        'username|管理员账户'=> 'require',
        'password|密码' => 'require',
        'conpass|确认密码' => 'require|confirm:password',
        'email|邮箱' => 'require|email|unique:admin',
        'code|验证码' => 'require'
    ];
    
    //验证场景
    public function sceneLogin()
    {
        return $this->only(['username','password']);
    }

    public function sceneRegister()
    {
        $this->only(['username','password','conpass','email'])
        ->append('username','unique:admin');
    }

    public function sceneReset()
    {
        return $this->only(['code']);
    }
}