<?php

namespace App\Http\Controllers\Api;

use App\Models\Cep;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class CepController extends Controller
{
    /**
     * Exibe um endereço baseado no CEP.
     *
     * @param  string  $cep
     * @return \Illuminate\Http\Response
     */
    public function show($cep)
    {
        $cep = preg_replace('/\D/', '', $cep);

        if (!preg_match('/^[0-9]{8}$/', $cep)) {
            return response()->json([
                'status' => 'WRONG FORMAT',
            ], 400);
        }

        $endereco = Cep::where('cep', $cep)->first();

        if (!$endereco) {
            $response = Http::get('https://viacep.com.br/ws/' . $cep . '/json/');

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['erro']) && $data['erro'] === true) {
                    return response()->json([
                        'status' => 'NOT-FOUND',
                    ], 404);
                }

                $data['cep'] = str_replace('-', '', $data['cep']);
                $endereco = new Cep;
                $endereco->cep = $data['cep'];
                $endereco->logradouro = $data['logradouro'];
                $endereco->bairro = $data['bairro'];
                $endereco->cidade = $data['localidade'];
                $endereco->estado = $data['uf'];
                $endereco->save();

                return response()->json([
                    'status' => 'FOUND IN VIACEP AND SAVED IN DATABASE',
                    'data' => $endereco,
                ], 200);
            } else {
                return response()->json([
                    'status' => 'NOT-FOUND',
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'FOUND IN DATABASE',
                'data' => $endereco,
            ], 200);
        }
    }
}
