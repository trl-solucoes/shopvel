<?php

namespace Shoppvel\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
	    protected $fillable = [
	    'marca_id',
		'nome',
		'id'
	];

	public function produtos() {
        return $this->hasMany(Produto::class);
    }

    public function marca() {
        return $this->belongsTo(Marca::class);
    }
}
