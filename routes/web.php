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

Auth::routes();

Route::group(['prefix' => 'employee', 'as' => 'emp.'], function () {
    Route::get('', 'EmployeeContoller@index')->name('index');
    Route::post('/import', 'EmployeeContoller@import')->name('import');
});

// Employee Route
// Route::resource('/employee', 'EmployeeContoller');

Route::get('/home', function () {
    return redirect()->route('emp.index');
})->name('home');
