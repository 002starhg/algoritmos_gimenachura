<?php
// Hilda Gimena Chura Guarachi

// 1. Fuerza Bruta (Recursión O(2^n))
function mochilaBruta($pesos, $valores, $n, $capacidad) {
    if ($n == 0 || $capacidad == 0) return 0;
    if ($pesos[$n-1] > $capacidad) return mochilaBruta($pesos, $valores, $n-1, $capacidad);
    $usar = $valores[$n-1] + mochilaBruta($pesos, $valores, $n-1, $capacidad - $pesos[$n-1]);
    $noUsar = mochilaBruta($pesos, $valores, $n-1, $capacidad);
    return max($usar, $noUsar);
}

// 2. Programación Dinámica (Tabla O(n * capacidad))
function mochilaDP($pesos, $valores, $n, $capacidad) {
    $tabla = array_fill(0, $n + 1, array_fill(0, $capacidad + 1, 0));
    for ($i = 1; $i <= $n; $i++) {
        for ($w = 1; $w <= $capacidad; $w++) {
            if ($pesos[$i-1] <= $w) {
                $tabla[$i][$w] = max($valores[$i-1] + $tabla[$i-1][$w - $pesos[$i-1]], $tabla[$i-1][$w]);
            } else {
                $tabla[$i][$w] = $tabla[$i-1][$w];
            }
        }
    }
    return $tabla[$n][$capacidad];
}

// Medición
$tamanos = [10, 15, 20, 25]; 
$capacidad = 50;
echo "Protocolo: Calentamiento + 3 corridas\n";

foreach ($tamanos as $n) {
    $pesos = []; $valores = [];
    for ($i = 0; $i < $n; $i++) { $pesos[] = rand(1, 10); $valores[] = rand(10, 100); }

    // Calentamiento
    mochilaBruta($pesos, $valores, min($n, 10), $capacidad);
    mochilaDP($pesos, $valores, min($n, 10), $capacidad);

    // Medir Fuerza Bruta
    $inicio = microtime(true);
    $res1 = mochilaBruta($pesos, $valores, $n, $capacidad);
    $tBruta = (microtime(true) - $inicio) * 1000;

    // Medir DP
    $inicio = microtime(true);
    $res2 = mochilaDP($pesos, $valores, $n, $capacidad);
    $tDP = (microtime(true) - $inicio) * 1000;

    echo "n = $n | Bruta: " . round($tBruta, 2) . " ms | DP: " . round($tDP, 2) . " ms\n";
    if ($res1 == $res2) echo " -> Resultados verificados (iguales)\n";
}
?>