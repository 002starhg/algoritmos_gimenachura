<?php
// Hilda Gimena Chura Guarachi
$n = 1000;
$lista = range(1, $n);
$hash = [];
foreach ($lista as $id) { $hash[$id] = true; }

$inicio = microtime(true);
for ($i = 0; $i < 100; $i++) { $encontrado = in_array(rand(1, $n), $lista); }
$tiempoLista = (microtime(true) - $inicio) * 1000;

$inicio = microtime(true);
for ($i = 0; $i < 100; $i++) { $encontrado = isset($hash[rand(1, $n)]); }
$tiempoHash = (microtime(true) - $inicio) * 1000;

echo "Lista: " . round($tiempoLista, 2) . " ms\n";
echo "Hash: " . round($tiempoHash, 2) . " ms\n";
?>