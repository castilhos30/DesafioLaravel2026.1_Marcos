<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $vendas = Sale::with(['product', 'comprador'])->where('vendedor_id', $user->id)->latest()->get();
        $compras = Sale::with(['product', 'vendedor'])->where('comprador_id', $user->id)->latest()->get();

        return view('historico', compact('vendas', 'compras'));
    }

    public function baixarPdf()
    {
        $user = Auth::user();
        
        $vendas = Sale::with(['product', 'comprador'])->where('vendedor_id', $user->id)->latest()->get();
        $compras = Sale::with(['product', 'vendedor'])->where('comprador_id', $user->id)->latest()->get();
        $pdf = Pdf::loadView('pdf.historico', compact('vendas', 'compras')); 
        
        return $pdf->download('meu_historico_de_transacoes.pdf');
    }
}