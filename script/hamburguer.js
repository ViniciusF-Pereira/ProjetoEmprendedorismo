document.getElementById("hamburguerBtn").addEventListener("click", mostrarEsconderNavMobile);

// Abre a nav caso esteja fechada, e fecha caso esteja aberta em dispositivos mobile.
function mostrarEsconderNavMobile() {
    let nav = document.getElementsByClassName("navMenu")[0];

    nav.classList.toggle("mostrar");
    console.log("toggado")


}
