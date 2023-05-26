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

Route::get('/', 'HomeController@index');

Auth::routes();


/**
 * +-------------------------
 * | User
 * +-------------------------
 */
Route::get('/users', 'UserController@index');
Route::post('/users/create', 'UserController@create');
Route::post('/users/createWithoutLogin', 'UserController@createWithoutLogin');
Route::delete('/users/delete', 'UserController@delete');
Route::post('/users/activate', 'UserController@activate');
Route::post('/users/update', 'UserController@update');
Route::post('/users/datatable', 'UserController@datatable');
Route::get('/users/lang/{local}', 'UserController@lang');
Route::post('/users/permissions', 'UserController@permissions');
Route::post('/users/updatePermissions', 'UserController@updatePermissions');
Route::post('/users/refreshUserRole', 'UserController@refreshUserRole');
Route::get('/register', 'UserController@registerPage');

/**
 * +-------------------------
 * | Roles
 * +-------------------------
 */
Route::get('/roles', 'RoleController@index');
Route::post('/roles/datatable', 'RoleController@datatable');
Route::post('/roles/create', 'RoleController@create');
Route::post('/roles/read', 'RoleController@read');
Route::delete('/roles/delete', 'RoleController@delete');
Route::post('/roles/update', 'RoleController@update');
Route::post('/roles/permissions', 'RoleController@permissions');
Route::post('/roles/updatePermissions', 'RoleController@updatePermissions');
Route::post('/roles/updatePermitionForAllUsers', 'RoleController@updatePermitionForAllUsers');
/**
 * +-------------------------
 * | settings
 * +-------------------------
 */
Route::get('/settings', 'SettingController@index');
Route::post('/settings/update', 'SettingController@update');
Route::post('/settings/updateThemeColor', 'SettingController@updateThemeColor');


/**
 * +-------------------------
 * | GlobalController
 * +-------------------------
 */
Route::post('/GlobalController/GetEnumValues', 'GlobalController@GetEnumValues');
Route::post('/GlobalController/GetTableList', 'GlobalController@GetTableList');


/**
 * +-------------------------
 * | Audits
 * +-------------------------
 */

Route::get('importExportView', 'ImportationController@importExportView');
Route::get('export', 'ImportationController@export')->name('export');
Route::post('import', 'ImportationController@import')->name('import');




Route::post('/symptoms/Autocomplete','SymptomController@Autocomplete');
Route::post('/criterias/Autocomplete','CriteriaController@Autocomplete');
Route::post('/metabolites/Autocomplete','MetaboliteController@Autocomplete');
Route::post('/analytical_criterias/Autocomplete','AnalyticalCriteriaController@Autocomplete');
/**
 * +-------------------------
 * | medicine
 * +-------------------------
 */
Route::get('/medicines', 'MedicineController@index');
Route::post('/medicines/datatable', 'MedicineController@datatable');
Route::post('/medicines/get', 'MedicineController@get');
Route::post('/medicines/create', 'MedicineController@create');
Route::post('/medicines/update', 'MedicineController@update');
Route::delete('/medicines/delete', 'MedicineController@delete');
Route::get('/medicines/search', 'MedicineController@searchView');
Route::post('/medicines/advanceSearch', 'MedicineController@advanceSearch');





Route::post('import', 'ImportationController@import')->name('import');
Route::get('export/{table_name}', 'ImportationController@export')->name('export');




/**
 * +-------------------------
 * | appointments
 * +-------------------------
 */
Route::get('/appointments', 'AppointmentController@index');
Route::post('/appointments/datatable', 'AppointmentController@datatable');
Route::post('/appointments/create', 'AppointmentController@create');
Route::post('/appointments/checkedAppointment', 'AppointmentController@checkedAppointment');
Route::delete('/appointments/delete', 'AppointmentController@delete');

/**
 * +-------------------------
 * | visit_types
 * +-------------------------
 */
//Route::get('/visit_types', 'VisitTypeController@index');
Route::post('/visit_types/doctors', 'VisitTypeController@doctors');





/**
 * +-------------------------
 * | reservation
 * +-------------------------
 */
Route::get('/reservations', 'ReservationController@index');
Route::post('/houses', 'HouseController@houses');
Route::post('/reservations/datatable', 'ReservationController@datatable');
Route::delete('/reservations/delete', 'ReservationController@delete');
Route::post('/beds/beds_available', 'BedController@beds_available');
Route::post('/reservations/create', 'ReservationController@create');
//Route::post('/appointments/checkedAppointment', 'AppointmentController@checkedAppointment');

