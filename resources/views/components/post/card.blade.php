<div class="grid-item mb-[20px] p-5 shadow-md relative xl:w-[32%] md:w-[48%]">
    <div class="post-card__header h-12 flex items-center justify-between border-b-2 border-b-gray-200">
        <div class="post-card__title truncate w-4/5 font-bold">{{$post->title}}</div>
        <div class="post-card__options cursor-pointer text-2xl">
            <i class="zmdi zmdi-more p-2"></i>
        </div>
        <div class="dropdown absolute top-[70px] right-[15px] rounded shadow-md py-3 px-6 bg-white" role="menu">
            <div class="dropdown__content">
                <div class="dropdown__content-item border-b-2 border-b-gray-100">
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                       class="edit-option block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
                        <i class="zmdi zmdi-edit mr-1 align-middle"></i>
                        <span class="text-sm align-middle">Редактировать</span>
                    </a>
                </div>
                <div class="dropdown__content-item border-b-2 border-b-gray-100">
                    <form method="post" action="{{ route('posts.update', ['post' => $post->id]) }}">
                        @method("PUT")
                        @csrf
                        <x-form.input type="text" name="title" value="{{$post->title}}" class="hidden"/>
                        <x-form.input type="text" name="text" value="{{$post->text}}" class="hidden"/>
                        <input type="checkbox" name="is_published"
                                      value="{{ $post->is_published ? 0 : 1 }}"
                                      {{ $post->is_published ? 'checked=false' : 'checked=true' }} class="hidden">
                        @if($post->is_published)
                            <button type="submit"
                                    class="publish-option text-left block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
                                <i class="zmdi zmdi-eye-off mr-1 align-middle"></i>
                                <span class="text-sm align-middle">Скрыть</span>
                            </button>
                        @else
                            <button type="submit"
                                    class="publish-option text-left block w-full h-full py-2 px-2 hover:text-blue-900 transition-colors">
                                <i class="zmdi zmdi-eye mr-1 align-middle"></i>
                                <span class="text-sm align-middle">Опубликовать</span>
                            </button>
                        @endif
                    </form>
                </div>
                <div class="dropdown__content-item">
                    <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="publish-option block w-full h-full py-2 px-2 text-red-700 hover:text-red-900 transition-colors text-left">
                            <i class="zmdi zmdi-delete mr-1 align-middle"></i>
                            <span class="text-sm align-middle">Удалить</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="post-card__body py-3 text-[15px]">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, animi aut autem cum eligendi error
        exercitationem fuga laboriosam libero nemo omnis quaerat repellendus sit soluta tempore veniam
        veritatis! Adipisci corporis dolorum, esse id ipsa labore maxime minus odit, quidem quos sed sint
        veritatis vero. Fugiat iusto necessitatibus quaerat quibusdam quod!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci cum expedita laboriosam, maiores quis rem
        velit. Aliquid commodi consectetur corporis, ducimus est id impedit inventore ipsa ipsum iste laudantium, maxime
        nihil nisi optio pariatur perferendis quibusdam quis reiciendis rerum sapiente sed suscipit tempora tempore
        tenetur veniam voluptas voluptate voluptates! Veniam?
    </div>
</div>
