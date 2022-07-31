@extends('admin.layouts.base')

@section('title', 'Статистика Яндекс Метрики')

@section('content')
    <x-aside />
    <div class="content p-5 w-screen overflow-auto">
        <x-page.header>
            <x-page.title title="Статистика Яндекс Метрики" icon="view-dashboard">
                <x-slot name="subtitle">
                    <p class="page-subtitle subtitle block text-xs text-gray-500 tracking-wide">
                        {{ __('Главная страница панели управления') }}
                    </p>
                </x-slot>
            </x-page.title>
            <div class="period-button-group flex items-center flex-wrap">
                <a href="{{ route("admin.index", ['period' => 7]) }}"
                   class="period-metrika-link px-3 py-1.5 mr-2 my-1 bg-green-200 text-green-800 text-sm rounded hover:bg-green-600 hover:text-white transition-colors @if (request()->query('period') == 7 || request()->query('period') == null) is-active-metrika-link @endif">
                    <span>{{ __('Неделя') }}</span>
                </a>
                <a href="{{ route("admin.index", ['period' => 30]) }}"
                   class="period-metrika-link px-3 py-1.5 mr-2 my-1 bg-green-200 text-green-800 text-sm rounded hover:bg-green-600 hover:text-white transition-colors @if (request()->query('period') == 30) is-active-metrika-link @endif">
                    <span>{{ __('Месяц') }}</span>
                </a>
                <a href="{{ route("admin.index", ['period' => 90]) }}"
                   class="period-metrika-link px-3 py-1.5 mr-2 my-1 bg-green-200 text-green-800 text-sm rounded hover:bg-green-600 hover:text-white transition-colors @if (request()->query('period') == 90) is-active-metrika-link @endif">
                    <span>{{ __('Квартал') }}</span>
                </a>
                <a href="{{ route("admin.index", ['period' => 365]) }}"
                   class="period-metrika-link px-3 py-1.5 my-1 bg-green-200 text-green-800 text-sm rounded hover:bg-green-600 hover:text-white transition-colors @if (request()->query('period') == 365) is-active-metrika-link @endif">
                    <span>{{ __('Год') }}</span>
                </a>
            </div>
        </x-page.header>
        <div class="content-card">
            <div class="p-6 w-full bg-white rounded shadow">
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endpush
