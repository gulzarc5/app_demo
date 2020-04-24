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
Route::group(['namespace' => 'Admin'],function(){
    Route::get('/','LoginController@showLoginForm')->name('admin.login');    
    Route::post('login', 'LoginController@adminLogin');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');

    Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){
        Route::get('/dashboard', 'DashboardController@dashboardView')->name('admin.deshboard');
        Route::post('images/insert','SlotController@imageInsert')->name('admin.image_insert');
        
        Route::get('/slot/delete/{slot_id}', 'SlotController@slotDelete')->name('admin.slot_delete');
        
        Route::get('/change/password/form', 'LoginController@changePasswordForm')->name('admin.change_password_form');
        Route::post('/change/password', 'LoginController@changePassword')->name('admin.change_password');

        Route::get('/user/edit/{slot_id}', 'SlotController@userEdit')->name('admin.user_edit');
        Route::post('/user/update', 'SlotController@userUpdate')->name('admin.user_update');
    });
});

// Route::get('/', function () {
//     return view('admin.index');
// });
