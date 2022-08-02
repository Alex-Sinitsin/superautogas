@props([
'disabledFields' => [],
'post' => [],
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

<textarea id="x" name="content" class="hidden">{{ $post ? $post->content : old('content') }}</textarea>
<div class="trix {{$hidden ? 'hidden' : ''}}">
    @trix(\App\Models\Post::class, 'content', ['id' => 'x', 'hideTools' => $disabledFields ? $disabledFields : []])
</div>

@error('content')
<span class="text-red-600 my-2 block">{{ $message }}</span>
@enderror

@pushonce('trix')
    @trixassets
@endpushonce
