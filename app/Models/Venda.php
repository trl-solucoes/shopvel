<?php

namespace Shoppvel\Models;

use Illuminate\Database\Eloquent\Model;
use Shoppvel\User;

/**
 * Modelo de acesso aos dados de venda, tratados na frente como Pedidos.
 * O cliente de um pedido internamente é associado ao usuário que logou na 
 * aplicação
 */
class Venda extends Model {

    private $pagseguro = null;
    protected $dates = ['data_venda'];

    private function initPagSeguro() {
        if ($this->pagseguro == null) {
            $credentials = \PagSeguro::credentials()->get();
            $transaction = \PagSeguro::transaction()->get($this->pagseguro_transaction_id, $credentials);
            $this->pagseguro = $transaction->getInformation();
        }

        return $this->pagseguro;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function itens() {
        return $this->hasMany(VendaItem::class);
    }

    /**
     * Veja attribute mutators na documentação do Eloquent
     * 
     * @link https://laravel.com/docs/5.2/eloquent-mutators
     */
    public function getStatusPagamentoAttribute() {
        $this->initPagSeguro();

        return $this->pagseguro->getStatus()->getName();
    }

    /**
     * Veja attribute mutators na documentação do Eloquent
     * 
     * @link https://laravel.com/docs/5.2/eloquent-mutators
     */
    public function getMetodoPagamentoAttribute() {
        $this->initPagSeguro();

        return $this->pagseguro->getPaymentMethod()->getTypeName();
    }

    public function scopeNaoPagas($query) {
        return $query->where('pago', false);
    }

    public function scopePagas($query) {
        return $query->where('pago', true);
    }

    public function scopeFinalizadas($query) {
        return $query->where('enviado', true);
    }

}
