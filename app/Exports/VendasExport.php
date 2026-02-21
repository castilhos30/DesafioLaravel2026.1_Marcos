<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VendasExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Pega todas as vendas com os relacionamentos (Requisito Admin RF009)
        return Sale::with(['product', 'comprador', 'vendedor'])->latest()->get();
    }

    public function headings(): array
    {
        return ["Produto", "Categoria", "Comprador", "Vendedor", "Data", "Valor"];
    }

    public function map($sale): array
    {
        return [
            $sale->product->nome ?? 'N/A',
            $sale->product->categorias ?? 'N/A',
            $sale->comprador->name ?? 'N/A',
            $sale->vendedor->name ?? 'N/A',
            $sale->created_at->format('d/m/Y'),
            'R$ ' . number_format($sale->valor, 2, ',', '.')
        ];
    }
}