<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Produtos</h1>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProductModal">
            + Novo Produto
        </button>
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

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
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
                <td><span class="badge bg-secondary">{{ $product->categorias }}</span></td>
                <td>R$ {{ number_format($product->preco, 2, ',', '.') }}</td>
                <td>{{ $product->quantidade }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm text-white" 
                            data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $product->id }}" title="Ver Detalhes">
                        Ver
                    </button>

                    <button type="button" class="btn btn-warning btn-sm" 
                            data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}" title="Editar">
                        Editar
                    </button>
                    
                    <button type="button" class="btn btn-danger btn-sm" 
                            data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}" title="Excluir">
                        Excluir
                    </button>

                    <div class="modal fade" id="viewProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title">Detalhes do Produto #{{ $product->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 border-bottom pb-2">
                                        <label class="fw-bold text-muted small">NOME</label>
                                        <p class="fs-5 mb-0">{{ $product->nome }}</p>
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

                    <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title">Editar Produto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('products.update', $product->id) }}" method="POST">
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

    <div class="modal fade" id="createProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Novo Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('products.store') }}" method="POST">
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
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label>Preço</label>
                                <input type="number" step="0.01" name="preco" class="form-control" placeholder="0.00" required>
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