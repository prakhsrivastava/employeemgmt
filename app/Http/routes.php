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
    return redirect()->to('/login');
});

// Auth::routes(['register' => false]);
Route::get('/login', 'Auth\LoginController@getLogin')->name('login');
Route::post('/login', 'Auth\LoginController@postLogin');
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->to('/login');
})->name('logout');

// /* AUTH Registration Routes */
// Route::get('/register', 'Auth\RegisterController@getRegister')->name('register');
// Route::post('/register', 'Auth\RegisterController@postRegister');


Route::group(['prefix' => 'employee', 'as' => 'emp.', 'middleware' => ['auth']], function () {
    Route::get('', 'EmployeeContoller@index')->name('index');
    Route::post('/import', 'EmployeeContoller@import')->name('import');
    Route::get('/{id}/edit', 'EmployeeContoller@edit')->name('edit');
    Route::get('/report', 'EmployeeContoller@report')->name('report');
    Route::post('/edit', 'EmployeeContoller@getData');
    Route::post('/{id}/delete', 'EmployeeContoller@destroy')->name('delete');
});

// Employee Route
// Route::resource('/employee', 'EmployeeContoller');

Route::get('/home', function () {
    return redirect()->route('emp.index');
})->name('home');
