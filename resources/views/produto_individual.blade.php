<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nome }} - RPM Motos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #111827 !important; 
            color: #e0e0e0; 
        }
        
        .product-image-container {
            background-color: #1e1e1e; 
            height: 650px; 
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            border: 1px solid #333;
        }
        .product-image-container i {
             color: #555;
        }

        .card-dark {
            background-color: #1f2937; 
            border: 1px solid #333;
            border-radius: 12px;
        }

        .price-tag {
            font-size: 2.8rem;
            font-weight: 800;
            color: #2ecc71;
        }

        .section-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 600;
            color: #888; 
            margin-bottom: 10px;
            display: block;
        }

        .navbar{
            background-color: #1f2937 !important;
        }
        .no-spinners::-webkit-outer-spin-button,
        .no-spinners::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .no-spinners {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-black py-3 shadow-sm border-bottom border-secondary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{route('home')}}">RPM Motos</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="mb-4">
            <a href="{{ route('produtos') }}" class="btn btn-outline-light btn-sm px-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar para a Página de Produtos
            </a>
        </div>

        <div class="card card-dark shadow-lg overflow-hidden">
            <div class="card-body p-0">
                <div class="row g-0">
                    
                    <div class="col-lg-6 p-4 d-flex align-items-center bg-black bg-opacity-25">
                        <div class="product-image-container w-100 shadow-sm">
                            <div class="text-center">
                                @if($product->foto)
                                    <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nome }}" class="img-fluid rounded" style="height: 100%;"> 
                                @else
                                    <i class="bi bi-image fs-1"></i>
                                    <p class="mt-3 text-white-50 fw-light">Sem Imagem</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 p-5">
                        
                        <div class="mb-3">
                            <span class="badge bg-primary bg-gradient me-2">{{ $product->categorias }}</span>
                            <small class="text-secondary" style="font-size: 1.25rem;">
                            <i class="bi bi-person-fill me-1"></i> 
                             {{ $product->user->name ?? 'RPM Motos' }}
                            </small>
                        </div>
                        
                        <h1 class="display-6 fw-bold text-white mb-4">{{ $product->nome }}</h1>

                        <div class="mb-4 p-3 bg-black bg-opacity-25 rounded-3 border border-secondary border-opacity-25">
                            <div class="d-flex align-items-center">
                                <span class="price-tag me-3">R$ {{ number_format($product->preco, 2, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="mb-5">
                            <span class="section-label">Sobre o Produto</span>
                            <p class="text-light lead fs-6" style="line-height: 1.7;">
                                {{ $product->descricao }}
                            </p>
                        </div>

                        <hr class="border-secondary opacity-25 my-4">

                        <div class="row mb-4 g-3">
                            <div class="col-6 col-md-4">
                                <div class="p-3 bg-black bg-opacity-25 rounded border border-secondary border-opacity-10 text-center">
                                    <i class="bi bi-box-seam fs-4 text-primary mb-2 d-block"></i>
                                    <small class="text-white-50 fw-bold d-block mb-1">ESTOQUE</small>
                                    <span class="fs-5 fw-bold text-white">{{ $product->quantidade }} unid.</span>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('add_to_cart', $product->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <span class="section-label">Quantidade</span>
                                <div class="d-flex align-items-center gap-3">
                                    
                                    <div class="input-group" style="width: 140px;">
                                        <button type="button" class="btn btn-outline-secondary text-white border-secondary" onclick="mudarQtd(-1)">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        
                                        <input type="number" 
                                               id="input-qtd"
                                               name="quantity" 
                                               value="1" 
                                               min="1" 
                                               max="{{ $product->quantidade }}" 
                                               class="form-control text-center bg-dark text-white border-secondary no-spinners"
                                               readonly>
                                        
                                        <button type="button" class="btn btn-outline-secondary text-white border-secondary" onclick="mudarQtd(1)">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                    
                                    <small class="text-secondary" id="aviso-estoque"></small>
                                </div>
                            </div>

                            <div class="d-grid gap-3 d-md-flex justify-content-md-start">
                                @if($product->quantidade > 0)
                                    <button class="btn btn-success btn-lg px-5 fw-bold py-3 flex-grow-1" type="submit">
                                        <i class="bi bi-bag-check-fill me-2"></i> COMPRAR AGORA
                                    </button>
                                @else
                                    <button class="btn btn-secondary btn-lg px-5 fw-bold py-3 flex-grow-1" type="button" disabled>
                                        <i class="bi bi-x-circle me-2"></i> INDISPONÍVEL
                                    </button>
                                @endif
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center text-white-50 pb-5">
            <small>RPM Motos</small>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function mudarQtd(mudanca) {
            let input = document.getElementById('input-qtd');
            let valorAtual = parseInt(input.value);
            let max = parseInt(input.getAttribute('max'));
            let min = 1;

            let novoValor = valorAtual + mudanca;

            if (novoValor >= min && novoValor <= max) {
                input.value = novoValor;
                document.getElementById('aviso-estoque').innerText = "";
            } else if (novoValor > max) {
                document.getElementById('aviso-estoque').innerText = "Máximo atingido!";
            }
        }
    </script>
</body>
</html>