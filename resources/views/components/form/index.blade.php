@props(['method' => 'GET'])

<form method="{{ $method == 'GET' ? $type : 'POST' }}" {{ $attributes }} {{ $attributes->class([]) }}">
@csrf
@if($method != 'GET' || $method != 'POST') @method($method)@endif
    {{ $slot }}
</form>
