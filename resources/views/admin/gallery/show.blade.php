@extends('admin.layouts.base')

@section('title', 'Наши работы')

@section('content')
<x-aside />
<div class="content p-5 w-screen overflow-auto">
    <x-page.header>
        <x-page.title title="Галерея изображений «{{$brand->name . ' ' . $model->name}}»" icon="collection-image">
            <x-slot name="subtitle">{{ Breadcrumbs::render('admin.galleries.show', $model, $brand) }}</x-slot>
        </x-page.title>
    </x-page.header>

    @if (session()->has('success'))
    <div class="bg-green-100 rounded-lg py-4 px-6 text-base text-green-700 mb-3" role="alert">
        <i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i>
        <span class="align-middle">{{ session()->get('success') }}</span>
    </div>
    @endif
    <div class="pswp-gallery pswp-gallery--single-column" id="model-gallery">
        <div class="images-gallery-grid 2xl:container 2xl:mx-auto">
            <div class="grid-sizer xl:w-[32%] md:w-[48%]"></div>
            @foreach ($model->images as $image)
            <div class="grid-item xl:w-[32%] md:w-[48%] mb-3">
                <a href="/storage/{{$image->image}}"
                    data-pswp-width="{{getimagesize(public_path('/storage/' . $image->image))[0]}}"
                    data-pswp-height="{{getimagesize(public_path('/storage/' . $image->image))[1]}}" target="_blank">
                    <img src="/storage/{{$image->image}}" class="rounded" alt="{{$model->name}}">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.2.2/photoswipe.min.css">
@endpush

@push('scripts')
<script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
</script>
@endpush

@push('scripts')
<script type="module">
    import PhotoSwipeLightbox from "https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.2.2/photoswipe-lightbox.esm.min.js";
    let imagesGrid = document.querySelector('.images-gallery-grid');
        new imagesLoaded(imagesGrid, () => {
            let msnry = new Masonry(imagesGrid, {
                columnWidth: '.grid-sizer',
                itemSelector: '.grid-item',
                percentPosition: true,
                gutter: 15
            });

            const lightbox = new PhotoSwipeLightbox({
            gallery: '#model-gallery',
            children: 'a',
            pswpModule: () => import("https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.2.2/photoswipe.esm.min.js")
            });
            lightbox.init();
        });
</script>
@endpush