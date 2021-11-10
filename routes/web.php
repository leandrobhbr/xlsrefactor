<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/joao', 'ExcelController@joao');
Route::get('/alunos', 'ExcelController@alunos');
Route::get('/updatepg', 'ExcelController@limeUsersPG');
Route::get('/updateis', 'ExcelController@limeUsersIS');
Route::get('/answersexport', 'ExcelController@limeAnswersExport');
Route::get('/surveysUniq', 'ExcelController@surveysUniq');
Route::get('/discentes', 'ExcelController@discentes');
Route::get('/posdoutoral', 'ExcelController@posdoutoral');
Route::get('/pbh', 'ExcelController@pbh');
Route::get('/coordenadores', 'ExcelController@coordenadores');
Route::get('/taes', 'ExcelController@taes');
Route::get('/credenciados', 'ExcelController@credenciados');
Route::get('/naocredenciados', 'ExcelController@naocredenciados');
