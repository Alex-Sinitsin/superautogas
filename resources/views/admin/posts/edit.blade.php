@extends('admin.layouts.base')

@section('title', 'Редактирование новости')

@section('content')
    <x-aside class="hidden lg:block"/>
    <div class="content p-5 w-screen overflow-auto">
        <x-page.header>
            <x-page.title title="Редактирование новости № {{ $post->id }}" icon="edit">
                <x-slot name="subtitle">{{ Breadcrumbs::render('post', $post) }}</x-slot>
            </x-page.title>
            <div class="buttons"></div>
        </x-page.header>
        <div class="edit-content w-full shadow-md p-7">
            <x-form method="PUT" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype='multipart/form-data'>
                <x-form.input type="text" name="title" value="{{$post->title }}" label="{{ __('Заголовок') }}" placeholder="{{ __('Введите заголовок') }}" required />

                <x-form.trix label="Контент" :disabledFields="['file-tools']" :post=$post required/>

                <div class="my-5">
                    <input type="checkbox" name="is_published" class="form__chk" id="form__chk" {{ $post->is_published ? 'checked' : '' }}>
                    <label for="form__chk" class="form__chk-label">
                        <span class="form__span">Опубликовать</span>
                    </label>
                </div>
                <button type="submit"
                        class="px-3 py-2.5 mr-2 my-1 bg-green-200 text-green-800 text-sm rounded hover:bg-green-600 hover:text-white transition-colors">
                    <i class="zmdi zmdi-card-sd mr-2 align-middle"></i>
                    <span class="align-middle">{{ __('сохранить') }}</span>
                </button>
            </x-form>
        </div>
    </div>
@endsection

@push('trix')
    @trixassets
@endpush
