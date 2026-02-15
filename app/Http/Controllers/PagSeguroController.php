<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagSeguroController extends Controller
{
    public function createCheckout(Request $request)
    {

        $token = config('services.pagseguro.token');
        $url = config('services.pagseguro.checkout_url'); 

        $json = $request->input('itens');
        $cartProducts = $json ? json_decode($json, true) : [];

        if (empty($cartProducts)) {
            return redirect()->back()->with('error', 'Carrinho vazio!');
        }
        $items = [];
        foreach ($cartProducts as $product) {
            $items[] = [
                'reference_id' => (string) ($product['id'] ?? uniqid()),
                'name' => $product['nome'],
                'quantity' =>$product['quantidade'],
                'unit_amount' =>($product['preco'] * 100),
            ];
        }

        $body = [
            'reference_id' => 'PEDIDO_' . time(),
            'items' => $items,
        ];

        $response = Http::withHeaders([
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
        return dd($response->json(), $body);
    }
}