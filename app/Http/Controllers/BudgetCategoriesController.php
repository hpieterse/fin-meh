<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BudgetCategory;
use Illuminate\Validation\Rule;

class BudgetCategoriesController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $budgetCategories = auth()->user()->budgetCategories()->get();
        return view('budget_category.index', ['budgetCategories' => $budgetCategories]);
    }

    public function create(){
        return view('budget_category.create');
    }

    public function edit(BudgetCategory $budgetCategory){
        $this->authorize('update', $budgetCategory);
        return view('budget_category.edit', compact('budgetCategory'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => [
                'required',
                Rule::unique('budget_categories')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                }),
                'max:255',
            ]
        ]);

        auth()->user()->budgetCategories()->create($data);

        return redirect(route('budget_category.index'));
    }

    public function update(BudgetCategory $budgetCategory, Request $request){
        $this->authorize('update', $budgetCategory);
        $data = $request->validate([
            'name' => [
                'required',
                Rule::unique('budget_categories')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                })->ignore($budgetCategory),
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
