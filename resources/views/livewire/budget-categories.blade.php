<div>
   <button wire:click="toggleShowCreateBudgetModal">Create Budget Category</button>
   @if($showCreateModal)
        <x-modal wire:click="toggleShowCreateBudgetModal" title="Create Category">
            <livewire:budget-categories.create/>
        </x-modal>
   @endif
</div>
