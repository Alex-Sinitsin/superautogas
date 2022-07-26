@extends('admin.layouts.base')

@section('title', 'Статистика Яндекс Метрики')

@section('content')
    <div class="content p-5">
        <div class="page-header-card w-full mb-4 shadow-md px-4 py-5">
            <div class="flex justify-between items-center">
                <div class="page-title flex items-center">
                    <i class="zmdi zmdi-view-dashboard mr-3 py-2 px-4 text-[28px] text-white rounded bg-green-500"></i>
                    <div class="page-caption">
                        <p class="page-title block font-medium text-lg tracking-wider mb-0">Статистика Яндекс Метрики</p>
                        <p class="page-subtitle block text-xs text-gray-500 tracking-wide">
                            Главная страница панели управления
                        </p>
                    </div>
                </div>
                <div class="period-button-group">
                    <p class="">
                        <a href="#" class="period-metrika-link px-3 py-1.5 mr-2  text-sm rounded hover:bg-blue-800 hover:text-white transition-colors  is-active">
                            <span>Неделя</span>
                        </a>
                        <a href="#" class="period-metrika-link px-3 py-1.5 mr-2 text-sm rounded hover:bg-blue-800 hover:text-white transition-colors">
                            <span>Месяц</span>
                        </a>
                        <a href="#" class="period-metrika-link px-3 py-1.5 mr-2 text-sm rounded hover:bg-blue-800 hover:text-white transition-colors">
                            <span>Квартал</span>
                        </a>
                        <a href="#" class="period-metrika-link px-3 py-1.5 text-sm rounded hover:bg-blue-800 hover:text-white transition-colors">
                            <span>Год</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="content-card">
            <div>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium debitis excepturi illo,
                laboriosam nihil quos sed tempore. Aliquid architecto at consequatur debitis delectus dolorem esse
                exercitationem, explicabo id impedit maiores minus molestias, neque pariatur perferendis porro quae,
                quam quasi reiciendis unde vel voluptates voluptatibus? Error esse inventore qui tempore?
            </div>
        </div>
    </div>
@endsection

