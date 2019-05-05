<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Cate extends Model
{
    //软删除
    use SoftDelete;

    public function cateadd($data)
    {
        $validate = new \app\common\validate\Cate();
        if(!$validate -> scene('cateadd') -> check($data)){
            return $validate -> getError();
        }
        $result = $this ->allowField(true) -> save($data);
        if($result){
            return 1;
        }else{
            return "添加失败";
        }
    }

    //栏目更新
    public function sort($data)
    {
        $validate = new \app\common\validate\Cate();
        if(!$validate -> scene('sort') -> check($data)){
            $validate -> getError();
        }
        $cateInfo = model('cate') ->find($data['id']);
        $cateInfo -> sort = $data['sort'];
        $result = $cateInfo -> save();
        if($result){
            return 1;
        }else{
            return "更新失败";
        }
    }

    //栏目编辑
    public function catedit($data)
    {
        $validate = new \app\common\validate\Cate();
        if(!$validate -> scene('catedit') -> check($data)){
            return $validate -> getError();
        }
        $cateInfo = model('cate') ->find($data['id']);
        $cateInfo -> catename = $data['catename'];
        $result = $cateInfo -> save();
        if($result){
            return 1;
        }else{
            return '更新是被';
        }
    }


}

