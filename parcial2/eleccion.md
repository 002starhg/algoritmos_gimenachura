# Hilda Gimena Chura Guarachi

## P2.1 — Elección de estructura

| Operación | Veces en la jornada | Estructura elegida | Costo O |
| :--- | :--- | :--- | :--- |
| Registrar | 120.000 | SplPriorityQueue (heap) | O(log n) |
| PrepararSiguiente | 120.000 | SplPriorityQueue (heap) | O(log n) |
| EstaPendiente | 40.000 | Arreglo asociativo (hash) | O(1) |
| Pendientes | consultas puntuales | Contador entero | O(1) |

### ¿Por qué no sirve la lista simple? (con números)

Con la lista simple, `PrepararSiguiente` recorre TODA la lista para buscar el mínimo → O(n). Y `array_splice` (o `RemoveAt` en C#) además mueve todos los elementos → otro O(n). Hacerlo 120.000 veces con una lista que arranca en 120.000 pedidos da:

- 120.000 preparaciones × 60.000 comparaciones promedio ≈ 7.200.000.000 de comparaciones.
- 40.000 consultas `EstaPendiente` × 60.000 recorridos ≈ 2.400.000.000 de comparaciones.
- Total aproximado: ~10¹⁰ operaciones. Inviable.

Con mi estructura:

- 120.000 registros × log₂(120.000) ≈ 120.000 × 17 ≈ 2.040.000
- 120.000 preparaciones × log₂(120.000) ≈ 2.040.000
- 40.000 consultas × 1 = 40.000
- Total ≈ 4.100.000 operaciones.

Diferencia: ~2.400 veces menos trabajo. Por eso la lista simple no sirve.

### ¿Cuándo cambiaría de opinión?

Cambiaria si los pedidos no tuvieran plazo y se atendieran unicamente por orden de llegada (FIFO): ahi una cola simple da todo en O(1) y es mas simple que el HEAP. También si se necesitara cancelar un pedido arbitrario con frecuencia porque `SplPriorityQueue` no permite borrar por clave en O(log n); en este caso convendria un árbol balanceado o un HEAP que ademas guarde el indice de cada pedido.