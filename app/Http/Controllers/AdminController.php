<?php

namespace App\Http\Controllers;

use App\Charts\YandexMetricaVisitorsChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{

    public function __invoke(YandexMetricaVisitorsChart $chart, Request $request) {
        $metrika_period = $request->query('period', 7);
        return view('admin.dashboard.index', ['chart'=> $chart->build($metrika_period)]);
    }


}
