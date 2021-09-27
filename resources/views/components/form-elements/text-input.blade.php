@php
  $modelName = $attributes->get('wire:model');
@endphp

<label class="block mt-5 first:mt-0">
  <span class="text-gray-700">
    {{ $label }}
  </span>
  <div class="flex flex-row relative mt-2" x-data="{ clean : true, entered: false }">
    <input
        type="text"
        {{ $attributes }}
        class="block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-opacity-50"
        @blur="clean = !entered"
        @keyup="entered = true"
        @error($modelName)
          :class="'border-red-300 focus:border-red-300 focus:ring-red-200'"
        @else 
          :class="clean 
            ? 'focus:ring-indigo-200 focus:border-indigo-300' 
            : 'border-green-300 focus:border-green-300 focus:ring-green-200'" 
        @enderror
    />
    <div class="absolute right-3 top-1/2 transform -translate-y-1/2" >
      <x-icon-circle-solid class="w-2 h-2 mr-1 text-gray-300" wire:loading wire:target="{{$modelName}}"/>
      @error($modelName)
        <x-icon-times-circle-light class="w-4 h-4 text-danger" wire:loading.remove wire:target="{{$modelName}}"/>
      @else
        <x-icon-check-circle-light x-show="!clean" class="w-4 h-4 text-success" wire:loading.remove wire:target="{{$modelName}}"/>
      @enderror
      
    </span>
    </div>
  </div>

  <span class="error text-danger mt-2" wire:loading.remove wire:target="{{$modelName}}">
    @error($modelName)
      {{ $message }} 
    @enderror
  </span>
</label>