<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::get('numbers/list','Api\SlotController@slotNumbers');
Route::group(['namespace'=>'Api'], function(){
    Route::post('user/login','LoginController@userLogin');
    Route::get('send/otp/{mobile}','SlotController@sendOtp');
    Route::get('verify/otp/{mobile}/{otp}','SlotController@varifyOtp');
    Route::get('images/list','SlotController@images');
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
