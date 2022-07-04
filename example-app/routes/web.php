<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin_panel', [App\Http\Controllers\MainController::class, 'admin_panel'])->name('admin_panel');
Route::match(['get','post'],'add_object', [App\Http\Controllers\MainController::class, 'add_object'])->name('add_object');
Route::match(['get','post'],'add_category', [App\Http\Controllers\MainController::class, 'add_category'])->name('add_category');
Route::match(['get','post'],'redact_object_page/{id}', [App\Http\Controllers\MainController::class, 'redact_object_page'])->name('redact_object_page');
Route::match(['get','post'],'redact_object/{id}', [App\Http\Controllers\MainController::class, 'redact_object'])->name('redact_object');
Route::match(['get','post'],'delete_object/{id}', [App\Http\Controllers\MainController::class, 'delete_object'])->name('delete_object');
Route::match(['get','post'],'delete_category/{id}', [App\Http\Controllers\MainController::class, 'delete_category'])->name('delete_category');

Route::match(['get','post'],'filter/{name}', [App\Http\Controllers\MainController::class, 'filter_objects'])->name('filter_objects');
