@extends('admin.layouts.base')

@section('title', 'Статистика Яндекс Метрики')

@section('content')
    <x-aside class="hidden lg:block"/>
    <div class="content p-5 w-screen overflow-auto">
        <x-page.header>
            <x-page.title title="Новости" icon="collection-text">
                <x-slot name="subtitle">{{ Breadcrumbs::render('posts') }}</x-slot>
            </x-page.title>
            <div class="buttons"></div>
        </x-page.header>
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
                <x-post.card :post=$post />
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
            console.log(e.target)
        }
    </script>
@endpush
