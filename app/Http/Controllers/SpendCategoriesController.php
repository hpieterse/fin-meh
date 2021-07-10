<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\SpendCategory;
use App\Models\BudgetCategory;

class SpendCategoriesController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }

    public function create(BudgetCategory $budgetCategory){
        return view('spend_category.create', compact('budgetCategory'));
    }

    public function edit(BudgetCategory $budgetCategory, SpendCategory $spendCategory){
        $this->authorize('update', $spendCategory);
        return view('spend_category.edit', compact('spendCategory', 'budgetCategory'));
    }

    public function store(BudgetCategory $budgetCategory, Request $request){
        $this->authorize('update', $budgetCategory);
        $data = $request->validate([
            'name' => [
                'required',
                Rule::unique('spend_categories')->where(function ($query) use($budgetCategory) {
                    return $query->where('budget_category_id', $budgetCategory->id);
                }),
                'max:255',
            ]
        ]);

        $budgetCategory->spendCategories()->create($data);

        return redirect(route('budget_category.index'));
    }

    public function update(BudgetCategory $budgetCategory, SpendCategory $spendCategory, Request $request){
        $this->authorize('update', $spendCategory);
        $data = $request->validate([
            'name' => [
                'required',
                Rule::unique('spend_categories')->where(function ($query) use($budgetCategory) {
                    return $query->where('budget_category_id', $budgetCategory->id);
                })->ignore($spendCategory),
                'max:255',
            ]
        ]);

        $spendCategory->update($data);
        return redirect(route('budget_category.index'));
    }

    public function destroy(SpendCategory $spendCategory){
        $this->authorize('delete', $spendCategory);
       
        $spendCategory->delete();
        return redirect()->route('budget_category.index');
    }
}
