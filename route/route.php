<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
Route::group('admin',function(){
    Route::rule('/','admin/index/login','get|post');
    Route::rule('register','admin/index/register','get|post');
    Route::rule('forget','admin/index/forget','get|post');
    Route::rule('reset','admin/index/reset','get|post');
    Route::rule('index','admin/home/index','get');
    Route::rule('loginout','admin/home/loginout','get|post');
    Route::rule('catelist','admin/cate/catelist','get');
    Route::rule('cateadd','admin/cate/cateadd','get|post');
    Route::rule('sort','admin/cate/sort','post|get');
    Route::rule('catedit','admin/cate/catedit','post|get');
    Route::rule('catedel','admin/cate/catedel','post|get');
    Route::rule('articlelists','admin/article/lists','post|get');
    Route::rule('articleadd','admin/article/add','post|get');
    Route::rule('articletop','admin/article/top','post|get');
    Route::rule('articledeit','admin/article/edit','post|get');
});
