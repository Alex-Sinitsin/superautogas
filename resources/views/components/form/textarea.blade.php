@props(['name' => 'content', 'value' => '' ])

<textarea name="{{$name}}" value="{{$value}}" {{ $attributes->class([]) }}>{{$value}}</textarea>
