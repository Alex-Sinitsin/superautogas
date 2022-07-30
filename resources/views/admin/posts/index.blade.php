@extends('admin.layouts.base')

@section('title', 'Статистика Яндекс Метрики')

@section('content')
    <x-aside/>
    <div class="content p-5 w-screen overflow-auto">
        <x-page.header>
            <x-page.title title="Новости" icon="collection-text">
                <div>{{ Breadcrumbs::render('posts') }}</div>
            </x-page.title>
            <div class="buttons"></div>
        </x-page.header>
        <div class="posts-grid">
            <div class="grid-sizer"></div>
            <div class="grid-item p-5 shadow-md relative">
                <div class="post-card__header h-12 flex items-center justify-between border-b-2 border-b-gray-200">
                    <div class="post-card__title text-ellipsis font-bold">Lorem ipsum dolor.</div>
                    <div class="post-card__options cursor-pointer text-2xl">
                        <i class="zmdi zmdi-more  p-2"></i>
                    </div>
                    <div class="dropdown absolute top-[70px] right-[15px] rounded shadow-md py-3 px-6 bg-white" role="menu">
                        <div class="dropdown__content">
                            <div class="dropdown__content-item border-b-2 border-b-gray-100">
                                <a href="#" class="edit-option block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
                                    <i class="zmdi zmdi-edit mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Редактировать</span>
                                </a>
                            </div>
                            <div class="dropdown__content-item border-b-2 border-b-gray-100">
                                <a href="#" class="publish-option block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
{{--                                    <i class="zmdi zmdi-eye mr-1 align-middle"></i>--}}
                                    <i class="zmdi zmdi-eye-off mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Скрыть</span>
                                </a>
                            </div>
                            <div class="dropdown__content-item">
                                <a href="#" class="publish-option block w-full h-full py-2 px-2 text-red-700 hover:text-red-900 transition-colors">
                                    <i class="zmdi zmdi-delete mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Удалить</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-card__body py-3 text-[15px]">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, animi aut autem cum eligendi error
                    exercitationem fuga laboriosam libero nemo omnis quaerat repellendus sit soluta tempore veniam
                    veritatis! Adipisci corporis dolorum, esse id ipsa labore maxime minus odit, quidem quos sed sint
                    veritatis vero. Fugiat iusto necessitatibus quaerat quibusdam quod!
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci cum expedita laboriosam, maiores quis rem velit. Aliquid commodi consectetur corporis, ducimus est id impedit inventore ipsa ipsum iste laudantium, maxime nihil nisi optio pariatur perferendis quibusdam quis reiciendis rerum sapiente sed suscipit tempora tempore tenetur veniam voluptas voluptate voluptates! Veniam?
                </div>
            </div>
            <div class="grid-item p-5 shadow-md relative">
                <div class="post-card__header h-12 flex items-center justify-between border-b-2 border-b-gray-200">
                    <div class="post-card__title text-ellipsis font-bold">Lorem ipsum dolor.</div>
                    <div class="post-card__options cursor-pointer text-2xl">
                        <i class="zmdi zmdi-more  p-2"></i>
                    </div>
                    <div class="dropdown absolute top-[70px] right-[15px] rounded shadow-md py-3 px-6 bg-white" role="menu">
                        <div class="dropdown__content">
                            <div class="dropdown__content-item border-b-2 border-b-gray-100">
                                <a href="#" class="edit-option block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
                                    <i class="zmdi zmdi-edit mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Редактировать</span>
                                </a>
                            </div>
                            <div class="dropdown__content-item border-b-2 border-b-gray-100">
                                <a href="#" class="publish-option block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
{{--                                    <i class="zmdi zmdi-eye mr-1 align-middle"></i>--}}
                                    <i class="zmdi zmdi-eye-off mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Скрыть</span>
                                </a>
                            </div>
                            <div class="dropdown__content-item">
                                <a href="#" class="publish-option block w-full h-full py-2 px-2 text-red-700 hover:text-red-900 transition-colors">
                                    <i class="zmdi zmdi-delete mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Удалить</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-card__body py-3 text-[15px]">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, animi aut autem cum eligendi error
                    exercitationem fuga laboriosam libero nemo omnis quaerat repellendus sit soluta tempore veniam
                    veritatis! Adipisci corporis dolorum, esse id ipsa labore maxime minus odit, quidem quos sed sint
                    veritatis vero. Fugiat iusto necessitatibus quaerat quibusdam quod!
                </div>
            </div>
            <div class="grid-item p-5 shadow-md relative">
                <div class="post-card__header h-12 flex items-center justify-between border-b-2 border-b-gray-200">
                    <div class="post-card__title text-ellipsis font-bold">Lorem ipsum dolor.</div>
                    <div class="post-card__options cursor-pointer text-2xl">
                        <i class="zmdi zmdi-more  p-2"></i>
                    </div>
                    <div class="dropdown absolute top-[70px] right-[15px] rounded shadow-md py-3 px-6 bg-white" role="menu">
                        <div class="dropdown__content">
                            <div class="dropdown__content-item border-b-2 border-b-gray-100">
                                <a href="#" class="edit-option block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
                                    <i class="zmdi zmdi-edit mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Редактировать</span>
                                </a>
                            </div>
                            <div class="dropdown__content-item border-b-2 border-b-gray-100">
                                <a href="#" class="publish-option block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
{{--                                    <i class="zmdi zmdi-eye mr-1 align-middle"></i>--}}
                                    <i class="zmdi zmdi-eye-off mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Скрыть</span>
                                </a>
                            </div>
                            <div class="dropdown__content-item">
                                <a href="#" class="publish-option block w-full h-full py-2 px-2 text-red-700 hover:text-red-900 transition-colors">
                                    <i class="zmdi zmdi-delete mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Удалить</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-card__body py-3 text-[15px]">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, animi aut autem cum eligendi error
                    exercitationem fuga laboriosam libero nemo omnis quaerat repellendus sit soluta tempore veniam
                    veritatis! Adipisci corporis dolorum, esse id ipsa labore maxime minus odit, quidem quos sed sint
                    veritatis vero. Fugiat iusto necessitatibus quaerat quibusdam quod!
                </div>
            </div>
            <div class="grid-item p-5 shadow-md relative">
                <div class="post-card__header h-12 flex items-center justify-between border-b-2 border-b-gray-200">
                    <div class="post-card__title text-ellipsis font-bold">Lorem ipsum dolor.</div>
                    <div class="post-card__options cursor-pointer text-2xl">
                        <i class="zmdi zmdi-more  p-2"></i>
                    </div>
                    <div class="dropdown absolute top-[70px] right-[15px] rounded shadow-md py-3 px-6 bg-white" role="menu">
                        <div class="dropdown__content">
                            <div class="dropdown__content-item border-b-2 border-b-gray-100">
                                <a href="#" class="edit-option block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
                                    <i class="zmdi zmdi-edit mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Редактировать</span>
                                </a>
                            </div>
                            <div class="dropdown__content-item border-b-2 border-b-gray-100">
                                <a href="#" class="publish-option block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
{{--                                    <i class="zmdi zmdi-eye mr-1 align-middle"></i>--}}
                                    <i class="zmdi zmdi-eye-off mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Скрыть</span>
                                </a>
                            </div>
                            <div class="dropdown__content-item">
                                <a href="#" class="publish-option block w-full h-full py-2 px-2 text-red-700 hover:text-red-900 transition-colors">
                                    <i class="zmdi zmdi-delete mr-1 align-middle"></i>
                                    <span class="text-sm align-middle">Удалить</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-card__body py-3 text-[15px]">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, animi aut autem cum eligendi error
                    exercitationem fuga laboriosam libero nemo omnis quaerat repellendus sit soluta tempore veniam
                    veritatis! Adipisci corporis dolorum, esse id ipsa labore maxime minus odit, quidem quos sed sint
                    veritatis vero. Fugiat iusto necessitatibus quaerat quibusdam quod!
                </div>
            </div>
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
            gutter: 25
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
