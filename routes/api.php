<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;



    Route::get('/language/{lang?}', [
        'as' => 'language.change',
        'uses' => 'LocalizationController@change'
    ]);


    Route::get('/index', ['as' => 'index', 'uses' => 'API\HomeController@home']);

    Route::get('/', function () {
        return redirect()->route('index');
    });

    // Route::get('/blogs', ['as' => 'blogs', 'uses' => 'API\HomeController@blogs']);
    Route::get('/blogs', 'API\HomeController@blogs');

    Route::get('/clientreviews', ['as' => 'clientreviews', 'uses' => 'API\HomeController@client_reviews']);
    Route::get('/workingteam', ['as' => 'workingteam', 'uses' => 'API\HomeController@working_team']);
    Route::get('/about_us', ['as' => 'about_us', 'uses' => 'API\HomeController@about_us']);
    Route::get('/blog/{id}','API\HomeController@show_blog');

    Route::post('/multiguard_login', 'API\LoginController@multiguardLogin')->name('multiguard_login');

    Route::post('/register/user', 'API\RegisterController@createUser')->name('user_register');
    Route::post('/forgot_password', 'ApI\ForgetPasswordController@forgot_password');


    Route::group(['middleware' => ['auth:api']], function(){

        Route::get('/logout/custom', ['as' => 'logout.custom', 'uses' => 'API\Controller@userLogout']);

        Route::post('/user_changepassword', ['as'=>'user_password.update','uses'=>'API\UserController@update_user_password']);
        Route::post('/user_editprofile', ['as'=>'user_profile.update','uses'=>'API\UserController@update_user_profile']);
        Route::get('/user_editprofile', ['as' => 'user_profile.edit', 'uses' => 'API\UserController@edit_user_profile']);
    });


    Route::get('/', ['as' => 'home', 'uses' => 'API\HomeController@home']);

