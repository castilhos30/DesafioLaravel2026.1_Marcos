<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'cep' => 'required',
            'logradouro' => 'required', 
            'numero' => 'required',
            'complemento'=> 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required|max:2',
        ]);

       
        
        auth()->user()->address()->updateOrCreate(
            ['user_id' => auth()->id()], 
            $data 
        );

        
        return redirect()->back()->with('success', 'Endereço atualizado com sucesso!');
    }
}