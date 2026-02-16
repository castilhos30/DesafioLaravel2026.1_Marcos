<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Produto - Dark Mode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        
        body {
            background-color: #121212 !important; 
            color: #e0e0e0; 
        }
        
       
        .product-image-container {
            background-color: #1e1e1e; 
            height: 450px; 
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
            background-color: #1e1e1e; 
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
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-black py-3 shadow-sm border-bottom border-secondary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-box-seam me-2"></i>RPM Motos</a>
        </div>
    </nav>

    <div class="container mt-5">
        
        <div class="mb-4">
            <a href="#" class="btn btn-outline-light btn-sm px-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar para a Página de Produtos
            </a>
        </div>

        <div class="card card-dark shadow-lg overflow-hidden">
            <div class="card-body p-0">
                <div class="row g-0">
                    
                    <div class="col-lg-6 p-4 d-flex align-items-center bg-black bg-opacity-25">
                        <div class="product-image-container w-100 shadow-sm">
                            <div class="text-center">
                                <img src="https://images.tcdn.com.br/img/img_prod/895069/carburador_completo_shineray_xy50q_traxx_star50_original_9525_3_cc24f3ad8894bdd5d70165b04bbaa4c5.png   " alt="Carburador Esportivo 200cc" class="img-fluid rounded"> 
                                <p class="mt-3 text-white-50 fw-light">Imagem do Produto</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 p-5">
                        
                        <div class="mb-3">
                            <span class="badge bg-primary bg-gradient me-2">Peças e Acessórios</span>
                            <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle-fill me-1"></i> Poucas unidades</span>
                        </div>

                        <h1 class="display-6 fw-bold text-white mb-4">Carburador Esportivo 200cc</h1>

                        <div class="mb-4 p-3 bg-black bg-opacity-25 rounded-3 border border-secondary border-opacity-25">
                            <span class="text-white-50 text-decoration-line-through me-2">R$ 3.200,00</span>
                            <div class="d-flex align-items-center">
                                <span class="price-tag me-3">R$ 2.890,00</span>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success">10% OFF</span>
                            </div>
                            <small class="text-white-50 d-block mt-1">À vista no Pix ou em até 12x de R$ 240,83 sem juros</small>
                        </div>

                        <div class="mb-5">
                            <span class="section-label">Sobre o Produto</span>
                            <p class="text-light lead fs-6" style="line-height: 1.7;">
                                Este é um carburador de alta performance ideal para competições. 
                                Feito com liga de alumínio resistente, garante melhor fluxo de combustível 
                                e aumento de potência para sua motocicleta. Compatível com modelos universais.
                            </p>
                            </p>
                        </div>

                        <hr class="border-secondary opacity-25 my-4">

                        <div class="row mb-4 g-3">
                            <div class="col-6 col-md-4">
                                <div class="p-3 bg-black bg-opacity-25 rounded border border-secondary border-opacity-10 text-center">
                                    <i class="bi bi-box-seam fs-4 text-primary mb-2 d-block"></i>
                                    <small class="text-white-50 fw-bold d-block mb-1">ESTOQUE</small>
                                    <span class="fs-5 fw-bold text-white">03 un.</span>
                                </div>
                            </div>
                            
                             <div class="col-6 col-md-4 d-none d-md-block">
                                <div class="p-3 bg-black bg-opacity-25 rounded border border-secondary border-opacity-10 text-center">
                                    <i class="bi bi-shield-check fs-4 text-primary mb-2 d-block"></i>
                                    <small class="text-white-50 fw-bold d-block mb-1">GARANTIA</small>
                                    <span class="fs-5 fw-bold text-white">1 Ano</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-3 d-md-flex justify-content-md-start">
                            <button class="btn btn-success btn-lg px-5 fw-bold py-3 flex-grow-1" type="button">
                                <i class="bi bi-bag-check-fill me-2"></i> COMPRAR AGORA
                            </button>
                            <button class="btn btn-outline-light btn-lg px-4 py-3" type="button" title="Adicionar aos favoritos">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center text-white-50 pb-5">
            <small>RPM Motos</small>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>