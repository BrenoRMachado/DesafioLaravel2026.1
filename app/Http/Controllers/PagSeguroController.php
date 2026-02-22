<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PagSeguroController extends Controller
{
    public function createCheckout(Request $request)
    {
        $produtoData = json_decode($request->produto, true);

        if (!$produtoData) {
            return redirect()->route('pagamento.erro');
        }

        $reference_id = (string) Str::uuid();

        $order = Order::create([
            'reference_id' => $reference_id,
            'status' => 'PENDING',
            'user_id' => auth()->id(),
            'produto_id' => $produtoData['id'],
            'valor_total' => $produtoData['preco'],
            'quantidade' => $produtoData['quantidade'],
        ]);

        $precoEmCentavos = (int) round($produtoData['preco'] * 100);

        $redirectUrl = "https://google.com.br"; 

        $body = [
            "reference_id" => $reference_id,
            "customer" => [
                "name" => auth()->user()->name,
                "email" => auth()->user()->email,
            ],
            "items" => [
                [
                    "reference_id" => "PROD_" . $produtoData['id'],
                    "name" => $produtoData['nome'],
                    "quantity" => (int) $produtoData['quantidade'],
                    "unit_amount" => $precoEmCentavos
                ]
            ],
            "notification_urls" => [
                "https://meusite.com.br/webhook" 
            ],
            "redirect_url" => $redirectUrl, 
        ];

        $response = Http::withoutVerifying() 
            ->withHeaders([
                'Authorization' => 'Bearer ' . config('services.pagseguro.token'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post(config('services.pagseguro.url_checkout'), $body);

        if ($response->successful()) {
            $data = $response->json();
            
            if (isset($data['links'])) {
                foreach ($data['links'] as $link) {
                    if ($link['rel'] == 'PAY') {
                        return redirect($link['href']);
                    }
                }
            }
        }

        return dd([
            'mensagem' => 'Erro na API do PagSeguro',
            'status' => $response->status(),
            'detalhes_do_erro' => $response->json(),
            'ajuda' => 'Verifique se o seu e-mail de usuário é um e-mail de teste do Sandbox.'
        ]);
    }
}