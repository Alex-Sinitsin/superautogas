@props(['method' => 'GET', 'action' => '', 'multipart' => false])

<form method="{{ $method == 'GET' ? $type : 'POST' }}" action="{{ $action }}" {{ $attributes->class([]) }} @if($multipart)  enctype='multipart/form-data'@endif>
@csrf
@if($method != 'GET' || $method != 'POST')
    @method($method)
@endif
    {{ $slot }}
</form>
