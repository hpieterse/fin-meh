<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BudgetCategory;

class BudgetCategoriesController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('budget_categories.index');
    }

    public function create(){
        return view('budget_categories.create');
    }

    public function edit(BudgetCategory $budgetCategory){
        $this->authorize('update', $budgetCategory);
        return view('budget_categories.edit', compact('budgetCategory'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|unique:budget_categories|max:255'
        ]);

        auth()->user()->budgetCategories()->create($data);

        return redirect(route('budget_category.index'));
    }

    public function update(BudgetCategory $budgetCategory, Request $request){
        $this->authorize('update', $budgetCategory);
        $data = $request->validate([
            'name' => [
                'required',
                'unique:budget_categories,name,' . $budgetCategory->id,
                'max:255',
            ]
        ]);

        $budgetCategory->update($data);
        return redirect(route('budget_category.index'));
    }

    public function destroy(BudgetCategory $budgetCategory){
        $this->authorize('delete', $budgetCategory);
       
        $budgetCategory->delete();
        return redirect()->route('budget_category.index');
    }


}
