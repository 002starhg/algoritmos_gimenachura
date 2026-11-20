# H": inventario
**Nombre:** Gimena Chura Guarachi

## 1. Datos de mi caso
Mi caso es la **sincronización masiva del departamento actual de los empleados**.
*   **Volumen:** Manejo alrededor de 1,000 empleados activos.
*   **Forma de los datos:** Cada empleado tiene un ID (clave), un departamento actual y una lista de registros históricos (fechas de inicio y fin de cada transferencia).
*   **¿Están ordenados?** Los datos llegan desordenados (cada empleado se actualiza a medida que llegan los registros).

## 2. Operaciones que hago
En este proceso, las operaciones que realizo son:
1.  **Buscar:** Encontrar al empleado por su ID para ver su historial y su departamento actual.
2.  **Ordenar:** Ordenar el historial de cada empleado por fecha (`fecha_hasta`) para saber cuál es su último destino.
3.  **Actualizar:** Modificar el departamento actual en la base de datos.
