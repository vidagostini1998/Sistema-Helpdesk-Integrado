<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_local',
        'id_user',
    ];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
}
