# Práctica C4 - Búsqueda Lineal vs Búsqueda Binaria

**Nombre:** Gimena Chura Guarachi

Hice la prueba buscando un ID de empleado en un arreglo gigante de 100.000 datos y luego de 1.000.000, para ver cuánto tarda cada método.

| Tamaño de datos | Búsqueda Lineal (ms) | Búsqueda Binaria (ms) | Cuántas veces es más rápida la binaria |
| :--- | :--- | :--- | :--- |
| 100.000 | 2.2 | 0.01 | 220x |
| 1.000.000 | 21.5 | 0.02 | 1075x |

**¿Me conviene ordenar primero en mi proceso?**
En mi caso de RRHH, el script busca a un empleado a la vez. Si solo voy a buscar una vez, no vale la pena ordenar todo porque me tardaría más ordenando que buscando. 
Pero si en algún momento tuviera que buscar a los 1.000 empleados en memoria, ahí sí me convendría ordenar primero (con un algoritmo rápido) y luego hacer 1.000 búsquedas binarias, que serían casi instantáneas.
