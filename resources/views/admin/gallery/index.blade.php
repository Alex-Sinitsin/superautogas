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
				data-bs-toggle="modal" data-target="#createBrand" />
			<x-button text="Добавить модель" icon="collection-add"
				class="create-model-btn bg-red-200 hover:bg-red-500 hover:text-white w-full sm:w-fit sm:ml-2"
				data-bs-toggle="modal" data-target="#createModel" />
		</div>
	</x-page.header>

	<div class="alerts">
		@if (session()->has('success'))
		<div class="bg-green-100 rounded-lg py-4 px-6 mb-4 text-base text-green-700" role="alert">
			<i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i>
			<span class="align-middle">{{ session()->get('success') }}</span>
		</div>
		@endif
	</div>

	<div class="page-body relative">
		<div class="gallery-grid 2xl:container 2xl:mx-auto">
			<div class="grid-sizer"></div>
			@foreach ($brands as $brand)
			<x-gallery.item data-id="{{$brand->id}}">
				<x-slot:logotype>
					<div class="brand min-w-[200px] w-full min-h-[200px] p-3 rounded-md flex justify-center
						items-center shadow-lg bg-slate-100 relative">
						<img src="/storage/{{$brand->logotype}}" class="h-auto w-full xl:w-2/3 xl:mx-auto" alt="Логотип бренда">
						<x-button type="button" color="amber" icon="edit"
							class="edit-link absolute h-fit top-2 right-16 bg-amber-300 hover:bg-amber-400" data-id="{{$brand->id}}"
							data-name="{{$brand->name}}" data-active="{{$brand->is_active}}" data-logotype="{{$brand->logotype}}" />
						<a href="#">
							<x-button type="button" color="red" icon="delete"
								class="delete-link absolute h-fit top-2 right-3 px-[1.1rem] bg-red-300 hover:bg-red-400"
								data-id="{{$brand->id}}" data-name="{{$brand->name}}" />
						</a>
						@if($brand->is_active)
						<span
							class="absolute left-2 bottom-2 text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-600 text-white rounded">Опубликован</span>
						@else
						<span
							class="absolute left-2 bottom-2 text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-300 text-gray-800 rounded">Скрыт</span>
						@endif
					</div>
				</x-slot:logotype>
				@if($brand->models->count() == 0)
				<div class="empty-box absolute inset-0 text-center text-slate-500 flex flex-col justify-center items-center">
					<i class="zmdi zmdi-inbox text-6xl"></i>
					<p class="font-bold">Нет моделей</p>
				</div>
				@else
				<ul class="models-list flex w-full flex-wrap mr-10 px-2">
					@foreach ($brand->models as $model)
					<li class="flex-1 text-center relative">
						<a href="{{route('galleries.show', ['gallery' => $model->slug])}}"
							class="model-link m-1 block bg-neutral-600 hover:bg-neutral-700 transition-colors text-white font-semibold px-5 py-2.5 tracking-wide rounded cursor-pointer"
							data-id="{{$model->id}}">
							<span class="">{{$model->name}}</span>
							<div class="actions max-h-0 overflow-hidden flex items-center justify-center">
								<span class="w-10 cursor-pointer text-amber-900 bg-amber-300 hover:bg-amber-400 py-1 rounded"
									data-parent="{{$brand}}" data-id="{{$model->id}}" data-name="{{$model->name}}"
									data-images="{{$model->images}}" id="edit-link">
									<i class="zmdi zmdi-edit pointer-events-none"></i>
								</span>
								<span id="delete-link" data-name="{{$brand->name . ' ' . $model->name}}" data-id="{{$model->id}}"
									class="w-10 text-red-900 cursor-pointer bg-red-300 hover:bg-red-400 py-1 ml-1 rounded">
									<i class="zmdi zmdi-delete pointer-events-none"></i>
								</span>
							</div>
						</a>
					</li>
					@endforeach
				</ul>
				@endif
			</x-gallery.item>
			@endforeach
		</div>
		<div class="pagination-links my-5">
			{{ $brands->links() }}
		</div>
	</div>
</div>

<div class="modals">
	<!-- Modal -->
	<x-modal id="createBrand" title="Добавление бренда автомобиля">
		<x-form method="POST" action="{{ route('admin.brands.store') }}" class="create-brand-form" multipart>
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
					<x-form.input type="text" name="name" label="Заголовок" placeholder="{{ __('Введите название') }}"
						class="brand-name-input min-w-[300px] mb-2" required />
					<span class="modal-error-name my-2 text-red-600 hidden"></span>
				</div>
			</div>
			<x-form.checkbox name="is_active" label="Опубликовать" class="is_active_checkbox" onchange="changeState()"
				checked />
			<div class="flex justify-end w-full mt-6">
				<x-button type="submit" text="Сохранить" icon="card-sd"
					class="submit-btn bg-violet-300 hover:bg-violet-600 hover:text-white py-2" />
			</div>
		</x-form>
	</x-modal>

	<!-- Modal -->
	<x-modal id="createModel" title="Добавление модели автомобиля">
		<x-form name="createModelForm" method="POST" action="{{ route('galleries.store') }}" class="create-model-form"
			multipart>
			<div class="form-inner flex flex-wrap">
				<div class="form-item w-full mb-2">
					<x-form.select name="parent" placeholder="Выберите родительскую группу" label="Родительская группа"
						class="mb-2" required>
						@foreach ($brandsForSelect as $brand)
						<option class="option" value="{{$brand->id}}" label="{{$brand->name}}"
							image='/storage/{{$brand->logotype}}'>
							{{$brand->name}}
						</option>
						@endforeach
					</x-form.select>
					<span class="modal-error-parent my-2 text-red-600 hidden"></span>
				</div>
				<div class="form-item w-full">
					<x-form.input type="text" name="name" label="Название" placeholder="{{ __('Введите название') }}"
						class="brand-name-input min-w-[300px] mb-2" required />
					<span class="modal-error-name my-2 text-red-600 hidden"></span>
				</div>

				<div class="serverImages w-full">
					<div class="title">
						<p class="block text-gray-500 font-bold my-3">Изображения на сервере</p>
					</div>
					<div class="inner grid grid-cols-4 gap-1"></div>
				</div>

				<x-dropzone label="Изображения для галереи" name="images" id="dropZone" required />

				<div class="flex justify-end w-full mt-3">
					<x-button type="submit" text="Сохранить" icon="card-sd"
						class="submit-btn bg-violet-300 hover:bg-violet-600 hover:text-white py-2" />
				</div>
			</div>
		</x-form>
	</x-modal>
</div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endpush

@push('scripts')
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
@endpush

@push('scripts')
<script>
	// Upload files
	let file;
	let validFileExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml', 'image/svg'];
	let editModelMode = false;
	let deleteImageMode = false;
	let editBrandMode = false;
	// Create Brand Modal
	let frm_brand_btn = document.querySelector('.create-brand-btn');
	let modalCreateBrand = document.querySelector(frm_brand_btn.getAttribute('data-target'));
	let drp_area = document.querySelector('.logo-drop-area');
	let drp_area_input = drp_area.querySelector(".drop-area__input");
	let drp_area_btn = drp_area.querySelector(".browse");
	let frm_brand_create = document.querySelector(".create-brand-form");
	let frm_brand_submit_btn = frm_brand_create.querySelector('.submit-btn');
	let frm_brand_edit_links = document.querySelectorAll('.gallery-item .brand .edit-link'); 
	let frm_brand_delete_links = document.querySelectorAll('.gallery-item .brand .delete-link'); 
	let modal_brand_close_btn = modalCreateBrand.querySelector('.close-btn');
	// Create Model Modal
	let frm_model_btn = document.querySelector('.create-model-btn');
	let modalCreateModel = document.querySelector(frm_model_btn.getAttribute('data-target'));
	let frm_model_create = document.querySelector(".create-model-form");
	let modal_model_close_btn = modalCreateModel.querySelector('.close-btn');
	let frm_model_edit_links = document.querySelectorAll('.gallery-item .actions .edit-link'); 
	let frm_model_links = document.querySelectorAll('.gallery-item .model-link'); 

	function changeState() {
		let checkbox = document.querySelector('#createBrand #form__chk');
		checkbox.toggleAttribute('checked');
	}

	async function loadSingleFile(url = '') {
		file = await fetch(url)
		.then(r => r.blob())
		.then(blobImage => validFileExtensions.includes(blobImage.type) ? new File([blobImage], `image_` + Math.random() * 100 + '.' + blobImage.type.split('/').pop().toLowerCase() , { type: blobImage.type.toLowerCase()}) : null);
		showImage();
	}

	window.addEventListener("load", function() {
		let alertsDiv = document.querySelector('.alerts');
		editModelMode = false;
		deleteImageMode = false;
		editBrandMode = false;
		showAlert('Бренд автомобиля успешно добавлен!', 'bcSuccess', 'bcSuccess');
		showAlert('Бренд автомобиля успешно обновлен!', 'buSuccess', 'buSuccess');
		showAlert('Бренд автомобиля успешно удален!', 'bdSuccess', 'bdSuccess');
		showAlert('Модель автомобиля успешно добавлена!', 'mcSuccess', 'mcSuccess');
		showAlert('Модель автомобиля успешно обновлена!', 'muSuccess', 'muSuccess');
		showAlert('Модель автомобиля успешно удалена!', 'mdSuccess', 'mdSuccess');
	});

	function showAlert(message, itemClass, storageItemName) {
		let alertsDiv = document.querySelector('.alerts');
		if(localStorage.getItem(storageItemName) == 'true') {
			if(alertsDiv) {
				alertsDiv.insertAdjacentHTML('afterbegin', `<div class="${itemClass} bg-green-100 rounded-lg py-4 px-6 mb-4 text-base text-green-700" role="alert"> <i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i><span class="align-middle">${message}</span></div>`);
				localStorage.setItem(storageItemName, false);
			}
			let elem = document.querySelector(`.${itemClass}`);
			if(elem) setTimeout(() => alertsDiv.removeChild(elem), 7000);
		}
	}

	function resetValidationErrors(modalID) {
		if(modalID == '#createBrand') {
			document.querySelector(`#createBrand .modal-error-name`).classList.add('hidden');
			document.querySelector(`#createBrand .modal-error-logotype`).classList.add('hidden');
		}
		if(modalID == '#createModel') {
			document.querySelector(`#createModel .modal-error-images`).classList.add('hidden');
			document.querySelector(`#createModel .modal-error-parent`).classList.add('hidden');
			document.querySelector(`#createModel .modal-error-name`).classList.add('hidden');
		}
	}

	function showValidationErrors(messages, modalID) {
		if(messages.name) {
			document.querySelector(`${modalID} .modal-error-name`).innerText = messages.name[0];
			document.querySelector(`${modalID} .modal-error-name`).classList.remove('hidden');
		}
		if(messages.logotype) {
			document.querySelector(`${modalID} .modal-error-logotype`).classList.remove('hidden');
			document.querySelector(`${modalID} .modal-error-logotype`).innerText = messages.logotype[0];
		}
		if(messages.images) {
			document.querySelector(`${modalID} .modal-error-images`).classList.remove('hidden');
			document.querySelector(`${modalID} .modal-error-images`).innerText = messages.images[0];
		}
		if(messages.parent) {
			document.querySelector(`${modalID} .modal-error-parent`).classList.remove('hidden');
			document.querySelector(`${modalID} .modal-error-parent`).innerText = messages.parent[0];
		}
	}

	function openCreateModel() {
		modalCreateModel.classList.remove('hidden');
		modalCreateModel.setAttribute('role', 'dialog');
	}

	function closeCreateModel() {
		let modal_title = document.querySelector('#createModel .modal-header').getElementsByTagName('h5')[0];
		let serverImagesDiv = document.querySelector('.serverImages .inner');
		modal_title.innerText = 'Добавление модели автомобиля';
		modalCreateModel.classList.add('hidden');
		modalCreateModel.removeAttribute('role');
		if(myDropzone) myDropzone.removeAllFiles();
		resetSelect('parent');
		resetValidationErrors('#createModel');
		serverImagesDiv.innerHTML = '';
		frm_model_create.reset();
		if(deleteImageMode) window.location.reload(true);
	}

	function closeBrandModal() {
			let modal_title = document.querySelector('#createBrand .modal-header').getElementsByTagName('h5')[0];
			modal_title.innerText = 'Добавление бренда автомобиля';
			modalCreateBrand.classList.add('hidden');
			modalCreateBrand.removeAttribute('role');
			drp_area.querySelector('.image').innerHTML = '';
			drp_area.querySelector('.image').classList.remove('bg-white');
			resetValidationErrors('#createBrand');
			editBrandMode = false;
			frm_brand_create.reset();
	}

	function openCreateBrand() {
		modalCreateBrand.classList.remove('hidden');
		modalCreateBrand.setAttribute('role', 'dialog');
	}

	if (frm_brand_btn) {
		frm_brand_btn.addEventListener('click', () => {
			openCreateBrand();
		})

		modal_brand_close_btn.addEventListener('click', () => {
			closeBrandModal();
		})
	}

	if (frm_model_btn) {
		frm_model_btn.addEventListener('click', () => {
			openCreateModel();
		})

		modal_model_close_btn.addEventListener('click', () => {
			closeCreateModel();
		})
	}

	if(!editBrandMode) {
		frm_brand_create.onsubmit = e => {
			e.preventDefault();
			let data = new FormData(frm_brand_create);
			file ? data.append('logotype', file) : null;

			frm_brand_create.querySelector('.submit-btn').setAttribute('disabled', '');

			resetValidationErrors('#createBrand');
		
			axios.post("{{route('admin.brands.store')}}", data)
			.then(response => {
				if(response.status == 200) {
					localStorage.bcSuccess = true;
					closeBrandModal();
					frm_brand_create.querySelector('.submit-btn').removeAttribute('disabled');
					window.location.reload(true);
				}
			})
			.catch(function (error) {
				if (error.response) {
					frm_brand_create.querySelector('.submit-btn').removeAttribute('disabled');
					if(error.response.status == 422) {
						showValidationErrors(error.response.data.errors, '#createBrand');
					}
				}
			});
		}
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
	function loadFiles(image) {
		let serverImagesDiv = document.querySelector('.serverImages .inner');
		let imageName = image.image.split('/').pop().toLowerCase();
		let imageType = 'image/' + imageName.split('.').pop().toLowerCase();

		fetch(`/storage/${image.image}`)
		.then(r => r.blob())
		.then(blobImage => {
			let imgFile = validFileExtensions.includes(imageType) ? new File([blobImage], imageName , {type: imageType}) : null;

			let fileReader = new FileReader();
				fileReader.onload = () => {
					let fileURL = fileReader.result;
					serverImagesDiv.insertAdjacentHTML('beforeend', `<div class='image-preview w-[130px] h-[100px] m-2 relative'><img src='${fileURL}'class='rounded w-full h-full' data-id='${image.id}' alt='${imageName}' /><x-button data-id='${image.id}' type="button" icon="close" color='red' class="delete-link block w-full h-fit py-1 text-xl text-center bg-red-200 hover:bg-red-400 hover:text-white absolute left-0 bottom-0" onclick='deleteModelImage(${image.id})' /></div>`);
				}
				fileReader.readAsDataURL(imgFile);
			})
	}
	
	function deleteModelImage(id) {
		let serverImagesDiv = document.querySelector('.serverImages .inner');
		let _url = "{{route('galleries.destroy', ['gallery' => 'imageId'])}}";
		let urlDelete = _url.replace('imageId', id);
		deleteImageMode = true;

		axios.delete(urlDelete)
			.then(response => {
				if(response.status == 200) {
					let images = document.querySelectorAll('.image-preview').forEach(preview => {
						let image = preview.getElementsByTagName(`img`)[0];
						image.dataset.id == id ? serverImagesDiv.removeChild(image.parentNode) : null;
					});
				}
			})
			.catch(function (error) {
				let images = document.querySelectorAll('.image-preview').forEach(preview => {
					let image = preview.getElementsByTagName(`img`)[0];
					if(image.dataset.id == id) {
						serverImagesDiv.removeChild(image.parentNode);
						if (index > -1) {
							array.splice(index, 1);
						}
					}
				});
				console.error(error);
			});
	}

	Dropzone.autoDiscover = false;
	let myDropzone = new Dropzone("div#dropZone", {
		url: "/galleries/store",
		autoProcessQueue: false,
		acceptedFiles: ".jpeg,.jpg,.png,.gif,.svg",
		uploadMultiple: true,
		parallelUploads: 100,
		maxFiles: 25,
		addRemoveLinks: true,
	});

	if(!editModelMode) {
		frm_model_create.addEventListener('submit', e => {
			e.preventDefault();
			let data = new FormData(frm_model_create);
			let files = myDropzone.getAcceptedFiles();
			files.forEach(file => {
				data.append('images[]', file);
			})

			frm_model_create.querySelector('.submit-btn').setAttribute('disabled', '');

			axios.post('{{route("galleries.store")}}', data)
				.then(response => {
					if(response.status == 200) {
						localStorage.mcSuccess = true;
						frm_model_create.querySelector('.submit-btn').removeAttribute('disabled');
						closeCreateModel();
						window.location.reload(true);
					}
				})
				.catch(function (error) {
					if (error.response) {
						frm_model_create.querySelector('.submit-btn').removeAttribute('disabled');
						if(error.response.status == 422) {
							showValidationErrors(error.response.data.errors, '#createModel');
						}
					}
				});
		});	
	}

	frm_model_links.forEach(link => {
		link.onclick = e => {
			if(e.target.id == 'edit-link') {
				e.preventDefault();
				const editLink = e.target;
				let modal_title = document.querySelector('#createModel .modal-header').getElementsByTagName('h5')[0];
				let select = document.querySelector(`#parent`);
				let span = document.querySelector('#createModel div.header').getElementsByTagName('span')[0];
				let img = document.querySelector('#createModel div.header').getElementsByTagName('img')[0];
				let option = document.querySelector(`#createModel .option[data-value="${editLink.dataset.parentId}"]`);
				let parentData = JSON.parse(editLink.dataset.parent);
				let modelImages = JSON.parse(editLink.dataset.images);
				modal_title.innerText = `Редактирование модели №${editLink.dataset.id}`;
				select.value = parentData.id;
				span.innerText = parentData.name;
				img.src = '/storage/' + parentData.logotype;
				frm_model_create.querySelector('#name').value = editLink.dataset.name;
				editModelMode = true;

				if(editModelMode) modelImages.forEach(image => loadFiles(image));

				openCreateModel();

				if(editModelMode) {
					frm_model_create.addEventListener('submit', e => {
						e.preventDefault();
						let data = new FormData(frm_model_create);

						let files = myDropzone.getAcceptedFiles();
						
						if(files.length > 0) {
							files.forEach(file => {
								data.append('images[]', file);
							})
						} else {
							data.append('images[]', []);
						}

						resetValidationErrors('#createModel');

						frm_model_create.querySelector('.submit-btn').setAttribute('disabled', '');
						
						let _url = "{{route('admin.models.update', ['gallery' => 'modelId'])}}";
						let urlUpdate = _url.replace('modelId', editLink.dataset.id);

						axios.post(urlUpdate, data)
							.then(response => {
								if(response.status == 200) {
									localStorage.muSuccess = true;
									closeCreateModel();
									frm_model_create.querySelector('.submit-btn').removeAttribute('disabled');
									window.location.reload(true);
								}
							})
							.catch(function (error) {
								if (error.response) {
									frm_model_create.querySelector('.submit-btn').removeAttribute('disabled');
									if(error.response.status == 422) {
										showValidationErrors(error.response.data.errors, '#createModel');
									}
								}
							});
					});
				}
			}

			if(e.target.id == 'delete-link') {
				e.preventDefault();
				let modelId = e.target.dataset.id;
				let modelName = e.target.dataset.name;

				let _url = "{{route('admin.models.delete', ['gallery' => 'modelId'])}}";
				let urlDelete = _url.replace('modelId', modelId);

				Confirm.open({
					title: "Подтверждение",
					body: `Вы действительно хотите удалить модель ${modelName} из галереи?`,
					okText: "Да",
					cancelText: "Нет",
					onOk: () => {
						axios.delete(urlDelete)
							.then(response => {
								if(response.status == 200) {
									localStorage.mdSuccess = true;
									window.location.reload(true);
								}
							})
							.catch(function (error) {});
					},
					onCancel: () => {},
				});

			}
		}
	});

	frm_brand_edit_links.forEach(link => {
		link.onclick = e => {
			let modal_title = document.querySelector('#createBrand .modal-header').getElementsByTagName('h5')[0];
			let checkbox = document.querySelector('#createBrand #form__chk')
			let brandId = e.target.dataset.id;
			let name = e.target.dataset.name;
			let logotype = e.target.dataset.logotype;
			editBrandMode = true;

			let _url = "{{route('admin.brands.update', ['gallery' => 'brandId'])}}";
			let _urlUpdate = _url.replace('brandId', e.target.dataset.id);

			loadSingleFile(`/storage/${logotype}`);
			frm_brand_create.querySelector('#name').value = name;

			e.target.dataset.active == true ? checkbox.checked = true : checkbox.removeAttribute('checked')

			openCreateBrand();
			
			modal_title.innerText = `Редактирование бренда №${e.target.dataset.id}`;

			frm_brand_create.onsubmit = function(e) {
				e.preventDefault();
				let data = new FormData(frm_brand_create);
				file ? data.append('logotype', file) : null;
				data.append('id', brandId);
				
				resetValidationErrors('#createBrand');

				axios.post(_urlUpdate, data)
					.then(response => {
						if(response.status == 200) {
							localStorage.buSuccess = true;
							closeBrandModal();
							frm_brand_create.querySelector('.submit-btn').removeAttribute('disabled');
							window.location.reload(true);
						}
					})
					.catch(function (error) {
						if (error.response) {
							frm_brand_create.querySelector('.submit-btn').removeAttribute('disabled');
							if(error.response.status == 422) {
								showValidationErrors(error.response.data.errors, '#createModel');
							}
						}
				});
			}
		}
	})

	frm_brand_delete_links.forEach(link => {
		link.addEventListener('click', e => {
			let target = e.target;
			let brandId = target.dataset.id;
			let brandName = target.dataset.name;

				let _url = "{{route('admin.brands.delete', ['gallery' => 'brandId'])}}";
				let urlDelete = _url.replace('brandId', brandId);

				Confirm.open({
					title: "Подтверждение",
					body: `Вы действительно хотите удалить бренд ${brandName} из галереи? Все модели автомобилей, связанные с брендом, а также изображения галереи будут удалены!`,
					okText: "Да",
					cancelText: "Нет",
					onOk: () => {
						axios.delete(urlDelete)
							.then(response => {
								if(response.status == 200) {
									localStorage.bdSuccess = true;
									window.location.reload(true);
								}
							})
							.catch(function (error) {});
					},
					onCancel: () => {},
				});
		})
	})
</script>
@endpush