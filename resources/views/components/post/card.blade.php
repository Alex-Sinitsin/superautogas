<div class="grid-item mb-[20px] p-5 shadow-md relative xl:w-[32%] md:w-[48%] w-full">
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
                    <x-form method="PUT" action="{{ route('posts.update', ['post' => $post->id]) }}">
                        <x-form.input type="text" name="title" value="{{$post->title}}" class="hidden"/>
                        <x-form.trix label="Контент" :post=$post required hidden/>
                        <x-form.checkbox name="is_published" label="Опубликовать" :checked="!$post->is_published"
                                         class="hidden"/>

                        @if($post->is_published)
                            <x-button type="submit" text="Скрыть" icon="eye-off" class="px-2 hover:text-blue-900" />
                        @else
                            <x-button type="submit" text="Опубликовать" icon="eye" class="px-2 hover:text-blue-900" />
                        @endif
                    </x-form>
                </div>
                <div class="dropdown__content-item">
                    <x-form method="DELETE" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                        <x-button type="submit" text="Удалить" icon="delete" color="red" class="px-2" />
                    </x-form>
                </div>
            </div>
        </div>
    </div>
    <div class="post-card__body py-3 text-[15px]">
        <div class="badges-group mb-[10px]">
            @if($post->is_published)
                <span
                    class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-white rounded">Опубликована</span>
            @else
                <span
                    class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded">Скрыта</span>
            @endif
        </div>
        {!! $post->content !!}
    </div>
</div>
