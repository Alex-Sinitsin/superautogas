@extends('admin.layouts.base')

@section('title', 'Конфиденциальность')

@section('content')
    <x-aside/>
    <div class="content p-5 w-screen overflow-auto">
        <x-page.header>
                <x-page.title title="WYSIWYG разделы" icon="view-carousel">
                    <x-slot name="subtitle">{{ Breadcrumbs::render('admin.pages') }}</x-slot>
                </x-page.title>
            <div class="buttons my-5 sm:my-0 w-full sm:w-fit">
                <a href="{{ route("pages.create") }}"
                   class="block px-3 py-2.5 mr-2 my-1 bg-red-200 text-red-800 text-sm rounded hover:bg-red-600 hover:text-white transition-colors text-center w-full sm:w-fit sm:inline-block sm:text-left">
                    <i class="zmdi zmdi-collection-add mr-2 align-middle"></i>
                    <span class="align-middle">{{ __('Добавить') }}</span>
                </a>
            </div>
        </x-page.header>

        @if (session()->has('success'))
            <div class="bg-green-100 rounded-lg py-4 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
                <i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i>
                <span class="align-middle">{{ session()->get('success') }}</span>
            </div>
        @endif

        <div class="pages">
            @if(!$pages)
                <p class="w-full text-center">Нет данных</p>
            @else
                @foreach($pages as $page)
                    <div class="page-item shadow-md mb-8">
                        <div class="pages-title flex flex-wrap items-center justify-between border-b p-4">
                            <div class="text-2xl font-bold">{{ $page->title }}</div>
                            <div class="buttons">
                                <a href="{{ route('pages.edit', ['page' => $page->id]) }}"
                                   class="block px-3 py-2.5 mr-2 my-1 bg-amber-200 text-amber-900 text-sm rounded hover:bg-amber-500 hover:text-white transition-colors text-center w-full sm:w-fit sm:inline-block sm:text-left">
                                    <i class="zmdi zmdi-edit mr-2 align-middle"></i>
                                    <span class="align-middle">{{ __('Изменить') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="pages-body p-4 overflow-y-auto max-h-[400px]">{!! $page->content !!}</div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
