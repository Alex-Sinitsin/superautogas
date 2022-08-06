@props(['type' => 'button', 'text' => '', 'icon' => '', 'color' => 'gray'])

<button type="{{$type}}" {{ $attributes->class(["text-left block rounded h-full py-2.5 px-4 text-$color-900
    transition-colors"]) }}>
    <i class="zmdi zmdi-{{$icon}} {{$text ?? 'mr-1'}} align-middle"></i>
    <span class="text-sm align-middle">{{ __($text) }}</span>
</button>