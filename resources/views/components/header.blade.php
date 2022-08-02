<header class="header fixed top-0 left-0 right-0 w-full bg-blue-600 py-3 px-7">
    <div class="flex justify-center sm:justify-between items-center flex-wrap">
        <div class="logotype">
            <img src="/images/logo/logo-white.png" class="w-32 h-8 mx-auto" alt="Логотип компании">
        </div>
        @auth
            <div class="logout flex items-center">
                <div class="user flex items-center mr-4">
                    <div class="avatar rounded-full mr-3"><i class="zmdi zmdi-account text-white text-[2.8em]"></i></div>
                    <div class="user-data text-white">
                        <span class="block font-bold">{{ auth()->user()->name }}</span>
                        <span class="block text-sm mt-[-3px] font-light">{{ auth()->user()->role == 'admin' ? __('Администратор') : '' }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.logout.perform') }}">
                    <i class="zmdi zmdi-power text-3xl text-white"
                        title="Выйти из системы"></i>
                </a>
            </div>
        @endauth
    </div>
</header>
