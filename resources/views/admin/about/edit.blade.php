@extends('admin.layouts.base')

@section('title', 'Редактирование страницы')

@section('content')
    <x-aside class="hidden lg:block"/>
    <div class="content p-5 w-screen overflow-auto">
        <x-page.header>
            <x-page.title title="Редактирование страницы «{{$page->title}}»" icon="edit">
                <x-slot name="subtitle">{{ Breadcrumbs::render('admin.about.edit', $page) }}</x-slot>
            </x-page.title>
            <div class="buttons"></div>
        </x-page.header>
        <div class="edit-content w-full shadow-md p-7 2xl:container 2xl:mx-auto">
            <x-form method="PUT" action="{{ route('about.update', ['about' => $page->id]) }}">
                <x-form.input type="text" name="title" value="{{$page->title }}" label="{{ __('Заголовок') }}" placeholder="{{ __('Введите заголовок') }}" required />

                <x-form.trix label="Контент" :post=$page :model=$page />

                <x-button type="submit" text="Сохранить" icon="card-sd" color="green" class="bg-green-200 hover:bg-green-600 hover:text-white mt-5" />
            </x-form>
        </div>
    </div>
@endsection

@push('trix')
    @trixassets
@endpush

