<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome',
        'descricao',
        'preco',
        'quantidade', 
        'foto',
        'categorias',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}