<?php

namespace Shoppvel\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
	    protected $fillable = [
		'nome',
		'id'
	];

	public function produtos() {
        return $this->belongsTo(Produto::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
}
