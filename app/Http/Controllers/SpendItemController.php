<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\SpendItem;
use App\Models\BudgetCategory;

class SpendItemController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }

    private function validation($budgetCategoryId) {
        $userId = auth()->user()->id;
        return [
            'budget_category_id' => [
                'required',
                Rule::exists('budget_categories','id')->where(function ($query) use($userId) {
                    return $query->where('user_id', $userId);
                }),
            ],
            'spend_category_id' => [
                'required',
                Rule::exists('spend_categories','id')->where(function ($query) use($budgetCategoryId) {
                    return $query->where('budget_category_id', $budgetCategoryId);
                }),
            ],
            'description' => 'required',
            'date' => 'required|date',
            'amount' => 'required|numeric',
        ];
    }

    private function getAllCategories(){
        return BudgetCategory::with('spendCategories')
        ->where('user_id', auth()->user()->id)
        ->get();

    }

    public function index(){
        $userId = auth()->user()->id;

        $spendItems = SpendItem::with('spendCategory.budgetCategory.user')
            ->whereHas('spendCategory.budgetCategory.user', function ($query)  use($userId) {
                $query->where('id', $userId);
            })->orderBy('date', 'DESC')
            ->paginate(20);

        return view('spend_item.index', compact('spendItems'));
    }

    public function edit(SpendItem $spendItem){
        $this->authorize('update', $spendItem);
        $budgetCategories = $this->getAllCategories();

        return view('spend_item.edit', compact('budgetCategories', 'spendItem'));
    }

    public function create(){
        // get budget and spend categories for drop downs
        $budgetCategories = $this->getAllCategories();
        return view('spend_item.create', compact('budgetCategories'));
    }

    public function store(Request $request){
        $userId = auth()->user()->id;

        $budgetCategoryId = $request->input('budget_category_id');
        $data = $request->validate($this->validation($budgetCategoryId));

        unset($data['budget_category_id']);
        SpendItem::create($data);

        return redirect(route('spend_item.index'));
    }

    public function update(SpendItem $spendItem, Request $request){
        $this->authorize('update', $spendItem);

        $budgetCategoryId = $request->input('budget_category_id');
        $data = $request->validate($this->validation($budgetCategoryId));

        unset($data['budget_category_id']);
        
        $spendItem->update($data);
        return redirect(route('spend_item.index'));
    }

    public function destroy(SpendItem $spendItem){
        $this->authorize('delete', $spendItem);
       
        $spendItem->delete();
        return redirect()->route('spend_item.index');
    }
}
