<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Cep;

class CepController extends Controller
{
    public function index()
    {
        return view('cep.index');
    }

    public function show(Request $request)
    {
        $request->validate([
            'cep' => 'required|regex:/^[0-9]{8}$/',
        ], [
            'cep.required' => 'O CEP é obrigatório',
            'cep.regex' => 'Formato de CEP inválido',
        ]);

        $cep = $request->input('cep');

        $endereco = Cep::where('cep', $cep)->first() ?? $this->fetchCep($cep);

        return view('cep.index', ['endereco' => $endereco]);
    }

    private function fetchCep($cep)
    {
        try {
            $response = Http::get('https://viacep.com.br/ws/' . $cep . '/json/');

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['erro']) && $data['erro'] === true) {
                    return redirect('/')->withErrors('CEP não encontrado');
                }

                $endereco = new Cep;
                $endereco->cep = $data['cep'];
                $endereco->logradouro = $data['logradouro'];
                $endereco->bairro = $data['bairro'];
                $endereco->cidade = $data['localidade'];
                $endereco->estado = $data['uf'];
                $endereco->save();

                return $endereco;
            } else {
                return redirect('/')->withErrors('CEP não encontrado');
            }
        } catch (\Exception $e) {
            return redirect('/')->withErrors('Erro ao buscar CEP: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $endereco = Cep::find($id);

        if ($endereco) {
            $endereco->delete();

            return response()->json([
                'status' => 'DELETED',
                'message' => 'Registro deletado com sucesso',
            ], 200);
        } else {
            return response()->json([
                'status' => 'NOT-FOUND',
                'message' => 'Registro não encontrado',
            ], 404);
        }
    }

}
