<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BudgetCategories extends Component
{
    public $showCreateModal = false;

    protected $queryString = [
        'showCreateModal' => ['except' => false],
    ];

    public function toggleShowCreateBudgetModal(){
        $this->showCreateModal = !$this->showCreateModal;
    }

    public function render()
    {
        return view('livewire.budget-categories');
    }
}
