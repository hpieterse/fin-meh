<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetCategoriesController;
use App\Http\Controllers\SpendCategoriesController;
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
Route::get("/budget_category/{budget_category}/edit", [ BudgetCategoriesController::class, 'edit'])->name("budget_category.edit");
Route::put("/budget_category/{budget_category}", [ BudgetCategoriesController::class, 'update'])->name("budget_category.update");
Route::delete("/budget_category/{budget_category}", [ BudgetCategoriesController::class, 'destroy'])->name("budget_category.destroy");

Route::get("/budget_category/{budget_category}/spend_category/create", [ SpendCategoriesController::class, 'create'])->name("spend_category.create");
Route::post("/budget_category/{budget_category}/spend_category", [ SpendCategoriesController::class, 'store'])->name("spend_category.store");
Route::get("/budget_category/{budget_category}/spend_category/{spend_category}/edit", [ SpendCategoriesController::class, 'edit'])->name("spend_category.edit");
Route::put("/budget_category/{budget_category}/spend_category/{spend_category}", [ SpendCategoriesController::class, 'update'])->name("spend_category.update");
Route::delete("/spend_category/{spend_category}", [ SpendCategoriesController::class, 'destroy'])->name("spend_category.destroy");