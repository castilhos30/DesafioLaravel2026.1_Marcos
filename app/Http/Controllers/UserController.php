<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminMensagemMail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('address')->get();
        return view('admin.userlist', compact('users'));
    }

   public function update(Request $request, User $user)
{
    
    if (Auth::id() !== $user->id && !Auth::user()->is_admin) {
        return redirect()->route('usuarios.index')->with('error', 'Ação não permitida.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'cpf' => 'nullable|string|unique:users,cpf,' . $user->id, 
    ]);

    $data = $request->only(['name', 'email', 'telefone', 'data_nascimento', 'cpf']);

    if ($request->filled('password')) {
        $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
    }

    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
        $data['foto'] = $request->foto->store('usuarios', 'public');
    }

    $user->update($data);

    if ($user->address) {
        $user->address->update($request->only([
            'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado'
        ]));
    }

    return redirect()->route('usuarios.index');
}
    public function store(Request $request)
    {
        
        $caminhoFoto = null;
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $caminhoFoto = $request->foto->store('usuarios', 'public');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $caminhoFoto,
            'telefone' => $request->telefone,
            'cpf' => $request->cpf,
            'data_nascimento' => $request->data_nascimento,
        ]);
        Address::create([
            'user_id' => $user->id,
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
        ]);

        return redirect()->route('usuarios.index');
    }

    public function destroy(User $user)
    {
       if (Auth::id() !== $user->id && !Auth::user()->is_admin) {
            return redirect()->route('index')->with('error', 'Ação não permitida. Você só pode editar o seu próprio perfil.');
        }
        $user->delete();
        return redirect()->route('index');
    }

    public function enviarEmail(Request $request, User $user)
{
    if (!auth()->user()->is_admin) {
        abort(403);
    }

    $request->validate([
        'assunto' => 'required|string|max:255',
        'mensagem' => 'required|string',
    ]);


    Mail::to($user->email)->send(new AdminMensagemMail($request->assunto, $request->mensagem));

    return redirect()->back()->with('success', 'E-mail enviado com sucesso para ' . $user->name);
}
}