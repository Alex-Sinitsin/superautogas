@extends('admin.layouts.base')

@section('title', 'Новости')

@section('content')
<x-aside />
<div class="content p-5 w-screen overflow-auto">
    <x-page.header>
        <x-page.title title="Новости" icon="collection-text">
            <x-slot name="subtitle">{{ Breadcrumbs::render('admin.posts') }}</x-slot>
        </x-page.title>
        <div class="buttons my-5 sm:my-0 w-full sm:w-fit">
            <a href="{{ route('posts.create') }}"
                class="block px-3 py-2.5 mr-2 my-1 bg-red-200 text-red-800 text-sm rounded hover:bg-red-600 hover:text-white transition-colors text-center w-full sm:w-fit sm:inline-block sm:text-left">
                <i class="zmdi zmdi-collection-add mr-2 align-middle"></i>
                <span class="align-middle">{{ __('Добавить') }}</span>
            </a>
        </div>
    </x-page.header>
    @if (session()->has('success'))
    <div class="bg-green-100 rounded-lg py-4 px-6 mb-4 text-base text-green-700" role="alert">
        <i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i>
        <span class="align-middle">{{ session()->get('success') }}</span>
    </div>
    @endif

    <x-post.grid>
        @foreach($posts as $post)
        <x-post.card :post=$post />
        @endforeach
    </x-post.grid>
    <div class="pagination-links my-4 2xl:container 2xl:mx-auto">
        {{ $posts->links() }}
    </div>
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