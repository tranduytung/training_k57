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
// API_register_user
Route::post('user/register', 'AuthController@register');

// API_login
Route::post('user/auth', 'AuthController@login');

// API_logout
Route::get('user/logout', 'AuthController@logout');

// API_get_user_profile
Route::get('user', 'UserController@get');

// API_update_user_profile
Route::post('user', 'UserController@update');

// API_forget_pass
Route::post('password/forgot', 'PasswordController@forgot');

// API_reset_pass
Route::post('password/reset', 'PasswordController@reset');

// API_get_list_area
Route::get('area', 'AreaController@getList');

// API_get_advertisement
Route::get('advertisement', 'AdvertisementController@get');

// API_update_user_social
Route::post('user/social-action', 'UserController@updateSocialAction');

// API_get_list_social_action
Route::get('social-actions', 'SocialActionController@getList');

// API_get_detail_social_action
Route::get('social-action', 'SocialActionController@get');

// API_get_donation_result
Route::get('donations/result', 'DonationController@getResult');

// API_send_donation
Route::post('donations', 'UserController@donate');

// API_get_dashboard_info
Route::get('user/dashboard', 'UserController@getDashboard');

// API_get_donation_by_date
Route::get('user/donations', 'DonationController@getByDate');

// API_get_info_current_month
Route::get('user/status', 'UserController@getCurrentMonth');