<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaPatrimonio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_cate_patrimonio',
        'id_user'
    ];


    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
}
