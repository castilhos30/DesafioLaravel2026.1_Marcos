<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('address')->get();
        return view('admin.userlist', compact('users'));
    }

    public function update(User $user, Request $request)
    {
   
     if (Auth::id() !== $user->id && !Auth::user()->is_admin) {
            return redirect()->route('index')->with('error', 'Ação não permitida. Você só pode editar o seu próprio perfil.');
        }

        $data = $request->only(['name', 'email']);
        
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $data['foto'] = $request->foto->store('usuarios', 'public');
        }
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        $user->update($data);
        Address::updateOrCreate(
            ['user_id' => $user->id],
            [
                'cep' => $request->cep,
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
            ]
        );

        return redirect()->route('index'); 
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

        return redirect()->route('index');
    }

    public function destroy(User $user)
    {
       if (Auth::id() !== $user->id && !Auth::user()->is_admin) {
            return redirect()->route('index')->with('error', 'Ação não permitida. Você só pode editar o seu próprio perfil.');
        }
        $user->delete();
        return redirect()->route('index');
    }
}