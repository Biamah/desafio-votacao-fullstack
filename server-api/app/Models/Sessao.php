<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;

    /**
     * Nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'sessoes';

    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'pauta_id',
        'data_inicio',
        'duracao',
        'status',
    ];

    /**
     * Atributos que devem ser ocultos para arrays ou JSON.
     *
     * @var array
     */
    protected $hidden = [
        // Campos sensíveis que não devem ser expostos
    ];

    /**
     * Atributos que devem ser convertidos para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'data_inicio' => 'datetime',
        'status'      => 'boolean', // true = aberta, false = fechada
    ];

    /**
     * Relacionamento: Uma sessão pertence a uma pauta.
     */
    public function pauta()
    {
        return $this->belongsTo(Pauta::class);
    }

    /**
     * Boot do modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Definir o valor padrão para a duração (1 minuto) se não for informada.
        static::creating(function ($sessao) {
            if (empty($sessao->duracao)) {
                $sessao->duracao = 1;
            }
            // Definir a data de início como o momento atual.
            $sessao->data_inicio = now();
            // Definir o status como aberto por padrão.
            $sessao->status = true;
        });
    }
}
