@props(['title' => '', 'icon' => 'label', 'color' => 'gray', 'value' => 0])

<div {{ $attributes->class(["block p-6 rounded-lg shadow-lg w-full px-20 bg-$color-200 my-3"]) }}>
    <div class="flex items-center text-2xl flex items-center justify-center">
        <i class="zmdi zmdi-{{$icon}} mr-3 align-middle"></i>
        <h5 class="mb-0 text-gray-900 leading-tight font-bold align-middle">
            {{ __($title) }}
        </h5>
    </div>
    <p class="text-gray-700 text-base mb-4 align-middle text-center text-4xl pt-3">{{ $value }}</p>
</div>
