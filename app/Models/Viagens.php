<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Motoristas;
use App\Models\Veiculos;

class Viagens extends Model
{
    use HasFactory;
    protected $table = 'viagens';

    protected $fillable = [
        'km_inicial',
        'km_final',
        'veiculo_id',
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculos::class);
    }

    public function motoristas()
    {
        return $this->belongsToMany(Motoristas::class, 'motorista_viagem', 'viagem_id', 'motorista_id');
    }
}