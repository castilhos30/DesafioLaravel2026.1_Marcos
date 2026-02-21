<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPostModal">Criar</button>

<table class="table">
    <thead>
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
<div class="modal fade" id="createPostModal" tabindex="-1" aria-hidden="true">
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
@endforeach


</body>
</html>