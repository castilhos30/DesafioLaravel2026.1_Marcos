<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Transações - Code Jr</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; margin: 0; padding: 0; }
        .header { text-align: center; border-bottom: 2px solid #AE171C; padding: 10px; margin-bottom: 20px; }
        .header h1 { color: #AE171C; margin: 0; text-transform: uppercase; }
        .user-info { margin-bottom: 20px; background: #f9f9f9; padding: 10px; border-left: 4px solid #AE171C; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; vertical-align: middle; }
        th { background-color: #AE171C; color: white; text-transform: uppercase; }
        .img-produto { width: 45px; height: 45px; border-radius: 4px; }
        .text-green { color: #27ae60; font-weight: bold; }
        .text-red { color: #AE171C; font-weight: bold; }
        h2 { border-bottom: 1px solid #AE171C; padding-bottom: 5px; color: #333; }
        .footer { position: fixed; bottom: -20px; width: 100%; text-align: center; font-size: 9px; color: #777; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Histórico de Compras e Vendas</h1>
        <p>Documento Oficial de Registro de Transações</p>
    </div>

    <div class="user-info">
        <p><strong>Titular do Relatório:</strong> {{ Auth::user()->name }} ({{ Auth::user()->is_admin ? 'Administrador' : 'Usuário' }})</p>
        <p><strong>Data de Emissão:</strong> {{ \Carbon\Carbon::now('America/Sao_Paulo')->format('d/m/Y H:i') }}</p>
    </div>

    <h2>Minhas Compras</h2>
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Produto</th>
                <th>Categoria</th>
                <th>Vendedor</th>
                <th>Data</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @forelse($compras as $compra)
            <tr>
                <td>
                    @if($compra->product && $compra->product->foto)
                        <img src="{{ public_path('storage/' . $compra->product->foto) }}" class="img-produto">
                    @else
                        <span style="color: #ccc;">Sem foto</span>
                    @endif
                </td>
                <td>{{ $compra->product->nome ?? 'N/A' }}</td>
                <td>{{ $compra->product->categorias ?? 'N/A' }}</td>
                <td>{{ $compra->vendedor->name ?? 'N/A' }}</td>
                <td>{{ $compra->created_at->format('d/m/Y') }}</td>
                <td class="text-red">R$ {{ number_format($compra->valor, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center">Nenhuma compra registrada.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>Minhas Vendas</h2>
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Produto</th>
                <th>Categoria</th>
                <th>Comprador</th>
                <th>Data</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vendas as $venda)
            <tr>
                <td>
                    @if($venda->product && $venda->product->foto)
                        <img src="{{ public_path('storage/' . $venda->product->foto) }}" class="img-produto">
                    @else
                        <span style="color: #ccc;">Sem foto</span>
                    @endif
                </td>
                <td>{{ $venda->product->nome ?? 'N/A' }}</td>
                <td>{{ $venda->product->categorias ?? 'N/A' }}</td>
                <td>{{ $venda->comprador->name ?? 'N/A' }}</td>
                <td>{{ $venda->created_at->format('d/m/Y') }}</td>
                <td class="text-green">R$ {{ number_format($venda->valor, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center">Nenhuma venda registrada.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Relatório gerado conforme requisitos RF008 e RF009 - DomPDF
    </div>

</body>
</html>