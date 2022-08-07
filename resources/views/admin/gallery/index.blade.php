@extends('admin.layouts.base')

@section('title', 'Наши работы')

@section('content')
<x-aside />
<div class="content p-5 w-screen overflow-auto">
	<x-page.header>
		<x-page.title title="Наши работы" icon="collection-image">
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

	<div class="alerts">
		@if (session()->has('success'))
		<div class="bg-green-100 rounded-lg py-4 px-6 mb-4 text-base text-green-700" role="alert">
			<i class="zmdi zmdi-notifications align-middle text-lg"></i>
			<span class="align-middle">{{ session()->get('success') }}</span>
		</div>
		@endif
	</div>

	<div class="page-body h-full">
		<div class="gallery-grid 2xl:container 2xl:mx-auto">
			<div class="grid-sizer"></div>
			@for ($i = 1; $i <= 5; $i++) <x-gallery.item>
				<x-slot:logotype>
					<div class="brand min-w-[200px] w-full min-h-full p-3 rounded-md flex justify-center
						items-center shadow-lg bg-slate-100 relative">
						<img src="/images/cadillac.png" class="h-auto w-full" alt="Логотип бренда">
						<x-button type="button" color="amber" icon="edit"
							class="absolute h-fit top-2 right-2 bg-amber-300 hover:bg-amber-400" />
					</div>
				</x-slot:logotype>
				<ul class="flex w-full items-center flex-wrap h-full mr-10 px-2">
					<li class="flex-auto text-center relative">
						<a href="#"
							class="m-1 block bg-neutral-600 hover:bg-neutral-700 transition-colors text-white font-semibold px-5 py-2.5 tracking-wide rounded cursor-pointer">
							<span class="">Outlander II</span>
							<div class="actions max-h-0 overflow-hidden flex items-center justify-center">
								<span class="w-10 cursor-pointer text-amber-900 bg-amber-300 hover:bg-amber-400 py-1 rounded"><i
										class="zmdi zmdi-edit"></i></span>
								<span class="w-10 text-red-900 cursor-pointer bg-red-300 hover:bg-red-400 py-1 ml-1 rounded"><i
										class="zmdi zmdi-delete"></i></span>
							</div>
						</a>
					</li>
					<li class="flex-auto text-center relative">
						<a href="#"
							class="m-1 block bg-neutral-600 hover:bg-neutral-700 transition-colors text-white font-semibold px-5 py-2.5 tracking-wide rounded cursor-pointer">
							<span class="">XRay</span>
							<div class="actions max-h-0 overflow-hidden flex items-center justify-center">
								<span class="w-10 cursor-pointer text-amber-900 bg-amber-300 hover:bg-amber-400 py-1 rounded"><i
										class="zmdi zmdi-edit"></i></span>
								<span class="w-10 text-red-900 cursor-pointer bg-red-300 hover:bg-red-400 py-1 ml-1 rounded"><i
										class="zmdi zmdi-delete"></i></span>
							</div>
						</a>
					</li>
					<li class="flex-auto text-center relative">
						<a href="#"
							class="m-1 block bg-neutral-600 hover:bg-neutral-700 transition-colors text-white font-semibold px-5 py-2.5 tracking-wide rounded cursor-pointer">
							<span class="">Evolution</span>
							<div class="actions max-h-0 overflow-hidden flex items-center justify-center">
								<span class="w-10 cursor-pointer text-amber-900 bg-amber-300 hover:bg-amber-400 py-1 rounded"><i
										class="zmdi zmdi-edit"></i></span>
								<span class="w-10 text-red-900 cursor-pointer bg-red-300 hover:bg-red-400 py-1 ml-1 rounded"><i
										class="zmdi zmdi-delete"></i></span>
							</div>
						</a>
					</li>
					<li class="flex-auto text-center relative">
						<a href="#"
							class="m-1 block bg-neutral-600 hover:bg-neutral-700 transition-colors text-white font-semibold px-5 py-2.5 tracking-wide rounded cursor-pointer">
							<span class="">LC Prado </span>
							<div class="actions max-h-0 overflow-hidden flex items-center justify-center">
								<span class="w-10 cursor-pointer text-amber-900 bg-amber-300 hover:bg-amber-400 py-1 rounded"><i
										class="zmdi zmdi-edit"></i></span>
								<span class="w-10 text-red-900 cursor-pointer bg-red-300 hover:bg-red-400 py-1 ml-1 rounded"><i
										class="zmdi zmdi-delete"></i></span>
							</div>
						</a>
					</li>
				</ul>
				</x-gallery.item>
				@endfor
		</div>
	</div>

	<div class="modals">
		<!-- Modal -->
		<x-modal id="createBrand" title="Добавление бренда автомобиля">
			<x-form method="POST" action="{{ route('admin.brand.store') }}" class="create-brand-form" multipart>
				<div class="form-inner flex flex-wrap">
					<div
						class="logo-drop-area flex flex-col relative justify-center items-center mx-auto border border-neutral-400 rounded min-w-[200px] min-h-[200px] max-h-[250px] w-full">
						<div class="image absolute inset-0 pointer-events-none"></div>
						<div class="content flex flex-col py-3 justify-center items-center text-center select-none">
							<i class="zmdi zmdi-cloud text-5xl mb-2"></i>
							<p class="drop-area__header px-6 text-sm">Перетащите файл в эту область</p>
							<span class="drop-area__header px-6 text-sm">или </span>
							<span class="browse block font-bold text-blue-500 hover:text-blue-700 cursor-pointer">Выберите файл</span>
							<input type="file" name="logotype" class="drop-area__input" hidden>
						</div>
					</div>
					<span class="modal-error-logotype my-2 text-red-600 hidden"></span>
					<div class="w-full">
						<x-form.input type="text" name="name" value="{{ old('title') }}" label="{{ __('Заголовок') }}"
							placeholder="{{ __('Введите название') }}" class="brand-name-input min-w-[300px]" required />
						<span class="modal-error-name my-2 block text-red-600 hidden"></span>
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
	let drp_area_btn = drp_area.querySelector(".browse");
	let frm_brand_create = document.querySelector(".create-brand-form");
	let frm_brand_btn = document.querySelector('.create-brand-btn');
	let frm_submit_btn = frm_brand_create.querySelector('.submit-btn');
	let modal = document.querySelector(frm_brand_btn.getAttribute('data-bs-target'));
	let modal_close_btn = modal.querySelector('.close-btn');

	let file;
  
	async function getFile(url = '') {
		file = await fetch(url)
		.then(r => r.blob())
		.then(blobImage => validFileExtensions.includes(blobImage.type) ? new File(blobImage, `image_${Math.rand() * 100}`, { type: blobImage.type}) : null);
		showImage();
	}

	function resetValidationErrors() {
		document.querySelector(`.modal-error-name`).classList.add('hidden');
		document.querySelector(`.modal-error-logotype`).classList.add('hidden');
	}

	function showValidationErrors(messages) {
			if(messages.name) {
				document.querySelector(`.modal-error-name`).classList.remove('hidden');
				document.querySelector(`.modal-error-name`).innerText = messages.name[0];
			} 
			
			if(messages.logotype) {
				document.querySelector(`.modal-error-logotype`).classList.remove('hidden');
				document.querySelector(`.modal-error-logotype`).innerText = messages.logotype[0];
			}
	}

	function closeBrandModal() {
			modal.classList.add('hidden');
			modal.removeAttribute('role');
			drp_area.querySelector('.image').innerHTML = '';
			drp_area.querySelector('.image').classList.remove('bg-white');
			resetValidationErrors();
			frm_brand_create.reset();
	}

	document.addEventListener('click', () => document.querySelector(`.alerts`).innerHTML = '')

	if (frm_brand_btn) {
		frm_brand_btn.addEventListener('click', () => {
			modal.classList.remove('hidden');
			modal.setAttribute('role', 'dialog');
		})

		modal_close_btn.addEventListener('click', () => {
			closeBrandModal();
		})
	}

	frm_submit_btn.onclick = e => {
		e.preventDefault();
		let data = new FormData();
		data.append('name', frm_brand_create.querySelector('.brand-name-input').value);
		file ? data.append('logotype', file) : null;

		resetValidationErrors();
		
		axios.post("{{route('admin.brand.store')}}", data)
			.then(response => {
				if(response.status == 200) {
					let successAlert = `<div class="bg-green-100 rounded-lg py-4 px-6 mb-4 text-base text-green-700" role="alert"> <i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i> <span class="align-middle">${response.data.message}</span></div>`;
					document.querySelector(`.alerts`).innerHTML = successAlert;
					closeBrandModal();
				}
			})
			.catch(function (error) {
				if (error.response) {
					if(error.response.status == 422) {
						showValidationErrors(error.response.data.errors);
					}
				}
			});
	}

	drp_area_btn.addEventListener('click', () => {
		drp_area_input.click();
	})

	drp_area_input.addEventListener('change', () => {
		file = drp_area_input.files[0];
		showImage();
	})

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
		let fileType = file ? file.type : '';
		if (!validFileExtensions.includes(fileType)) {
			console.log('This is not an image!')
		} else {
			let fileReader = new FileReader();
			fileReader.onload = () => {
				let fileURL = fileReader.result;
				drp_area.querySelector('.image').innerHTML = `<img src="${fileURL}" class="logo-preview mx-auto h-full" alt="Лого"/>`;
				drp_area.querySelector('.image').classList.add('bg-white');
			}
			fileReader.readAsDataURL(file);
		}
	}

	let msnry = new Masonry('.gallery-grid', {
		columnWidth: '.grid-sizer',
		itemSelector: '.gallery-item',
		percentPosition: true,
		gutter: 20
	});
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