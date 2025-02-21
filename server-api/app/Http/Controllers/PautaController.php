<?php
namespace App\Http\Controllers;

use App\Models\Pauta;
use Illuminate\Http\Request;

class PautaController extends Controller
{
    /**
     * Listar todas as pautas.
     */
    public function index()
    {
        $pautas = Pauta::all();
        return response()->json($pautas);
    }

    /**
     * Criar uma nova pauta.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $pauta = Pauta::create($request->all());
        return response()->json($pauta, 201);
    }

    /**
     * Buscar uma pauta específica.
     */
    public function show($id)
    {
        $pauta = Pauta::findOrFail($id);
        return response()->json($pauta);
    }

    /**
     * Atualizar uma pauta.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome'      => 'sometimes|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $pauta = Pauta::findOrFail($id);
        $pauta->update($request->all());
        return response()->json($pauta);
    }

    /**
     * Deletar uma pauta.
     */
    public function destroy($id)
    {
        $pauta = Pauta::findOrFail($id);
        $pauta->delete();
        return response()->json(null, 204);
    }
}
