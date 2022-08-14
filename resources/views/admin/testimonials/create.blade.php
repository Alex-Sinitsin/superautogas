@extends('admin.layouts.base')

@section('title', 'Создание отзыва')

@section('content')
<x-aside class="hidden lg:block" />
<div class="content p-5 w-screen overflow-auto">
    <x-page.header>
        <x-page.title title="Создание отзыва" icon="comment-text">
            <x-slot name="subtitle">{{ Breadcrumbs::render('admin.testimonials.create') }}</x-slot>
        </x-page.title>
        <div class="buttons">

        </div>
    </x-page.header>
    <div class="tml-create-content w-full shadow-lg p-7 2xl:container 2xl:mx-auto">
        <x-form method="POST" action="{{ route('testimonials.store') }}">
            <x-form.input type="text" name="nickname" value="{{ old('nickname') }}" label="Имя (никнейм)"
                placeholder="{{ __('Введите имя (никнейм)') }}" required />
            <x-form.input type="text" name="car_model" value="{{ old('car_model') }}" label="Модель автомобиля"
                placeholder="{{ __('Введите модель автомобиля') }}" required />
            <x-form.input type="hidden" name="rating" class="rateInput" value="{{ old('rating') }}" />

            <x-rating name='rating' className='tsml-rate' label='Оценка' rating='{{old("rating") ?? "0" }}' required />

            <x-form.trix label="Текст" name='text'
                :disabledFields="['attach', 'bold', 'italic', 'strike', 'link', 'heading-1', 'quote', 'code', 'bullet-list', 'number-list', 'decrease-nesting-level', 'increase-nesting-level']"
                :model=$testimonial required />

            <x-form.checkbox name="is_published" label="Опубликовать" class="is_active_checkbox"
                onchange="changeState()" />

            <x-button type="submit" text="Сохранить" icon="card-sd" color="green"
                class="bg-green-200 hover:bg-green-600 hover:text-white mt-5" />
        </x-form>
    </div>
</div>
@endsection

@pushonce('scripts')
<script src="https://starratingjs.netlify.app/index.js"></script>
@endpushonce

@push('scripts')
<script>
    let ratingEl = document.querySelector('div#rating');
    let ratingVal = ratingEl.dataset.rating;

    console.log(ratingVal);

    let ratingOptions = [
        {"rating": ratingVal, "maxRating":"5", "readOnly":"no", "starImage":"/images/star.png", "emptyStarImage":"/images/starbackground.png", "starSize":"22", "step":"1"}
    ];


    rateSystem('tsml-rate', ratingOptions, function(rating, ratingTargetElement){  
        ratingTargetElement.parentElement.parentElement.dataset.rating = rating;  
        document.querySelector('input#rating').value = rating;  
    });

    function changeState() {
		let checkbox = document.querySelector('.tml-create-content #form__chk');
		checkbox.toggleAttribute('checked');
	}

</script>
@endpush