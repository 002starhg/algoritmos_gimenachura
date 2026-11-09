# H1 - Descripción del proceso a optimizar

**Nombre:** Gimena Chura

## 1. El proceso real y lento
El proceso que quiero optimizar es la **sincronización masiva del departamento actual de los empleados en la base de datos**. Cuando Recursos Humanos necesita actualizar la ubicación o departamento actual de cada empleado (`tabla_personal.departamento_actual`) basándose en su último registro de transferencias (`tabla_historial`), se ejecuta un script en PHP que recorre a todo el personal uno por uno.

**Quien lo sufre:** El personal de sistemas y administración de RRHH, quienes deben esperar a que el script termine. Si el proceso falla a la mitad, la base de datos queda desincronizada y genera errores en los reportes.
**Cantidad de datos:** El script procesa a **más de 1,000 empleados activos**. Para cada uno, busca en el historial todos sus registros asociados a transferencias de departamento. Algunos empleados tienen hasta 20 registros en su historial.
**Cuánto tarda hoy:** El script tarda entre **10 a 15 minutos**. Esto ocurre porque utiliza un bucle `while` en PHP que hace una consulta `SELECT` a la base de datos para cada empleado, ordena los datos en la memoria del servidor para encontrar la fecha de fin más reciente (`fecha_hasta`), y luego lanza un `UPDATE` individual. Es decir, realiza más de 2,000 peticiones a la base de datos en lugar de hacerlo de forma masiva.

## 2. Muestra de los datos reales (20 filas)
Así se ve la estructura de la tabla de historial de transferencias de donde se extrae el departamento más reciente (se usa la columna `fecha_hasta` para saber cuál es el registro más actual):

| ID_Empleado | Código_Concepto | Departamento_Destino | Fecha_Desde | Fecha_Hasta | Fecha_Registro |
| :--- | :--- | :--- | :--- | :--- | :--- |
| 1001 | 20001 | Desarrollo de Software | 2026-01-07 | 2026-12-31 | 2025-01-07 |
| 1001 | 20001 | Soporte Técnico | 2025-12-31 | 2026-01-07 | 2026-01-07 |
| 1002 | 20001 | Recursos Humanos | 2024-01-01 | 2024-12-31 | 2024-01-01 |
| 1002 | 20001 | Finanzas | 2025-01-01 | 2025-12-31 | 2025-01-01 |
| 1003 | 20001 | Marketing | 2023-05-10 | 2024-05-09 | 2023-05-10 |
| 1003 | 20001 | Ventas | 2024-05-10 | 2025-05-09 | 2024-05-10 |
| 1004 | 20001 | Logística | 2022-01-01 | 2022-12-31 | 2022-01-01 |
| 1004 | 20001 | Almacén | 2023-01-01 | 2023-12-31 | 2023-01-01 |
| 1005 | 20001 | Auditoría | 2024-01-01 | 2024-12-31 | 2024-01-01 |
| 1005 | 20001 | Contabilidad | 2025-01-01 | 2025-12-31 | 2025-01-01 |
| 1006 | 20001 | Legal | 2021-06-01 | 2022-06-01 | 2021-06-01 |
| 1006 | 20001 | Compras | 2022-06-02 | 2023-06-01 | 2022-06-02 |
| 1007 | 20001 | Operaciones | 2024-01-01 | 2025-12-31 | 2024-01-01 |
| 1007 | 20001 | Producción | 2026-01-01 | 2026-12-31 | 2026-01-01 |
| 1008 | 20001 | Investigación | 2023-01-01 | 2023-12-31 | 2023-01-01 |
| 1008 | 20001 | Desarrollo | 2024-01-01 | 2024-12-31 | 2024-01-01 |
| 1009 | 20001 | Calidad | 2022-05-15 | 2023-05-14 | 2022-05-15 |
| 1009 | 20001 | Seguridad | 2023-05-15 | 2024-05-14 | 2023-05-15 |
| 1009 | 20001 | Infraestructura | 2024-05-15 | 2025-05-14 | 2024-05-15 |
| 1009 | 20001 | Arquitectura | 2025-05-15 | 2026-05-14 | 2025-05-15 |
