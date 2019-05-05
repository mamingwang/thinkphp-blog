<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Article extends Model
{
    //软删除
    use SoftDelete;
    //关联模型
    public function  cate()
    {
        return $this -> belongsTo('Cate','cate_id','id');
    }

    public function add($datas){
        //验证
        $validate = new \app\common\validate\Article();
        if(!$validate -> scene('add') -> check($datas)){
            return $validate -> getError();
        }
        $result = $this->allowField(true) ->save($datas);
        if ($result) {
            return 1;
        }else{
            return "文章添加失败";
        }
    }

    //文章推荐
    public function top($data)
    {
        $validate = new \app\common\validate\Article();
        if(!$validate -> scene('top') -> check($data)){
            return $validate -> getError();
        }
        $article = $this -> find($data['id']);
        $article -> is_top = $data['is_top'];
        $result = $article -> allowField(true) -> save();
        if($result) {
            return 1;
        }else{
            return "推荐失败";
        }
        
    }

    //文章编辑
    public function edit($data)
    {
        $validate = new \app\common\validate\Article();
        if(!$validate -> scene('edit') -> check($data)){
            return $validate -> getError();
        }
        $article = $this -> find($data['id']);
        $article -> title = $data['title'];
        $article -> tags = $data['tags'];
        $article -> is_top = $data['is_top'];
        $article -> cate_id = $data['cate_id'];
        $article -> desc = $data['desc'];
        $article -> content = $data['content'];
        $result = $article -> save();
        if($result){
            return 1;
        }else{
            return "编辑失败";
        }

    }

}
