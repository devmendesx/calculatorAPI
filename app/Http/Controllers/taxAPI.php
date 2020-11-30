<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class taxAPI extends Controller
{
    public function getCalculate(Request $require)
    {
        
        $capital = $require->input('capital');
        $juros = $require->input('juros');
        $meses = $require->input('meses');
        if($capital == NULL)
        {
            return ['error'];
        }
        else
        {
            $taxCalculated = pow((1+($juros/100)),$meses);

            $result = $capital * $taxCalculated;
            
            return $result;
        }
    }
}   