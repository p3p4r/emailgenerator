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
/*Route::get('/', function () {
    return view('mypage');
});*/

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('login', '\App\Http\Controllers\Auth\LoginController@showForm')->name('login');

/*Route::GET('/login', array('as' => 'show.login', 'uses' => 'Auth\LoginController@showForm'));
*//*Route::post('/login/custom',[
	'uses' => "Auth\LoginController@login",
	'as' => 'login.custom'

]);*/

Route::get('/', function () {
    return view('welcome');
})->name('home');
// [ Dashboard - Generate HTML ]
Route::GET('generatehtml', array('as' => 'generatehtml.index', 'uses' => 'GenerateHtmlController@index'));
Route::GET('generatehtml/create', array('as' => 'generatehtml.create', 'uses' => 'GenerateHtmlController@create'));
Route::POST('generatehtml/', array('as' => 'redirect', 'uses' => 'GenerateHtmlController@redirectForm'));
Route::POST('generatehtml/{id}/edit/download', array('as' => 'download', 'uses' => 'GenerateHtmlController@downloadContent'));
Route::POST('generatehtml/save', array('as' => 'saveHtml', 'uses' => 'GenerateHtmlController@saveHtml'));
Route::GET('generatehtml/{id}/edit', array('as' => 'html.edit', 'uses' => 'GenerateHtmlController@edit'));
Route::PUT('generatehtml/update/{id}', array('as' => 'html.update', 'uses' => 'GenerateHtmlController@update'));
Route::DELETE('generatehtml/destroy/{id}', array('as' => 'html.destroy', 'uses' => 'GenerateHtmlController@destroy'));
Route::GET('generatehtml/template/{id}', array('as' => 'html.template', 'uses' => 'GenerateHtmlController@templateRow'));
Route::GET('generatehtml/header/create', array('as' => 'header.create', 'uses' => 'GenerateHtmlController@headerCreate'));
Route::POST('generatehtml/header/save', array('as' => 'header.save', 'uses' => 'GenerateHtmlController@headerStore'));
Route::GET('generatehtml/header/{id}', array('as' => 'header.template', 'uses' => 'GenerateHtmlController@templateHeader'));
Route::GET('generatehtml/footer/{id}', array('as' => 'footer.template', 'uses' => 'GenerateHtmlController@templateFooter'));
Route::GET('generatehtml/{id}', array('as' => 'copy.template', 'uses' => 'GenerateHtmlController@copyRow'));
/*Route::get('/home', 'HomeController@index')->name('home');
*/