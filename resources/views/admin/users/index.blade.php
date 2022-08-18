@extends('admin.layouts.base')

@section('title', 'Пользователи')

@section('content')
<x-aside />
<div class="content p-5 w-screen overflow-auto">
  <x-page.header>
    <x-page.title title="Пользователи" icon="accounts">
      <x-slot name="subtitle">{{ Breadcrumbs::render('admin.users') }}</x-slot>
    </x-page.title>
    <div class="buttons my-5 sm:my-0 w-full sm:w-fit">
      <a href="{{ route('users.create') }}"
        class="block px-3 py-2.5 mr-2 my-1 bg-red-200 text-red-800 text-sm rounded hover:bg-red-600 hover:text-white transition-colors text-center w-full sm:w-fit sm:inline-block sm:text-left">
        <i class="zmdi zmdi-collection-add mr-2 align-middle"></i>
        <span class="align-middle">{{ __('Добавить') }}</span>
      </a>
    </div>
  </x-page.header>
  @if (session()->has('success'))
  <div class="bg-green-100 rounded-lg py-4 px-6 mb-4 text-base text-green-700" role="alert">
    <i class="zmdi zmdi-notifications align-middle text-lg mr-2"></i>
    <span class="align-middle">{{ session()->get('success') }}</span>
  </div>
  @endif
  
  <x-table id="users-table">
    <thead class="border-b bg-gray-100">
      <tr>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left border-r">
          #
        </th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left border-r">
          Имя и Отчество
        </th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left border-r">
          Email
        </th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
          Роль в системе
        </th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
          Действия
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr class="border-b">
        <td class="pl-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{$user->id}}</td>
        <td class="text-sm text-gray-900 font-light px-6 py-3 whitespace-nowrap border-r">
          {{$user->name}}
        </td>
        <td class="text-sm text-gray-900 font-light px-6 py-3 whitespace-nowrap border-r">
          {{$user->email}}
        </td>
        <td class="text-sm text-gray-900 font-light px-6 py-3 whitespace-nowrap border-r">
          {{$user->role == 'admin' ? 'Администратор' : 'Пользователь'}}
        </td>
        <td class="px-6 py-3 flex items-center">
          <a href="{{ route('users.edit', ['user' => $user->id]) }}"
            class="edit-option h-full py-2.5 font-bold px-4 rounded bg-amber-300 hover:bg-amber-500 hover:text-white transition-colors whitespace-nowrap">
            <i class="zmdi zmdi-edit mr-1 align-middle"></i>
            <span class="text-sm align-middle">Редактировать</span>
          </a>
          <x-form method="DELETE" action="{{ route('users.destroy', ['user' => $user->id]) }}"
            class="inline-block ml-1">
            <x-button type="submit" text="Удалить" icon="delete"
              class="rounded py-2.5 block bg-red-300 hover:bg-red-500 hover:text-white transition-colors {{$users->count() == 1 ? 'disabled' : ''}}" />
          </x-form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </x-table>
  @endsection