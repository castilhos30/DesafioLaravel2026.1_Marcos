<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = Product::all();
        return view('carrinho', compact('carrinho'));
    }

        public function purchase(){
            return view('purchase_error');
        }

   public function remover($id)
{
    $carrinho = session()->get('carrinho');
    if(isset($carrinho[$id])) {
        unset($carrinho[$id]);
        session()->put('carrinho', $carrinho);
    } 

    elseif(isset($carrinho[(int)$id])) {
        unset($carrinho[(int)$id]);
        session()->put('carrinho', $carrinho);
    }

    return redirect()->route('carrinho')->with('success', 'Item removido!');
}
}