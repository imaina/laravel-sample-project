<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>['web']], function(){ 

   Route::get('/', [
   	   'uses'=> 'postController@getBlogIndex',
   	   'as'  => 'blog.index'
   	]);

   Route::get('/blog', [
   	   'uses'=> 'postController@getBlogIndex',
   	   'as'  => 'blog.index'
   	]);

   Route::get('/blog/{end}&{post_id}', [
   	   'uses'=> 'postController@getSinglePost',
   	   'as'  => 'blog.single'
   	]);

   /* other routes*/

   Route::get('/about', function(){

   	   return view('frontend.others.about');
   })->name('about');

    Route::get('/contact', [
    	'uses' => 'ContactMessageController@getContactIndex',
    	'as'   => 'contact'
    	]);

    Route::post('/contact/sendmail', [
      'uses' => 'ContactMessageController@postSendMessage',
      'as'   => 'contact.send'
      ]);

    Route::get('/admin/login',[
      'uses' => 'AdminController@getLogin',
      'as'   => 'admin.login'
      ]);

    Route::post('/admin/login',[
      'uses' => 'AdminController@postLogin',
      'as'   => 'admin.login'
      ]);

    Route::group(['prefix' => '/admin'], function(){
          
          Route::get('/', [
            'uses' => 'AdminController@getIndex',
            'as'   => 'admin.index'

            ]);
          
          Route::get('/logout', [
            'uses' => 'AdminController@getLogout',
            'as'   => 'admin.logout'
            ]);

          Route::get('/blog/posts', [
            'uses' => 'PostController@getPostIndex',
            'as'   => 'admin.blog.index'

            ]);

          Route::get('/blog/categories', [
            'uses' => 'CategoryController@getCategoryIndex',
            'as'   => 'admin.blog.categories'

            ]);

          Route::get('/blog/post/{end}&{post_id}', [
            'uses' => 'PostController@getSinglePost',
            'as'   => 'admin.blog.single'

            ]);

          Route::get('/blog/post/create', [
            'uses' => 'PostController@getCreatePost',
            'as'   => 'admin.blog.create_post'

            ]);

          Route::post('/blog/post/create', [
            'uses' => 'PostController@postCreatePost',
            'as'   => 'admin.blog.post.create'

            ]);

           Route::post('/blog/category/create', [
            'uses' => 'CategoryController@postCreateCategory',
            'as'   => 'admin.blog.category.create'

            ]);


          Route::get('/blog/post/edit/{post_id}', [
            'uses' => 'PostController@getUpdatePost',
            'as'   => 'admin.blog.edit_post'

            ]);


          Route::post('/blog/post/update', [
            'uses' => 'PostController@postUpdatePost',
            'as'   => 'admin.blog.post.update'

            ]);

          Route::post('/blog/category/update', [
            'uses' => 'CategoryController@postUpdateCategory',
            'as'   => 'admin.blog.category.update'

            ]);

          Route::get('/blog/post/delete/{post_id}', [
            'uses' => 'PostController@getDeletePost',
            'as'   => 'admin.blog.post.delete'

            ]);

          Route::get('/blog/category/delete/{category_id}', [
            'uses' => 'CategoryController@getDeleteCategory',
            'as'   => 'admin.blog.category.delete'

            ]);

           Route::get('/contact/messages', [
            'uses' => 'ContactMessageController@getContactMessageIndex', 
            'as'   => 'admin.contact.index'
           ]);

           Route::get('/contact/message/delete/{message_id}', [
            'uses' => 'ContactMessageController@getDeleteMessage',
            'as'   => 'admin.contact.delete'
            ]);



    });


});

