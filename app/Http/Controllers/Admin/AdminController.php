<?php

namespace App\Http\Controllers\Admin;

use App\Charts\YandexMetricaVisitorsChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __invoke(YandexMetricaVisitorsChart $chart, Request $request) {
        $metrika = new YandexMetrikaController();

        $metrika_period = $request->query('period', 7);
        $visitors = $metrika->getVisitors($metrika_period);
        $mostviewedpages = $metrika->getMostViewedPages($metrika_period);

        return view('admin.dashboard.index', ['chart'=> $chart->build($metrika_period, $visitors), 'mostviewedpages' => $mostviewedpages, 'visitors' => $visitors]);
    }


}