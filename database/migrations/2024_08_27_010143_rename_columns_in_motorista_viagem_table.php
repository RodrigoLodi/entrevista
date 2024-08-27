<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('motorista_viagem', function (Blueprint $table) {
            $table->renameColumn('viagens_id', 'viagem_id');
            $table->renameColumn('motoristas_id', 'motorista_id');
        });
    }

    public function down()
    {
        Schema::table('motorista_viagem', function (Blueprint $table) {
            $table->renameColumn('viagem_id', 'viagens_id');
            $table->renameColumn('motorista_id', 'motoristas_id');
        });
    }

};
