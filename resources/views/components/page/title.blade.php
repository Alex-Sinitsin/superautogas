<div {{ $attributes->class(["page-title flex items-center flex-wrap justify-center sm:justify-start text-center sm:text-left my-2"]) }}>
    <i class="zmdi zmdi-{{$icon}} py-3 px-4 text-[28px] text-white rounded bg-green-500"></i>
    <div class="page-caption ml-4">
        <p class="page-title block font-bold text-2xl tracking-wider mb-1">
            {{ __($title) }}
        </p>
        <div class="subtitle-element">{{ $subtitle }}</div>
        {{ $slot }}
    </div>
</div>
