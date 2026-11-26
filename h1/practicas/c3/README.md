# Práctica C3 - Medición de Búsqueda Lineal

**Nombre:** Gimena Chura Guarachi

## 1. Código de Búsqueda Lineal (PHP)

```php
<?php
// Hilda Gimena Chura Guarachi

function busquedaLineal($lista, $buscado) {
    $inicio = microtime(true);
    $encontrado = -1;
    
    for ($i = 0; $i < count($lista); $i++) {
        if ($lista[$i] == $buscado) {
            $encontrado = $i;
            break;
        }
    }
    
    $fin = microtime(true);
    return ($fin - $inicio) * 1000; // Retorna milisegundos
}
?>
