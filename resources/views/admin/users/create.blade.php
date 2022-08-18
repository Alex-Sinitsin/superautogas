@extends('admin.layouts.base')

@section('title', 'Создание отзыва')

@section('content')
<x-aside class="hidden lg:block" />
<div class="content p-5 w-screen overflow-auto">
    <x-page.header>
        <x-page.title title="Добавление пользователя" icon="account-add">
            <x-slot name="subtitle">{{ Breadcrumbs::render('admin.users.create') }}</x-slot>
        </x-page.title>
    </x-page.header>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> 
    @endif

    <div class="users-create-content w-full shadow-lg p-7 2xl:container 2xl:mx-auto">
        <x-form method="POST" action="{{ route('users.store') }}">
            <x-form.input type="text" name="user_name" value="{{ old('name') }}" label="Имя, Отчество"
                placeholder="{{ __('Введите имя пользователя') }}" required />
            <x-form.input type="email" name="email" value="{{ old('email') }}" label="Email пользователя"
                placeholder="{{ __('Введите Email пользователя') }}" required />
            <x-form.input type="password" name="password" label="Пароль" placeholder="{{ __('Введите пароль') }}"
                required />
            <x-form.input type="password" name="password_confirmation" label="Подтверждение пароля"
                placeholder="{{ __('Введите пароль повторно') }}" required />
            <x-form.select name="role" placeholder="Выберите роль пользователя" label="Роль пользователя" required>
                <option class="option" value="user" label="Пользователь" selected>Пользователь</option>
                <option class="option" value="admin" label="Администратор">Администратор</option>
            </x-form.select>
            <x-button type="submit" text="Сохранить" icon="card-sd" color="green"
                class="bg-green-200 hover:bg-green-600 hover:text-white mt-5" />
        </x-form>
    </div>
</div>
@endsection