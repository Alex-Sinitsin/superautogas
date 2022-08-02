<?php

namespace App\Http\Controllers;

use App\Charts\YandexMetricaVisitorsChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
