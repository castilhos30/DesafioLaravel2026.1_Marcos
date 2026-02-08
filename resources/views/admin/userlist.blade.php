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
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPostModal{{ $user->id }}">Editar</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePostModal{{ $user->id }}">Deletar</button>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
    
{{-- MODAL Vizualizar --}}

   @foreach ($users as $user)
    <div class="modal" id="showPostModal{{ $user->id }}" tabindex="-1">  
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Visualizar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <form action="">
                    <p>Nome:</p>
                    <p>{{ $user->name }}</p>
                    <p>Email:</p>
                    <p>{{ $user->email }}</p>
                     </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
   @endforeach

   {{-- MODAL Editar --}}
@foreach ($users as $user)
   <div class="modal" id="editPostModal{{ $user->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')
          <p>Nome:</p>
          <input type="text" name="name" value="{{ $user->name }}" >
          <p>Email:</p>
          <input type="email" name="email" value="{{ $user->email }}" >
          <p>Senha:</p>
          <input type="password" name="password" value="{{ $user->password }}" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
          </form> 
    </div>
  </div>
</div>
@endforeach

{{-- MODAL CRIAR --}}
<div class="modal" id="createPostModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store')}}" method="POST">
                    @csrf
                    <p>Nome:</p>
                    <input type="text" name="name">
                    <p>Email:</p>
                    <input type="email" name="email">
                    <p>Senha:</p>
                    <input type="password" name="password">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL DELETAr --}}

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


</body>
</html>