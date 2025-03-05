<?php

use App\Models\Pauta;
use App\Models\Sessao;
use App\Models\User;
use App\Models\Voto;
use Carbon\Carbon;

test('should search resultado', function () {
    $dataPauta = [
        'nome'      => 'Criando uma pauta teste',
        'descricao' => 'loreloresloores',
    ];

    $pauta       = Pauta::create($dataPauta);
    $releaseDate = Carbon::now();

    $dataSessao = [
        'pauta_id'    => $pauta->id,
        'data_inicio' => $releaseDate->format('Y-m-d H:i:00'),
        'data_final'  => $releaseDate->addMinutes(1)->format('Y-m-d H:i:00'),
    ];

    $sessao  = Sessao::create($dataSessao);
    $sessoes = Sessao::where('pauta_id', $pauta->id)->get();

    $dataUSers = [
        'name'     => 'Associado1',
        'email'    => "associado@email.com",
        'password' => '12345678',
    ];

    $user = User::create($dataUSers);

    $dataVoto = [
        'sessao_id' => $sessao->id,
        'user_id'   => $user->id,
        'voto'      => true,
    ];

    $voto = Voto::create($dataVoto);

    $totalSim = 0;
    $totalNao = 0;

    foreach ($sessoes as $sessao) {
        $totalSim += $sessao->votos->where('voto', true)->count();
        $totalNao += $sessao->votos->where('voto', false)->count();
    }

    $resultado = [
        'pauta_id'  => $pauta->id,
        'total_sim' => $totalSim,
        'total_nao' => $totalNao,
    ];

    $response = $this->getJson('/api/resultados/' . $pauta->id, $resultado);
    $response
        ->assertStatus(200)
        ->assertJsonStructure([
            'pauta_id',
            'total_sim',
            'total_nao',
        ]);
});

test('should be an error when count resultado', function () {
    $pauta_id = 'Pauta não informada';

    $response = $this->get('/api/resultados/' . $pauta_id);
    $response
        ->assertStatus(404);
});
