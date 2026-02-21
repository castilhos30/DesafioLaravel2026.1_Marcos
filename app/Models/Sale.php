<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'comprador_id',
        'vendedor_id',
        'product_id',
        'valor',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function comprador()
    {
        return $this->belongsTo(User::class, 'comprador_id');
    }
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }
}
