@extends('admin.layouts.base')

@section('title', 'Авторизация администратора')

@section('content')
    <div class="container px-6 mx-auto">
        <div class="flex items-center justify-center h-full">
            <div class="w-full md:w-full lg:w-2/6 mx-auto md:mx-0">
                <div class="bg-white p-10 flex flex-col w-full shadow-xl rounded-xl">
                    <h2 class="text-2xl font-bold text-gray-800 text-left mb-5">
                        {{ __('Авторизация') }}
                    </h2>

                    @error('auth')
                        <div class="py-2 text-red-600">
                            <i class="zmdi zmdi-alert-circle text-lg align-middle mr-1"></i>
                            <span class="align-middle">{{ $message }}</span>
                        </div>
                    @enderror

                    <x-form method="POST" action="{{ route('admin.login.perform') }}" class="w-full">
                        <div id="input" class="flex flex-col w-full mt-2">
                            <x-form.input
                                name="email"
                                type="email"
                                label="Email"
                                placeholder="{{ __('Введите Email') }}"
                                required
                            />
                        </div>
                        <div id="input" class="flex flex-col w-full mt-2">
                            <x-form.input
                                name="password"
                                type="password"
                                label="Пароль"
                                placeholder="{{ __('Введите пароль') }}"
                                required
                            />
                        </div>
                        <div id="button" class="flex flex-col w-full mt-6">
                            <x-button type="submit" text="Войти" icon="sign-in" color="green" class="text-center text-white text-2xl font-bold bg-green-600 hover:bg-green-700 px-3 py-3 w-full" />
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
@endsection
