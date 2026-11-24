// Hilda Gimena Chura Guarachi

1. Datos de mi caso
Mi caso es la sincronización masiva del departamento actual de los empleados.
- Volumen: Manejo alrededor de 1,000 empleados activos.
- Forma de los datos: Cada empleado tiene un ID (clave), un departamento actual y una lista de registros históricos.
- ¿Están ordenados? Los datos llegan desordenados.

2. Operaciones que hago
- Buscar: Encontrar al empleado por su ID para ver su historial.
- Ordenar: Ordenar el historial de cada empleado por fecha.
- Actualizar: Modificar el departamento actual en la base de datos.

3. ¿Cuáles hago más veces?
La operación que MÁS hago es **Buscar** (se hace 1.000 veces, una por cada empleado). La Actualización también se hace 1.000 veces, pero al final. Ordenar se hace con listas muy pequeñas (máximo 20 registros).