<?php

namespace App\Http\Controllers;
use AXP\YaMetrika\Client;
use AXP\YaMetrika\YaMetrika;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class YandexMetrikaController
{
    private $token;
    private $counterId;
    private $metrika;
    private $client;

    public function __construct()
    {
        $this->token = getenv('TOKEN');
        $this->counterId = getenv('COUNTER_ID');
        $this->client = new Client($this->token, $this->counterId);
        $this->metrika = new YaMetrika($this->client);
    }

    public function getVisitors($period)
    {
        $visitorsRaw = isset($this->metrika) ? $this->metrika->getVisitors($period)->formatData() : [];

        $visitors = ['dimensions' => [], 'visits' => ['values' => []], 'pageviews' => ['values' => []], 'users' => ['values' => []]];

        for ($i = 0; $i < count($visitorsRaw['data']); $i++) {
            array_push($visitors['dimensions'], Date::create($visitorsRaw['data'][$i]['dimensions']['date']['name'])->locale('ru')->format('d.m.y'));
            array_push($visitors['visits']['values'], $visitorsRaw['data'][$i]['metrics']['visits']);
            array_push($visitors['pageviews']['values'], $visitorsRaw['data'][$i]['metrics']['pageviews']);
            array_push($visitors['users']['values'], $visitorsRaw['data'][$i]['metrics']['users']);
        }
        return $visitors;
    }
}
