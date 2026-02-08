<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nossa Loja - Todos os Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Inter', sans-serif;
        }

        .navbar-store {
            background-color: rgba(18, 18, 18, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #333;
        }

       
        .search-input {
            background-color: #1e1e1e;
            border: 1px solid #333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
        }
        .search-input:focus {
            background-color: #252525;
            border-color: #2ecc71;
            box-shadow: none;
            color: #fff;
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
        }
        .img-container i {
            color: #333;
            transition: color 0.3s;
        }
        .product-card:hover .img-container i {
            color: #555;
            transform: scale(1.1);
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

        
        .page-link {
            background: #1e1e1e;
            border-color: #333;
            color: #fff;
        }
        .page-item.active .page-link {
            background: #2ecc71;
            border-color: #2ecc71;
            color: #000;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-store sticky-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                <img src="https://t4.ftcdn.net/jpg/16/65/65/33/360_F_1665653395_iWwcbFAXRQ9yAAgGpVKGxTe3pHxsizhQ.jpg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                RPM Motos
            </a>
            
            <div class="d-none d-lg-block mx-auto" style="width: 40%;">
                <form class="position-relative">
                    <input type="text" class="form-control search-input" placeholder="O que você procura hoje?">
                    <button type="submit" class="btn position-absolute top-50 end-0 translate-middle-y me-2 text-muted">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="#" class="btn btn-outline-light position-relative border-0">
                    <i class="bi bi-cart3 fs-4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                        #
                    </span>
                </a>
                <a href="#" class="btn btn-outline-light border-0"><i class="bi bi-person-circle fs-4"></i></a>
            </div>
        </div>
    </nav>

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
                    </select>
                    <select class="form-select filter-select w-auto">
                        <option selected>Mais Recentes</option>
                        <option value="1">Menor Preço</option>
                        <option value="2">Maior Preço</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">

            <div class="col">
                <div class="product-card h-100">
                    <div class="img-container">
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3 shadow">OFERTA</span>
                        <i class="bi bi-box-seam-fill fs-1"></i>
                    </div>

                    <div class="p-4">
                        <div class="category-tag mb-2">Peças de Motor</div>
                        <h5 class="text-white fw-bold mb-3 text-truncate">Kit Turbo Garrett GT35</h5>
                        
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <small class="text-decoration-line-through text-muted d-block" style="font-size: 0.8rem">R$ 4.500,00</small>
                                <span class="price-main">R$ 3.990,00</span>
                            </div>
                        </div>
                        <small class="text-success d-block mt-2"><i class="bi bi-truck me-1"></i> Frete Grátis</small>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="product-card h-100">
                    <div class="img-container">
                        <i class="bi bi-speedometer fs-1"></i>
                    </div>
                    <div class="p-4">
                        <div class="category-tag mb-2">Acessórios</div>
                        <h5 class="text-white fw-bold mb-3 text-truncate">Conta Giros Monster 5"</h5>
                        <div class="d-flex justify-content-between align-items-end">
                            <span class="price-main">R$ 549,90</span>
                        </div>
                        <small class="text-secondary d-block mt-2">Em até 10x sem juros</small>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="product-card h-100">
                    <div class="img-container">
                        <i class="bi bi-tools fs-1"></i>
                    </div>
                    <div class="p-4">
                        <div class="category-tag mb-2">Ferramentas</div>
                        <h5 class="text-white fw-bold mb-3 text-truncate">Jogo de Chaves 150pçs</h5>
                        <div class="d-flex justify-content-between align-items-end">
                            <span class="price-main">R$ 890,00</span>
                        </div>
                        <small class="text-secondary d-block mt-2">Últimas unidades</small>
                    </div>
                </div>
            </div>

            

        </div> <div class="d-flex justify-content-center mt-5 mb-5">

        </div>
        
        <footer class="text-center text-muted py-4 border-top border-secondary border-opacity-25">
            <p class="mb-0">RPM Motos</p>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>