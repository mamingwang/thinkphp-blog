<?php

namespace app\admin\controller;
class Article extends Base
{
    //文章添加
    public function add()
    {
        if(request() -> isAjax()){
            $datas =[
                'title' => input('post.title'),
                'tags' => input('post.tags'),
                'is_top' => input('post.is_top',0),
                'cate_id' => input('post.cate_id'),
                'desc' => input('post.desc'),
                'content' => input('post.content'),
            ];
            $result = model('Article') ->add($datas);
            if($result ==1){
                $this->success('文章添加成功','admin/article/lists');
            }else{
                $this->error($result);
            }
        }
        $cates = model('Cate') -> select();
        $datas = [
            'cates' => $cates,
        ];
        $this -> assign($datas);
        return view();
    }
    
    //文章列表
    public function lists()
    {
        $articles = model('Article') ->with('cate') -> order(['is_top'  => 'desc', 'create_time' => 'desc']) -> paginate('2');
        $datas = [
            'article' => $articles,
        ];
        $this -> assign($datas);
        return view();
    }

    //文章推荐
    public function top()
    {
        if(request() -> isAjax()){
            $data = [
                'id' => input('post.id'),
                'is_top' => input('post.is_top') ? 0:1,
            ];
            $result  =  model('Article') -> top($data);
            if($result == 1){
                $this->success('操作成功','admin/article/lists');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //文章以编辑
    public function edit()
    {
        if(request() -> isAjax()){
            $data = [
                'id' => input('post.id'),
                'title' => input('post.title'),
                'tags' => input('post.tags'),
                'is_top' => input('post.is_top'),
                'cate_id' => input('post.cate_id'),
                'desc' => input('post.desc'),
                'content' => input('post.content'),
            ];

            $result = model('Article') -> edit($data);
            if($result == 1){
                $this->success('编辑成功','admin/article/lists');
            }else{
                $this->error($result);
            }
        }

        $article = model('Article') -> find(input('id'));
        $cates = model('Cate') -> select();
        $datas = [
            'article' => $article,
            'cates' => $cates,
        ];
        $this -> assign($datas);
        return view();
    }
}
