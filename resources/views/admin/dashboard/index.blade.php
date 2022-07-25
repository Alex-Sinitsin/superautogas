<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--    <title>@yield("title")</title>--}}
    <title>CMS</title>
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.ttf')}} as="font">
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.woff')}} as="font">
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.woff2')}} as="font">
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.eot')}} as="font">
    @vite('resources/css/app.css')
</head>
<body>
<header class="header fixed top-0 left-0 right-0 w-full bg-blue-600 py-3 px-7">
    <div class="md:container md:mx-auto flex justify-between items-center">
        <div class="logotype">
            <img src="/images/logo/logo-white.png" class="w-32 h-8" alt="Логотип компании">
        </div>
        <div class="logout">
            <a href="#" class="px-2 py-2"><i class="zmdi zmdi-power text-2xl text-white"></i></a>
        </div>
    </div>
</header>
<section class="content-wrapper mt-[56px] flex">
    <aside class="sidebar p-3 bg-gray-100">
        <div class="menu-wrapper">
            <div class="menu-item mb-3 w-56">
                <p class="text-gray-600 font-bold mb-1 uppercase text-sm tracking-wider">{{__('Статистика')}}</p>
                <a href="#"
                   class="block text-base hover:bg-blue-700 hover:text-white font-medium px-7 py-2 transition-colors active-link">
                    <i class="zmdi zmdi-view-dashboard mr-1.5 icon"></i>
                    <span>{{__('Яндекс Метрика')}}</span>
                </a>
            </div>
            <div class="menu-item mb-3">
                <p class="text-gray-600 font-bold mb-1 uppercase text-sm tracking-wider">{{__('Контент')}}</p>
                <a href="#"
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
    <div class="content p-5 flex-auto">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam blanditiis culpa fuga magnam,
        nostrum obcaecati officia omnis possimus. Accusamus ad aliquam aliquid architecto assumenda culpa dolor dolorem
        doloremque doloribus dolorum eius enim error, eum illo incidunt ipsum laboriosam maiores, mollitia nulla odit
        perspiciatis placeat provident qui quisquam repellat reprehenderit saepe sapiente sit ullam veritatis? A ad
        aliquid asperiores commodi consequuntur cumque deleniti dicta earum eos, explicabo fuga fugiat ipsa iste labore
        libero magnam magni maiores minus nemo nesciunt recusandae repellendus reprehenderit rerum sunt tempore totam
        unde ut vel voluptas voluptate? Accusamus corporis eius est excepturi omnis sapiente totam vitae!
    </div>
</section>
</body>
</html>
