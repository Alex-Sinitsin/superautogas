<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\AreaChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use AXP\YaMetrika\Client;
use AXP\YaMetrika\YaMetrika;
use Illuminate\Support\Facades\Date;

class YandexMetricaChart
{
    protected $chart;
    protected $token;
    protected $counterId;
    protected $metrika;
    protected $client;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $this->token = getenv('TOKEN');
        $this->counterId = getenv('COUNTER_ID');
        $this->client = new Client($this->token, $this->counterId);
        $this->metrika = new YaMetrika($this->client);
    }

    public function build($period): AreaChart
    {
        //TODO: Сделать Hepler для активной страницы и выбранного периода метрики
        $visitors = $this->getVisitors($period);
        return $this->chart->areaChart()
            ->setTitle('Посещения')
            ->addData('Посещения', $visitors['visits']['values'])
            ->addData('Просмотры', $visitors['pageviews']['values'])
            ->addData('Уникальные пользователи', $visitors['users']['values'])
            ->setXAxis($visitors['dimensions'])
            ->setGrid()
            ->setHeight(420);
    }

    protected function getVisitors($period) {
        $visitorsRaw = $this->metrika->getVisitors($period)->formatData();

        $visitors = ['dimensions' => [], 'visits' => ['values' => []], 'pageviews' => ['values' => []], 'users' => ['values' => []]];

        for ($i = 0; $i < count($visitorsRaw['data']); $i++) {
            array_push($visitors['dimensions'], Date::create($visitorsRaw['data'][$i]['dimensions']['date']['name'])->locale('ru')->format('d M y'));
            array_push($visitors['visits']['values'], $visitorsRaw['data'][$i]['metrics']['visits']);
            array_push($visitors['pageviews']['values'], $visitorsRaw['data'][$i]['metrics']['pageviews']);
            array_push($visitors['users']['values'], $visitorsRaw['data'][$i]['metrics']['users']);
        }
        return $visitors;
    }
}
