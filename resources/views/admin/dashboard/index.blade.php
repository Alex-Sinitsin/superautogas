@extends('admin.layouts.base')

@section('title', 'Статистика Яндекс Метрики')

@section('content')
    <x-aside/>
    <div class="content p-5 w-screen overflow-auto">
        <x-page.header>
            <x-page.title title="Статистика Яндекс Метрики" icon="view-dashboard">
                <x-slot name="subtitle">
                    <p class="page-subtitle subtitle block text-xs text-gray-500 tracking-wide">
                        {{ __('Главная страница панели управления') }}
                    </p>
                </x-slot>
            </x-page.title>
            <div
                class="period-button-group flex items-center justify-center sm:justify-end flex-wrap mt-5 w-full lg:mt-0 sm:w-fit">
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
            <div class="w-full bg-white rounded shadow-md">
                <div class="2xl:container 2xl:mx-auto py-8 px-4">
                    <div class="chart">
                        {!! $chart->container() !!}
                    </div>
                    <div class="row my-2 flex flex-wrap">
                        <div class="popularpages flex-col sm:w-full lg:flex-1 overflow-x-auto my-5">
                            <p class="text-2xl mb-2 font-bold">{{ __('Популярные страницы') }}</p>
                            <table class="text-center w-full">
                                <thead class="border-b">
                                <tr>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ __('Адрес страницы') }}</th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-900 px-6 py-4">{{ __('Просмотры') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mostviewedpages['data'] as $page)
                                    <tr class="bg-white border-b">
                                        <td class="text-sm text-gray-900 font-light pl-4 py-4 text-left whitespace-nowrap">
                                            <i class="zmdi zmdi-globe-alt text-lg align-middle mr-2 text-gray-500"></i>
                                            <span class="inline-block truncate align-middle">
                                            {{$page['dimensions']['URLPathFull']['favicon'] . $page['dimensions']['URLPathFull']['name']}}
                                        </span>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-2 py-4 whitespace-nowrap">
                                            {{ $page['metrics']['pageviews'] }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="totals flex flex-col lg:px-12 w-full lg:w-fit">
                            <h5 class="text-2xl font-bold w-full">Общая статистика</h5>
                            <x-widget title="Визиты" icon="sign-in" color="amber" value="{{$visitors['totals'][0]['visits']}}" />
                            <x-widget title="Просмотры" icon="eye" class="bg-violet-200" value="{{$visitors['totals'][0]['pageviews']}}" />
                            <x-widget title="Пользователи" icon="accounts" color="red" value="{{$visitors['totals'][0]['users']}}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endpush
