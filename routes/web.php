<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetCategoriesController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/budget_category", [ BudgetCategoriesController::class, 'index'])->name("budget_category.index");
Route::get("/budget_category/create", [ BudgetCategoriesController::class, 'create'])->name("budget_category.create");
Route::post("/budget_category", [ BudgetCategoriesController::class, 'store'])->name("budget_category.store");
