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
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    /*
     * Students Routes
     */
    Route::get('/students/export_excel', 'StudentController@exportExcel')->name('students.export_excel');
    Route::get('/students/export_pdf', 'StudentController@exportPdf')->name('students.export_pdf');
    Route::resource('students', 'StudentController');

});
