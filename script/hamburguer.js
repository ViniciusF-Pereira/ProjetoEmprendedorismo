document.getElementById("hamburguerBtn").addEventListener("click", mostrarEsconderNavMobile);

// Abre a nav caso esteja fechada, e fecha caso esteja aberta em dispositivos mobile.
function mostrarEsconderNavMobile() {
    let nav = document.getElementsByClassName("navMenu")[0];

    nav.classList.toggle("mostrar");
    console.log("toggado")


}



var EnderecoContainer = document.getElementsByClassName("EnderecoContainer")[0];
var adicionarEnderecoContainer = document.getElementsByClassName("adicionarEnderecoContainer")[0];

function AdicionarEndereco() {



    adicionarEnderecoContainer.classList.toggle("visible");
    if (EnderecoContainer.style.display = "block") {
        EnderecoContainer.style.display = "none";
    }

}

function GerenciarEndereco() {


    if (EnderecoContainer.style.display = "none") {
        EnderecoContainer.style.display = "block";
    }



    adicionarEnderecoContainer.classList.remove("visible");
}