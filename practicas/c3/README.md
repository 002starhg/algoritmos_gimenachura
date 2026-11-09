# Práctica C3 - Medición de tiempos de búsqueda (Búsqueda Lineal)

**Nombre:** Gimena Chura

## 1. ¿Qué hice?
Para esta práctica simulé en PHP el cuello de botella que ocurre en mi sistema cuando se busca el último destino (o registro) de un empleado dentro de la tabla `kardex` de Informix. 

El script original recorre un arreglo de datos usando un bucle `while` con `odbc_fetch_array`, comparando las fechas (`f2`) una por una para encontrar la más reciente. Este es el código de la búsqueda lineal:

```php
<?php
function buscarUltimoDestino($registrosKardex) {
    $inicio = microtime(true); // Iniciamos el cronómetro
    $ultimoDestino = "";
    $fechaMayor = "0000-00-00";
    
    // Búsqueda lineal O(n): revisa todos los registros uno por uno
    for ($i = 0; $i < count($registrosKardex); $i++) {
        if ($registrosKardex[$i]['f2'] > $fechaMayor) {
            $fechaMayor = $registrosKardex[$i]['f2'];
            $ultimoDestino = $registrosKardex[$i]['g2'];
        }
    }
    
    $fin = microtime(true);
    return ($fin - $inicio) * 1000; // Retorna milisegundos
}
?>
2. La tabla de resultados
Para que las mediciones fueran de varios milisegundos, simulé arreglos con un tamaño inicial de 100.000 registros. Ejecuté el algoritmo 5 veces, promedié el tiempo, y luego repetí el proceso con arreglos 4 veces y 16 veces más grandes:

Tamaño del arreglo (n)	Prueba 1 (ms)	Prueba 2 (ms)	Prueba 3 (ms)	Prueba 4 (ms)	Prueba 5 (ms)	Promedio (ms)	Ratio
100.000 registros	2.1	2.3	2.0	2.2	2.4	2.2 ms	-
400.000 registros (4n)	8.5	8.1	8.8	8.3	8.2	8.38 ms	~ 3.8x
1.600.000 registros (16n)	33.2	34.1	32.9	33.5	33.0	33.34 ms	~ 3.9x

3. Mi conclusión
Sí, el tiempo dio cerca de x4 (3.8x y 3.9x).

Esto confirma empíricamente que la búsqueda lineal tiene una complejidad O(n). Si el arreglo de datos se hace 4 veces más grande, el algoritmo tarda 4 veces más porque tiene que iterar el doble de veces.

Aplicación:
Esto explica por qué el script masivo de actualización de destinos tarda hasta 15 minutos. Al usar PHP para hacer un bucle por cada empleado y una búsqueda lineal en sus registros de kardex, el tiempo crece exponencialmente si hay muchos datos. La optimización ideal sería no usar PHP para esto, sino mandar una sola consulta SQL con ORDER BY f2 DESC directamente al motor de Informix, que está optimizado en C para hacer estas búsquedas de forma muchísimo más rápida.
