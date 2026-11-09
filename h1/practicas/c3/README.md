# Práctica C3 - Medición de Búsqueda Lineal

**Nombre:** Gimena Chura Guarachi

## 1. Código de Búsqueda Lineal (JavaScript)
Hecho con JavaScript

```javascript
function busquedaLineal(lista, buscado) {
    for (let i = 0; i < lista.length; i++) {
        if (lista[i] === buscado) return i;
    }
    return -1;
}

// Generador de arreglos para las pruebas
function generarArreglo(n) {
    let arr = [];
    for(let i = 0; i < n; i++) {
        arr.push(i);
    }
    return arr;
}
