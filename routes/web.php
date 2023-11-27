<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\DoseController;
use App\Http\Controllers\MedicineController;

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
    Route::get('/dose-delete/{id}','DoseController@delete')->name('dose-delete');
    Route::get('/medicine-delete/{id}','MedicineController@delete')->name('medicine-delete');
    Route::post('medicine-search', 'MedicineController@search')->name('medicines.search');
    Route::resource('patients', 'PatientController');
    Route::post('patient-search', 'PatientController@search')->name('patients.search');
    Route::post('date-search', 'PatientController@dateSearch')->name('date.search');
    Route::get('search-by-date', 'PatientController@date')->name('searchByDate');
    Route::post('patient-complain', 'PatientController@complain')->name('patients.complain');
    Route::get('patient-profile/{id}', 'PatientController@profile')->name('patients.profile');
    Route::resource('power','PowerController');
    Route::resource('dose','DoseController');
    Route::resource('medicine','MedicineController');
    Route::get('medicine/low/stock','MedicineController@lowStock')->name('medicine.low-stock');
    Route::get('expired-medicine','MedicineController@expiredMedicine')->name('medicine.expired-medicine');
    Route::resource('complains','ComplainController');
    Route::resource('companyInvoice','CompanyInvoiceController');
    Route::get('invoice-delete/{id}','CompanyInvoiceController@delete')->name('invoice.delete');
    Route::resource('companies','CompanyController');
    Route::get('company-delete/{companyId}','CompanyController@destroy')->name('company.delete');
    Route::resource('diseases','DiseaseController');
    Route::get('disease-delete/{id}','DiseaseController@erase')->name('disease.delete');
    Route::post('medicineByDisease','HomeController@medicineByDisease')->name('medicineByDisease');

    Route::get('prescription', function (){
       return view('prescription.index');
    })->name('prescription');

    Route::get('backup', 'HomeController@backup')->name('backup');

    Route::get('migrate', function () {
        \Illuminate\Support\Facades\Artisan::call('migrate');
        return redirect()->back()->with('success', 'Migrated Successfully');
    });
});
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
