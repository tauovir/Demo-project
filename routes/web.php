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

Route::get('/', function () {
    return view('web.home.home');
});
Route::get('/login-user', function () {
    return view('login');
});
//Auth::routes();
Route::group([ 'namespace' => 'Web'], function () {
    Route::get('reset-deeplink', 'ResetPasswordController@resetDeeplink');
    Route::get('reset/{token}', 'ResetPasswordController@showForm');
    Route::post('reset-password', 'ResetPasswordController@resetPassword');
    Route::get('privacy-policy/{lang?}', 'ContentMastersController@privacyPolicy');
    Route::get('term-condition/{lang?}', 'ContentMastersController@termCondition');
    Route::post('signin', 'AuthenticationController@loginCustomer');

    Route::post('signup', 'AuthenticationController@signupCustomer');
    Route::get('auth/{provider}', 'SocialLoginController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'SocialLoginController@handleProviderCallback');
    Route::get('yahoo-login', 'SocialLoginController@yahooLogin');
});
Route::group(['middleware' => ['guest:customers'], 'namespace' => 'Web'], function () {
    Route::get('home', 'HomeController@index');
    Route::get('logout', 'HomeController@logout'); 
});
//===================Ajax call========================
Route::group([ 'namespace' => 'Web'], function () {
        Route::post('user-check', 'AuthenticationController@checkUser');
        Route::get('reset-link', 'AuthenticationController@resetPasswordLink');
        Route::post('get-username', 'AjaxController@suggestedUserName');
        Route::get('check-userOrEmail-exist', 'AjaxController@checkUSerOrEmail');
   
        });