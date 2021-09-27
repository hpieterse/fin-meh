<div>
    <form wire:submit.prevent="submit">
        <x-form-elements.text-input
            placeholder="Enter category name"
            wire:model="name"
            autofocus
            label="{{ __('Category Name') }}" />
        <x-form-elements.button-area>
            <x-button type="button" color="primary">
                {{ __('Cancel') }}
            </x-button>
            <x-button type="submit" color="success">
                {{ __('Add') }}
            </x-button>
        </x-form-elements.button-area>
    </form>
</div>
