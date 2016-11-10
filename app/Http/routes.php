<?php


Route::group(['middleware' => ['web']], function () {
	
    Route::get('/', 'Home\IndexController@index'); //前台首页
	
	Route::get('/cat/{cid}', 'Home\IndexController@cat'); //文章列表页
    Route::get('/a/{id}', 'Home\IndexController@article'); //文章详情页
	
    Route::any('admin/login','Admin\LoginController@login'); //后台登录
    Route::get('admin/code','Admin\LoginController@code'); //后台验证码
    /*测试验证码是否能从session中取出
    Route::get('admin/getcode','Admin\LoginController@getcode');
    */
});



/*
 * 中间件，管理后台的内容都需要登录用户才能访问
 * 设置['web','admin.login']之后，
 * 需要去Kernel.php下的$routeMiddleware里加一个
 * 'admin.login' => \App\Http\Middleware\AdminLogin::class,
 * prefix 访问前缀
 * namespace 命名前缀
 */
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware' => ['web','admin.login']], function () {
	Route::get('/','IndexController@index');//后台首页
    Route::get('info','IndexController@info');//后台内容区
    Route::get('quit','LoginController@quit'); //后台退出
    Route::any('pass', 'IndexController@pass');//修改管理员密码

	//资源路由
	Route::resource('articlecat', 'ArticleCatController'); //文章分类控制器
	
	Route::resource('article', 'ArticleController'); //文章控制器

    Route::resource('quotes', 'QuotesController'); //格言控制器

    Route::resource('about', 'AboutController'); //关于我控制器
	
    Route::resource('links', 'LinksController'); //友情链接控制器
    Route::post('links/changeorder', 'LinksController@changeOrder');//友情列表排序
	
	Route::resource('navs', 'NavsController'); //导航控制器
	Route::post('navs/changeorder', 'NavsController@changeOrder');//友情列表排序
	
	Route::resource('config', 'ConfigController'); //配置控制器
	Route::get('config/putfile', 'ConfigController@putFile'); //生成配置文件
    Route::post('config/changecontent', 'ConfigController@changeContent'); //修改配置内容
    Route::post('config/changeorder', 'ConfigController@changeOrder'); //修改配置排序
	
	Route::any('upload', 'CommonController@upload'); //上传的方法


});

















