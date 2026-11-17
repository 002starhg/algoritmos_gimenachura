// Hilda Gimen Chura Guarachi

P.1 

Datos 
n=300.000 historias clinicas y 5.000 consultas

1.- recorrer todo por cada consulta:
Cada consulta cuesta O(n) = 300.000
total 5.000*300.000= 1.500.000.000 operaciones

2.- (ordenar n log n y buscar binario)
Ordenar cuesta 300.000*Log2(300.000) aprox = 300.000*18 = 5.400.000
las 5.000 busquedas cuestan 5.000*18 = 90.000
el total es 5.490.000 operaciones

3.- ordenar n^2 y buscar binario

ordenar cuesta 300.000^2 = 90.000.000.000 operaciones 

Elegir
 Opto por la opcion 2 es mas eficinete por que hacer 5.5 millones de operaciones es mucho mas rapido que los 1.500 millones de la 1.-

 cuando deberia cambiar de opinion?
 Cambiaria a la 1 si el hospital hiciera muy minimas consultas al dia si solo se busca 20 veces recorrer la lista cuesta 20*300.000 = 6.000.000 operaciones que casi lo mismo qye ordenar 5.4 millones y ahorro el tiempo de ordenar.