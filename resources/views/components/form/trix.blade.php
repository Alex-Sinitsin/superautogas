@props([
'disabledFields' => [],
'post' => [],
'label' => '',
'required' => false
])
@if($label)
<label for="x" class="block text-gray-500 font-bold my-3">
    {{ __($label) }}
    @if($required)<span class="text-red-600 ml-1">*</span>@endif
</label>
@endif

<textarea id="x" name="content" class="hidden">{{ !$post ? old('content') : $post->content }}</textarea>
@trix(\App\Models\Post::class, 'content', ['id' => 'x', 'hideTools' => $disabledFields ? $disabledFields : []])

@error('content')
<span class="text-red-600 my-2 block">{{ $message }}</span>
@enderror

@pushonce('trix')
    @trixassets
@endpushonce
