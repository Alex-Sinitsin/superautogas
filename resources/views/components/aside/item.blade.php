<div {{ $attributes->class(["menu-item mb-3"]) }}>
    <p class="text-gray-600 font-bold mb-1 uppercase text-sm tracking-wider">{{__($title)}}</p>
    {{ $slot }}
</div>
