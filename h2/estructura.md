// Hilda Gimena Chura Guarachi

Para mi caso, elijo usar una **Tabla Hash** (Dictionary/Map) para la búsqueda de empleados por su ID.

| Operación | Cuántas veces la hago | Costo O |
| :--- | :--- | :--- |
| Buscar empleado por ID | 1.000 veces (lo más frecuente) | O(1) |
| Insertar nuevo empleado | 1.000 veces | O(1) |
| Ordenar historial | 1.000 veces (listas pequeñas) | O(n log n) |

**¿Por qué no uso una lista simple?**
Porque buscar en una lista simple cuesta O(n). Si tengo 1,000 empleados y busco a cada uno, tendría que recorrer la lista entera cada vez (1,000 * 1,000 = 1,000,000 de operaciones). Con la Tabla Hash, encuentro a cada empleado en O(1), en un solo paso.