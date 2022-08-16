@extends('admin.layouts.base')

@section('title', 'Сертификаты компании')

@section('content')
<x-aside />
<div class="content p-5 w-screen overflow-auto">
  <x-page.header>
    <x-page.title title="Сертификаты компании" icon="view-carousel">
      <x-slot name="subtitle">{{ Breadcrumbs::render('admin.certificates') }}</x-slot>
    </x-page.title>
  </x-page.header>

  @if (session()->has('success'))
  <div class="bg-green-100 rounded-lg py-4 px-6 text-base text-green-700 mb-3" role="alert">
    <i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i>
    <span class="align-middle">{{ session()->get('success') }}</span>
  </div>
  @endif

  <div class="cert-wrapper relative min-h-[400px]">
    <div class="pswp-gallery pswp-gallery--single-column min-h-[400px]" id="certificates-gallery">
      <div class="cert-gallery-grid min-h-[400px] 2xl:container 2xl:mx-auto">
        <div class="grid-sizer xl:w-[32%] md:w-[48%]"></div>
        @if($certificates->count() == 0)
        <div
          class="empty-box pointer-events-none absolute select-none inset-0 text-center text-slate-500 flex flex-col justify-center items-center min-h-[400px]">
          <i class="zmdi zmdi-inbox text-6xl"></i>
          <p class="font-bold">Нет данных для отображения</p>
        </div>
        @else
        @foreach ($certificates as $certificate)
        <div class="grid-item relative xl:w-[32%] md:w-[48%] mb-3">
          <a href="/storage/{{$certificate->image}}" class="image-link"
            data-pswp-width="{{getimagesize(public_path('/storage/' . $certificate->image))[0]}}"
            data-pswp-height="{{getimagesize(public_path('/storage/' . $certificate->image))[1]}}" target="_blank">
            <img src="/storage/{{$certificate->image}}" class="rounded image-link shadow-md"
              alt="Сертификат компании SuperAutoGas">
            <div class="absolute top-2 right-2 pointer-events-auto">
              <x-form method="DELETE" name='cert-form-del'
                action="{{ route('admin.certificates.destroy', ['certificate' => $certificate->id]) }}">
                <x-button type="submit" icon="delete"
                  class="delete-image-link text-red-800 bg-red-300 hover:bg-red-600 hover:text-white px-4 py-1.5 text-xl" />
              </x-form>
            </div>
          </a>
        </div>
        @endforeach
        @endif
      </div>
    </div>
    <div class="dz-wrapper bg-white z-10 absolute inset-0 px-4 flex flex-col h-[450px] opacity-0" style="">
      <x-dropzone label="Загрузка сертификатов компаниии" name="image" id="certDropZone" required />
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
    let imagesGrid = document.querySelector('.cert-gallery-grid');
        new imagesLoaded(imagesGrid, () => {
            let msnry = new Masonry(imagesGrid, {
                columnWidth: '.grid-sizer',
                itemSelector: '.grid-item',
                percentPosition: true,
                gutter: 15
            });

            const lightbox = new PhotoSwipeLightbox({
            gallery: '#certificates-gallery',
            children: 'a',
            pswpModule: () => import("https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.2.2/photoswipe.esm.min.js")
            });
            lightbox.init();
        });
</script>
@endpush

@push('scripts')
<script>
  Dropzone.autoDiscover = false;
	let myDropzone = new Dropzone("div#certDropZone", {
		url: "{{route('admin.certificates.store')}}",
		autoProcessQueue: true,
		acceptedFiles: ".jpeg,.jpg,.png",
		uploadMultiple: true,
		parallelUploads: 100,
		maxFiles: 25,
		addRemoveLinks: false,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    init: function () {
      this.on("queuecomplete", function (file) {
          window.location.reload(true);
      });
    }
	});

  let wrapper = document.querySelector('.cert-wrapper');
  let dZone = document.querySelector('.dz-wrapper');

  wrapper.addEventListener('dragover', (e) => {
    e.preventDefault();
    dZone.classList.add('active');
  })

  wrapper.addEventListener('dragleave', (e) => {
    e.preventDefault();
    if(!e.target.classList.contains('cert-gallery-grid') && !e.target.classList.contains('dropzone') && !e.target.classList.contains('image-link')) dZone.classList.remove('active');
  })

  let imageLinks = document.querySelectorAll('.image-link');

  imageLinks.forEach(link => {
      link.addEventListener('click', e => {
        if(e.target.classList.contains('delete-image-link')) {
          e.preventDefault();
          e.stopPropagation();
          document.forms['cert-form-del'].submit();
        }
      })
  });
</script>
@endpush