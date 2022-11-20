@extends('admin.layouts.base')

@section('title', 'Создание новости')

@section('content')
<x-aside class="hidden lg:block" />
<div class="content p-5 w-screen overflow-auto">
    <x-page.header>
        <x-page.title title="Создание новости" icon="collection-add">
            <x-slot name="subtitle">{{ Breadcrumbs::render('admin.post.create') }}</x-slot>
        </x-page.title>
        <div class="buttons">

        </div>
    </x-page.header>
    <div class="create-content w-full shadow-lg p-7 2xl:container 2xl:mx-auto">
        <x-form class="post-form" method="POST" action="{{ route('posts.store') }}">

            <div class="flex items-start">
                <div class="logo-drop-area flex flex-col relative justify-center items-center border border-neutral-400 rounded min-w-[250px] min-h-[150px] max-h-[200px]">
                    <div class="image absolute inset-0 pointer-events-none"></div>
                    <div class="content flex flex-col py-3 justify-center items-center text-center select-none">
                        <i class="zmdi zmdi-cloud text-4xl mb-2"></i>
                        <p class="drop-area__header px-6 text-xs">Перетащите файл в эту область</p>
                        <span class="drop-area__header px-6 text-xs">или </span>
                        <span class="browse block font-bold text-blue-500 hover:text-blue-700 cursor-pointer text-sm">Выберите файл</span>
                        <input type="file" name="image" class="drop-area__input" hidden>
                    </div>
                </div>

                <div class="w-full ml-4">
                    <x-form.input type="text" name="title" value="{{ old('title') }}" label="Заголовок"
                                  placeholder="{{ __('Введите заголовок') }}" required />
                </div>
            </div>

            <x-form.trix label="Контент" :disabledFields="['file-tools']" value="{{old('content')}}" :model=$post required />

            <x-button type="submit" text="Сохранить" icon="card-sd" color="green"
                class="bg-green-200 hover:bg-green-600 hover:text-white mt-5" />
        </x-form>
    </div>
</div>
@endsection


@push('scripts')
    <script>
        // Upload files
        let file;
        let validFileExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml', 'image/svg'];

        let drp_area = document.querySelector('.logo-drop-area');
        let drp_area_input = drp_area.querySelector(".drop-area__input");
        let drp_area_btn = drp_area.querySelector(".browse");

        async function loadSingleFile(url = '') {
            file = await fetch(url)
                .then(r => r.blob())
                .then(blobImage => validFileExtensions.includes(blobImage.type) ? new File([blobImage], `image_` + Math.random() * 100 + '.' + blobImage.type.split('/').pop().toLowerCase() , { type: blobImage.type.toLowerCase()}) : null);
            showImage();
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

            } else {
                let fileReader = new FileReader();
                fileReader.onload = () => {
                    let fileURL = fileReader.result;
                    drp_area.querySelector('.image').innerHTML = `<img src="${fileURL}" class="logo-preview mx-auto h-full" alt="Обложка новости"/>`;
                    drp_area.querySelector('.image').classList.add('bg-white');
                }
                fileReader.readAsDataURL(file);
            }
        }

        document.querySelector('.post-form').addEventListener('submit', e => {
            e.preventDefault();

            let data = new FormData(document.querySelector('.post-form'));
            file ? data.append('image', file) : null;

            axios.post('{{route("posts.store")}}', data)
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
        })
    </script>
@endpush
