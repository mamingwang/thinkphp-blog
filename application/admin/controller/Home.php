<?php

namespace app\admin\controller;

use think\Controller;

class Home extends Base
{
    //后台主页面
    public function index()
    {
        return view();

    }

    //退出
    public function loginout()
    {
        session(null);
        if(session('?admin.id')){
             $this->error('退出失败');
        }else{
            $this->success('退出成功','admin/index/login');
        }
    }
}
