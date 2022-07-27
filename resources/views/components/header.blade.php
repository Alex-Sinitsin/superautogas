<header class="header fixed top-0 left-0 right-0 w-full bg-blue-600 py-3 px-7">
    <div class="md:container md:mx-auto flex justify-between items-center">
        <div class="logotype">
            <img src="/images/logo/logo-white.png" class="w-32 h-8" alt="Логотип компании">
        </div>
        @auth
            <div class="logout">
                <a href="#" class="px-2 py-2"><i class="zmdi zmdi-power text-2xl text-white"
                                                 title="Выйти из системы"></i></a>
            </div>
        @endauth
    </div>
</header>
