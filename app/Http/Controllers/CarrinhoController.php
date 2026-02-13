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
}
