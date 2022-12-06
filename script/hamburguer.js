document.getElementById("hamburguerBtn").addEventListener("click", mostrarEsconderNavMobile);

// Abre a nav caso esteja fechada, e fecha caso esteja aberta em dispositivos mobile.
function mostrarEsconderNavMobile() {
    let nav = document.getElementsByClassName("navMenu")[0];

    nav.classList.toggle("mostrar");
    console.log("toggado")


}



var EnderecoContainer = document.getElementsByClassName("EnderecoContainer")[0];
var adicionarEnderecoContainer = document.getElementsByClassName("adicionarEnderecoContainer")[0];
var dashboard = document.getElementsByClassName("dashboard")[0];

function default_divs() {
    EnderecoContainer.classList.remove("visible");
    adicionarEnderecoContainer.classList.remove("visible");

}

function AdicionarEndereco() {

    adicionarEnderecoContainer.classList.toggle("visible");
    EnderecoContainer.classList.remove("visible");
    dashboard.classList.remove("visible");


}

function GerenciarEndereco() {

    EnderecoContainer.classList.toggle("visible");
    adicionarEnderecoContainer.classList.remove("visible");
    dashboard.classList.remove("visible");

}


function AlterarSenha() {

    dashboard.classList.toggle("visible");

    adicionarEnderecoContainer.classList.remove("visible");
    EnderecoContainer.classList.remove("visible");



}

document.onload(validando());

function validando() {

    dashboard.classList.toggle("visible");


}