@extends('admin.layouts.base')

@section('title', 'Наши работы')

@section('content')
    <x-aside/>
    <div class="content p-5 w-screen overflow-auto">
        <x-page.header>
            <x-page.title title="Наши работы" icon="collection-text">
                <x-slot name="subtitle">{{ Breadcrumbs::render('admin.galleries') }}</x-slot>
            </x-page.title>
            <div class="buttons my-5 sm:my-0 w-full sm:w-fit flex flex-wrap">
                <x-button text="Добавить марку" icon="collection-add"
                          class="create-brand-btn bg-red-200 hover:bg-red-500 hover:text-white w-full sm:w-fit my-2 sm:my-0"
                          data-bs-toggle="modal" data-bs-target="#createBrand"/>
                <x-button text="Добавить модель" icon="collection-add"
                          class="create-model-btn bg-red-200 hover:bg-red-500 hover:text-white w-full sm:w-fit sm:ml-2"
                          data-bs-toggle="modal" data-bs-target="#createBrand"/>
            </div>
        </x-page.header>

        @if (session()->has('success'))
            <div class="bg-green-100 rounded-lg py-4 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
                <i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i>
                <span class="align-middle">{{ session()->get('success') }}</span>
            </div>
        @endif

        <div class="page-body">
            <div class="brands flex flex-wrap">
                <p class="block w-full mb-1 px-2 text-lg font-bold">Бренды</p>
                @foreach($brands as $brand)
                    <button class="flex items-center mx-1 py-2 px-4 border hover:bg-amber-500 hover:text-white transition-colors rounded">
                        <img src="{{$brand->logotype}}" width="20" height="20" alt="Лого марки автомобиля" class="rounded-full">
                        <span class="ml-2">{{$brand->name}}</span>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="modals">
            <!-- Modal -->
            <div
                class="modal fixed top-0 left-0 hidden bg-gray-600 bg-opacity-80 w-full h-full outline-none overflow-x-hidden overflow-y-auto justify-center items-center"
                id="createBrand" tabindex="-1" aria-labelledby="createBrandLabel" aria-hidden="true">
                <div
                    class="modal-dialog h-full flex justify-center items-center sm:w-2/3 xl:w-2/5 mx-2 relative sm:mx-auto pointer-events-none animate__animated animate__fadeIn my-5">
                    <div
                        class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div
                            class="modal-header flex flex-shrink-0 items-center justify-between px-4 py-2 border-b border-gray-200 rounded-t-md">
                            <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                                Добавление новой марки автомобиля
                            </h5>
                            <x-button icon="close" class="close-btn text-2xl hover:text-red-500"/>
                        </div>
                        <div class="modal-body relative p-4">
                            <x-form method="POST" action="{{ route('admin.brand.store') }}" class="create-brand-form"
                                    multipart>
                                <div class="form-inner flex flex-wrap">
                                    <div
                                        class="logo-drop-area relative flex flex-col justify-center items-center mx-auto border border-neutral-400 rounded min-w-[200px] min-h-[200px] w-full">
                                        <div
                                            class="content flex flex-col py-3 justify-center items-center text-center">
                                            <i class="zmdi zmdi-cloud text-5xl mb-2"></i>
                                            <p class="drop-area__header px-6">Перетащите файл в эту область</p>
                                            <span>или</span>
                                            <x-button type="button" icon="upload" text="Выберите файл" color="neutral"
                                                      class="drop-area__btn bg-neutral-200 hover:bg-neutral-500 hover:text-white py-1 my-2"/>
                                            <x-form.input type="file" name="logotype" value="{{ old('image') }}"
                                                          class="drop-area__input" hidden required/>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <x-form.input type="text" name="name" value="{{ old('title') }}"
                                                      label="{{ __('Заголовок') }}"
                                                      placeholder="{{ __('Введите название') }}" class="brand-name-input min-w-[300px]"
                                                      required/>
                                    </div>
                                </div>
                                <div class="flex justify-end w-full mt-6">
                                    <x-button type="submit" text="Сохранить" icon="card-sd"
                                              class="submit-btn bg-violet-300 hover:bg-violet-600 hover:text-white py-2"/>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
@endpush

@push('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endpush

@push('scripts')
    <script>
        let validFileExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        let dropArea = document.querySelector('.logo-drop-area');
        let createBrandForm = document.querySelector(".create-brand-form");
        let createBrandBtn = document.querySelector('.create-brand-btn');
        let modal = document.querySelector(createBrandBtn.getAttribute('data-bs-target'));
        let closeBtn = modal.querySelector('.close-btn');
        let dropAreaButton = dropArea.querySelector(".drop-area__btn");
        let dropAreaInput = dropArea.querySelector(".drop-area__input");
        let createBrandSubmitBtn = createBrandForm.querySelector('.submit-btn');
        let defaultHTML = `<div class="content flex flex-col py-3 justify-center items-center text-gray-500 text-center">
                                            <i class="zmdi zmdi-cloud text-5xl mb-2"></i>
                                            <p class="drop-area__header px-6">Перетащите файл в эту область</p>
                                            <span>или</span>
                                            <x-button type="button" icon="upload" text="Выберите файл" color="neutral" class="drop-area__btn bg-neutral-200 hover:bg-neutral-500 hover:text-white py-1 my-2"/>
                                            <x-form.input type="file" name="image" value="{{ old('image') }}" class="drop-area__input" hidden  required />
                                        </div>`;

        if (createBrandBtn) {
            createBrandBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
                modal.setAttribute('role', 'dialog');
            })

            closeBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
                modal.removeAttribute('role');
                dropArea.innerHTML = defaultHTML;
                createBrandForm.reset();
            })
        }

        let file;

        dropAreaButton.onclick = () => {
            dropAreaInput.click()
        };

        dropAreaInput.addEventListener('change', (e) => {
            file = dropAreaInput.files[0];
            showImage();
        })

        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('active');
        })
        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('active');
        })
        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('active');
            file = e.dataTransfer.files[0];
            showImage();
        })

        createBrandSubmitBtn.onclick = e => {
            e.preventDefault();
            let data = new FormData();
            data.append('name', createBrandForm.querySelector('.brand-name-input').value);
            data.append('logotype', file);
            axios.post('{{route('galleries.store')}}', data);
        }

        function showImage() {
            let fileType = file.type;
            if (!validFileExtensions.includes(fileType)) {
                console.log('This is not an image!')
            } else {
                let fileReader = new FileReader();
                fileReader.onload = () => {
                    let fileURL = fileReader.result;
                    dropArea.innerHTML = `<img src="${fileURL}" class="logo-preview mx-auto h-full aspect-4/3 absolute top-0" alt="Лого"/>`;
                }
                fileReader.readAsDataURL(file);
            }
        }
    </script>
@endpush

@push('scripts')
    <script>
        {{--Dropzone.autoDiscover = false;--}}
        {{--let myDropzone = new Dropzone("div#drop-zone", {--}}
        {{--    url: "/galleries/store",--}}
        {{--    autoProcessQueue: false,--}}
        {{--    addRemoveLinks: true,--}}
        {{--    acceptedFiles: ".jpeg,.jpg,.png,.gif",--}}
        {{--    uploadMultiple: true,--}}
        {{--    parallelUploads: 100,--}}
        {{--    maxFiles: 100,--}}
        {{--});--}}

        {{--let form = document.querySelector('.upload-form');--}}

        {{--form.querySelector("button[type=submit]").addEventListener("click", function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    e.stopPropagation();--}}
        {{--    let formData = new FormData();--}}
        {{--    let files = myDropzone.getAcceptedFiles();--}}
        {{--    files.forEach(file => {--}}
        {{--        formData.append('images[]', file);--}}
        {{--    })--}}
        {{--    formData.append('title', form.children['username'].value);--}}
        {{--    axios.post('{{route('galleries.store')}}', formData);--}}
        {{--});--}}
    </script>
@endpush
