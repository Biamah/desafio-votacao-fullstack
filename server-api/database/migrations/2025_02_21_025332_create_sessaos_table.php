<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as migrações.
     */
    public function up(): void
    {
        Schema::create('sessoes', function (Blueprint $table) {
            $table->id();                                                      // Coluna `id` (chave primária)
            $table->foreignId('pauta_id')->constrained()->onDelete('cascade'); // Chave estrangeira para a tabela `pautas`
            $table->dateTime('data_inicio');                                   // Data e hora de início da sessão
            $table->integer('duracao')->default(1);                            // Duração da sessão em minutos (padrão: 1 minuto)
            $table->boolean('status')->default(true);                          // Status da sessão (true = aberta, false = fechada)
            $table->timestamps();                                              // Colunas `created_at` e `updated_at`
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessoes');
    }
};
