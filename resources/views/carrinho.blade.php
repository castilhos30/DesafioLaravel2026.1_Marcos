<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - RPM Motos</title>
    
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}?v=1"> 

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #111827 ;
            color: #e0e0e0;
            font-family: 'Inter', sans-serif;
        }
        .navbar{
            background-color: #1f2937 !important; 
            border-bottom: 2px solid #333 !important;
        }

       
        .card-dark {
            background-color:  #1f2937;
            border: 1px solid #333;
            border-radius: 12px;
        }

        
        .form-control-dark {
            background-color: #1f2937;
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

.no-spinners::-webkit-outer-spin-button,
.no-spinners::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.no-spinners {
    -moz-appearance: textfield;
}

@media (max-width: 768px) {
    .card-dark .d-flex.align-items-center {
        flex-direction: column; 
    }

    .cart-img-container {
        width: 100%; 
        height: 150px;
    }

    .flex-grow-1 {
        width: 100%;
    }

    .d-flex.justify-content-between.align-items-end {
        flex-direction: column; 
        align-items: center !important;
        gap: 15px;
    }

    .price-tag {
        font-size: 2rem;
    }
}
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-black py-3 border-bottom border-secondary border-opacity-25 mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/produtos">
                <i class="bi bi-arrow-left me-2"></i> Continuar Comprando
            </a>
            <span class="text-white fw-bold">Carrinho  <i class="bi bi-cart4"></i> </span>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row g-4">
            
            @php $total = 0; @endphp

            <div class="col-lg-8">
    
            @if(count($carrinho) > 0)
                
                @foreach($carrinho as $product)
                    
                    @php 
                        $subtotal = $product['preco'] * $product['quantidade'];
                        $total += $subtotal;
                    @endphp

                    <div class="card card-dark mb-3 p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="cart-img-container flex-shrink-0">
                                @if($product['foto'])
                                    <img src="{{ asset($product['foto']) }}" width="80" class="rounded">
                                @else
                                    <i class="bi bi-box-seam-fill fs-2"></i>
                                @endif
                            </div>
                            
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <h5 class="fw-bold text-white mb-1">{{ $product['nome'] }}</h5>
                                    <form action="{{ route('carrinho.remover', $product['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    </form>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-end mt-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-white me-2">Qtd:</span>

                                        <form action="{{ route('carrinho.atualizar', $product['id']) }}" method="POST" id="form-qtd-{{ $product['id'] }}">
                                            @csrf
                                            @method('PATCH')
                                            
                                            @php 
                                                $estoque = \App\Models\Product::find($product['id'])->quantidade; 
                                            @endphp

                                            <div class="input-group input-group-sm" style="width: 120px;">
                                                
                                                <button type="button" class="btn btn-outline-secondary text-white border-secondary" 
                                                        onclick="alterarQuantidade({{ $product['id'] }}, -1)">
                                                    <i class="bi bi-dash"></i>
                                                </button>

                                                <input type="number" 
                                                    id="input-qtd-{{ $product['id'] }}"
                                                    name="quantidade" 
                                                    value="{{ $product['quantidade'] }}" 
                                                    min="1" 
                                                    max="{{ $estoque }}" 
                                                    class="form-control text-center bg-dark text-white border-secondary no-spinners"
                                                    readonly>

                                                <button type="button" class="btn btn-outline-secondary text-white border-secondary" 
                                                        onclick="alterarQuantidade({{ $product['id'] }}, 1)">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                        </form>
                                        
                                        @if($product['quantidade'] >= $estoque)
                                            <small class="text-danger ms-2" style="font-size: 0.7rem;">Máx</small>
                                        @endif
                                    </div>

                                    <div class="text-end">
                                        <small class="text-secondary d-block">Unit: R$ {{ number_format($product['preco'], 2, ',', '') }}</small>
                                        <span class="text-neon fs-5">
                                            R$ {{ number_format($subtotal, 2, ',', '') }}
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
                        <span class="fs-2 text-neon">R$ {{ number_format($total, 2, ',', '') }}</span>
                    </div>
                    <form action="/checkout" method="POST">
                        @csrf
                        
                        <div class="d-grid gap-2">
                            <input type="hidden" name="itens" value="{{ json_encode($carrinho) }}">
                            @if(Auth::user()->saldo< $total)
                                    <button class="btn btn-secondary btn-lg px-5 fw-bold py-3 flex-grow-1" type="button" disabled>
                                        <i class="bi bi-x-circle me-2"></i> Saldo Insuficiente
                                    </button>
                                @else
                            <button type="submit" class="btn btn-checkout rounded-pill shadow-lg" {{ $total == 0 ? 'disabled' : '' }}>
                                Finalizar Compra
                            </button>
                            @endif
                        </div>
                    </form>      

                    
                    <a href="/produtos" class="btn btn-link text-secondary text-decoration-none text-center mt-3 d-block">
                        Continuar Comprando
                    </a>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



    <script>function alterarQuantidade(id, mudanca) {
        let input = document.getElementById('input-qtd-' + id);
        let form = document.getElementById('form-qtd-' + id);
        let valorAtual = parseInt(input.value);
        let max = parseInt(input.getAttribute('max'));
        let min = parseInt(input.getAttribute('min'));
        let novoValor = valorAtual + mudanca;
        if (novoValor >= min && novoValor <= max) {
            input.value = novoValor;
            form.submit(); 
        }
    }
    </script>
</body>
</html>