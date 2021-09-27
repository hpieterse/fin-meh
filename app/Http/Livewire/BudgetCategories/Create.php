<?php

namespace App\Http\Livewire\BudgetCategories;

use App\Models\BudgetCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public $name;

    protected function rules()
    {
        return [
                'name' => [
                    'required',
                    Rule::unique('budget_categories')->where(function ($query) {
                        return $query->where('user_id', auth()->user()->id);
                    }),
                    'max:255',
                ]
            ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $data = $this->validate();

        auth()->user()->budgetCategories()->create($data);
    }

    public function render()
    {
        return view('livewire.budget-categories.create');
    }
}
