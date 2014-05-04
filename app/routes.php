<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */
Route::get('login/', 'AuthController@getLogin');
Route::post('login/', 'AuthController@postLogin');
Route::get('logout/', 'AuthController@getLogout');

Route::controller('/health-check', 'HealthCheckController');
Route::controller('/information', 'InformationController');

Route::controller('/twilio', 'TwilioController');
Route::controller('/twilio_check', 'TwilioCheckController');
Route::controller('/twilio_add_child', 'TwilioAddChildController');
Route::controller('/twilio_vaccine', 'TwilioVaccineController');
Route::controller('/twilio_health_check', 'TwilioHealthCheckController');
Route::controller('/twilio_information', 'TwilioInformationController');

Route::controller('/mother/(:any)', 'FrontController');
Route::controller('/child/(:any)', 'FrontController');
Route::controller('/vaccine/(:any)', 'FrontController');
Route::controller('/', 'FrontController');

