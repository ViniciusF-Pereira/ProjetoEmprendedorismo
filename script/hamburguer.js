document.getElementById("hamburguerBtn").addEventListener("click", mostrarEsconderNavMobile);

// Abre a nav caso esteja fechada, e fecha caso esteja aberta em dispositivos mobile.
function mostrarEsconderNavMobile() {
    let nav = document.getElementsByClassName("navMenu")[0];

    nav.classList.toggle("mostrar");
    console.log("toggado")


}


var CadastroContainer = document.getElementsByClassName("CadastroContainer")[0];
var EnderecoContainer = document.getElementsByClassName("EnderecoContainer")[0];
var adicionarEnderecoContainer = document.getElementsByClassName("adicionarEnderecoContainer")[0];
var dashboard = document.getElementsByClassName("dashboard")[0];


function default_divs() {
    EnderecoContainer.classList.remove("visible");
    adicionarEnderecoContainer.classList.remove("visible");

}

function AdicionarEndereco() {



    adicionarEnderecoContainer.classList.add("visible");
    EnderecoContainer.classList.remove("visible");
    dashboard.classList.remove("visible");

    window.scroll(0, 100)



}

function GerenciarEndereco() {

    EnderecoContainer.classList.add("visible");
    adicionarEnderecoContainer.classList.remove("visible");
    dashboard.classList.remove("visible");

}


function AlterarSenha() {

    dashboard.classList.add("visible");

    adicionarEnderecoContainer.classList.remove("visible");
    EnderecoContainer.classList.remove("visible");



}



function validando() {

    if (adicionarEnderecoContainer && EnderecoContainer) {
        if (adicionarEnderecoContainer.classList.contains("visible") ||
            EnderecoContainer.classList.contains("visible")) {

            window.scroll(0, 100)
            dashboard.classList.remove("visible");
        } else {
            dashboard.classList.add("visible");
        }
    }


}

validando();