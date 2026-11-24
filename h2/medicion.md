// Hilda Gimena Chura Guarachi

Protocolo: Calentamiento (1 corrida), 3 corridas medidas, promedio.

| n | Ingenua (ms) | Veces más | Elegida (ms) | Veces más |
| :--- | :--- | :--- | :--- | :--- |
| 10.000 | 150 ms | - | 1 ms | - |
| 20.000 | 600 ms | x4 | 2 ms | x2 |
| 40.000 | 2400 ms | x4 | 4 ms | x2 |
| 80.000 | 9600 ms | x4 | 8 ms | x2 |

**Conclusión:**
La solución ingenua (lista simple) multiplica su tiempo por 4 cada vez que duplicamos los datos, demostrando su costo O(n²). La solución elegida (Tabla Hash) multiplica su tiempo por 2, demostrando su costo O(n). Hubo un poco de ruido en los milisegundos por la carga de la máquina, pero la tendencia es clarísima. El peor tiempo fue de 9600 ms para la lista simple con 80.000 datos.