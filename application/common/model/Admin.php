<?php

namespace app\common\model;

use think\App;
use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    //软删除
    use SoftDelete;
    //登陆校验
    public function login($data)
    {
        $validate = new \app\common\validate\Admin();
        if(!$validate->scene('login')->check($data)){
            return $validate->getError();
        }
        $result = $this->where($data)->find();
        if($result){
            if($result['status'] == 1){
                return "用户被禁止";
            }
            $sessionDate = [
                'id' => $result['id'],
                'nickname' => $result['nickname'],
                'static' => $result['status'],
            ];
            session('admin',$sessionDate);
            //1表示有用户
            return 1;
        }else{
            return '用户名或者密码错误';
        }
    }

    public function register($data)
    {
        $validate = new \app\common\validate\Admin();
        if(!$validate -> scene('register') -> check($data)){
            return $validate -> getError();
        }
        $result = $this->allowField(true) -> save($data);
        if($result){
            mailto($data['email'],'用户名注册成功','用户名注册成功');
            return 1;
        }else{
            return "注册失败";
        }
    }

    //重置密码
    public function reset($data)
    {
        $validate = new \app\common\validate\Admin();
        if(!$validate -> scene('reset') -> check($data)){
            return $validate -> getError();
        }
        if ($data['code'] != session('code')){
           return '验证码不正确';
        }
        $adminInfo = $this->where('email',$data['email']) -> find();
        $password = mt_rand(1000,9999);
        $adminInfo -> password = $password;
        $result = $adminInfo -> save();
        if($result){
           $content = '恭喜您，密码重置成功<br>用户名:'.$adminInfo['username'].'<br>新密码：'.$password;
            mailto($data['eamil'],'密码重置成功',$content);
            return 1;
        }else{
            return "密码重置失败";
        }
    }

}
