<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endereço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body { 
            background-color: #121212; 
            color: white; display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }
        .modal-dark { 
            background-color: #1e1e1e; 
            color: #fff; 
            border: 1px solid #333; }
        .form-control-dark { 
            background-color: #2c2c2c;
             border: 1px solid #444; 
             color: #fff; 
            }
        .form-control-dark:focus { 
            background-color: #2c2c2c; 
            border-color: #2ecc71; 
            color: #fff; 
            box-shadow: none;
         }
        .btn-success { 
            background-color: #2ecc71; 
            border: none; 
            color: #000; 
            font-weight: bold; 
        }
        .btn-success:hover { 
            background-color: #27ae60; 
        }
    </style>

</head>
<body>

{{-- Vai sair na merge --}}
    <div class="text-center">
        
        <button type="button" class="btn btn-outline-success btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#modalEndereco">
            <i class="bi bi-geo-alt-fill"></i> Adicionar Endereço
        </button>
    </div>

    <div class="modal fade" id="modalEndereco" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-dark">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title"><i class="bi bi-house-add me-2"></i> Novo Endereço</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <form id="formEndereco" action="{{ route('address.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-4">
                                <label class="form-label text-secondary">CEP</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-dark" placeholder="00000-000" id="cep" name="cep" required>
                                    <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-8">
                                <label class="form-label text-secondary">Logradouro</label>
                                <input type="text" class="form-control form-control-dark" id="logradouro" name="logradouro" required>
                            </div>
                            <div class="col-8">
                                <label class="form-label text-secondary">Complemento</label>
                                <input type="text" class="form-control form-control-dark" id="complemento" name="complemento" required>
                            </div>
                            <div class="col-4">
                                <label class="form-label text-secondary">Número</label>
                                <input type="text" class="form-control form-control-dark" id="numero" name="numero" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label text-secondary">Bairro</label>
                                <input type="text" class="form-control form-control-dark" id="bairro" name="bairro" required>
                            </div>
                            <div class="col-4">
                                <label class="form-label text-secondary">Cidade</label>
                                <input type="text" class="form-control form-control-dark" id="cidade" name="cidade" required>
                            </div>
                            <div class="col-2">
                                <label class="form-label text-secondary">UF</label>
                                <input type="text" class="form-control form-control-dark" id="estado" name="estado" maxlength="2" required>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" form="formEndereco" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>