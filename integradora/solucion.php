<?php

// Hilda Gimena Chura Guarachi

interface IPlanificador {
    public function Elegir($paquetes, $capacidadKg);
    public function EstaEnElViaje($codigo);
}

// la solucion ingenua

class PlanificadorIngenuo implements IPlanificador {
    private $elegidos = [];

    public function Elegir($paquetes, $capacidadKg) {

        $n = count($paquetes);
        $mejor = 0;
        $mejorMascara = 0;

        for ($mascara = 0; $mascara < (1 << $n); $mascara++) {
            
            $kg = 0; $ganancia = 0;
            for ($i = 0; $i < $n; $i++) {
                if (($mascara & (1 << $i)) != 0) {
                    $kg += $paquetes[$i]['kg'];
                    $ganancia += $paquetes[$i]['ganancia'];
                }
            }
            if ($kg <= $capacidadKg && $ganancia > $mejor) {
                $mejor = $ganancia;
                $mejorMascara = $mascara;
            }
        }

        $this->elegidos = [];
        for ($i = 0; $i < $n; $i++) {
            if (($mejorMascara & (1 << $i)) != 0) {
                $this->elegidos[] = $paquetes[$i]['codigo'];
            }
        }
        return [$mejor, $this->elegidos];
    }

    public function EstaEnElViaje($codigo) {
        return in_array($codigo, $this->elegidos);
    }
}

// esta podria ser la solucion mejorada 
class PlanificadorMejorado implements IPlanificador {

    private $enViaje = []; 

    // aqui se aplicaria la funcion principal 
    public function Elegir($paquetes, $capacidadKg) {
        $n = count($paquetes);

        $this->enViaje = [];

        if ($n == 0 || $capacidadKg <= 0) {
            return [0, []];
        }

        $dp = array_fill(0, $n + 1, array_fill(0, $capacidadKg + 1, 0));

        for ($i = 1; $i <= $n; $i++) {
            $kgActual = $paquetes[$i - 1]['kg'];
            $gananciaActual = $paquetes[$i - 1]['ganancia'];

            for ($w = 0; $w <= $capacidadKg; $w++) {

                if ($kgActual <= $w) {
                    
                    $dp[$i][$w] = max($dp[$i - 1][$w], $dp[$i - 1][$w - $kgActual] + $gananciaActual);
                } else {

                    $dp[$i][$w] = $dp[$i - 1][$w];
                }
            }
        }

        $w = $capacidadKg;
        for ($i = $n; $i > 0; $i--) {
            if ($dp[$i][$w] != $dp[$i - 1][$w]) {
                $codigo = $paquetes[$i - 1]['codigo'];

                $this->enViaje[$codigo] = true; 
                $w -= $paquetes[$i - 1]['kg'];  
            }
        }

        $elegidos = array_keys($this->enViaje);
        
        return [$dp[$n][$capacidadKg], $elegidos];
    }
// aqui estaria lo que se pide EstaEnElViaje.....

    public function EstaEnElViaje($codigo) {
        return isset($this->enViaje[$codigo]); 
    }
}


function Lote(...$datos) {
    return array_map(fn($d) => ['codigo' => $d[0], 'kg' => $d[1], 'ganancia' => $d[2]], $datos);
}

$casos = [

    ["el voraz se equivoca", Lote(["P1", 10, 60], ["P2", 20, 100], ["P3", 30, 120]), 50, 220, ["P2", "P3"]],
    ["cuatro paquetes",      Lote(["P1", 2, 3], ["P2", 3, 4], ["P3", 4, 5], ["P4", 5, 6]), 8, 10, ["P2", "P4"]],
    ["capacidad cero",       Lote(["P1", 5, 10], ["P2", 7, 12]), 0, 0, []],
    ["sin paquetes",         Lote(), 30, 0, []],
    ["nada cabe",            Lote(["P1", 40, 90], ["P2", 50, 100]), 30, 0, []],
    ["entran todos",         Lote(["P1", 5, 10], ["P2", 7, 12], ["P3", 3, 4]), 100, 26, ["P1", "P2", "P3"]],
];

function Probar($titulo, $fabrica, $casos) {
    $bien = 0; $total = 0;
    foreach ($casos as [$que, $paquetes, $capacidad, $esperada, $codigosEsperados]) {
        $plan = $fabrica();

        [$ganancia, $elegidos] = $plan->Elegir($paquetes, $capacidad);
        $total++;
       sort($codigosEsperados);
        sort($elegidos);

        $ok = ($ganancia == $esperada && $elegidos == $codigosEsperados);
        if ($ok) $bien++;
        else echo "   MAL en «$que»: esperado $esperada con [".implode(",", $codigosEsperados)."], obtuvo $ganancia con [".implode(",", $elegidos)."]\n";
    }
    $p = $fabrica();
    $p->Elegir($casos[0][1], $casos[0][2]);
    $total += 2;
    
    if ($p->EstaEnElViaje("P2")) $bien++; else echo "   MAL en EstaEnElViaje(P2)\n";

        if (!$p->EstaEnElViaje("P1")) $bien++; else echo "   MAL en EstaEnElViaje(P1)\n";
    echo "$titulo: $bien de $total pruebas correctas\n";
}

function EjecutarCarga($plan, $n) {
    mt_srand($n); 
    $paquetes = [];
    $pesoTotal = 0;

    for ($i = 0; $i < $n; $i++) {

        $kg = mt_rand(5, 59);
        $ganancia = mt_rand(10, 99);

        $paquetes[] = ['codigo' => "C$i", 'kg' => $kg, 'ganancia' => $ganancia];
        $pesoTotal += $kg;
    }
    $capacidad = intdiv($pesoTotal, 3);
    [$ganancia, $_] = $plan->Elegir($paquetes, $capacidad);
    return $ganancia;
}

echo "Iniciando con las pruebas\n";

    Probar("PlanificadorIngenuo ", fn() => new PlanificadorIngenuo(), $casos);
     Probar("PlanificadorMejorado", fn() => new PlanificadorMejorado(), $casos);

echo "\n Medición (n, n+2, n+4, n+6) \n";
$tamanos = [16, 18, 20, 22];
$res = [];


foreach ($tamanos as $n) {
    EjecutarCarga(new PlanificadorIngenuo(), $n);
        EjecutarCarga(new PlanificadorMejorado(), $n);


    $t_ing = [];
    for ($r=0; $r<3; $r++) {
        $t0 = microtime(true);
        $g1 = EjecutarCarga(new PlanificadorIngenuo(), $n);
        $t_ing[] = (microtime(true) - $t0) * 1000;
    }

    $t_mej = [];
    for ($r=0; $r<3; $r++) {
        $t0 = microtime(true);
        $g2 = EjecutarCarga(new PlanificadorMejorado(), $n);
        $t_mej[] = (microtime(true) - $t0) * 1000;
    }


    $prom_ing = array_sum($t_ing)/3;
    $prom_mej = array_sum($t_mej)/3;
    
    echo "n=$n | Gana_Ing=$g1, Gana_Mej=$g2 | Tiempo: Ing=".round($prom_ing,2)."ms, Mej=".round($prom_mej,2)."ms\n";
    $res[] = ['n'=>$n, 'ing'=>$prom_ing, 'mej'=>$prom_mej, 'g1'=>$g1, 'g2'=>$g2];
}

echo "\n Probando la solución con 1000 paquetes y capacidad 10000 \n";
mt_srand(1000);
$paq1000 = [];
for($i=0; $i<1000; $i++) $paq1000[] = ['codigo'=>"C$i", 'kg'=>mt_rand(5,59), 'ganancia'=>mt_rand(10,99)];
$t0 = microtime(true);
(new PlanificadorMejorado())->Elegir($paq1000, 10000);
echo "Tiempo: " . round((microtime(true)-$t0)*1000, 2) . " ms\n";


