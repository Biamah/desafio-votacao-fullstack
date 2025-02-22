<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $fillable = ['pauta_id', 'total_sim', 'total_nao'];

    public function pauta()
    {
        return $this->belongsTo(Pauta::class);
    }
}
