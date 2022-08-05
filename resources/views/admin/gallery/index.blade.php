@extends('admin.layouts.base')

@section('title', 'Наши работы')

@section('content')
<x-aside />
<div class="content p-5 w-screen overflow-auto">
	<x-page.header>
		<x-page.title title="Наши работы" icon="collection-text">
			<x-slot name="subtitle">{{ Breadcrumbs::render('admin.galleries') }}</x-slot>
		</x-page.title>
		<div class="buttons my-5 sm:my-0 w-full sm:w-fit flex flex-wrap">
			<x-button text="Добавить марку" icon="collection-add"
				class="create-brand-btn bg-red-200 hover:bg-red-500 hover:text-white w-full sm:w-fit my-2 sm:my-0"
				data-bs-toggle="modal" data-bs-target="#createBrand" />
			<x-button text="Добавить модель" icon="collection-add"
				class="create-model-btn bg-red-200 hover:bg-red-500 hover:text-white w-full sm:w-fit sm:ml-2"
				data-bs-toggle="modal" data-bs-target="#createBrand" />
		</div>
	</x-page.header>

	@if (session()->has('success'))
	<div class="bg-green-100 rounded-lg py-4 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
		<i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i>
		<span class="align-middle">{{ session()->get('success') }}</span>
	</div>
	@endif

	<div class="page-body h-full">
		<div class="gallery-grid 2xl:container 2xl:mx-auto grid xl:grid-cols-3 gap-1">
			@for ($i = 0; $i < 5; $i++) <div
				class="gallery-item cursor-pointer rounded flex max-w-full relative flex-wrap sm:flex-nowrap border h-[250px] bg-white">
				<div class="brand z-20 h-full bg-white">
					{{-- <img src="/images/autovaz.png" class="object-cover h-full w-full" alt="Лого бренда"> --}}
					{{-- <img src="/images/cadillac.png" class="h-full mx-auto" alt="Лого бренда"> --}}
					<img src="/images/audi.png" class="w-full object-cover" alt="Лого бренда">
				</div>
				<div class="models h-full w-full absolute left-0 top-0">
					<ul class="flex flex-wrap h-fit mr-10">
						<li><a href="#"
								class="m-1 block bg-blue-500 text-white font-semibold px-5 py-2 tracking-wide rounded">Outlander II</a>
						</li>
						<li><a href="#"
								class="m-1 block bg-blue-500 text-white font-semibold px-5 py-2 tracking-wide rounded">XRay</a></li>
						<li><a href="#" class="m-1 block bg-blue-500 text-white font-semibold px-5 py-2 tracking-wide rounded">LC
								PRADO</a></li>
						<li><a href="#"
								class="m-1 block bg-blue-500 text-white font-semibold px-5 py-2 tracking-wide rounded">Octavia Tour</a>
						</li>
					</ul>
					<button type="button" class="open-models-btn rounded-tr rounded-br absolute top-0 right-0 h-full w-7 bg-slate-500">
						<i class="zmdi zmdi-chevron-right text-3xl"></i>
					</button>
				</div>
		</div>
		@endfor
	</div>
</div>

<div class="modals">
	<!-- Modal -->
	<x-modal id="createBrand" title="Добавление бренда автомобиля">
		<x-form method="POST" action="{{ route('admin.brand.store') }}" class="create-brand-form" multipart>
			<div class="form-inner flex flex-wrap">
				<div
					class="logo-drop-area relative flex flex-col justify-center items-center mx-auto border border-neutral-400 rounded min-w-[200px] min-h-[200px] max-h-[250px] w-full">
					<div class="content flex flex-col py-3 justify-center items-center text-center">
						<i class="zmdi zmdi-cloud text-5xl mb-2"></i>
						<p class="drop-area__header px-6">Перетащите файл в эту область</p>
					</div>
				</div>
				<div class="w-full">
					<x-form.input type="text" name="name" value="{{ old('title') }}" label="{{ __('Заголовок') }}"
						placeholder="{{ __('Введите название') }}" class="brand-name-input min-w-[300px]" required />
				</div>
			</div>
			<div class="flex justify-end w-full mt-6">
				<x-button type="submit" text="Сохранить" icon="card-sd"
					class="submit-btn bg-violet-300 hover:bg-violet-600 hover:text-white py-2" />
			</div>
		</x-form>
	</x-modal>
</div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
@endpush

@push('scripts')
<script>
	let validFileExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
	let drp_area = document.querySelector('.logo-drop-area');
	let drp_area_input = drp_area.querySelector(".drop-area__input");
	let frm_brand_create = document.querySelector(".create-brand-form");
	let frm_brand_btn = document.querySelector('.create-brand-btn');
	let frm_submit_btn = frm_brand_create.querySelector('.submit-btn');
	let modal = document.querySelector(frm_brand_btn.getAttribute('data-bs-target'));
	let modal_close_btn = modal.querySelector('.close-btn');
	let drp_initialHTML = `<div class="content flex flex-col py-3 justify-center items-center text-gray-500 text-center">
	<i class="zmdi zmdi-cloud text-5xl mb-2"></i>
	<p class="drop-area__header px-6">Перетащите файл в эту область</p>
  </div>`;

	if (frm_brand_btn) {
		frm_brand_btn.addEventListener('click', () => {
			modal.classList.remove('hidden');
			modal.setAttribute('role', 'dialog');
		})

		modal_close_btn.addEventListener('click', () => {
			modal.classList.add('hidden');
			modal.removeAttribute('role');
			drp_area.innerHTML = drp_initialHTML;
			frm_brand_create.reset();
		})
	}

	let file;

	frm_submit_btn.onclick = e => {
		e.preventDefault();
		let data = new FormData();
		data.append('name', frm_brand_create.querySelector('.brand-name-input').value);
		data.append('logotype', file);
		axios.post("{{route('galleries.store')}}", data);
	}

	drp_area.addEventListener('dragover', (e) => {
		e.preventDefault();
		drp_area.classList.add('active');
	})
	drp_area.addEventListener('dragleave', () => {
		drp_area.classList.remove('active');
	})
	drp_area.addEventListener('drop', (e) => {
		e.preventDefault();
		drp_area.classList.remove('active');
		file = e.dataTransfer.files[0];
		showImage();
	})

	function showImage() {
		let fileType = file.type;
		if (!validFileExtensions.includes(fileType)) {
			console.log('This is not an image!')
		} else {
			let fileReader = new FileReader();
			fileReader.onload = () => {
				let fileURL = fileReader.result;
				drp_area.innerHTML = `<img src="${fileURL}" class="logo-preview mx-auto h-full" alt="Лого"/>`;
			}
			fileReader.readAsDataURL(file);
		}
	}

	const gallerygrid = document.querySelector('.open-models-btn');
	gallerygrid.onclick = e => {
		let nodes = Array.prototype.slice.call(gallerygrid.children );
    for (let i = 0; i < gallerygrid.children.length; i++) {
      gallerygrid.children[i].classList.remove('active');
    }
		e.target.parentNode.parentNode.classList.toggle('active')
  }
</script>
@endpush

@push('scripts')
<script>
	// Dropzone.autoDiscover = false;
	// let myDropzone = new Dropzone("div#drop-zone", {
	// 	url: "/galleries/store",
	// 	autoProcessQueue: false,
	// 	addRemoveLinks: true,
	// 	acceptedFiles: ".jpeg,.jpg,.png,.gif",
	// 	uploadMultiple: true,
	// 	parallelUploads: 100,
	// 	maxFiles: 100,
	// });

	// let form = document.querySelector('.upload-form');

	// form.querySelector("button[type=submit]").addEventListener("click", function(e) {
	// 	e.preventDefault();
	// 	e.stopPropagation();
	// 	let formData = new FormData();
	// 	let files = myDropzone.getAcceptedFiles();
	// 	files.forEach(file => {
	// 		formData.append('images[]', file);
	// 	})
	// 	formData.append('title', form.children['username'].value);
	// 	axios.post('{{route("galleries.store")}}', formData);
	// });
</script>
@endpush