@extends('admin.layouts.base')

@section('title', 'Статистика Яндекс Метрики')

@section('content')
    <x-sidebar/>
    <div class="content p-5 w-screen overflow-auto">
        <div class="page-header-card w-full mb-4 shadow-md px-4 py-5">
            <div class="flex justify-between items-center">
                <div class="page-title flex items-center">
                    <i class="zmdi zmdi-view-dashboard mr-3 py-2 px-4 text-[28px] text-white rounded bg-green-500"></i>
                    <div class="page-caption">
                        <p class="page-title block font-bold text-2xl tracking-wider mb-0">{{ __('Новости') }}</p>
                        <p class="page-subtitle subtitle block text-xs text-gray-500 tracking-wide">
                            Хлебные крошки
                        </p>
                    </div>
                </div>
                <div class="period-button-group flex items-center flex-wrap">

                </div>
            </div>
        </div>
        <div class="content-card">

        </div>
    </div>
@endsection
