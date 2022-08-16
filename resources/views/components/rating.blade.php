@props([
'label' => '',
'name' => '',
'rating' => '',
'className' => '',
'required' => false
])
@if($label)
<label for="{{ $name }}" class="block text-gray-500 font-bold my-3">
  {{ __($label) }}
  @if($required)<span class="text-red-600 ml-1">*</span>@endif
</label>
@endif
<div {{$attributes->class(["testinonial-item__rating mb-2"])}} id="{{$name}}" data-rating='{{$rating}}'>
  <div class="starRatingContainer">
    <div class="{{$className}}"></div>
  </div>
  <div class="ratingHolder"></div>
</div>
@error($name)
<span class="text-red-600 my-2 block">{{ $message }}</span>
@enderror