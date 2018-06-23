<?php



Route::get("/", ['uses' => 'HomeController@root', 'as' => 'root']);
Route::get("/", ['uses' => 'HomeController@home', 'as' => 'home']);
Route::get("/welcome", ['uses' => 'HomeController@welcome', 'as' => 'welcome']);

Route::get("/login", ['uses' => 'AuthController@getLogin', 'as' => 'auth.getLogin']);
Route::post("/login", ['uses' => 'AuthController@postLogin', 'as' => 'auth.postLogin']);
Route::get("/logout", ['uses' => 'AuthController@logout', 'as' => 'auth.logout']);

Route::prefix("user")->middleware('admin.auth')->name("user.")->group(function () {
    Route::get('/', ['uses' => "UserController@index", 'as' => 'index']);
    Route::get('/getUser', ['uses' => "UserController@getUser", 'as' => 'getUser']);
    Route::get('/lists', ['uses' => "ListsController@getList", 'as' => 'getList']);
    Route::post('/lists', ['uses' => "ListsController@store", 'as' => 'postList']);
    Route::get('/lists/{id}', ['uses' => "ListsController@show", 'as' => 'showList']);
    Route::post('/lists/{id}', ['uses' => "ListItemController@store", 'as' => 'store.item']);
    Route::delete('/lists/{id}', ['uses' => "ListsController@destroy", 'as' => 'deleteList']);
});
