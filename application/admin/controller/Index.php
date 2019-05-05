<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    //登陆
    public function login()
    {
        if(session('?admin.id')){
            $this -> redirect('admin/home/index');
        }
        if(request()->isAjax()){
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password')
            ];
            $result = model('Admin')->login($data);
            if($result == 1){
                 $this->success('登陆成功','admin/index/index');
            }else{
                $this->error($result);
            }
        }
        return view();
    }
    
    //注册
    public function register()
    {
        if(request() -> isAjax()){
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'conpass' =>input('post.conpass'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email'),
            ];
            $result = model('Admin') -> register($data);
            if($result == 1) {
                $this->success('注册成功','admin/index/login');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //忘记密码
    public function forget()
    {
        if(request() -> isAjax()) {
            $code = mt_rand(1000, 9999);
            session('code', $code);
            $data = [
                'email' => input('post.email'),
            ];
            $result = mailto($data['email'], '重置密码验证码', '您重置密码验证码是' . $code);
            if($result){
                $this -> $this->success('验证码发送成功');
            }else{
                $this -> error('验证码发送失败');
            }
        }
        return view();
    }

    //重置密码
    public function reset()
    {
        if(request() -> isAjax()){
            $data = [
                'code' => input('post.code'),
                'eamil' => input('post.email'),
            ];
            $result = model('Admin') -> reset($data);
            if($result ==1){
                $this ->success('密码重置成功,请去邮箱查看','admin/index/login');
            }else{
                $this -> error($result);
            }
        }
        return view();
    }
}
