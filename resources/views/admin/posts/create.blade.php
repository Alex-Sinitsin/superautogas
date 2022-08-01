@extends('admin.layouts.base')

@section('title', 'Создание новости')

@section('content')
    <x-aside class="hidden lg:block"/>
    <div class="content p-5 w-screen overflow-auto">
        <x-page.header>
            <x-page.title title="Создание новости" icon="edit">
                <x-slot name="subtitle">{{ Breadcrumbs::render('posts') }}</x-slot>
            </x-page.title>
            <div class="buttons">

            </div>
        </x-page.header>
        <div class="edit-content w-full shadow-lg p-7">
            <x-form method="POST" action="{{ route('posts.store') }}" enctype='multipart/form-data'>
                <x-form.input type="text" name="title" value="{{ old('title') }}" label="{{ __('Заголовок') }}" placeholder="{{ __('Введите заголовок') }}" required />

                <x-form.trix label="Контент" :disabledFields="['file-tools']" required/>

                <button type="submit"
                   class="px-3 py-2.5 my-3 bg-green-200 text-green-800 text-sm rounded hover:bg-green-600 hover:text-white transition-colors">
                    <i class="zmdi zmdi-card-sd mr-2 align-middle"></i>
                    <span class="align-middle">{{ __('сохранить') }}</span>
                </button>
            </x-form>
        </div>
    </div>
@endsection
