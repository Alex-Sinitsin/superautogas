<a href="{{ $link }}"
    {{ $attributes->class(["block text-base hover:bg-blue-700 hover:text-white font-medium px-7 py-2 transition-colors"]) }}>
    <i class="zmdi zmdi-@isset($icon){{ $icon }}@endisset mr-1.5 icon"></i>
    <span>{{__($title)}}</span>
</a>
