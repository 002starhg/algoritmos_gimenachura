
# Hilda Gimena Chura Guarachi

## I1 ANALIZAR Y ELEGIR

**a) Costo de PlanificadorIngenuo.Elegir**
El costo es O(2^n * n) 
El ciclo exterior recorre las 2^n combinaciones posibles de paquetes (por eso el (1 << n)). Dentro, un ciclo de n (para ver qué paquetes entran en esa combinacion) al multiplicarlos da 2^n * n

**b) La recurrencia T(n) = 2 T(n-1) + 1 y el por que no se aplica el TEOREMA MAESTRO**
En este caso no aplica el Teorema Maestro el divide y vemceras porque la división no es del tipo T(n/b), sino que el problema se reduce en 1 (n-1), no se divide a la mitad
Si lo resolvemos por iteración o arbol de recursion T(n) = 2^n - 1 Es decir que cuesta O(2^n) lo cual se podria decir que es inviable.

**c) ¿Sirve un algoritmo VORAZ?**
No sirve por que un voraz elegiria primero el paquete con mejor ganancia por kg. 
**Contraejemplo** P1(10kg, 60Bs), P2(20kg, 100Bs), P3(30kg, 120Bs). Capacidad: 50kg.
- Ratio de P1 = 6 Bs/kg. Ratio de P2 = 5 Bs/kg. Ratio de P3 = 4 Bs/kg.
- El voraz agarra P1 (el de mayor ratio). Le quedan 40kg.
- Luego agarra P2  (ratio 5). Le quedan 20kg.
- P3 pesa 30kg, no entra    Total = 160 Bs.
- optimo real es llevar P2   +   P3 (50kg) = 220 Bs el voraz falla

**Estrategia que elegi**
La Programación Dinámica (Mochila 0/1) es una funciona por que el problema tiene subestructura óptima (la mejor solución para capacidad W se construye a partir de las mejores soluciones para capacidades menores) y los subproblemas superpuestos (se repite el calculo de que pasa con los primeros paquetes y cierta capacidad). El costo es O(n * capacidad) en tiempo y espacio

**d) Estructura para EstaEnElViaje**
Uso un Arreglo Asociativo (Hash) donde las claves son los codigos de los paquetes elegidos se consulta con isset() cuesta O(1), contra recorrer el arreglo de elegidos que cuesta O(n)


