@extends('admin.layouts.base')

@section('title', 'Отзывы клиентов')

@section('content')
<x-aside />
<div class="content p-5 w-screen overflow-auto">
  <x-page.header>
    <x-page.title title="Отзывы клиентов" icon="comments">
      <x-slot name="subtitle">{{ Breadcrumbs::render('admin.testimonials') }}</x-slot>
    </x-page.title>
    <div class="buttons my-5 sm:my-0 w-full sm:w-fit">
      <a href="{{ route('testimonials.create') }}"
        class="block px-3 py-2.5 mr-2 my-1 bg-red-200 text-red-800 text-sm rounded hover:bg-red-600 hover:text-white transition-colors text-center w-full sm:w-fit sm:inline-block sm:text-left">
        <i class="zmdi zmdi-collection-add mr-2 align-middle"></i>
        <span class="align-middle">{{ __('Добавить отзыв') }}</span>
      </a>
    </div>
  </x-page.header>
  @if (session()->has('success'))
  <div class="bg-green-100 rounded-lg py-4 px-6 mb-4 text-base text-green-700" role="alert">
    <i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i>
    <span class="align-middle">{{ session()->get('success') }}</span>
  </div>
  @endif

  <div class="testimonials-grid 2xl:container 2xl:mx-auto">
    <div class="grid-sizer xl:w-[32%]"></div>

    @foreach($testimonials as $testimonial) <div
      class="testimonial-item border rounded shadow-md py-4 px-3 xl:w-[32%] w-full my-3 xl:my-5">
      <div class="testimonial-item__header flex items-center">
        <div
          class="testimonial-item__avatar py-3 px-6 flex justify-center items-center mr-4 text-white text-6xl bg-cyan-600 rounded-[50%]">
          <i class="zmdi zmdi-account"></i>
        </div>
        <div class="testimonial-item__information w-full flex flex-col">
          <div class="testimonials-item__user">
            <p class="text-lg font-bold">{{__($testimonial->nickname)}}</p>
          </div>
          <div class="testimonial-item__car pb-2  text-gray-400 italic">
            <p>{{__($testimonial->car_model)}}</p>
          </div>
          <div class="testinonial-item__rating" id="rater" data-rating='{{$testimonial->rating}}'>
            <div class="starRatingContainer">
              <div class="ratingValue"></div>
            </div>
            <div class="ratingHolder"></div>
          </div>
        </div>
      </div>
      <div class="testimonials-item__body py-2">{!! $testimonial->text !!}</div>
      <div class="testimonial-item__footer flex items-center">
        <div class="badges flex-1">
          <span
            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-violet-500 text-white rounded">
            <i class="zmdi zmdi-calendar-note mr-1"></i>
            <span>{{ $testimonial->created_at }}</span>
          </span>
          @if($testimonial->is_published)
          <span
            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-600 text-white rounded">Опубликован</span>
          @else
          <span
            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-300 text-gray-700 rounded">Скрыт</span>
          @endif
        </div>

        <div class="post-card__options cursor-pointer text-2xl">
          <i class="zmdi zmdi-more p-2"></i>
        </div>
        <div class="dropdown absolute bottom-[55px] right-[15px] rounded shadow-md py-3 px-6 bg-white" role="menu">
          <div class="dropdown__content">
            <div class="dropdown__content-item border-b-2 border-b-gray-100">
              <a href="{{ route('testimonials.edit', ['testimonial' => $testimonial->id]) }}"
                class="edit-option block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
                <i class="zmdi zmdi-edit mr-1 align-middle"></i>
                <span class="text-sm align-middle">Редактировать</span>
              </a>
            </div>
            <div class="dropdown__content-item border-b-2 border-b-gray-100">
              <x-form method="PUT" action="{{ route('testimonials.update', ['testimonial' => $testimonial->id]) }}">
                <x-form.input type="hidden" name="nickname" value="{{$testimonial->nickname }}" />
                <x-form.input type="hidden" name="car_model" value="{{ $testimonial->car_model}}" />
                <x-form.input type="hidden" name="rating" class="rateInput" value="{{$testimonial->rating}}" />
                <x-form.trix name='text' :model=$testimonial value="{{ $testimonial->text}}" hidden />
                <x-form.checkbox name="is_published" :checked="!$testimonial->is_published" class="hidden" />

                @if($testimonial->is_published)
                <x-button type="submit" text="Скрыть" icon="eye-off" class="px-2 hover:text-blue-900" />
                @else
                <x-button type="submit" text="Опубликовать" icon="eye" class="px-2 hover:text-blue-900" />
                @endif
              </x-form>
            </div>
            <div class="dropdown__content-item">
              <x-form method="DELETE" action="{{ route('testimonials.destroy', ['testimonial' => $testimonial->id]) }}">
                <x-button type="submit" text="Удалить" icon="delete" class="px-2 text-red-600 hover:text-red-800" />
              </x-form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="pagination-links my-4 2xl:container 2xl:mx-auto">
    {{ $testimonials->links() }}
  </div>
</div>
@endsection

@pushonce('scripts')
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://starratingjs.netlify.app/index.js"></script>
@endpushonce

@push('scripts')
<script>
  let msnry = new Masonry('.testimonials-grid', {
        columnWidth: '.grid-sizer',
        itemSelector: '.testimonial-item',
        percentPosition: true,
        gutter: 20
    });

    const testiomnialsgrid = document.querySelector('.testimonials-grid');

    testiomnialsgrid.onclick = e => {
        for (let i = 1; i < testiomnialsgrid.children.length; i++) {
          testiomnialsgrid && testiomnialsgrid.children[i].classList.remove('is-active');
        }
        e.target.parentNode.parentNode.parentNode.classList.add('is-active');
    }

    let testimonialRatingBlocks = document.querySelectorAll('#rater');

    let ratingOptions = [];

    testimonialRatingBlocks.forEach(element => {
      let rating = element.dataset.rating;

      ratingOptions.push({"rating": rating, "maxRating":"5", "readOnly":"yes", "starImage":"/images/star.png", "emptyStarImage":"/images/starbackground.png", "starSize":"18", "step":"1"});
    });

    rateSystem("ratingValue", ratingOptions);

</script>
@endpush