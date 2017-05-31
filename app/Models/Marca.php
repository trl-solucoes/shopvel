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
        return $this->hasMany(Produto::class);
    }

    public function produto() {
        return $this->belongsTo(Produto::class);
    }
}
