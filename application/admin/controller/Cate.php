<?php

namespace app\admin\controller;

use think\Controller;

class Cate extends Base
{
    //栏目列表
    public function catelist()
    {
       $cates = model('cate') -> order('sort','asc') -> paginate('3');
       $datacate = [
           'cates' => $cates,
       ];
       $this -> assign($datacate);
        return view();
    }
    //栏目添加
    public function cateadd()
    {
        if(request()->isAjax()){
            $data = [
                'catename' => input('post.catename'),
                'sort' => input('post.sort'),
            ];
            $result = model('Cate') -> cateadd($data);
            if($result ==1 ){
                $this->success('添加成功','admin/cate/catelist');
            }else{
                $this->error($result);
            }
        }
        return view();
    }
    //栏目排序
    public function sort()
    {
        $data = [
            'id' => input('post.id'),
            'sort' => input('post.sort'),
        ];
        $result = model('Cate') -> sort($data);
        if($result == 1){
            $this->success('更新成功');
        }else{
            $this->error($result);
        }
        return view();

    }

    //栏目编辑
    public function catedit()
    {

        if(request() -> isAjax()){
            $data = [
                'id' => input('post.id'),
                'catename' => input('post.catename'),
            ];
            $result = model('Cate') -> catedit($data);
            if($result == 1){
                $this->success('编辑成功','admin/cate/catelist');
            }else{
                $this->error($result);
            }
        }
        //查询不要编辑的栏目信息
        $cateInfo = model('Cate') -> find(input('id'));
        $cates = [
            'cates' => $cateInfo,
        ];
        $this -> assign($cates);
        return view();
    }

    //栏目删除
    public function catedel(){

        $cateid = input('post.id');
        $cateinfo = model('cate') -> find($cateid);
        $result = $cateinfo ->delete();
        if($result){
            $this->success('删除成功','admin/cate/catelist');
        }else{
            $this->error('删除失败');
        }
    }
}
