<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Administradores</title>

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

        .modal-content, .modal-content p, .modal-content label {
            color: #1f2937 !important;
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
    </style>
</head>
<body>

{{-- BLOQUEIO DE SEGURANÇA: Só exibe se for Administrador --}}
@if(Auth::check() && Auth::user()->is_admin)

    <div class="container mt-4">
        {{-- ALERTAS DE ERRO E SUCESSO --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <strong>Atenção! Não foi possível salvar:</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
            <h1>Lista de Administradores</h1>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createAdminModal">
                + Novo Administrador  
            </button>
        </div>

        <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm" style="white-space: nowrap;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Criado Por (ID)</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($admins as $admin)
                <tr>
                    <th scope="row">{{ $admin->id }}</th>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->criado_por ?? 'Sistema' }}</td>
                    <td>    
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#showAdminModal{{ $admin->id }}">Visualizar</button>
                        
                        {{-- REGRA DO RF006: Editar e Excluir APENAS o próprio perfil ou os perfis criados por este admin --}}
                        @if(Auth::id() == $admin->id || $admin->criado_por == Auth::id()) 
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAdminModal{{ $admin->id }}">Editar</button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAdminModal{{ $admin->id }}">Deletar</button>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
        
    {{-- MODAL VIZUALIZAR --}}
    @foreach ($admins as $admin)
        <div class="modal fade" id="showAdminModal{{ $admin->id }}" tabindex="-1">  
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Visualizar Administrador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="fw-bold">Foto:</p>
                        @if($admin->foto)
                            <img src="{{ asset('storage/' . $admin->foto) }}" alt="Foto de Perfil" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin: 0 auto;">
                        @else
                            <div style="width: 100px; height: 100px; border-radius: 50%; background-color: #ccc; display: flex; align-items: center; justify-content: center; margin: 0 auto;">Sem foto</div>
                        @endif
                        
                        <p class="mt-3 fw-bold">Nome:</p>
                        <p>{{ $admin->name }}</p>
                        
                        <p class="fw-bold">Email:</p>
                        <p>{{ $admin->email }}</p>

                        <p class="fw-bold">Telefone:</p>
                        <p>{{ $admin->telefone ?? 'Não informado' }}</p>

                        <p class="fw-bold">CPF:</p>
                        <p>{{ $admin->cpf ?? 'Não informado' }}</p>

                        <p class="fw-bold">Data de Nascimento:</p>
                        <p>{{ $admin->data_nascimento ? \Carbon\Carbon::parse($admin->data_nascimento)->format('d/m/Y') : 'Não informada' }}</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center mt-5 mb-4 pagination-wrapper">
            {{ $admins->links() }}
        </div>

    {{-- MODAL EDITAR --}}
    @foreach ($admins as $admin)
    <div class="modal fade" id="editAdminModal{{ $admin->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body text-center">
                        <div class="mb-3 d-flex justify-content-center flex-column align-items-center">
                            <p class="fw-bold mb-1">Foto Atual:</p>
                            @if($admin->foto)
                                <img src="{{ asset('storage/' . $admin->foto) }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
                            @else
                                <div style="width: 100px; height: 100px; border-radius: 50%; background-color: #ccc; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">Sem foto</div>
                            @endif
                            <input type="file" name="foto" class="form-control form-control-sm w-75">
                        </div>

                        <p class="fw-bold mt-3">Nome:</p>
                        <input type="text" name="name" value="{{ $admin->name }}" class="form-control text-center">
                        
                        <p class="fw-bold mt-2">Email:</p>
                        <input type="email" name="email" value="{{ $admin->email }}" class="form-control text-center">
                        
                        <p class="fw-bold mt-2">Senha (Deixe em branco para manter):</p>
                        <input type="password" name="password" class="form-control text-center">

                        <p class="fw-bold mt-3">Telefone:</p>
                        <input type="text" name="telefone" value="{{ $admin->telefone ?? '' }}" class="form-control text-center">

                        <p class="fw-bold mt-3">CPF:</p>
                        <input type="text" name="cpf" value="{{ $admin->cpf ?? '' }}" class="form-control text-center">

                        <p class="fw-bold mt-3">Data de Nascimento:</p>
                        <input type="date" name="data_nascimento" value="{{ $admin->data_nascimento ?? '' }}" class="form-control text-center">
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    @endforeach

    {{-- MODAL CRIAR --}}
    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Criar Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Forçando a criação como Admin --}}
                    <input type="hidden" name="is_admin" value="1">

                    <div class="modal-body text-center">
                        <div class="mb-3 d-flex justify-content-center flex-column align-items-center">
                            <label for="foto" class="form-label fw-bold">Escolher Foto</label>
                            <input type="file" class="form-control form-control-sm w-75" name="foto" id="foto" accept="image/*">
                        </div>

                        <p class="fw-bold mt-3">Nome:</p>
                        <input type="text" name="name" class="form-control text-center" placeholder="Nome completo" required>

                        <p class="fw-bold mt-2">Email:</p>
                        <input type="email" name="email" class="form-control text-center" placeholder="exemplo@email.com" required>

                        <p class="fw-bold mt-2">Senha:</p>
                        <input type="password" name="password" class="form-control text-center" placeholder="******" required>
                        
                        <p class="fw-bold mt-3">Telefone:</p>
                        <input type="text" name="telefone" class="form-control text-center" placeholder="(00) 00000-0000">

                        <p class="fw-bold mt-3">CPF:</p>
                        <input type="text" name="cpf" class="form-control text-center" placeholder="000.000.000-00">

                        <p class="fw-bold mt-3">Data de Nascimento:</p>
                        <input type="date" name="data_nascimento" class="form-control text-center">
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Administrador</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL DELETAR --}}
    @foreach ($admins as $admin)
    <div class="modal" id="deleteAdminModal{{ $admin->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deletar Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <p class="fw-bold text-danger">Atenção!</p>
                        <p>Tem certeza que deseja excluir o administrador <strong>{{ $admin->name }}</strong>?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir Definitivamente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@else
    {{-- MENSAGEM CASO USUÁRIO COMUM TENTE ACESSAR --}}
    <div class="container mt-5 text-center">
        <div class="alert alert-danger shadow">
            <h4 class="alert-heading"><i class="bi bi-shield-lock-fill"></i> Acesso Negado</h4>
            <p>Você não tem permissão para visualizar o gerenciamento de administradores.</p>
        </div>
    </div>
@endif

</body>
</html>
</x-app-layout>