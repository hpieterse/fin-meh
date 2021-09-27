<button 
{{ $attributes->merge([
  'class' => 'mt-5 px-5 py-2 font-bold text-white rounded-md bg-'.$color.' hover:bg-'.$color.'-active'
  ]) }}>
    {{ $slot }}
</button>