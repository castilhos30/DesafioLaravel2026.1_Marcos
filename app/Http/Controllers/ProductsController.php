<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    public function index()
    {
       
        $products = Product::all();
        return view('admin.productslist', compact('products'));
    }

  
   public function store(Request $request)
    {
        Product::create([
            'user_id' => Auth::id(),
            'nome' => $request->nome,
            'descricao' => $request->descricao ?? 'Sem descrição',
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
            'categorias' => $request->categorias ?? 'Outros', 
            
            'foto' => null,
        ]);

        return redirect()->route('products.index');
    }

  
    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        $product->update($data);
        
        return redirect()->route('products.index'); 
    }

 
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}