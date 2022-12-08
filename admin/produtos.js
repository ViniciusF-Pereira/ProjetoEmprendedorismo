var _preco_promo = document.getElementsByClassName("preco_promo")[0];
var Digite_senha = document.getElementsByClassName("Digite_senha")[0];



function add_promo() {
    _preco_promo.classList.toggle("visible");
}

function preco_check() {
    var preco_check = document.getElementById("preco_check");
    var preco_produtos = document.getElementById("preco_produtos");
    var visible_produtos = document.getElementsByClassName("preco_produtos");
    if (preco_check.checked == true) {
        preco_produtos.readOnly = false;
        visible_produtos.classList.toggle("visible");
    } else {
        preco_produtos.readOnly = true;
        visible_produtos.classList.toggle("visible");
    }
}

function promo_check() {
    var promo_check = document.getElementById("promo_check");
    var preco_promo = document.getElementById("preco_promo");
    var visible_promo = document.getElementsByClassName("preco_promo");

    if (promo_check.checked == true) {
        preco_promo.readOnly = false;
        visible_promo.classList.toggle("visible");
    } else {
        preco_promo.readOnly = true;
        visible_promo.classList.toggle("visible");
    }
}

function preco_finalizarcheck() {
    var preco_produtos = document.getElementById("preco_produtos");

    var preco_promo = document.getElementById("preco_promo");

    preco_produtos.readOnly = true;
    preco_promo.readOnly = true;
    Digite_senha.classList.toggle("visible");

}