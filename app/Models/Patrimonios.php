<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrimonios extends Model
{
    use HasFactory;

    protected $fillable = [
        'patrimonio',
        'nome',
        'marca',
        'modelo',
        'n_serie',
        'fornecedor',
        'ref',
        'obs_patrimonio',
        'situacao',
        'motivo_situacao',
        'id_user',
        'id_local',
        'id_categoria',
        'id_filial',
    ];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function local(){
        return $this->belongsTo(Local::class,'id_local');
    }

    public function categoria(){
        return $this->belongsTo(CategoriaPatrimonio::class,'id_categoria');
    }

    public function filial(){
        return $this->belongsTo(Filial::class,'id_filial');
    }

}
