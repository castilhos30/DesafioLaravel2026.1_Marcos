<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Address;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   protected $fillable = [
    'name',
    'email',
    'password',
    'foto',
    'is_admin',
    'cpf',
    'telefone',
    'data_nascimento',
    'saldo',
];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function address()
    {
    return $this->hasOne(Address::class);
    }

    public function getSaldoAttribute()
    {
        $totalVendas = \App\Models\Sale::where('vendedor_id', $this->id)->sum('valor');
        $totalCompras = \App\Models\Sale::where('comprador_id', $this->id)->sum('valor');
        return $totalVendas - $totalCompras;
    }
}
