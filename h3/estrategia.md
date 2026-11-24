// Hilda Gimena Chura Guarachi

## H3 - Estrategia de mi caso

**¿Mi caso admite estrategia Voraz o Programación Dinámica?**
Mi caso original (sincronización de departamentos) es un problema de búsqueda, no de optimización. Por lo tanto, planteo un **problema análogo de mi área de Recursos Humanos**: *Seleccionar qué empleados recibirán un bono de ascenso con un presupuesto limitado, maximizando el puntaje total de rendimiento.*

**¿Por qué Programación Dinámica y no Voraz?**
*   Un algoritmo **Voraz** intentaría elegir primero al empleado con la mejor relación "puntaje por costo". Esto falla porque podría gastar todo el presupuesto en un solo empleado excelente, dejando fuera a dos empleados de puntaje medio que, juntos, sumarían un puntaje mayor. (Falta la propiedad de subestructura óptima para el voraz).
*   Usamos **Programación Dinámica** (Problema de la Mochila) porque tiene **subproblemas repetidos** (calcular el mejor puntaje para un presupuesto X con N empleados se repite). Usamos una tabla de abajo hacia arriba para guardar esos cálculos.

**¿Por qué es mejor que la Fuerza Bruta?**
La fuerza bruta evalúa todas las combinaciones de empleados (costo O(2^n)). Con 30 empleados, son más de 1.000 millones de combinaciones. Con Programación Dinámica, el costo es O(n * presupuesto), muchísimo más rápido.