<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('viagens', function (Blueprint $table) {
            $table->dropColumn('motorista_id');
        });
    }

    public function down()
    {
        Schema::table('viagens', function (Blueprint $table) {
            $table->foreignId('motorista_id')->constrained()->onDelete('cascade');
        });
    }
};
