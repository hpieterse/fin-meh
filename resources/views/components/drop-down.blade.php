<button x-data="{ dropDownOpen : false }" 
  @click="dropDownOpen = !dropDownOpen"
  @click.away="dropDownOpen = false"
  class="relative flex items-center"
  >
    {{ $title }}
    <x-icon-caret-down-solid class="h-4 ml-3"/>
  
  <div x-show="dropDownOpen" class="absolute top-full right-0 bg-white shadow-md">
    <ul>
      {{ $slot }}
    </ul>
  </div>
</button>
