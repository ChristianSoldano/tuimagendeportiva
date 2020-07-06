<?php

// Route::view('/','home');

Auth::routes(['verify' => true]);

//web
Route::get('/', 'Web\PageController@index')->name('home');
Route::get('/articulo/{slug}', 'Web\PageController@viewArticle')->name('viewArticle');
Route::get('/categoria/{slug}', 'Web\PageController@selectByCategory')->name('selectByCategory');
Route::get('/cookies', 'Web\PageController@cookies')->name('cookies');

//USERS
// Route::get('/perfil/{username}', 'UserController@profile')->name('user.profile');
Route::get('/perfil/{username}', 'UserController@profile')->name('user.profile');
Route::get('/perfil/{username}/editar', 'UserController@edit')->name('user.profile.edit');
Route::patch('/perfil/{username}/editar', 'UserController@update_profile')->name('user.profile.update');
Route::post('/perfil/{username}/redsocial', 'UserController@socialnetwork')->name('user.profile.socialnetwork');


//ADMIN
Route::get('/admin', 'Admin\ArticleController@published')->name('admin.index');
Route::get('/admin/solicitudes','Admin\AdminController@requests')->name('admin.requests.index');

//categories
Route::get('/admin/categorias', 'Admin\CategoryController@index')->name('admin.categories.index');
Route::get('/admin/categorias/crear', 'Admin\CategoryController@create')->name('admin.categories.create');
Route::get('/admin/categorias/editar/{category}', 'Admin\CategoryController@edit')->name('admin.categories.edit');
Route::delete('/admin/categorias/eliminar/{category}', 'Admin\CategoryController@destroy')->name('admin.categories.destroy');
Route::post('/admin/categorias/crear', 'Admin\CategoryController@store')->name('admin.categories.store');
Route::put('/admin/categorias/actualizar/{category}', 'Admin\CategoryController@update')->name('admin.categories.update');

//articles
Route::get('/admin/articulos/publicados', 'Admin\ArticleController@published')->name('admin.articles.index');
Route::get('/admin/articulos/rechazados', 'Admin\ArticleController@rejected')->name('admin.articles.rejected');
Route::get('/admin/articulos/crear', 'Admin\ArticleController@create')->name('admin.articles.create');
Route::get('/admin/articulos/{article}', 'Admin\ArticleController@show')->name('admin.articles.show');
Route::get('/admin/articulos/editar/{article}', 'Admin\ArticleController@edit')->name('admin.articles.edit');
Route::delete('/admin/articulos/eliminar/{article}', 'Admin\ArticleController@destroy')->name('admin.articles.destroy');
Route::post('/admin/articulos/crear', 'Admin\ArticleController@store')->name('admin.articles.store');
Route::put('/admin/articulos/actualizar/{article}', 'Admin\ArticleController@update')->name('admin.articles.update');

//users
Route::get('/admin/usuarios', 'Admin\UserController@index')->name('admin.users.index');
Route::get('/admin/usuarios/{user}', 'Admin\UserController@show')->name('admin.users.show');
Route::put('/admin/usuarios/{user}/actualizar', 'Admin\UserController@update')->name('admin.users.update');

//requests
Route::get('/admin/solicitudes', 'Admin\RequestController@index')->name('admin.requests.index');
Route::get('/admin/solicitudes/{article}', 'Admin\RequestController@show')->name('admin.requests.show');
Route::get('/admin/solicitudes/{article}/editar', 'Admin\RequestController@edit')->name('admin.requests.edit');
Route::get('/admin/solicitudes/{article}/actualizar', 'Admin\RequestController@update')->name('admin.requests.update');
Route::get('/admin/solicitudes/aceptar/{article}', 'Admin\RequestController@accept')->name('admin.requests.accept');
Route::post('/admin/solicitudes/rechazar/{article}', 'Admin\RequestController@reject')->name('admin.requests.reject');

//WRITER
Route::get('/escritor/categorias', 'Writer\WriterController@categories')->name('writer.categories.index');
Route::get('/escritor', 'Writer\ArticleController@published')->name('writer.articles.published');
Route::get('/escritor/articulos/revision', 'Writer\ArticleController@inReview')->name('writer.articles.review');
Route::get('/escritor/articulos/rechazados', 'Writer\ArticleController@rejected')->name('writer.articles.rejected');
Route::get('/escritor/articulos/crear', 'Writer\ArticleController@create')->name('writer.articles.create');
Route::get('/escritor/articulos/{article}', 'Writer\ArticleController@show')->name('writer.articles.show');
Route::get('/escritor/articulos/editar/{article}', 'Writer\ArticleController@edit')->name('writer.articles.edit');
Route::delete('/escritor/articulos/eliminar/{article}', 'Writer\ArticleController@destroy')->name('writer.articles.destroy');
Route::post('/escritor/articulos/crear', 'Writer\ArticleController@store')->name('writer.articles.store');
Route::put('/escritor/articulos/actualizar/{article}', 'Writer\ArticleController@update')->name('writer.articles.update');

//COMMENTS
Route::post('/articulo/{article}/comentar', 'Web\CommentController@comment')->name('comments.comment');
Route::post('/articulo/{article}/responder', 'Web\CommentController@reply')->name('comments.reply');
Route::delete('/eliminar/comentario/{id}', 'Web\CommentController@destroy')->name('comments.destroy');
Route::delete('/eliminar/respuesta/{id}', 'Web\CommentController@destroyReply')->name('comments.destroyReply');