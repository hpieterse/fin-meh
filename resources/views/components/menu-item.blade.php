<li class="list-none">
    <a  class="h-10 block flex items-center {{request()->routeIs($attributes->get('route-name')) ? 'font-bold' : ''}}"
        href="{{ route($attributes->get('route-name')) }}">
        {{ $slot }}
    </a>
</li>