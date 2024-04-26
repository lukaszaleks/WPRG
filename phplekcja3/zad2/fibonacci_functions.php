<?php

function fibonacciRekurencyjnie($n) {
    if ($n <= 1) {
        return $n;
    }
    return fibonacciRekurencyjnie($n - 1) + fibonacciRekurencyjnie($n - 2);
}

function fibonacciNierekurencyjnie($n) {
    $a = 0;
    $b = 1;
    for ($i = 0; $i < $n; $i++) {
        $temp = $a;
        $a = $b;
        $b = $temp + $b;
    }
    return $a;
}

?>
