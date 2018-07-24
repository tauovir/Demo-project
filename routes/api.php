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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
  });
 */
//====================swagger implementation for API======================
//dev url = https://caltex.appinventive.com
/**
 * @SWG\Swagger( 
 *     schemes={"https"}, 
 *     host="dev.camp.com", 
 *     basePath="/api/v1", 
 *     @SWG\Info( 
 *         version="1.0", 
 *         title="Caltex Music", 
 *         description="", 
 *         @SWG\Contact( 
 *             email="tauovir.khan@appinventiv.com" 
 *         ) 
 *     ), 
 * @SWG\SecurityScheme( 
 *   securityDefinition="basicAuth", 
 *   type="basic" 
 * ) 
 * ), 
 */
Route::group(['middleware' => 'checkBasicAuth', 'prefix' => 'v1', 'namespace' => 'Apiv1'], function () {
    Route::get('check-email', 'AuthenticatesController@isEmailExist');
    Route::get('check-username', 'AuthenticatesController@isUserNameExist');
    Route::post('signup', 'AuthenticatesController@signup');
    Route::post('login', 'AuthenticatesController@login');
    Route::post('social-login', 'AuthenticatesController@socialLogin');
    Route::get('forgot-password', 'AuthenticatesController@forgotPassword');
    Route::post('reset-password', 'AuthenticatesController@resetPassword');
    Route::post('update-profile', 'CustomerController@updareProfile')->middleware('checkAccessToken');
    Route::post('change-password', 'CustomerController@changePassword')->middleware('checkAccessToken');
    Route::get('logout', 'CustomerController@logout')->middleware('checkAccessToken');
    Route::get('country-list', 'CountriesController@getCountries');
    Route::get('language', 'Languages@getLanguages');
    Route::post('contact-us', 'ContactUsController@contactUs')->middleware('checkAccessToken');
   Route::post('last-active-time', 'CustomerPresences@store');
});
