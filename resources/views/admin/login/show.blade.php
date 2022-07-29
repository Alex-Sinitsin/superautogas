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
                        <div class="px-3 py-2 text-red-600">
                            <i class="zmdi zmdi-alert-circle text-lg align-middle mr-1"></i>
                            <span class="align-middle">{{ $message }}</span>
                        </div>
                    @enderror

                    <form method="POST" action={{ route('admin.login.perform') }} class="w-full">
                        @csrf
                        <div id="input" class="flex flex-col w-full my-5">
                            <label for="email" class="text-gray-500 mb-2">{{ __('Email') }}</label>
                            <input
                                name="email"
                                type="text"
                                id="email"
                                value="{{old('email')}}"
                                placeholder="{{ __('Введите Email') }}"
                                class="appearance-none border-2 border-gray-100 rounded-lg px-4 py-2 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg @error('email') ring-2 ring-red-600 @enderror"
                            />
                            @error('email')
                                <span class="text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="input" class="flex flex-col w-full my-5">
                            <label for="password" class="text-gray-500 mb-2">{{ __('Пароль') }}</label>
                            <input
                                name="password"
                                type="password"
                                id="password"
                                value="{{old('password')}}"
                                placeholder="{{ __('Введите пароль')}} "
                                class="appearance-none border-2 border-gray-100 rounded-lg px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg @error('password') ring-2 ring-red-600 @enderror"
                            />
                            @error('password')
                                <span class="text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="button" class="flex flex-col w-full my-5">
                            <div class="">
                                <button
                                    type="submit"
                                    class="w-full py-3 bg-green-600 rounded-lg text-green-100"
                                >
                                    <i class="zmdi zmdi-sign-in text-2xl text=white mr-2 align-middle"></i>
                                    <span class="font-bold align-middle">{{__('Войти')}}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
