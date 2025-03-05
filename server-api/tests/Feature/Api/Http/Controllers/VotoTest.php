<?php
namespace FeatureTestVoto;

use App\Models\Pauta;
use App\Models\Sessao;
use App\Models\User;
use App\Models\Voto;
use Carbon\Carbon;
use Illuminate\Support\Carbon\now;
use Illuminate\Testing\Fluent\AssertableJson;

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

    return [$pauta, $sessao, $user];
}

test('should search voto', function () {
    $response = $this->get('/api/votos');

    $response->assertOk();
});

test('should create voto', function () {
    [$pauta, $sessao, $user] = factoryCreate();

    $voto = [
        'sessao_id' => $sessao->id,
        'user_id'   => $user->id,
        'voto'      => true,
    ];

    $response = $this->postJson('/api/votos', $voto);
    $response
        ->assertStatus(201)
        ->assertJsonStructure([
            'sessao_id',
            'user_id',
            'voto',
        ]);
});

test('should be an error when create voto', function () {
    $response = $this->post('/api/votos');

    $response
        ->assertStatus(422)
        ->assertJson(fn(AssertableJson $json) =>
            $json
                ->has('message')
                ->has('errors'));
});

test('should be an error when create voto is not boolean', function () {
    [$pauta, $sessao, $user] = factoryCreate();

    $voto = [
        'sessao_id' => $sessao->id,
        'user_id'   => $user->id,
        'voto'      => 'eu não quero votar',
    ];

    $response = $this->postJson('/api/votos', $voto);

    $response
        ->assertStatus(422)
        ->assertJson(fn(AssertableJson $json) =>
            $json
                ->has('message')
                ->has('errors'));
});

test('should show voto_id', function () {
    [$pauta, $sessao, $user] = factoryCreate();

    $dataVoto = [
        'sessao_id' => $sessao->id,
        'user_id'   => $user->id,
        'voto'      => true,
    ];

    $voto = Voto::create($dataVoto);

    $response = $this->get('/api/votos/' . $voto->id);
    $response
        ->assertOk()
        ->assertJson(['id' => $voto->id]);
});
