<aside {{ $attributes->class(["sidebar p-3 bg-gray-100 h-full, hidden md:block"]) }}>
    <div class="menu-wrapper py-5 w-56">
        <x-aside.item title="Статистика">
            <x-aside.link link="{{ route('admin.index', ['period' => 7]) }}"
                          title="Яндекс Метрика"
                          icon="view-dashboard"
                          class="{{ active_link('admin*') }}"
            />
        </x-aside.item>
        <x-aside.item title="Контент">
            <x-aside.link link="{{ route('posts.index') }}"
                          title="Новости"
                          icon="collection-text"
                          class="{{ active_link('posts*') }}"
            />
            <x-aside.link link="{{ route('galleries.index') }}"
                          title="Наши работы"
                          icon="collection-image"
                          class="{{ active_link('galleries*') }}"
            />
            <a href="#"
               class="block text-base hover:bg-blue-700 hover:text-white font-medium px-7 py-2 transition-colors">
                <i class="zmdi zmdi-comment-text-alt mr-1.5 icon"></i>
                <span>{{__('Отзывы')}}</span>
            </a>
            <a href="#"
               class="block text-base hover:bg-blue-700 hover:text-white font-medium px-7 py-2 transition-colors">
                <i class="zmdi zmdi-view-carousel mr-1.5 icon"></i>
                <span>{{__('Сертификаты')}}</span>
            </a>
        </x-aside.item>
        <x-aside.item title="WYSIWYG разделы">
            <x-aside.link link="{{ route('pages.index') }}"
                          title="Разделы"
                          icon="view-carousel"
                          class="{{ active_link('pages*') }}"
            />
        </x-aside.item>
        <x-aside.item title="Администрирование">
            <a href="#"
               class="block text-base hover:bg-blue-700 hover:text-white font-medium px-7 py-2 transition-colors">
                <i class="zmdi zmdi-accounts mr-1.5 icon"></i>
                <span>{{__('Пользователи')}}</span>
            </a>
        </x-aside.item>
    </div>
</aside>
