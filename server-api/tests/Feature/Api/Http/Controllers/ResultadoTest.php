<?php
namespace FeatureTestResultado;

use App\Models\Pauta;
use App\Models\Sessao;
use App\Models\User;
use App\Models\Voto;
use Carbon\Carbon;

function factoryCreate()
{
    $dataPauta = [
        'nome'      => 'Criando uma pauta teste',
        'descricao' => 'loreloresloores',
    ];

    $pauta = Pauta::create($dataPauta);

    $releaseDate = Carbon::now();

    $dataSessao = [
        'pauta_id'    => $pauta->id,
        'data_inicio' => $releaseDate->format('Y-m-d H:i:00'),
        'data_final'  => $releaseDate->addMinutes(1)->format('Y-m-d H:i:00'),
    ];

    $sessao = Sessao::create($dataSessao);

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

    return $pauta;
}

test('should search resultado', function () {
    $pauta = factoryCreate();

    $response = $this->get('/api/resultados/' . $pauta->id);
    $response
        ->assertStatus(200)
        ->assertJson([
            'pauta_id'  => $pauta->id,
            'total_sim' => 1,
            'total_nao' => 0,
        ]);
});

test('should be an error when count resultado', function () {
    $pauta_id = 'Pauta não informada';

    $response = $this->get('/api/resultados/' . $pauta_id);
    $response
        ->assertStatus(404);
});
