<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale; // Importando o model de Vendas que acabamos de criar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ChartsController extends Controller
{
    public function index()
    {
        if (Auth::user()->is_admin) {
            $chart_options = [
                'chart_title' => 'Produtos Cadastrados por Mês (Últimos 12 Meses)',
                'report_type' => 'group_by_date',
                'model' => Product::class,
                'group_by_field' => 'created_at',
                'group_by_period' => 'month',
                'chart_type' => 'bar', 
                'chart_color' => '0,123,255', 
                'filter_field' => 'created_at',
                'filter_days' => 365,
            ];
        } 
        else {
            $chart_options = [
                'chart_title' => 'Minhas Vendas por Mês (Últimos 12 Meses)',
                'report_type' => 'group_by_date',
                'model' => Sale::class,
                'group_by_field' => 'created_at',
                'group_by_period' => 'month',
                'chart_type' => 'line', 
                'chart_color' => '40,167,69',
                'filter_field' => 'created_at',
                'filter_days' => 365,
                'where_raw' => 'vendedor_id = ' . Auth::id(), 
            ];
        }
        $chart = new LaravelChart($chart_options);
        return view('dashboard', compact('chart'));
    }
}