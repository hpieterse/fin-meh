<li class="list-none">
    <a  class="h-14 block flex items-center {{request()->routeIs($attributes->get('route-name')) ? 'font-bold' : ''}} hover:underline"
        href="{{ route($attributes->get('route-name')) }}">
        {{ $slot }}
    </a>
</li>