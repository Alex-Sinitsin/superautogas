@extends('admin.layouts.base')

@section('title', 'Новости')

@section('content')
    <x-aside class="hidden lg:block"/>
    <div class="content p-5 w-screen overflow-auto">
        <x-page.header>
            <x-page.title title="Новости" icon="collection-text">
                <x-slot name="subtitle">{{ Breadcrumbs::render('posts') }}</x-slot>
            </x-page.title>
            <div class="buttons">
                <a href="{{ route("posts.create") }}"
                   class="px-3 py-2.5 mr-2 my-1 bg-red-200 text-red-800 text-sm rounded hover:bg-red-600 hover:text-white transition-colors">
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
        @elseif (session()->has('error'))
            <div class="bg-red-100 rounded-lg py-4 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
                <i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i>
                <span class="align-middle">{{ session()->get('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-post.grid>
            @foreach($posts as $post)
                <x-post.card :post=$post/>
            @endforeach
        </x-post.grid>
    </div>
@endsection

@pushonce('scripts')
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
@endpushonce

@push('scripts')
    <script>
        let msnry = new Masonry('.posts-grid', {
            columnWidth: '.grid-sizer',
            itemSelector: '.grid-item',
            percentPosition: true,
            gutter: 20
        });

        const postgrid = document.querySelector('.posts-grid');

        postgrid.onclick = e => {
            for (let i = 1; i < postgrid.children.length; i++) {
                postgrid && postgrid.children[i].classList.remove('is-active');
            }
            e.target.parentNode.parentNode.parentNode.classList.add('is-active');
        }
    </script>
@endpush
