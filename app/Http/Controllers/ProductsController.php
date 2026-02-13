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
        $request->validate([
        'nome' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    $caminhoFoto = null;

    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
        $caminhoFoto = $request->foto->store('produtos', 'public');
    }

        Product::create([
            'user_id' => Auth::id(),
            'nome' => $request->nome,
            'descricao' => $request->descricao ?? 'Sem descrição',
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
            'categorias' => $request->categorias ?? 'Outros', 
            'foto' => $caminhoFoto,
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

public function adicionarAoCarrinho($id)
    {
        $product = Product::find($id);

        if(!$product) {
            abort(404);
        }

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantidade']++;
        } else {

            $cart[$id] = [
                "nome" => $product->nome,
                "quantidade" => 1,
                "preco" => $product->preco,
                "foto" => $product->foto
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }
    public function carrinho()
    {
       
        $carrinho = session()->get('cart', []);
        
        $total = 0;
        foreach($carrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        return view('carrinho', compact('carrinho', 'total'));
    }

}