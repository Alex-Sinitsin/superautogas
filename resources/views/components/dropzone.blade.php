@props([
'label' => '',
'name' => '',
'id' => '',
'required' => false
])
@if($label)
<label for="{{ $id }}" class="block text-gray-500 font-bold my-3">
  {{ __($label) }}
  @if($required)<span class="text-red-600 ml-1">*</span>@endif
</label>
@endif
<div id="{{ $id }}" {{$attributes->class(["dropzone w-full bg-white"])}}>
  <div class="dz-message select-none pointer-events-none text-sm text-gray-500 h-full" data-dz-message>
    <i class="zmdi zmdi-cloud text-5xl mb-2"></i>
    <span class="block">Перетащите файлы в эту область</span>
    <span class="block">или нажмите, чтобы выбрать файлы</span>
  </div>
</div>

<span class="modal-error-{{$name}} my-2 text-red-600 hidden pointer-events-none"></span>

@pushonce('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpushonce

@pushonce('scripts')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endpushonce