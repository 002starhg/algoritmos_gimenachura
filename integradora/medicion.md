

# Hilda Gimena Chura Guarachi

## I3 — MEDICION

**PROTOCOLO APLICADO:** 1 calentamiento + 3 corridas medidas + promedio. Tamaños: n, n+2, n+4, n+6 con n = 16

| Tamaño (n) | Ingenua (ms) | Veces vs anterior | Mejorada (ms) | Veces vs anterior |
| :--- | :--- | :--- | :--- | :--- |
| 16 | 33.28 | - | 0.18 | - |
| 18 | 157.31 | x4.72 | 0.21 | x1.16 |
| 20 | 720.39 | x4.57 | 0.34 | x1.61 |
| 22 | 3151.72 | x4.37 | 0.33 | x0.97 |

**VERIFICACION DE GANANCIA**
En cada tamaño se verifica que la ganancia que devuelve por el PlanificadorIngenuo y por el PlanificadorMejorado sea exactamente la misma para n=16 es 448, para n=18 es 624, para n=20 es 703 y para n=22 es 678. No hay errores ni diferencias

**CONCLUSION Y RUIDO**
La solución ingenua escala de forma exponencial al sumar 2 paquetes (pasar de n a n+2), el número de combinaciones se multiplica por 4 (\(2^{(n+2)} = 4 \cdot 2^n\)) por lo que el tiempo debería multiplicarse por 4 en esta corrida los resultados fueron limpios de 16 a 18 se multiplica por 4.72, de 18 a 20 por 4.57 y de 20 a 22 por 4.37. La forma es exactamente lo que se esperaba
La solucipn mejorada (Programación Dinámica) escala de forma polinómica, con tiempos bajísimos (menos de 1 ms), esas pequeñas variaciones (0.18 ms, 0.21 ms, 0.34 ms, 0.33 ms) son puro ruido por ser tiempos tan pequeños que cualquier interrupcion del sistema operativo creo que afecta la medicion.

**LA SOLUCION 1.000 PAQUETES Y CAPAC. 10.000:**
Al correr la prueba especial, tarda 743.91 ms. Esto demuestra que la programacion dinamica es viable incluso para volumenes de datos mucho mas grandes ya que completa la tabla en menos de un segundo.

**CON CAPACIDAD 1.000.000.000 DE KG**
La solucion puede fallar en la practica, el costo de la DP es O(n * capacidad) y si la capacidad es de mil millones, la tabla necesitaría n * 1.000.000.000 de celdas aunque se tuviera solo 100 paquetes serían 100 mil millones de celdas lo que agotaria toda la memoria RAM del sistema (Out of memory) y colapsaria para capacidades gigantes, la DP basada en peso no se puede usar; en este caso habria que usar otra tecnica, como ramificacion y poda (Branch and Bound) o programación dinamica basada en la ganancia (si la ganancia maxima fuera chica en lugar del peso).