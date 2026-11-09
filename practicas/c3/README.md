# Práctica C3 - Medición de tiempos de búsqueda

**Nombre:** Gimena Chura

## 1. ¿Qué hice?
Para esta práctica hice un pequeño programa en JavaScript que busca un número dentro de una lista. La idea era medir cuánto tarda la computadora en encontrar ese número a medida que la lista se hace más y más grande.

Este es el código que utilicé (es una "búsqueda lineal", o sea, revisar uno por uno):

```javascript
function busquedaLineal(lista, buscado) {
    // Revisamos la lista número por número
    for (let i = 0; i < lista.length; i++) {
        if (lista[i] === buscado) {
            return i; // Si lo encuentra, devuelve la posición
        }
    }
    return -1; // Si termina de revisar y no lo encuentra, devuelve -1
}
