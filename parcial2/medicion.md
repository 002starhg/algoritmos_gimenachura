# Hilda Gimena Chura Guarachi

## P2.3 — Medición

**Protocolo aplicado:** 1 corrida de calentamiento (no medida) + 3 corridas medidas + promedio, por cada tamaño. Tamaños: n, 2n, 4n con n = 2.000.

| Solución | n = 2.000 | n = 4.000 | n = 8.000 |
| :--- | :--- | :--- | :--- |
| Ingenua (ms, promedio de 3) | 198,75 | 787,84 | 4.130,93 |
| Veces vs fila anterior | — | ×3,96 | ×5,24 |
| Mejorada (ms, promedio de 3) | 1,01 | 1,79 | 3,82 |
| Veces vs fila anterior | — | ×1,77 | ×2,14 |

**Corridas individuales (para mostrar el ruido):**

| n | Ingenua (3 corridas, ms) | Mejorada (3 corridas, ms) |
| :--- | :--- | :--- |
| 2.000 | 188,60 / 206,99 / 200,65 | 1,08 / 0,89 / 1,06 |
| 4.000 | 773,68 / 786,91 / 802,93 | 1,81 / 1,78 / 1,77 |
| 8.000 | 3.987,38 / 4.822,89 / 3.582,53 | 3,87 / 3,67 / 3,91 |

### Conclusión

Cuando duplique n, la solucion ingenua pasa de 198 ms a 788 ms (×3,96) y despues a 4.131 ms (×5,24). Ese segundo salto da un poquito mas de 4, pero la idea creo que es la misma ya que cada vez que duplico los datos el tiempo se multiplica por 4 o mas. Eso es justo lo que esperaba de un O(n²), se preparan n pedidos y en cada preparación hay que recorrer la lista entera. Por eso empeora tanto a medida que va creciendo.

La mejorada en cambio pasó de 1,01 ms a 1,79 ms (×1,77) y después a 3,82 ms (×2,14). Crecio más o menos ×2 cada vez que es lo que se espera de un O(n log n). La diferencia con la ingenua es enorme con 8.000 pedidos, una tardo 4 segundos y la otra 4 milisegundos, unas mil veces menos.

Sobre el ruido se nota bastante sobre todo en la ingenua. Con n = 8.000 una corrida tardó 3.582 ms y otra 4.823 ms, más del 30% de diferencia entre una y otra. Eso pasa por el recolector de basura de PHP, la caché y los procesos que corren de fondo en la maquina. En la mejorada el ruido se nota más en proporción porque los tiempos son de pocos milisegundos y cualquier interrupción pesa pero la tendencia a duplicarse se mantiene igual.

**Elección de n:** al principio hice la prueba con n = 10.000, pero la ingenua con 40.000 tardaba varios minutos y el enunciado pide que el mayor tamaño tarde entre 0,5 y 20 segundos. Así que bajé a n = 2.000: con el mayor tamaño (8.000) la ingenua tardó 4,13 segundos, dentro del rango, y pude medir los tres puntos sin quedarme esperando media hora.