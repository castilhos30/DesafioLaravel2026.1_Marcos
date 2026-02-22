<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $admins = User::where('is_admin', 1)->get();
        return view('admin.adminlist', compact('admins')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $caminhoFoto = null;
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $caminhoFoto = $request->foto->store('usuarios', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $caminhoFoto,
            'telefone' => $request->telefone,
            'cpf' => $request->cpf,
            'data_nascimento' => $request->data_nascimento,
            'is_admin' => 1,
            'criado_por' => Auth::id(), 
        ]);

        return redirect()->route('admin.index')->with('success', 'Administrador criado com sucesso!');
    }

    public function update(Request $request, User $admin)
    {
      
        if (Auth::id() !== $admin->id && $admin->criado_por !== Auth::id()) {
            return redirect()->route('admin.index')->with('error', 'Você não tem permissão para editar este administrador.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'cpf' => 'nullable|string|unique:users,cpf,' . $admin->id,
        ]);

        $data = $request->only(['name', 'email', 'telefone', 'data_nascimento', 'cpf']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $data['foto'] = $request->foto->store('usuarios', 'public');
        }

        $admin->update($data);

        return redirect()->route('admin.index')->with('success', 'Administrador atualizado!');
    }

    public function destroy(User $admin)
    {
        if (Auth::id() !== $admin->id && $admin->criado_por !== Auth::id()) {
            return redirect()->route('admin.index')->with('error', 'Você não tem permissão para excluir este administrador.');
        }

        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Administrador excluído!');
    }
}