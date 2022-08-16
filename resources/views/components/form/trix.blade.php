@props([
'model' => null,
'name' => 'content',
'disabledFields' => [],
'post' => [],
'value' => "",
'label' => '',
'required' => false,
'hidden' => false,
])
@if($label && !$hidden)
<label for="x" class="block text-gray-500 font-bold my-3">
    {{ __($label) }}
    @if($required)<span class="text-red-600 ml-1">*</span>@endif
</label>
@endif

<textarea id="x" name="{{$name}}" class="hidden">{!! $post ? $post->content : $value !!}</textarea>
<div class="trix {{$hidden ? 'hidden' : ''}}">
    @trix($model, 'content', ['id' => 'x', 'hideTools' => $disabledFields ?? []])
</div>

@error($name)
<span class="text-red-600 my-2 block">{{ $message }}</span>
@enderror

@error('content')
<span class="text-red-600 my-2 block">{{ $message }}</span>
@enderror

@pushonce('trix')
@trixassets
@endpushonce