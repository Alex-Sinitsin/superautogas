<?php

namespace App\Charts;

use App\Http\Controllers\YandexMetrikaController;
use ArielMejiaDev\LarapexCharts\AreaChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class YandexMetricaVisitorsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($period): AreaChart
    {
        //TODO: Сделать Hepler для выбранного периода метрики
        $metrika = new YandexMetrikaController();
        $visitors = $metrika->getVisitors($period);

        return $this->chart->areaChart()
            ->setTitle('Посещения')
            ->addData('Посещения', $visitors['visits']['values'])
            ->addData('Просмотры', $visitors['pageviews']['values'])
            ->addData('Уникальные пользователи', $visitors['users']['values'])
            ->setXAxis($visitors['dimensions'])
            ->setGrid()
            ->setHeight(420);
    }
}