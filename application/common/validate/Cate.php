<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/8 0008
 * Time: 下午 10:57
 */

namespace app\common\validate;


use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename|栏目' => 'require|unique:cate',
        'sort|排序' => 'require|number'
    ];

    public function sceneCateadd(){
        return $this -> only(['catename','sort']);
    }

    public function sceneSort()
    {
        return $this -> only(['sort']);
    }

    public function sceneCatedit(){
        return $this -> only(['catename']);
    }
}