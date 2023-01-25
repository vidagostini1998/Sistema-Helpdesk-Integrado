<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_manutencao',
        'data_realizada',
        'solicitante',
        'tipo_manutencao',
        'motivo',
        'problema',
        'solucao',
        'obs_manutencao',
        'status_manutencao',
        'id_patrimonio',
        'id_local',
        'id_filial',
        'id_user'

    ];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function local(){
        return $this->belongsTo(Local::class,'id_local');
    }

    public function filial(){
        return $this->belongsTo(Filial::class,'id_filial');
    }

    public function patrimonio(){
        return $this->belongsTo(Patrimonios::class,'id_patrimonio');
    }

    
}
