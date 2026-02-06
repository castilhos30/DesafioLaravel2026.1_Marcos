@php
    // DADOS MOCK
    $banners = [
        'banner_exemplo_1.jpg', 
        'banner_exemplo_2.jpg', 
        'banner_exemplo_3.jpg'
    ];

    $produtos = [
        (object)['id' => 1, 'nome' => 'Tênis Runner', 'preco' => 299.90, 'foto' => 'tenis.jpg'],
        (object)['id' => 2, 'nome' => 'Camiseta Sport', 'preco' => 89.90, 'foto' => 'camisa.jpg'],
        (object)['id' => 3, 'nome' => 'Relógio Smart', 'preco' => 1250.00, 'foto' => 'relogio.jpg'],
        (object)['id' => 4, 'nome' => 'Fone Bluetooth', 'preco' => 150.00, 'foto' => 'fone.jpg'],
        (object)['id' => 5, 'nome' => 'Mochila Preta', 'preco' => 120.00, 'foto' => 'mochila.jpg'],
        (object)['id' => 6, 'nome' => 'Garrafa Térmica', 'preco' => 45.00, 'foto' => 'garrafa.jpg'],
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #e5e7eb !important;">
            {{ __('Loja') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        /* barra do Laravel */
        nav.bg-white {
            background-color: #1f2937 !important; 
            border-bottom: 1px solid #374151 !important;
            
        }

        /* Força o texto dos links e ícones a ficar claro (branco/cinza claro) */
        nav.bg-white a, 
        nav.bg-white button,
        nav.bg-white div {
            color: #e5e7eb !important; 
        }
        

        /* Ajusta o Logo do Laravel para branco */
        nav.bg-white svg.fill-current {
         
        }

    
        nav.bg-white svg.text-gray-500 {
            color: #e5e7eb !important;
        }

        /* "Loja" */
        header.bg-white {
            background-color: #1f2937 !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.5) !important;
            border-bottom: 1px solid #374151 !important;
        }
        
  /* Botão do ususario */
        nav button.bg-white {
            background-color: #1f2937 !important; 
            color: #e5e7eb !important;
            border: none !important; 
        }
        nav button.bg-white:hover {
            background-color: #374151 !important; 
        }


        /* --- ESTILOS GERAIS --- */
        .min-h-screen { background-color: #111827; } 
        a { text-decoration: none; }
        
        /* --- ESTILOS DA LOJA --- */
        .shop-wrapper { font-family: 'Poppins', sans-serif; color: #f3f4f6; }

        /* Navbar Secundária (Loja) */
        .shop-navbar { 
            background: #1f2937; 
            border: 1px solid #374151;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3); 
            border-radius: 8px; 
            margin-bottom: 20px;
        }
        .shop-navbar .navbar-brand { font-weight: 700; letter-spacing: 1px; color: #fff !important; }
        .shop-navbar .nav-link { font-weight: 500; color: rgba(255,255,255,0.7) !important; transition: 0.3s; }
        .shop-navbar .nav-link:hover { color: #AE171C !important; }
        .shop-navbar .nav-link.active { color: #fff !important; }

        /* Carrossel */
        #mainCarousel { 
            box-shadow: 0 4px 20px rgba(0,0,0,0.5); 
            border-radius: 0 0 12px 12px; 
            overflow: hidden; 
        }
        .carousel-item img { height: 400px; object-fit: cover; filter: brightness(0.7); }

        /* Cards de Produto */
        .produto-card { 
            border: none; border-radius: 12px; 
            background: #1f2937; 
            color: #fff;
            transition: all 0.3s ease; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.3); overflow: hidden;
            border: 1px solid #374151;
        }
        .produto-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.5); border-color: #AE171C; }
        .produto-card img { height: 220px; object-fit: cover; border-bottom: 1px solid #374151; width: 100%; }
        
        /* Título e Texto do Card */
        .card-title { color: #fff !important; }
        .card-text { color: #9ca3af !important; } 

        /* Preço e Botão */
        .price-tag { font-size: 1.4rem; font-weight: 700; color: #4ade80; margin-bottom: 1rem; } 
        .btn-comprar { 
            background: linear-gradient(135deg, #AE171C 0%, #d62d35 100%);
            border: none; color: white; padding: 10px; border-radius: 6px;
            font-weight: 600; width: 100%; display: block; text-align: center;
        }
        .btn-comprar:hover
         { filter: brightness(1.1); color: white; transform: scale(1.02); 
        }
    </style>

    <div class="py-12 shop-wrapper">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <nav class="navbar navbar-expand-lg navbar-dark shop-navbar px-3">
                <a class="navbar-brand" href="#">MINHA LOJA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#shopNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="shopNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" href="#">Início</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Carrinho</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Ofertas</a></li>
                    </ul>
                </div>
            </nav>

            <div id="mainCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
    
    <div class="carousel-indicators">
        @foreach($banners as $key => $banner)
            <button type="button" 
                    data-bs-target="#mainCarousel" 
                    data-bs-slide-to="{{ $key }}" 
                    class="{{ $loop->first ? 'active' : '' }}" 
                    aria-current="{{ $loop->first ? 'true' : 'false' }}"
                    aria-label="Slide {{ $key + 1 }}">
            </button>
        @endforeach
    </div>

   <div class="carousel-inner">
    @foreach($banners as $banner)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            
            <img src="imagem" 
                 class="d-block w-100" 
                 alt="Banner {{ $loop->iteration }}" 
                 style="height: 400px; object-fit: cover;"
                 onerror="this.onerror=null;this.src='https: //placehold.co/1200x400/red/white?text=Erro+Imagem';"> 
                 <div class="carousel-caption d-none d-md-block">
                <h2>Promoção Imperdível</h2>
                <p>Os melhores produtos com os melhores preços.</p>
            </div>
        </div>
    @endforeach
</div>

    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
    </button>
</div>

            <div class="mb-4 text-center">
                <h2 class="fw-bold" style="color: #fff; display: inline-block; border-bottom: 4px solid #AE171C; padding-bottom: 10px;">
                    Nossos Produtos
                </h2>
            </div>

            <div class="row g-4">
                @foreach($produtos as $produto)
                    <div class="col-md-3 col-sm-6">
                        <div class="card h-100 produto-card">
                            <img src="https://placehold.co/300x300/374151/FFF?text={{ urlencode($produto->nome) }}" class="card-img-top" alt="{{ $produto->nome }}">
                            
                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="card-title fw-bold">{{ $produto->nome }}</h5>
                                <p class="card-text small">Lorem ipsum dolor sit amet.</p>
                                
                                <div class="mt-auto">
                                    <p class="price-tag">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                    <button class="btn btn-comprar">
                                        <i class="fa-solid fa-cart-shopping me-2"></i> Comprar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>