# Práctica C6 - Elección de algoritmo para mi caso

**Nombre:** Gimena Chura Guarachi

Para mi proceso de sincronización de departamentos, si tuviera que ordenar los registros en memoria, elegiría **QuickSort**.

**¿Por qué elegí QuickSort?**
Porque es muy rápido (O(n log n)) y, a diferencia de MergeSort, no necesita crear arreglos extra en la memoria, ordena todo "en el mismo lugar". Para un servidor que procesa miles de datos, ahorrar memoria es importantísimo.
Sé que QuickSort tiene un punto débil: si el pivote se elige mal, se vuelve lento. Así que, si lo programara, elegiría un pivote al azar para evitar ese problema.
Lo que vi en la práctica C5 me lo confirmó: QuickSort fue el más rápido de todos mis pruebas (11ms para 40.000 datos).
