<?php
namespace App\Http\Controllers;

use App\Models\Sessao;
use Illuminate\Http\Request;

class SessaoController extends Controller
{
    /**
     * Listar todas as sessões.
     */
    public function index()
    {
        $sessoes = Sessao::all();
        return response()->json($sessoes);
    }

    /**
     * Criar uma nova sessão.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pauta_id' => 'required|exists:pautas,id',
            'duracao'  => 'nullable|integer|min:1',
        ]);

        $sessao = Sessao::create($request->all());
        return response()->json($sessao, 201);
    }

    /**
     * Buscar uma sessão específica.
     */
    public function show($id)
    {
        $sessao = Sessao::findOrFail($id);
        return response()->json($sessao);
    }

    /**
     * Atualizar uma sessão.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'duracao' => 'sometimes|integer|min:1',
            'status'  => 'sometimes|boolean',
        ]);

        $sessao = Sessao::findOrFail($id);
        $sessao->update($request->all());
        return response()->json($sessao);
    }

    /**
     * Deletar uma sessão.
     */
    public function destroy($id)
    {
        $sessao = Sessao::findOrFail($id);
        $sessao->delete();
        return response()->json(null, 204);
    }
}
