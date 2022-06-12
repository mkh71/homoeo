<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\DoesController;
use App\Http\Controllers\MadicineController;

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

Route::get('reboot', function () {
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    dd('Web site Refreshed!  Please, Go back :)');
});
Auth::routes();

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/power-delete/{id}','PowerController@delete')->name('power-delete');
    Route::get('/does-delete/{id}','DoesController@delete')->name('does-delete');
    Route::get('/madicine-delete/{id}','MadicineController@delete')->name('madicine-delete');
    Route::resource('patients', 'PatientController');
    Route::post('patient-search', 'PatientController@search')->name('patients.search');
    Route::post('patient-complain', 'PatientController@complain')->name('patients.complain');
    Route::get('patient-profile/{id}', 'PatientController@profile')->name('patients.profile');
    Route::resource('power','PowerController');
    Route::resource('does','DoesController');
    Route::resource('madicine','MadicineController');
});
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
