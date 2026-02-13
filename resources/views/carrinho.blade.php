<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - TurboStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Inter', sans-serif;
        }

       
        .card-dark {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 12px;
        }

        
        .form-control-dark {
            background-color: #252525;
            border: 1px solid #333;
            color: #fff;
        }
        .form-control-dark:focus {
            background-color: #252525;
            border-color: #2ecc71;
            color: #fff;
            box-shadow: none;
        }

        
        .cart-img-container {
            width: 100px;
            height: 100px;
            background-color: #181818;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #444;
        }

      
        .btn-qty {
            background-color: #252525;
            border: 1px solid #333;
            color: #fff;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .btn-qty:hover {
            background-color: #2ecc71;
            border-color: #2ecc71;
            color: #000;
        }

       
        .text-neon {
            color: #2ecc71;
            font-weight: 700;
        }

       
        .btn-checkout {
            background-color: #2ecc71;
            color: #000;
            font-weight: 800;
            border: none;
            padding: 15px;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: transform 0.2s;
        }
        .btn-checkout:hover {
            background-color: #27ae60;
            transform: scale(1.02);
            color: #fff;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-black py-3 border-bottom border-secondary border-opacity-25 mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-arrow-left me-2"></i> Continuar Comprando
            </a>
            <span class="text-white fw-bold">Carrinho  <i class="bi bi-cart4"></i> </span>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row g-4">
            
            <div class="col-lg-8">
    
    @if(count($carrinho) > 0)
        
        @foreach($carrinho as $id => $item) <div class="card card-dark mb-3 p-3">
    <div class="d-flex align-items-center gap-3">
        <div class="cart-img-container flex-shrink-0">
            @if($item['foto'])
                <img src="{{ asset('storage/' . $item['foto']) }}" width="80" class="rounded">
            @else
                <i class="bi bi-box-seam-fill fs-2"></i>
            @endif
        </div>
        
        <div class="flex-grow-1">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold text-white mb-1">{{ $item['nome'] }}</h5>
                <a href="#" class="btn btn-link text-danger p-0 text-decoration-none">
                    <i class="bi bi-trash"></i>
                </a>
            </div>
            
            <div class="d-flex justify-content-between align-items-end mt-3">
                <div class="d-flex align-items-center gap-2">
                    <span class="text-white">Qtd: {{ $item['quantidade'] }}</span>
                </div>
                <div class="text-end">
                    <small class="text-secondary d-block">Unit: R$ {{ number_format($item['preco'], 2, ',', '.') }}</small>
                    <span class="text-neon fs-5">
                        R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

    @else
        <div class="alert alert-warning">Seu carrinho está vazio.</div>
    @endif

</div>
            <div class="col-lg-4">
                <div class="card card-dark p-4 position-sticky" style="top: 20px;">
                    <h4 class="fw-bold text-white mb-4">Resumo do Pedido</h4>

    
                    <hr class="border-secondary opacity-25">

                    <div class="d-flex justify-content-between mb-4 align-items-center">
                        <span class="fs-5 fw-bold text-white">Total</span>
                        <span class="fs-2 text-neon">R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-checkout rounded-pill shadow-lg">
                            Finalizar Compra <i class="bi bi-chevron-right ms-1"></i>
                        </button>
                        <a href="/loja" class="btn btn-link text-secondary text-decoration-none text-center">
                            Continuar Comprando
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>