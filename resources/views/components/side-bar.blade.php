<aside class="sidebar p-3 bg-gray-100 h-full">
    <div class="menu-wrapper py-5">
        <div class="menu-item mb-3 w-56">
            <p class="text-gray-600 font-bold mb-1 uppercase text-sm tracking-wider">{{__('Статистика')}}</p>
            <a href="{{ route("admin.index", ['period' => 7]) }}"
               class="block text-base hover:bg-blue-700 hover:text-white font-medium px-7 py-2 transition-colors active-link">
                <i class="zmdi zmdi-view-dashboard mr-1.5 icon"></i>
                <span>{{__('Яндекс Метрика')}}</span>
            </a>
        </div>
        <div class="menu-item mb-3">
            <p class="text-gray-600 font-bold mb-1 uppercase text-sm tracking-wider">{{__('Контент')}}</p>
            <a href="{{ route("posts.index") }}"
               class="block text-base hover:bg-blue-700 hover:text-white font-medium px-7 py-2 transition-colors">
                <i class="zmdi zmdi-collection-text mr-1.5 icon"></i>
                <span>{{__('Новости')}}</span>
            </a>
            <a href="#"
               class="block text-base hover:bg-blue-700 hover:text-white font-medium px-7 py-2 transition-colors">
                <i class="zmdi zmdi-collection-image mr-1.5 icon"></i>
                <span>{{__('Галерея')}}</span>
            </a>
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
        </div>
        <div class="menu-item mb-3">
            <p class="text-gray-600 font-bold mb-1 uppercase text-sm tracking-wider">{{__('Общая информация')}}</p>
            <a href="#"
               class="block text-base hover:bg-blue-700 hover:text-white font-medium px-7 py-2 transition-colors">
                <i class="zmdi zmdi-store mr-1.5 icon"></i>
                <span>{{__('О компании')}}</span>
            </a>
        </div>
        <div class="menu-item mb-3">
            <p class="text-gray-600 font-bold mb-1 uppercase text-sm tracking-wider">{{__('Конфиденциальность')}}</p>
            <a href="#"
               class="block text-base hover:bg-blue-700 hover:text-white font-medium px-7 py-2 transition-colors">
                <i class="zmdi zmdi-face mr-1.5 icon"></i>
                <span>{{__('Персональные данные')}}</span>
            </a>
        </div>
        <div class="menu-item">
            <p class="text-gray-600 font-bold mb-1 uppercase text-sm tracking-wider">{{__('Администрирование')}}</p>
            <a href="#"
               class="block text-base hover:bg-blue-700 hover:text-white font-medium px-7 py-2 transition-colors">
                <i class="zmdi zmdi-accounts mr-1.5 icon"></i>
                <span>{{__('Пользователи')}}</span>
            </a>
        </div>
    </div>
</aside>
