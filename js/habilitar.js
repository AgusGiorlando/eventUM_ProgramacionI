function habilitar(idcheck, idtxt) {
    if (document.getElementById(idcheck).checked) {
        document.getElementById(idtxt).disabled = false;
    } else {
        document.getElementById(idtxt).disabled = true;
    }
}