<?php

use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\MainController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/register/{slug}', [MainController::class, 'view_form'])->name('main.view_form');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('forms', FormController::class);
Route::get('/forms/activate/{id}', [FormController::class, 'activate'])->name('forms.activate');
Route::get('/forms/deactivate/{id}', [FormController::class, 'deactivate'])->name('forms.deactivate');
Route::get('/forms/delete/{id}', [FormController::class, 'destroy'])->name('forms.delete');
Route::get('/field/delete/{id}', [FormController::class, 'delete_field'])->name('field.delete');
