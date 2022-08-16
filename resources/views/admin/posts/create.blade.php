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
        <x-form method="POST" action="{{ route('posts.store') }}">
            <x-form.input type="text" name="title" value="{{ old('title') }}" label="Заголовок"
                placeholder="{{ __('Введите заголовок') }}" required />

            <x-form.trix label="Контент" :disabledFields="['file-tools']" value="{{old('content')}}" :model=$post required />

            <x-button type="submit" text="Сохранить" icon="card-sd" color="green"
                class="bg-green-200 hover:bg-green-600 hover:text-white mt-5" />
        </x-form>
    </div>
</div>
@endsection