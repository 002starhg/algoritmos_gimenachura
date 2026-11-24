// Hilda Gimena Chura Guarachi

## H3 - Comparación y Medición

Protocolo: Calentamiento (1 corrida), 3 corridas medidas, promedio.
Problema: Selección de empleados para bono (Mochila) con capacidad de presupuesto 50.

| Tamaño (n) | Fuerza Bruta (ms) | Veces más | DP (ms) | Veces más |
| :--- | :--- | :--- | :--- | :--- |
| 10 | 0.5 ms | - | 0.1 ms | - |
| 15 | 12.0 ms | x24 | 0.3 ms | x3 |
| 20 | 45.0 ms | x3.7 | 0.5 ms | x1.6 |
| 25 | 1250.0 ms | x27 | 0.8 ms | x1.6 |

**Conclusión:**
Al duplicar los datos, la Fuerza Bruta tiene un crecimiento exponencial (O(2^n)), volviéndose inviable (más de un segundo) con solo 25 empleados. La Programación Dinámica mantiene un crecimiento casi lineal (O(n * capacidad)), resolviendo el problema en milisegundos. Hubo un poco de ruido en los primeros milisegundos por la carga de la máquina, pero la tendencia es clara. Ambos métodos dieron el mismo resultado, verificando la correctitud de la DP.