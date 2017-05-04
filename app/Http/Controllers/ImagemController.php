<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;
use Shoppvel\Http\Requests;
use Illuminate\Support\Facades\Storage;

class ImagemController extends Controller {

    function getImagemFile($nome) {
        $imagem = Storage::disk('public')->get($nome);
        return response($imagem,200)->header('Content-Type', 'image/jpeg');
    }

}
