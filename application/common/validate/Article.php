<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/14 0014
 * Time: 下午 9:12
 */

namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title|文章标题' => 'require|unique:article',
        'tags|文章标签' => 'require',
        'cate_id|所属导航' => 'require',
        'desc|文章概要' => 'require',
        'content|文章内容' => 'require',
        'is_top|推荐' => 'require',
    ];

    public function sceneAdd()
    {
        return $this -> only(['title','tags','cate_id','desc','content']);
    }

    //推荐场景
    public function sceneTop()
    {
        return $this -> only(['is_top']);
    }

    //推荐场景
    public function sceneEdit()
    {
        return $this -> only(['title','tags','cate_id','desc','content']);
    }
}