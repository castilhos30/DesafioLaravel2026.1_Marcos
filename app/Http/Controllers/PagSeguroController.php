<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;

class PagSeguroController extends Controller
{
    public function createCheckout(Request $request)
    {
        $json = $request->input('itens');
        $cartProducts = $json ? json_decode($json, true) : [];

        if (empty($cartProducts)) {
            return redirect()->back()->with('error', 'Carrinho vazio!');
        }

        foreach ($cartProducts as $product) {
            $produtoModel = \App\Models\Product::find($product['id']);
            
            if ($produtoModel) {
               
                $produtoModel->decrement('quantidade', $product['quantidade']);
               
                \App\Models\User::where('id', $produtoModel->user_id)
                    ->increment('saldo', $product['preco'] * $product['quantidade']);
                
                \App\Models\Sale::create([
                    'product_id' => $produtoModel->id,
                    'vendedor_id' => $produtoModel->user_id,
                    'comprador_id' => \Illuminate\Support\Facades\Auth::id(),
                    'valor' => $product['preco'] * $product['quantidade'],
                ]);
            }
        }

   
        session()->forget('carrinho');
        $token = config('services.pagseguro.token');
        $url = config('services.pagseguro.checkout_url'); 

        $items = [];
        foreach ($cartProducts as $product) {
            $items[] = [
                'reference_id' => (string) ($product['id'] ?? uniqid()),
                'name' => $product['nome'],
                'quantity' => $product['quantidade'],
                'unit_amount' => ($product['preco'] * 100),
            ];
        }

        $body = [
            'reference_id' => 'PEDIDO_' . time(),
            'items' => $items,
        ];

        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ])->withoutVerifying()->post($url, $body);

        if ($response->successful()) {
            $data = $response->json();
            
            $paymentLink = null;
            if (isset($data['links'])) {
                foreach ($data['links'] as $link) {
                    if ($link['rel'] == 'PAY') {
                        $paymentLink = $link['href'];
                        break;
                    }
                }
            }

            if ($paymentLink) {
                return redirect()->away($paymentLink);
            }
        }

        return redirect()->route('historico.index')->with('success', 'Compra finalizada no sistema! (API de pagamento indisponível no momento)');
    }
}