<?php

//前台
Route::group(['namespace'=>'Index'],function(){
    //首页
    Route::get('/','IndexController@index')->name('index');
    //列表页面
    Route::get('/lists/{cid}','IndexController@lists')->name('lists');
    //文章页面
    Route::get('/show/{aid}','IndexController@show')->name('show');
});



//后台--不需要登录
Route::name('admin.')->namespace('Admin')->prefix('admin')->group(function (){
    #登录
    Route::get("login","LoginController@create")->name("login");
    Route::post("login","LoginController@store")->name("login");
    #验证码
    Route::get("code","LoginController@code")->name("code");
});

//后台--需要登录才能访问
Route::name('admin.')->namespace('Admin')->prefix('admin')->middleware(['admin.login'])->group(function (){

    #后台首页
    Route::get("index","IndexController@index")->name("index");
    #后台首页--右侧信息页
    Route::get("info","IndexController@info")->name("info");
    #退出登录
    Route::get("logout","IndexController@logout")->name("logout");

    #密码修改
    Route::match(['get','post'],'changpwd','IndexController@changpwd')->name('changpwd');

    #文章分类
    Route::resource('category',"CategoryController");
    #文章分类排序
    Route::post('category/order',"CategoryController@chageOrder")->name("category.order");

    #文章
    Route::resource('article',"ArticleController");
    #上传图片
    Route::any('upload','CommonController@uploadImg')->name('upload');

    #友情链接
    Route::resource('links','LinksController');
    Route::post('links/order',"LinksController@changeOrder")->name("links.order");

    #导航
    Route::resource('navs','NavsController');
    Route::post('navs/order',"NavsController@changeOrder")->name("navs.order");

    #网站配置
    Route::get('config/file',"ConfigController@putFile")->name("config.file"); #将配置信息写入到文件中
    Route::resource('config','ConfigController');
    Route::post('config/order',"ConfigController@changeOrder")->name("config.order");
    Route::post('config/content',"ConfigController@changeContent")->name("config.content"); #内容修改
});



# 测试使用
Route::get('/demo','DemoController@index')->name('demo');