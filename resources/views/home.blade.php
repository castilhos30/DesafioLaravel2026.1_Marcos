@php
    $banners = [
        'https://casalotimotors.com.br/gallery_gen/1d97d9b71fcece8b1aebd092f8936f12_fit.png?ts=1757092059.jpg', 
        'https://i.pinimg.com/originals/a8/86/0a/a8860a7d2eb5cf3abb8f899c3aef1639.jpg', 
        'https://www.bmw-motorrad.com.br/content/dam/bmwmotorradnsc/marketBR/bmw-motorrad_com_br/servicos-financeiros/imagens-2023/banner-info-legal-motos-desk.jpg.asset.1712342488736.jpg'
    ];
   
@endphp
<title>RPM Motos</title>

<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        
        nav, nav[class*="bg-white"] {
            background-color: #1f2937 !important; 
            border-bottom: 1px solid #374151 !important;
        }
        nav a, nav div, nav span { color: #e5e7eb !important; }
        
        /* Botão do Usuário (Dropdown) */
        nav button.bg-white {
            background-color: #1f2937 !important; 
            border: none !important; 
            color: #e5e7eb !important; 
        }
        
        /* Ajusta a cor quando passa o mouse em cima dele */
        nav button.bg-white:hover {
            background-color: #374151 !important;
}
        /* =========================================
           ESTILOS DA LOJA
           ========================================= */
        .min-h-screen { background-color: #111827; }
        a { text-decoration: none; }
        .shop-wrapper { font-family: 'Poppins', sans-serif; color: #f3f4f6; }

        /* Navbar da Loja */
        .shop-navbar { 
            background: #1f2937; 
            border: 1px solid #374151;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3); 
            border-radius: 8px; 
            margin-bottom: 20px;
        }
        .shop-navbar .navbar-brand { font-weight: 700; letter-spacing: 1px; color: #fff !important; }

        /* Botão Carrinho */
        .btn-cart {
            color: #e5e7eb; border: 1px solid #374151; transition: 0.3s; position: relative;
        }
        .btn-cart:hover {
            background-color: #374151; color: #fff; border-color: #AE171C;
        }
        .badge-cart { background-color: #AE171C; font-size: 0.7rem; }

        /* Carrossel */
        #mainCarousel { box-shadow: 0 4px 20px rgba(0,0,0,0.5); border-radius: 0 0 12px 12px; overflow: hidden; }
        .carousel-item img { height: 400px; object-fit: cover; filter: brightness(0.8); }

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
        
        .card-title { color: #fff !important; }
        .card-text { color: #9ca3af !important; } 
        .price-tag { font-size: 1.4rem; font-weight: 700; color: #4ade80; margin-bottom: 1rem; } 
        
        .btn-comprar { 
            background: linear-gradient(135deg, #AE171C 0%, #d62d35 100%);
            border: none; color: white; padding: 10px; border-radius: 6px;
            font-weight: 600; width: 100%; display: block; text-align: center;
        }
        .btn-comprar:hover { filter: brightness(1.1); color: white; transform: scale(1.02); }
    </style>

    <div class="py-12 shop-wrapper">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <nav class="navbar navbar-dark shop-navbar px-4 d-flex justify-content-between align-items-center">
                <a class="navbar-brand m-0" href="#">RPM Motos</a>
                
                <div>
                    <a href="{{ route('carrinho') }}" class="btn btn-cart p-2 px-3 rounded-pill">
                        <i class="fa-solid fa-cart-shopping"></i>
                       @if(session('carrinho'))
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                            {{ count(session('carrinho')) }}
                        </span>
                        @endif
                    </a>
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
                            <img src="{{ $banner }}" 
                                 class="d-block w-100" 
                                 alt="Banner" 
                                 style="height: 400px; object-fit: cover;"
                                 onerror="this.onerror=null;this.src='https://placehold.co/1200x400/333/FFF?text=Erro+Imagem';">
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

            <div class="mb-4 text-center">
                <a href="/produtos"> 
                    <h2 class="fw-bold" style="color: #fff; display: inline-block; border-bottom: 4px solid #AE171C; padding-bottom: 10px;">
                        Nossos Produtos
                    </h2>
                </a>
            </div>

            <div class="mb-4 text-center">
                <a href="/produtos"> 
                    <h3 class="fw-bold" style="color: #fff; display: inline-block; border-bottom: 4px solid #AE171C; padding-bottom: 10px;">
                        Mais recentes
                    </h3>
                </a>
            </div>

            <div class="row g-4">
               @foreach($products->take(8) as $product)
                    <div class="col-md-3 col-sm-6">
                        <div class="card h-100 produto-card" onclick="window.location='{{ route('produto_individual', $product->id) }}'">
                            
                            <img src="{{ $product->foto }}" 
                                 class="card-img-top" 
                                 alt="{{ $product->nome }}">
                            
                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="card-title fw-bold">{{ $product->nome }}</h5>
                                <p class="card-text small">{{ Str::limit($product->descricao, 100) }}</p>
                                
                                <div class="mt-auto">
                                    <p class="price-tag">R$ {{ number_format($product->preco, 2, ',', '.') }}</p>
                                    <a href="#"> 
                                        <button class="btn btn-comprar">
                                            <i class="fa-solid fa-cart-shopping me-2"></i> Comprar
                                        </button>
                                    </a>
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