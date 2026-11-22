<?php
// Hilda Gimena Chura Guarachi

interface IReceptorPedidos {
    public function Registrar($pedido, $plazoMinutos);
    public function PrepararSiguiente();
    public function EstaPendiente($pedido);
    public function Pendientes();
}


// SOLUCIÓN INGENUA (traducida a php)
class ReceptorIngenuo implements IReceptorPedidos {
    private $lista = [];
    private $llegadas = 0;

    public function Registrar($pedido, $plazoMinutos) {
        $this->lista[] = ['nombre' => $pedido, 'plazo' => $plazoMinutos, 'llegada' => $this->llegadas++];
    }

    public function PrepararSiguiente() {
        $n = count($this->lista);
        if ($n === 0) return null;
        $mejor = 0;
        for ($i = 1; $i < $n; $i++) {
            $p = $this->lista[$i];
            $m = $this->lista[$mejor];
            if ($p['plazo'] < $m['plazo'] || ($p['plazo'] === $m['plazo'] && $p['llegada'] < $m['llegada'])) {
                $mejor = $i;
            }
        }
        $nombre = $this->lista[$mejor]['nombre'];
        array_splice($this->lista, $mejor, 1); // O(n): mueve todos los elementos
        return $nombre;
    }

    public function EstaPendiente($pedido) {
        foreach ($this->lista as $p) if ($p['nombre'] === $pedido) return true;
        return false;
    }

    public function Pendientes() {
        return count($this->lista);
    }
}


// ESTA SERIA MI SOLUCIÓN MEJORADA 

class ReceptorMejorado implements IReceptorPedidos {
    private $colaPrioridad;
    private $pendientes = [];
    private $contadorLlegada = 0;

    public function __construct() {
        $this->colaPrioridad = new SplPriorityQueue();
    }

    public function Registrar($pedido, $plazoMinutos) {
  
        $prioridad = -($plazoMinutos * 1000000 + $this->contadorLlegada);
        $this->colaPrioridad->insert($pedido, $prioridad);
        $this->pendientes[$pedido] = true;
        $this->contadorLlegada++;
    }

    public function PrepararSiguiente() {

        while (!$this->colaPrioridad->isEmpty()) {
            $pedido = $this->colaPrioridad->extract();
            if (isset($this->pendientes[$pedido])) {
                unset($this->pendientes[$pedido]);
                return $pedido;
            }
        }
        return null;
    }

    public function EstaPendiente($pedido) {
        return isset($this->pendientes[$pedido]);
    }

    public function Pendientes() {
        return count($this->pendientes);
    }
}

// PRUEBAS (incluye el desempate)

function ejecutar($g, $op, $arg, $plazo) {
    switch ($op) {
        case 'registrar': $g->Registrar($arg, $plazo); return '';
        case 'preparar':  return $g->PrepararSiguiente() ?? '(ninguno)';
        case 'esta':      return $g->EstaPendiente($arg) ? 'True' : 'False';
        default:          return (string)$g->Pendientes();
    }
}

function probar($titulo, $g) {
    $guion = [
        ['registrar','Torta',120,''], ['registrar','Galletas',30,''], ['registrar','Pan',120,''], ['registrar','Brazo',60,''],
        ['pendientes','',0,'4'],
        ['esta','Galletas',0,'True'], ['esta','Flan',0,'False'],
        ['preparar','',0,'Galletas'], ['esta','Galletas',0,'False'],
        ['preparar','',0,'Brazo'],
        ['registrar','Alfajor',30,''],
        ['preparar','',0,'Alfajor'], ['preparar','',0,'Torta'], ['preparar','',0,'Pan'],
        ['preparar','',0,'(ninguno)'], ['pendientes','',0,'0'],
    ];
    $bien = 0; $total = 0;
    foreach ($guion as [$op, $arg, $plazo, $esperado]) {
        $obtenido = ejecutar($g, $op, $arg, $plazo);
        if ($op === 'registrar') continue;
        $total++;
        if ($obtenido === $esperado) $bien++;
        else echo "   MAL en «$op $arg»: esperado $esperado, obtuvo $obtenido\n";
    }
    echo "$titulo: $bien de $total pasos correctos\n";
}

// CARGA PARA MEDIR (n registros + n preparaciones)

function ejecutarCarga($g, $n) {
    for ($i = 0; $i < $n; $i++) {
        $plazo = (($i * 6007) % 6 + 1) * 15;
        $g->Registrar("Q" . $i, $plazo);
    }
    $control = 0;
    for ($i = 0; $i < $n; $i++) {
        $r = $g->PrepararSiguiente();
        $control += $r === null ? 0 : strlen($r);
    }
    return $control;
}

// MAIN: pruebas + medición con protocolo

probar('ReceptorIngenuo ', new ReceptorIngenuo());
probar('ReceptorMejorado', new ReceptorMejorado());

echo "\n--- Medición: 1 calentamiento + 3 corridas + promedio ---\n\n";


$tamanos = [2000, 4000, 8000]; // n, 2n, 4n
$resultados = [];

foreach ($tamanos as $n) {
    // Calentamiento (no se mide)
    ejecutarCarga(new ReceptorIngenuo(), $n);
    ejecutarCarga(new ReceptorMejorado(), $n);

    // Ingenua: 3 corridas medidas
    $tiemposIng = [];
    for ($r = 0; $r < 3; $r++) {
        $t0 = microtime(true);
        ejecutarCarga(new ReceptorIngenuo(), $n);
        $tiemposIng[] = (microtime(true) - $t0) * 1000;
    }
    $promIng = array_sum($tiemposIng) / 3;

    // Mejorada: 3 corridas medidas
    $tiemposMej = [];
    for ($r = 0; $r < 3; $r++) {
        $t0 = microtime(true);
        ejecutarCarga(new ReceptorMejorado(), $n);
        $tiemposMej[] = (microtime(true) - $t0) * 1000;
    }
    $promMej = array_sum($tiemposMej) / 3;

    $detIng = implode(', ', array_map(fn($t) => round($t, 2), $tiemposIng));
    $detMej = implode(', ', array_map(fn($t) => round($t, 2), $tiemposMej));

    echo "n = $n\n";
    echo "  Ingenua  : prom " . round($promIng, 2) . " ms  [corridas: $detIng]\n";
    echo "  Mejorada : prom " . round($promMej, 2) . " ms  [corridas: $detMej]\n\n";

    $resultados[] = ['n' => $n, 'ing' => $promIng, 'mej' => $promMej];
}

echo "--- Resumen de l resultado ---\n";
foreach ($resultados as $r) {
    echo "n={$r['n']} | Ingenua={$r['ing']} ms | Mejorada={$r['mej']} ms\n";
}