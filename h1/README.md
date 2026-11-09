# H1 - Descripción del proceso a optimizar

**Nombre:** Gimena Chura

## 1. El proceso real y lento
El proceso que quiero optimizar este mes es la **gestión manual de reservas y pensiones del restaurante de la UAB**. 
Hoy en día, los funcionarios piden su almuerzo enviando mensajes por WhatsApp, y el encargado del restaurante anota todo a mano en un cuaderno. 
**Quien lo sufre:** El encargado, que pierde horas revisando chats, y los empleados, que a veces se quedan sin comida porque el encargado no vio su mensaje.
**Cantidad de datos:** Se manejan entre 80 y 100 funcionarios diarios, y hay que calcular las pensiones mensuales de unos 50 empleados.
**Cuánto tarda hoy:** El encargado tarda alrededor de **2 horas al día** revisando mensajes, tachando nombres y calculando quién pagó qué, lo cual es propenso a errores humanos y pérdida de dinero en los descuentos de planilla.

## 2. Muestra de los datos reales (20 filas)
Así es como se ve la información que el encargado maneja hoy en su cuaderno (formato extraído de sus registros):

| N° | Nombre Funcionario | Fecha | Modalidad | ¿Asistió? | Monto (Bs) | Estado |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| 1 | Juan Pérez | 2024-10-28 | Esporádico | Sí | 18 | Confirmado |
| 2 | María López | 2024-10-28 | Pensión | Sí | 15 | Confirmado |
| 3 | Carlos Gómez | 2024-10-28 | Pensión | No | 15 | Cobrado |
| 4 | Ana Rodríguez | 2024-10-28 | Esporádico | Sí | 18 | Confirmado |
| 5 | Pedro Martínez | 2024-10-28 | Esporádico | Sí | 18 | Confirmado |
| 6 | Lucía Fernández | 2024-10-29 | Pensión | Sí | 15 | Confirmado |
| 7 | Jorge Díaz | 2024-10-29 | Pensión | Sí | 15 | Confirmado |
| 8 | Elena Ruiz | 2024-10-29 | Esporádico | Sí | 18 | Confirmado |
| 9 | Raúl Castro | 2024-10-29 | Esporádico | Sí | 18 | Confirmado |
| 10 | Sofía Vargas | 2024-10-29 | Pensión | Sí | 15 | Confirmado |
| 11 | Diego Silva | 2024-10-30 | Pensión | No | 15 | Cobrado |
| 12 | Laura Rojas | 2024-10-30 | Esporádico | Sí | 18 | Confirmado |
| 13 | Miguel Torres | 2024-10-30 | Esporádico | Sí | 18 | Confirmado |
| 14 | Carmen Flores | 2024-10-30 | Pensión | Sí | 15 | Confirmado |
| 15 | Pablo Mendoza | 2024-10-30 | Esporádico | Sí | 18 | Confirmado |
| 16 | Andrea Peña | 2024-10-31 | Pensión | Sí | 15 | Confirmado |
| 17 | Luis Herrera | 2024-10-31 | Pensión | Sí | 15 | Confirmado |
| 18 | Patricia Ortiz | 2024-10-31 | Esporádico | Sí | 18 | Confirmado |
| 19 | Fernando Ríos | 2024-10-31 | Esporádico | Sí | 18 | Confirmado |
| 20 | Valeria Sosa | 2024-10-31 | Pensión | No | 15 | Cobrado |
