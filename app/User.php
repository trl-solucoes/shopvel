<?php

namespace Shoppvel;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'endereco',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function vendas() {
        return $this->hasMany(Models\Venda::class);
    }
    
    public function vendasNaoPagas() {
        return $this->vendas()->where('pago', false);
    }
    
    public function vendasPagas() {
        return $this->vendas()->where('pago', true);
    }
    
    public function vendasFinalizadas() {
        return $this->vendas()->where('enviado', true);
    }
}
