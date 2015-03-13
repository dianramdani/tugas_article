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

Route::resource('articles','ArticlesController');
Route::resource('comments','CommentsController');
Route::resource('galleries','GalleriesController');
Route::resource('sessions','SessionsController');

Route::get('/export/{id}', array ('as' =>'export', 'uses'=>'ArticlesController@export'));
Route::get('/export-to-pdf/{id}', array ('as' =>'export-to-pdf', 'uses'=>'ArticlesController@export_to_pdf'));
Route::get('/import', array ('as' =>'import', 'uses'=>'ArticlesController@import'));
Route::post('/getimport', array ('as' =>'getimport', 'uses'=>'ArticlesController@getimport'));

Route::resource('users', 'UsersController', array('except' => array('index', 'destroy')));

//Route::get('/change-password/{forgot_token}',array('as'=>'change-password', 'uses' => 'UsersController@change_password'));
Route::get('/reset-password', array('as' => 'reset-password', 'uses' => 'UsersController@reset_password'));
Route::post('/process-reset-password',array('as'=>'process-reset-password', 'uses' => 'UsersController@process_reset_password'));
Route::get('/change-password/{remember_token}',array('as'=>'change-password', 'uses' => 'UsersController@change_password'));
Route::post('/process-change-password/{remember_token}',array('as'=>'process-change-password','uses'=>'UsersController@process_change_password'));	  

Route::get('/', function ()
{
	return View::make('hello');
});
Route::get('home', function ()
{
	return View::make('hello');
});
