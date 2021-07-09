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

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|unique:budget_categories|max:255'
        ]);

        auth()->user()->budgetCategories()->create($data);

        return redirect(route('budget_category.index'));
    }
}
