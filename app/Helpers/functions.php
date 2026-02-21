<?php

function formatarMoeda($valor)
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}


function formatarData($data)
{
    return \Carbon\Carbon::parse($data)->format('d/m/Y');
}


function apenasNumeros($string)
{
    return preg_replace('/\D/', '', $string);
}