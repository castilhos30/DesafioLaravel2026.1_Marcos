<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Transações</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #AE171C;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #AE171C;
            margin: 0;
            font-size: 24px;
        }
        .info {
            margin-bottom: 30px;
        }
        h2 {
            font-size: 18px;
            color: #1f2937;
            margin-top: 30px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
            font-weight: bold;
            color: #111827;
        }
        .text-right {
            text-align: right;
        }
        .text-red {
            color: #AE171C;
            font-weight: bold;
        }
        .text-green {
            color: #27ae60;
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: -10px;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Relatório de Transações</h1>
        <p>Histórico Oficial de Compras e Vendas</p>
    </div>

    <div class="info">
        <p><strong>Usuário:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Data de Emissão:</strong> {{ \Carbon\Carbon::now('America/Sao_Paulo')->format('d/m/Y \à\s H:i') }}</p>
    </div>

    <h2>Minhas Compras (Saídas)</h2>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Vendedor</th>
                <th>Data</th>
                <th class="text-right">Valor Pago</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($compras as $compra)
                <tr>
                    <td>{{ $compra->product->nome ?? 'Produto Excluído' }}</td>
                    <td>{{ $compra->vendedor->name ?? 'Usuário Excluído' }}</td>
                    <td>{{ $compra->created_at->format('d/m/Y') }}</td>
                    <td class="text-right text-red">- R$ {{ number_format($compra->valor, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #777;">Nenhuma compra registrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h2>Minhas Vendas (Entradas)</h2>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Comprador</th>
                <th>Data</th>
                <th class="text-right">Valor Recebido</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vendas as $venda)
                <tr>
                    <td>{{ $venda->product->nome ?? 'Produto Excluído' }}</td>
                    <td>{{ $venda->comprador->name ?? 'Usuário Excluído' }}</td>
                    <td>{{ $venda->created_at->format('d/m/Y') }}</td>
                    <td class="text-right text-green">+ R$ {{ number_format($venda->valor, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #777;">Nenhuma venda registrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Gerado pelo Sistema - {{ date('Y') }}
    </div>

</body>
</html>