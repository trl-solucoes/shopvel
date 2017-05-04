<?php

namespace Shoppvel\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model {
	protected $fillable = [
		'nome',
		'marca_id',
		'marca',
        'categoria_id'
	];
    public function marca() {
        return $this->belongsTo(Marca::class);
    }
    
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
    
    public function scopeDestacado($query) {
        return $query->where('destacado', TRUE);
    }
}
