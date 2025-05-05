<?php

namespace App\Http\Controllers\Site\Parametre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function getShow() {

      return view('pages.site.parametre.show');  
    }
}
