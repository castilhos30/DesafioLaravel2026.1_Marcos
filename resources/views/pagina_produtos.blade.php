<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPM Motos - Catálogo</title>

 <x-app-layout>   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #111827 ;
            color: #e0e0e0;
            font-family: 'Inter', sans-serif;
        }

        nav, nav[class*="bg-white"] {
            background-color: #1f2937 !important; 
            border-bottom: 1px solid #374151 !important;
        }
        nav a, nav div, nav span { 
            color: #e5e7eb !important; 
            text-decoration: none !important; 
        }
        
        nav button.bg-white, input.bg-white {
            background-color: #1f2937 !important; 
            border: 1px solid #374151 !important;
            color: #e5e7eb !important; 
        }

        .search-input {
            background-color: #FFFFFF;
            border: 1px solid #333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
        }
        .filter-select {
            background-color: #1e1e1e;
            border: 1px solid #333;
            color: #ccc;
            border-radius: 8px;
        }

        .product-card {
            background-color: #1e1e1e;
            border: 1px solid transparent;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            border-color: #333;
            box-shadow: 0 15px 30px rgba(0,0,0,0.6);
        }

        .img-container {
            height: 250px;
            background-color: #181818;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden; /* Para a imagem não vazar */
        }
        .img-container i {
            color: #333;
            transition: color 0.3s;
        }
        .product-card:hover .img-container i {
            color: #555;
            transform: scale(1.1);
        }
        .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .price-main {
            color: #2ecc71; 
            font-weight: 800;
            font-size: 1.4rem;
        }
        .category-tag {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
        }

        .btn-comprar {
            background: linear-gradient(135deg, #AE171C 0%, #d62d35 100%);
            color: #FFFFFF;
            font-weight: bold;
            border-radius: 50px;
            border: none;
            width: 100%;
            padding: 8px;
            margin-top: 15px;
            transition: all 0.2s;
        }
        .btn-comprar:hover {
            background-color: #27ae60;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h1 class="fw-bold text-white mb-0">Catálogo</h1>
                <p class="text-secondary mt-1">Encontre as melhores peças para o seu projeto.</p>
            </div>
            <div class="col-md-6">
                <div class="d-flex gap-2 justify-content-md-end">
                    <select class="form-select filter-select w-auto">
                        <option selected>Todas as Categorias</option>
                        <option value="1">Peças</option>
                        <option value="2">Acessórios</option>
                        <option value="3">Ferramentas</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">

            @forelse($products as $product)
                <div class="col">
                    <div class="product-card h-100" onclick="window.location='{{ route('produto_individual', $product->id) }}'">
                        <div class="img-container">
                            @if($product->foto)
                                <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nome }}" class="product-img">
                            @else
                                <i class="bi bi-box-seam-fill fs-1"></i>
                            @endif
                        </div>

                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="category-tag mb-2">{{ $product->categorias }}</div>
                            <h5 class="text-white fw-bold mb-3 text-truncate">{{ $product->nome }}</h5>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-end">
                                    <span class="price-main">R$ {{ number_format($product->preco, 2, ',', '.') }}</span>
                                </div>
                             
                                    @if(!Auth::user()->is_admin)
                                    <form action="{{ route('add_to_cart', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-comprar">Comprar</button>
                                    </form>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h3 class="text-muted">Nenhum produto cadastrado ainda.</h3>
                </div>
            @endforelse

        </div> 

        <div class="d-flex justify-content-center mt-5 mb-5">
            {{-- {{ $products->links() }} --}}
        </div>
        
        <footer class="text-center text-muted py-4 border-top border-secondary border-opacity-25">
            <p class="mb-0">RPM Motos</p>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
</x-app-layout>