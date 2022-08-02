@props([
'label' => '',
'name' => '',
'type' => 'text',
'value' => '',
'required' => false
])
@if($label)
<label for="{{ $name }}" class="block text-gray-500 font-bold my-3">
    {{ __($label) }}
    @if($required)<span class="text-red-600 ml-1">*</span>@endif
</label>
@endif
<input
    name="{{$name}}"
    type="{{$type}}"
    id="{{$name}}"
    value="{{old($name) ? old($name) : $value}}"
    {{ $attributes->class(["appearance-none border-2 border-gray-100 rounded-lg px-4 py-2 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg w-full "]) }}
/>
@error($name)
<span class="text-red-600 my-2 block">{{ $message }}</span>
@enderror
