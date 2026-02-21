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
    if ($user->is_admin) {
        $vendas = Sale::with(['product', 'comprador'])->latest()->get();
        $compras = Sale::with(['product', 'vendedor'])->latest()->get();
    } else {
        $vendas = Sale::with(['product', 'comprador'])->where('vendedor_id', $user->id)->latest()->get();
        $compras = Sale::with(['product', 'vendedor'])->where('comprador_id', $user->id)->latest()->get();
    }

    return view('historico', compact('vendas', 'compras'));
    }

    public function baixarPdf()
{
  $user = Auth::user();

        if ($user->is_admin) {
            $vendas = Sale::with(['product', 'comprador', 'vendedor'])->latest()->get();
            $compras = Sale::with(['product', 'vendedor', 'comprador'])->latest()->get();
        } else {
            $vendas = Sale::with(['product', 'comprador'])->where('vendedor_id', $user->id)->latest()->get();
            $compras = Sale::with(['product', 'vendedor'])->where('comprador_id', $user->id)->latest()->get();
        }

        $pdf = Pdf::loadView('pdf.historico', compact('vendas', 'compras')); 
        return $pdf->download('historico_transacoes_completo.pdf');
}
}