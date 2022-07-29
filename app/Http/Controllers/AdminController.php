<?php

namespace App\Http\Controllers;

use App\Charts\YandexMetricaChart;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __invoke(YandexMetricaChart $chart, Request $request) {
        $metrika_period = $request->query('period', 7);
        return view('admin.dashboard.index', ['chart'=> $chart->build($metrika_period)]);
    }


}
