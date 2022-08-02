@props(['label' => '', 'name' => 'checkbox', 'checked' => true ])

<div {{$attributes->class(["my-5"])}}>
    <input type="checkbox" name="{{$name}}" class="form__chk" id="form__chk" {{ $checked ? 'checked' : '' }}>
    <label for="form__chk" class="form__chk-label">
        <span class="form__span">{{ __($label) }}</span>
    </label>
</div>
