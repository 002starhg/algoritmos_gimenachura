// Hilda Gimena Chura Guarachi

function hayRepetidoCurado(carnets) {
    let vistos =new Set ();
    for (let i = 0; i < carnets.length; i++) {
        if (vistos.has(carnets[i]));{

            return true;
        }
        vistos.add(carnets[i]);
    }
    return false;
}