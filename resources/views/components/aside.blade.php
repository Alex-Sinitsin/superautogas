<aside {{ $attributes->class(["sidebar p-3 bg-gray-100 h-full absolute left-[-100%] md:left-0 md:relative md:block"])
    }}>
    <div class="menu-wrapper py-5 w-56">
        <x-aside.item title="Статистика">
            <x-aside.link link="{{ route('admin.dashboard.index', ['period' => 7]) }}" title="Яндекс Метрика"
                icon="view-dashboard" class="{{ active_link('*dashboard*') }}" />
        </x-aside.item>
        <x-aside.item title="Контент">
            <x-aside.link link="{{ route('posts.index') }}" title="Новости" icon="collection-text"
                class="{{ active_link('posts*') }}" />
            <x-aside.link link="{{ route('galleries.index') }}" title="Наши работы" icon="collection-image"
                class="{{ active_link('galleries*') }}" />
            <x-aside.link link="{{ route('testimonials.index') }}" title="Отзывы клиентов" icon="comments"
                class="{{ active_link('testimonials*') }}" />
            <x-aside.link link="{{ route('admin.certificates.index') }}" title="Сертификаты" icon="view-carousel"
                class="{{ active_link('*certificates*') }}" />
        </x-aside.item>
        <x-aside.item title="WYSIWYG разделы">
            <x-aside.link link="{{ route('pages.index') }}" title="Разделы" icon="view-carousel"
                class="{{ active_link('pages*') }}" />
        </x-aside.item>
        <x-aside.item title="Администрирование">
            <x-aside.link link="{{ route('users.index') }}" title="Пользователи" icon="accounts"
                class="{{ active_link('users*') }}" />
        </x-aside.item>
    </div>
</aside>