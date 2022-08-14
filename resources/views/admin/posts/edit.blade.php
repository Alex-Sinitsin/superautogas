@extends('admin.layouts.base')

@section('title', 'Редактирование новости')

@section('content')
<x-aside class="hidden lg:block" />
<div class="content p-5 w-screen overflow-auto">
    <x-page.header>
        <x-page.title title="Редактирование новости № {{ $post->id }}" icon="edit">
            <x-slot name="subtitle">{{ Breadcrumbs::render('admin.post.edit', $post) }}</x-slot>
        </x-page.title>
        <div class="buttons"></div>
    </x-page.header>
    <div class="edit-content w-full shadow-md p-7 2xl:container 2xl:mx-auto">
        <x-form method="PUT" action="{{ route('posts.update', ['post' => $post->id]) }}">
            <x-form.input type="text" name="title" value="{{$post->title }}" label="{{ __('Заголовок') }}"
                placeholder="{{ __('Введите заголовок') }}" required />

            <x-form.trix label="Контент" :disabledFields="['file-tools']" :model=$post :post=$post required />

            <x-form.checkbox name="is_published" label="Опубликовать" :checked="$post->is_published" />

            <x-button type="submit" text="Сохранить" icon="card-sd" color="green"
                class="bg-green-200 hover:bg-green-600 hover:text-white" />
        </x-form>
    </div>
</div>
@endsection

@push('trix')
@trixassets
@endpush