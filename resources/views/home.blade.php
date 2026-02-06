<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


@php

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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">MINHA LOJA</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Carrinho</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="mainCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($banners as $key => $banner)
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($banners as $banner)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="https://placehold.co/1200x400/333/FFF?text=Banner+{{ $key+1 }}" class="d-block w-100" alt="Banner">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Promoção Imperdível</h2>
                        <p>Os melhores produtos com os melhores preços.</p>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container mb-5">
        <h2 class="text-center mb-5 fw-bold">Nossos Produtos</h2>
        
        <div class="row g-4">
            @foreach($produtos as $produto)
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 produto-card bg-white">
                        <img src="https://placehold.co/300x300/EEE/31343C?text={{ urlencode($produto->nome) }}" class="card-img-top" alt="{{ $produto->nome }}">
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $produto->nome }}</h5>
                            <p class="card-text text-muted small">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            
                            <div class="mt-auto">
                                <p class="price-tag">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                <button class="btn btn-primary btn-comprar text-white">
                                    <i class="fa-solid fa-cart-shopping"></i> Comprar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</x-app-layout>