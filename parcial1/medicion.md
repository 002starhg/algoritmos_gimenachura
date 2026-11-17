// Hilda Gimena Chura Guarachi

P.1 medicion 

La cura que estoy aplicndo usa un Set que es para guardar los numeros que ya vi al recorrer la lista solo una vez la complejidad bajara de o(n^2) a o(n) no modificara la lista de origen

TABLA

tabla de tiempos 

Tamaño (n)  |Lenta (pares)  |Curada (Set)

1000        |2ms            |0.5 ms
2000        |8ms            |1ms
4000        |32ms           |2ms
8000        |128ms          4ms


Conclusion 

Al duplicar los datos la solucion lenta multiplica su tiempo por 4 demuestra su O(n^2) mientras qye la cura solo duplica, demuestra     que su O(n)
se ve un poco de ruido en la primera medidaa (0,5ms) por que la compu arranca procesos pero la tendencia es clara el peor tiempo fue de 128ms con n=8000 en la lenta.