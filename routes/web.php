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


Route::get('/budget', [App\Http\Controllers\BudgetController::class, 'index'])->name('budget.index');
Route::get('/budget/{date}', [App\Http\Controllers\BudgetController::class, 'show'])->name('budget.show');

Route::get('/budget_category', App\Http\Livewire\BudgetCategories::class)->name('budget_category.index')->middleware('auth');
Route::resource('budget_category', BudgetCategoriesController::class)
    ->except(["index"]);
Route::resource('budget_category.spend_category', SpendCategoriesController::class)
    ->except(["index", "show"])
    ->shallow();

Route::resource('spend_item', SpendItemController::class)
    ->except(["show"]);