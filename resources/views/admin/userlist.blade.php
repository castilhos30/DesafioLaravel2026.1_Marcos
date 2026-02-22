<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários RPM Motos</title>

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
     <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Usuários</h1>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">
            + Novo Usuário  
        </button>
    </div>

<div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm" style="white-space: nowrap;">
            <thead class="table-dark">
                <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>

    @foreach ($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>    
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showPostModal{{ $user->id }}">Visualizar</button>
                @if(Auth::user()->is_admin)
                <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#mailUserModal{{ $user->id }}">Enviar E-mail</button>
            @endif
                @if(Auth::id() == $user->id || Auth::user()->is_admin) 
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPostModal{{ $user->id }}">Editar</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePostModal{{ $user->id }}">Deletar</button>
                @endif
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
    
{{-- MODAL Vizualizar --}}

   @foreach ($users as $user)
    <div class="modal fade" id="showPostModal{{ $user->id }}" tabindex="-1">  
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Visualizar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body text-center">
                   <form action="">
                    <p class="fw-bold">Foto:</p>
                    
                    <img src="{{ $user->foto }}" alt="Foto de Perfil" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin: 0 auto;">
                    
                    <p class="mt-3">Nome:</p>
                    <p class="fw-bold">{{ $user->name }}</p>
                    
                    <p>Email:</p>
                    <p class="fw-bold">{{ $user->email }}</p>

                    <p class="fw-bold">Telefone:</p>
                    <p>{{ $user->telefone }}</p>

                    <p class="fw-bold">CPF:</p>
                    <p>{{ $user->cpf }}</p>

                     <p class="fw-bold">Saldo:</p>
                    <p>R$ {{ number_format($user->saldo, 2, ',', '.') }}</p>

                     <p class="fw-bold">Data de Nascimento:</p>
                    <p>{{ $user->data_nascimento ? \Carbon\Carbon::parse($user->data_nascimento)->format('d/m/Y') : 'Não informada' }}</p>
                    
                    <hr>
                    
                    <p>CEP:</p>
                    <p class="fw-bold">{{ $user->address->cep ?? 'Não informado' }}</p>
                    
                    <p>Logradouro:</p>
                    <p class="fw-bold">{{ $user->address->logradouro ?? 'Não informado' }}</p>
                    
                    <p>Número:</p>
                    <p class="fw-bold">{{ $user->address->numero ?? 'Não informado' }}</p>
                    
                    <p>Complemento:</p>
                    <p class="fw-bold">{{ $user->address->complemento ?? 'Não informado' }}</p>
                    
                    <p>Bairro:</p>
                    <p class="fw-bold">{{ $user->address->bairro ?? 'Não informado' }}</p>
                    
                    <p>Cidade:</p>
                    <p class="fw-bold">{{ $user->address->cidade ?? 'Não informado' }}</p>
                    
                    <p>Estado:</p>
                    <p class="fw-bold">{{ $user->address->estado ?? 'Não informado' }}</p>
                     </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="d-flex justify-content-center mt-5 mb-4 pagination-wrapper">
            {{ $users->links() }}
        </div>

   {{-- MODAL Editar --}}

@foreach ($users as $user)
<div class="modal fade" id="editPostModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('update', $user->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          
          <div class="modal-body text-center">
            
            <div class="mb-3 d-flex justify-content-center flex-column align-items-center">
                <p class="fw-bold mb-1">Foto Atual:</p>
                @if($user->foto)
                    <img src="{{ asset($user->foto) }}" 
                         alt="Foto de Perfil" 
                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
                @else
                    <div style="width: 100px; height: 100px; border-radius: 50%; background-color: #ccc; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                        <span>Sem foto</span>
                    </div>
                @endif
                
                <input type="file" name="foto" class="form-control form-control-sm w-75">
            </div>

            <p class="fw-bold mt-3">Nome:</p>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control text-center">
            
            <p class="fw-bold mt-2">Email:</p>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control text-center">
            
            <p class="fw-bold mt-2">Senha (Deixe em branco para manter):</p>
            <input type="password" name="password" class="form-control text-center">

             <p class="fw-bold mt-3">Telefone:</p>
            <input type="text" name="telefone" value="{{ $user->telefone ?? '' }}" class="form-control text-center">

             <p class="fw-bold mt-3">CPF:</p>
            <input type="text" name="cpf" value="{{ $user->cpf ?? '' }}" class="form-control text-center">

             <p class="fw-bold mt-3">Data de Nascimento:</p>
            <input type="date" name="data_nascimento" value="{{ $user->data_nascimento ?? '' }}" class="form-control text-center">

            <hr>

            <p class="fw-bold">CEP:</p>
            <input type="text" name="cep" value="{{ $user->address->cep ?? '' }}" class="form-control text-center">
            
            <p class="fw-bold mt-2">Logradouro:</p>
            <input type="text" name="logradouro" value="{{ $user->address->logradouro ?? '' }}" class="form-control text-center">
            
            <p class="fw-bold mt-2">Número:</p>
            <input type="text" name="numero" value="{{ $user->address->numero ?? '' }}" class="form-control text-center">
            
            <p class="fw-bold mt-2">Complemento:</p>
            <input type="text" name="complemento" value="{{ $user->address->complemento ?? '' }}" class="form-control text-center">
            
            <p class="fw-bold mt-2">Bairro:</p>
            <input type="text" name="bairro" value="{{ $user->address->bairro ?? '' }}" class="form-control text-center">
            
            <p class="fw-bold mt-2">Cidade:</p>
            <input type="text" name="cidade" value="{{ $user->address->cidade ?? '' }}" class="form-control text-center">
            
            <p class="fw-bold mt-2">Estado:</p>
            <input type="text" name="estado" value="{{ $user->address->estado ?? '' }}" class="form-control text-center">

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
<div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="modal-body text-center">
                    
                    <div class="mb-3 d-flex justify-content-center flex-column align-items-center">
                        <div style="width: 100px; height: 100px; border-radius: 50%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; font-size: 2rem; color: #6c757d;">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <label for="foto" class="form-label fw-bold">Escolher Foto</label>
                        <input type="file" class="form-control form-control-sm w-75" name="foto" id="foto" accept="image/*">
                    </div>

                    <p class="fw-bold mt-3">Nome:</p>
                    <input type="text" name="name" class="form-control text-center" placeholder="Nome completo">

                    <p class="fw-bold mt-2">Email:</p>
                    <input type="email" name="email" class="form-control text-center" placeholder="exemplo@email.com">

                    <p class="fw-bold mt-2">Senha:</p>
                    <input type="password" name="password" class="form-control text-center" placeholder="******">
                    
                    <p class="fw-bold mt-3">Telefone:</p>
                    <input type="text" name="telefone" class="form-control text-center" placeholder="(00) 00000-0000">

                    <p class="fw-bold mt-3">CPF:</p>
                    <input type="text" name="cpf" class="form-control text-center" placeholder="000.000.000-00">

                    <p class="fw-bold mt-3">Data de Nascimento:</p>
                    <input type="date" name="data_nascimento" class="form-control text-center">

                        <hr>
                    <p class="fw-bold">CEP:</p>
                    <input type="text" name="cep" class="form-control text-center" placeholder="00000-000">

                    <p class="fw-bold mt-2">Logradouro:</p>
                    <input type="text" name="logradouro" class="form-control text-center" placeholder="Rua, Av...">

                    <p class="fw-bold mt-2">Número:</p>
                    <input type="text" name="numero" class="form-control text-center">

                    <p class="fw-bold mt-2">Complemento:</p>
                    <input type="text" name="complemento" class="form-control text-center" placeholder="Apto, Bloco...">

                    <p class="fw-bold mt-2">Bairro:</p>
                    <input type="text" name="bairro" class="form-control text-center">

                    <p class="fw-bold mt-2">Cidade:</p>
                    <input type="text" name="cidade" class="form-control text-center">

                    <p class="fw-bold mt-2">Estado:</p>
                    <input type="text" name="estado" class="form-control text-center" placeholder="UF">
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL DELETAr --}}
@foreach ($users as $user)
<div class="modal" id="deletePostModal{{ $user->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Deletar Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('destroy', $user->id) }}" method="POST">
          @csrf
          @method('DELETE')
          
          <p>Tem certeza?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>


{{-- MODAL ENVIAR E-MAIL --}}

<div class="modal fade" id="mailUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enviar E-mail para: {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('admin.enviar_email', $user->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Assunto:</label>
                        <input type="text" name="assunto" class="form-control" placeholder="Assunto do e-mail" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Conteúdo da Mensagem:</label>
                        <textarea name="mensagem" class="form-control" rows="5" placeholder="Escreva sua mensagem aqui..." required></textarea>
                    </div>
                </div>
                
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Enviar Agora</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cepInputs = document.querySelectorAll('input[name="cep"]');

        cepInputs.forEach(input => {
            input.addEventListener('blur', function() {
                let cep = this.value.replace(/\D/g, ''); 
                
                if (cep.length === 8) {
                    let form = this.closest('form');
                    let logradouroInput = form.querySelector('input[name="logradouro"]');
                    logradouroInput.value = "Buscando...";
                    fetch('/api/cep/' + cep)
                        .then(response => {
                            if (!response.ok) throw new Error('Erro na rota');
                            return response.json();
                        })
                        .then(data => {
                            if (!data.erro && !data.error) {
                                form.querySelector('input[name="logradouro"]').value = data.logradouro || '';
                                form.querySelector('input[name="bairro"]').value = data.bairro || '';
                                form.querySelector('input[name="cidade"]').value = data.localidade || '';
                                form.querySelector('input[name="estado"]').value = data.uf || '';
                            } else {
                                alert("CEP não encontrado!");
                                logradouroInput.value = "";
                            }
                        })
                        .catch(error => {
                            console.error('Erro:', error);
                            alert("Falha ao comunicar com a API do CEP.");
                            logradouroInput.value = "";
                        });
                }
            });
        });
    });
</script>

</body>
</html>
</x-app-layout>  