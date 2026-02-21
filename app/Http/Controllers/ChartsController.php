<?php

namespace App\Http\Controllers;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ChartsController extends Controller
{


$chart_options = [
    'chart_title' => 'Produtos Criados por Mês',
    'report_type' => 'group_by_date',
    'model' => Product::class,
    'group_by_field' => 'created_at',
    'group_by_period' => 'month',
    'chart_type' => 'bar',
    'chart_color' => '0,123,255',
];
$chart = new LaravelChart($chart_options);

return view('charts', compact('chart'));
}
