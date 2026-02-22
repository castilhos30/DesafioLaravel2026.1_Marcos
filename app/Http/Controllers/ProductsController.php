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

    public function pagina_produtos() 
    {
        $products = Product::all();
        return view('pagina_produtos', compact('products'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->is_admin) {
        return redirect()->back()->with('error', 'Administradores não podem criar produtos.');
    }
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
        if (!Auth::user()->is_admin) {
            return redirect()->back()->with('error', 'Acesso negado.');
        }    

      $data = $request->only(['nome', 'descricao', 'preco', 'quantidade', 'categorias']);

    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
        $data['foto'] = $request->foto->store('produtos', 'public');
    }

    $product->update($data);
    
    return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->back()->with('error', 'Acesso negado.');
        }

        $product->delete();
        return redirect()->route('products.index');
    }

    public function carrinho()
    {
        $carrinho = session()->get('carrinho', []);
        
        $total = 0;
        foreach($carrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        return view('carrinho', compact('carrinho', 'total'));
    }

    public function adicionarAoCarrinho(Request $request, $id) 
    {
        if (Auth::user()->is_admin) {
        return redirect()->back()->with('error', 'Administradores não podem realizar compras no sistema.');
    }

        $product = Product::find($id);

        if(!$product) {
            abort(404);
        }

        $carrinho = session()->get('carrinho', []);
        
        $qtdAdicionar = (int) $request->input('quantity', 1);

        if ($qtdAdicionar > $product->quantidade) {
            return redirect()->back()->with('error', 'Quantidade solicitada maior que o estoque!');
        }

        if(isset($carrinho[$id])) {
            if ($carrinho[$id]['quantidade'] + $qtdAdicionar <= $product->quantidade) {
                $carrinho[$id]['quantidade'] += $qtdAdicionar;
            } else {
                $carrinho[$id]['quantidade'] = $product->quantidade; 
                return redirect()->back()->with('warning', 'Estoque limite atingido no carrinho!');
            }
        } else {
            $carrinho[$id] = [
                "id" => $product->id,
                "nome" => $product->nome,
                "quantidade" => $qtdAdicionar, 
                "preco" => $product->preco,
                "foto" => $product->foto
            ];
        }

        session()->put('carrinho', $carrinho);
        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

    public function atualizarCarrinho(Request $request, $id)
    {
        $request->validate([
            'quantidade' => 'required|numeric|min:1'
        ]);

        $carrinho = session()->get('carrinho', []);

        if(isset($carrinho[$id])) {
            $produto = Product::find($id);
            $novaQtd = $request->quantidade;

            if ($novaQtd > $produto->quantidade) {
                $novaQtd = $produto->quantidade;
            }

            $carrinho[$id]['quantidade'] = $novaQtd;
            session()->put('carrinho', $carrinho);
        }

        return redirect()->back()->with('success', 'Carrinho atualizado!');
    }

    public function removerDoCarrinho($id)
    {
        $carrinho = session()->get('carrinho', []);

        if(isset($carrinho[$id])) {
            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);
        }

        return redirect()->route('carrinho')->with('success', 'Produto removido!');
    }
}