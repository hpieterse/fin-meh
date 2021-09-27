<div class="absolute h-screen w-screen bg-black bg-opacity-70 inset-0" {{ $attributes->whereStartsWith('wire:click') }}>
  <div class="bg-white shadow-md container mx-auto relative top-1/2 transform -translate-y-1/2" onclick="event.stopPropagation()">
    <div class="flex flex-row items-center">
      <h1 class="flex-1 text-lg p-5"> @isset ($title) {{ $title }} @endisset</h1>
      <button {{ $attributes->whereStartsWith('wire:click') }} class="p-5" ><x-icon-times-light class="text-danger w-5"/></button>
    </div>
    
    <div class="px-5 pb-5">
      {{ $slot }}
    </div>
  </div>
</div>
