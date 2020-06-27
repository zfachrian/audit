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

Route::get('/admin', 'Users\AdminController@index')->name('admin')->middleware('admin');
Route::get('/auditor', 'Users\AuditorController@index')->name('auditor')->middleware('auditor');
Route::get('/kontraktor', 'Users\KontraktorController@index')->name('kontraktor')->middleware('kontraktor');
Route::get('/manajer', 'Users\ManajerController@index')->name('manajer')->middleware('manajer');
Route::get('/supervisor', 'Users\SupervisorController@index')->name('supervisor')->middleware('supervisor');

Route::get('/home', 'Users\AdminController@index')->name('home');

Route::resource('user', 'UserController')->except(['create']);
Route::get('/user/create/{role}', 'UserController@create');
Route::get('/userAuditor', 'UserController@auditor');
Route::get('/userKontraktor', 'UserController@kontraktor');
Route::get('/userManajer', 'UserController@manajer');
Route::get('/userSupervisor', 'UserController@supervisor');

Route::resource('/audit', 'AuditController');
Route::get('/hasil/{id}', 'AuditController@hasilAudit');
Route::get('/hasilNilai/{id}', 'AuditController@hasilNilai');
Route::get('/AuditSumary/{id}', 'AuditController@audit');
// Route::get('/AuditSumary/{id}/edit', 'AuditController@auditEdit');
Route::get('/AuditKategori/{kategori}/{audit_id}/edit', 'AuditController@editSoal');
Route::get('/AuditKategori/{kategori}/{audit_id}', 'AuditController@soal');
Route::post('/SubmitSoal/{soal}', 'AuditController@storeSoal');
Route::post('/SubmitSoal/{soal}/{katNilai}', 'AuditController@storeEditSoal');
Route::post('/StatusManajer/{id_manajer}/{manajer}', 'AuditController@updateStatusManajer');
Route::post('/StatusSupervisor/{id_supervisor}/{supervisor}', 'AuditController@updateStatusSupervisor');
