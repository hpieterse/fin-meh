<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BudgetCategoriesController;
use App\Http\Controllers\SpendCategoriesController;
use App\Http\Controllers\SpendItemController;

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

Route::get('/budget/{date}', [App\Http\Controllers\BudgetController::class, 'show'])->name('budget.show');

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

Route::get("/spend_item", [ SpendItemController::class, 'index'])->name("spend_item.index");
Route::get("/spend_item/create", [ SpendItemController::class, 'create'])->name("spend_item.create");
Route::post("/spend_item", [ SpendItemController::class, 'store'])->name("spend_item.store");
Route::get("/spend_item/{spend_item}/edit", [ SpendItemController::class, 'edit'])->name("spend_item.edit");
Route::put("/spend_item/{spend_item}", [ SpendItemController::class, 'update'])->name("spend_item.update");
Route::delete("/spend_item/{spend_item}", [ SpendItemController::class, 'destroy'])->name("spend_item.destroy");