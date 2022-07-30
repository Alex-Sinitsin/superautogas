@props([
    'title' => '',
    'icon' => '',
])

<div {{ $attributes->class(["page-title flex items-center"]) }}>
    <i class="zmdi @isset($icon)zmdi-{{$icon}}@endisset py-3 px-4 text-[28px] text-white rounded bg-green-500"></i>
    <div class="page-caption ml-4">
        <p class="page-title block font-bold text-2xl tracking-wider mb-0">
            {{ __($title) }}
        </p>
        {{ $slot }}
    </div>
</div>
