<a href="{{ $link }}" {{ $attributes->class(["menu-link block text-base hover:bg-blue-700 hover:text-white font-medium
    px-7 py-2
    transition-colors whitespace-nowrap"]) }}>
    <i class="zmdi zmdi-@isset($icon){{ $icon }}@endisset mr-1.5 icon"></i>
    <span>{{__($title)}}</span>
</a>