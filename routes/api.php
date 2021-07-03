<?php

use App\Models\pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('posts',function(){
    $posts=
    [
        [
            'title' =>'here',
            'body'=>'here too'

        ]
    ];
    return response() ->json ($posts,'200');
});


//Route::get('data','App\Http\Controllers\studentController@index');
Route::get('show','App\Http\Controllers\puserController@show');
Route::post('register','App\Http\Controllers\puserController@register');
Route::get('delete/{id}','App\Http\Controllers\puserController@delete');
Route::post('login','App\Http\Controllers\puserController@login');

Route::get('showpet','App\Http\Controllers\petController@showpet');
Route::Post('addpet','App\Http\Controllers\petController@addpet');
Route::Post('addpost','App\Http\Controllers\puserController@addpost');
Route::Post('search','App\Http\Controllers\puserController@searchpost');
//Route::Post('viewpet/{id}','App\Http\Controllers\petController@viewpet');

Route::namespace('Api')-> group(function(){
    Route::prefix('auth')-> group(function(){
        Route::Post('login','App\Http\Controllers\Api\AuthController@login');
        Route::Post('signup', 'App\Http\Controllers\Api\AuthController@signup');
    });

    Route::group([
        'middleware'=>'auth:api'
    ],function(){
       // Route::get('user','AuthController@index');
        Route::post('logout', 'AuthController@logout');
    });
});

//Route::Post('signup','App\Http\Controllers\Api\AuthController@signup');
Route::middleware('auth:api')->group(function () {
    Route::post('sign', 'App\Http\Controllers\Api\AuthController@signup')->name('signp');


});
Route::post('signin','App\Http\Controllers\puserController@signin');



/*Route::middleware('checkpassword')->group(function ()
{
    Route::Post('viewpet/{id}','App\Http\Controllers\petController@viewpet');
    Route::post('register','App\Http\Controllers\puserController@register');
});*/

Route::post('login','App\Http\Controllers\puserController@login');
Route::post('allposts','App\Http\Controllers\puserController@allposts');
Route::post('newpassword','App\Http\Controllers\puserController@forgotpassword');
Route::Post('signup', 'App\Http\Controllers\puserController@register');
Route::Post('verify', 'App\Http\Controllers\puserController@verify');
Route::Post('addappointment', 'App\Http\Controllers\puserController@addappointment');
Route::Post('insertpost', 'App\Http\Controllers\puserController@insertpost');
Route::Post('insertcomment', 'App\Http\Controllers\puserController@insertcomment');
Route::Post('makeappointment', 'App\Http\Controllers\puserController@makeappointment');
Route::Post('allshelters', 'App\Http\Controllers\puserController@allshelters');
Route::Post('addlike', 'App\Http\Controllers\puserController@addlike');
Route::Post('postlikes', 'App\Http\Controllers\puserController@postlikes');


Route::Post('update/{id}', 'App\Http\Controllers\puserController@update');
Route::Post('comment', 'App\Http\Controllers\PostController@storecomment');


Route::Post('viewvet/{id}','App\Http\Controllers\vetController@viewvet');
Route::Post('allvet','App\Http\Controllers\vetController@allvet');
Route::Post('searchvet','App\Http\Controllers\vetController@searchvet');
Route::Post('addshedule','App\Http\Controllers\vetController@addshedule');

Route::Post('alladopt','App\Http\Controllers\petController@adoptionsection');
Route::Post('allmate','App\Http\Controllers\petController@matesection');
Route::Post('allhost','App\Http\Controllers\petController@hostsection');
Route::Post('searchadoption','App\Http\Controllers\petController@searchInadoptionSection');
Route::Post('searchhost','App\Http\Controllers\petController@Shostsection');
Route::Post('searchmate','App\Http\Controllers\petController@searchInmateSection');
Route::Post('deletepet','App\Http\Controllers\petController@deletepet');


Route::Post('addproduct','App\Http\Controllers\productController@addproduct');
Route::Post('searchInproduct','App\Http\Controllers\productController@searchInproduct');
Route::Post('allproduct','App\Http\Controllers\productController@allproduct');
Route::Post('deleteproduct','App\Http\Controllers\productController@deleteproduct');
Route::Post('viewproudct','App\Http\Controllers\productController@viewproudct');



