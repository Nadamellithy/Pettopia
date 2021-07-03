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
Route::get('alldata','App\Http\Controllers\petController@index');
Route::post('insert','App\Http\Controllers\petController@insert')->name('insertdata');
Route::get('deletepet/{id}','App\Http\Controllers\petController@delete');
Route::get('editpet/{id}','App\Http\Controllers\petController@showdata');
Route::post('updatepet/{id}','App\Http\Controllers\petController@update');

// vet
Route::get('vetdata','App\Http\Controllers\vetController@data');
Route::post('add','App\Http\Controllers\vetController@add')->name('adddata');
Route::get('dropvet/{id}','App\Http\Controllers\vetController@drop' );



#relations#
//Route::get('has-one','App\Http\Controllers\PhoneController@hasOneRelation');
//$vet=App\Models\vet::Where('id',3)->first();
//return response() ->json ($vet);
Route::get('hasone','App\Http\Controllers\TestController@hasOneRelation');

###
Route::get('many','App\Http\Controllers\TestController@hasonetomany');
Route::resource('sample','App\Http\Controllers\SampleDataController');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
