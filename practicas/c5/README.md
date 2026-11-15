# Práctica C5 - Torneo de Ordenamientos

**Nombre:** Gimena Chura Guarachi

Para armar mi torneo, comparé cómo se comporta la Inserción (que es de las lentas) contra MergeSort y QuickSort.

| Algoritmo | 10.000 datos | 20.000 datos | 40.000 datos |
| :--- | :--- | :--- | :--- |
| Inserción | 45 ms | 180 ms | 720 ms |
| MergeSort | 3 ms | 6 ms | 13 ms |
| QuickSort | 2 ms | 5 ms | 11 ms |

**Mis conclusiones:**
Se nota a leguas que la inserción es malísima para datos grandes. Cada vez que dupliqué los datos, su tiempo se multiplicó por 4 (de 45 pasó a 180, y luego a 720). En cambio, MergeSort y QuickSort se mantuvieron súper rápidos. 
En la vida real, para mi sistema, es mejor no hacer esto en PHP, sino mandarle un `ORDER BY` a la base de datos Informix para que ella haga el trabajo pesado.
