<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos</title>

 <x-app-layout>   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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

         .pagination-wrapper nav {
            background-color: transparent !important;
            border: none !important;
        }
        .pagination-wrapper .d-sm-flex {
            justify-content: center !important;
            width: 100%;
        }
        .pagination-wrapper .d-sm-flex > div:first-child {
            display: none !important;
        }
        .pagination-wrapper .pagination {
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
            border-radius: 8px;
            margin-bottom: 0;
        }
        .pagination-wrapper .page-link {
            background-color: #1e1e1e !important;
            border-color: #333 !important;
            color: #ccc !important;
            padding: 10px 16px;
            transition: all 0.2s;
        }
        .pagination-wrapper .page-link:hover {
            background-color: #374151 !important;
            color: #fff !important;
            border-color: #555 !important;
        }
        .pagination-wrapper .page-item.active .page-link {
            background: linear-gradient(135deg, #AE171C 0%, #d62d35 100%) !important;
            border-color: #AE171C !important;
            color: #fff !important;
            font-weight: bold;
        }
        .pagination-wrapper .page-item.disabled .page-link {
            background-color: #111827 !important;
            color: #666 !important;
            border-color: #222 !important;
}

        .modal-content {
            background-color: #ffffff; 
            color: #1a1a1a !important; 
}

    .modal-header .modal-title {
    color: #ffffff !important; 
}

    .modal-body label {
    color: #4b5563 !important;
    font-weight: 600;
}

    .modal-body input, .modal-body select, .modal-body textarea {
    background-color: #f9fafb !important;
    color: #111827 !important;
    border: 1px solid #d1d5db !important;
}

        .modal-body p, .modal-body span {
             color: #111827 !important;
    }
    
</style>
</head>
<body class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Produtos</h1>
        @if(!Auth::user()->is_admin)
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProductModal">
            + Novo Produto
        </button>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm" style="white-space: nowrap;">
            <thead class="table-dark">
                <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Autor</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Qtd</th>
                <th style="width: 200px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->nome }}</td>
                <td>{{ $product->user->name}}</td>
                <td><span class="badge bg-secondary">{{ $product->categorias }}</span></td>
                <td>R$ {{ number_format($product->preco, 2, ',', '.') }}</td>
                <td>{{ $product->quantidade }}</td>
                <td>
                    
                    <button type="button" class="btn btn-info btn-sm text-white" 
                            data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $product->id }}" title="Ver Detalhes">
                        Ver
                    </button>
 @if(Auth::id() == $product->user_id || Auth::user()->is_admin) 
                    <button type="button" class="btn btn-warning btn-sm" 
                            data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}" title="Editar">
                        Editar
                    </button>
                    
                    <button type="button" class="btn btn-danger btn-sm" 
                            data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}" title="Excluir">
                        Excluir
                    </button>
@endif

@endforeach
       </tbody>
    </table>
    </div> <div class="d-flex justify-content-center mt-4 mb-5 pagination-wrapper">
        {{ $products->links() }}
    </div>

<!--Modal de Visualizar-->
@foreach ($products as $product)    
    <div class="modal fade" id="viewProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detalhes do Produto #{{ $product->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            <div class="modal-body">
                
                <div class="text-center mb-4">
                        <img src="{{ asset($product->foto) }}" 
                             alt="{{ $product->nome }}" 
                             class="img-fluid rounded shadow-sm" 
                             style="max-height: 250px; object-fit: contain;">
                </div>
                <div class="mb-3 border-bottom pb-2">
                    <label class="fw-bold text-muted small">NOME</label>
                    <p class="fs-5 mb-0">{{ $product->nome }}</p>
                </div>

                <div class="col-6 mb-3 border-bottom pb-2">
                        <label class="fw-bold text-muted small">AUTOR</label>
                        <p class="mb-0">{{ $product->user->name }}</p>
                    </div>

                <div class="mb-3 border-bottom pb-2">
                    <label class="fw-bold text-muted small">DESCRIÇÃO</label>
                    <p class="mb-0">{{ $product->descricao ?? 'Sem descrição.' }}</p>
                </div>

                <div class="row">
                    <div class="col-6 mb-3 border-bottom pb-2">
                        <label class="fw-bold text-muted small">CATEGORIA</label>
                        <p class="mb-0"><span class="badge bg-primary">{{ $product->categorias }}</span></p>
                    </div>

                    <div class="col-6 mb-3 border-bottom pb-2">
                        <label class="fw-bold text-muted small">ESTOQUE</label>
                        <p class="mb-0">{{ $product->quantidade }} unidades</p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted small">PREÇO</label>
                    <p class="fs-4 text-success fw-bold mb-0">R$ {{ number_format($product->preco, 2, ',', '.') }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<!--Modal de Editar-->

                    <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title">Editar Produto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body text-start">
                                        <div class="mb-3">
                                            <label>Nome</label>
                                            <input type="text" name="nome" class="form-control" value="{{ $product->nome }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Descrição</label>
                                            <input type="text" name="descricao" class="form-control" value="{{ $product->descricao }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Categoria</label>
                                            <select name="categorias" class="form-select" required>
                                                <option value="Acessório" {{ $product->categorias == 'Acessório' ? 'selected' : '' }}>Acessório</option>
                                                <option value="Peça" {{ $product->categorias == 'Peça' ? 'selected' : '' }}>Peça</option>
                                                <option value="Ferramenta" {{ $product->categorias == 'Ferramenta' ? 'selected' : '' }}>Ferramenta</option>
                                                <option value="Outros" {{ $product->categorias == 'Outros' ? 'selected' : '' }}>Outros</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label>Foto do Produto</label>
                                            <div class="text-center mb-2">
                                                <img id="preview-edit-{{ $product->id }}" src="{{ asset($product->foto) }}" class="img-thumbnail" style="max-height: 150px; display: block; margin: 0 auto;">
                                            </div>
                                            <input type="file" name="foto" class="form-control" 
                                            onchange="previewImage(this, 'preview-edit-{{ $product->id }}')">
                                        </div>

                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label>Preço</label>
                                                <input type="number" step="0.01" name="preco" class="form-control" value="{{ $product->preco }}" required>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label>Quantidade</label>
                                                <input type="number" name="quantidade" class="form-control" value="{{ $product->quantidade }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


<!--Modal de Deletar-->

                    <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Excluir Produto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body text-start">
                                        <p>Tem certeza que deseja apagar <strong>{{ $product->nome }}</strong>?</p>
                                        <p class="text-danger small">Essa ação não pode ser desfeita.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>



   <!--Modal de Criar-->

    <div class="modal fade" id="createProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Novo Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Descrição</label>
                        <input type="text" name="descricao" class="form-control" placeholder="Descrição do produto">
                    </div>

                    <div class="mb-3">
                        <label>Categoria</label>
                        <select name="categorias" class="form-select" required>
                            <option value="" disabled selected>Selecione...</option>
                            <option value="Acessório">Acessório</option>
                            <option value="Peça">Peça</option>
                            <option value="Ferramenta">Ferramenta</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Foto do Produto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label>Preço</label>
                            <input type="number" name="preco" class="form-control" placeholder="0.00" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label>Quantidade</label>
                            <input type="number" name="quantidade" class="form-control" placeholder="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Criar</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
</x-app-layout>