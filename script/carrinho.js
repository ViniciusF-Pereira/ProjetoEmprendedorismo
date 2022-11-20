Section_ID = localStorage.getItem(`Section_ID`)

if (isNaN(localStorage.getItem(`Section_ID`)) || localStorage.getItem(`Section_ID`) == null) {

    Section_ID = Math.floor(Math.random() * 19900);

    // console.log(Section_ID);

    localStorage.setItem(`Section_ID`, Section_ID);
    // console.log(" e null");
    // console.log(localStorage.getItem(`Section_ID`));
} else {


    // console.log(" nao e null");
    // console.log(localStorage.getItem(`Section_ID`));
}


console.log(Section_ID);



var carrinho_id = localStorage.getItem("accent_color");

function adicionarProduto(id, nome_p) {

    //localStorage.clear();



    console.log(`ID do produto : ${id}`);

    if (isNaN(localStorage.getItem(`produto_${id}`)).NaN) {

        localStorage.setItem(`produto_${id}`, 1)
        console.log(localStorage.getItem(`produto_${id}`));


    } else {
        produto = localStorage.getItem(`produto_${id}`);

        if (produto >= 1 || isNaN(produto)) {



            console.log("Quantidade " + localStorage.getItem(`produto_${id}`));

        } else {
            localStorage.setItem(`produto_${id}`, 1)
            console.log("Quantidade " + localStorage.getItem(`produto_${id}`));

        }

        var clickX = event.clientX + document.body.scrollLeft;
        var clickY = event.clientY + document.body.scrollTop;



        adicionou = document.querySelector('.adicionou');

        adicionou.style.top = clickY + (-200) + 'px';
        adicionou.style.left = clickX + (-50) + 'px';

        //console.log(clickX);
        //console.log(clickY);



        adicionou.classList.add('sumiu');


        setTimeout(() => {

            adicionou.classList.remove('sumiu');

        }, 1800)



    }
}


let abrirCarrinhoBtn = document
    .getElementById("abrirCarrinhoBtn")
    .addEventListener("click", mostrarEsconderCarrinho);
// Botão "x" no carrinho.
let fecharCarrinhoBtn = document
    .getElementById("fecharCarrinhoBtn")
    .addEventListener("click", mostrarEsconderCarrinho);

// Abre o carrinho caso esteja fechado, e fecha caso esteja aberto.
function mostrarEsconderCarrinho() {
    let carrinho = document.getElementById("botao__carinho");
    carrinho.classList.toggle("carrinhoAberto");
}



var total = 0; // variável que retorna o total dos produtos que estão na LocalStorage.
var i = 0; // variável que irá percorrer as posições
var valor = 0; // variável que irá receber o preço do produto convertido em Float.

for (i = 1; i <= 99; i++) // verifica até 99 produtos registrados na localStorage
{
    var prod = localStorage.getItem("produto" + i + ""); // verifica se há recheio nesta posição. 
    if (prod != null) {
        // exibe os dados da lista dentro da div itens
        document.getElementById("itens").innerHTML += localStorage.getItem("qtd" + i) + " x ";
        document.getElementById("itens").innerHTML += localStorage.getItem("produto" + i);
        document.getElementById("itens").innerHTML += " ";
        document.getElementById("itens").innerHTML += "R$: " + localStorage.getItem("valor" + i) + "<hr>";

        // calcula o total dos recheios
        valor = parseFloat(localStorage.getItem("valor" + i)); // valor convertido com o parseFloat()
        total = (total + valor); // arredonda para 2 casas decimais com o .toFixed(2)
    }
}
// exibe o total dos recheios
document.getElementById("total").innerHTML = total.toFixed(2);


function AddCarrinho(produto, qtd, valor, posicao) {
    localStorage.setItem("produto" + posicao, produto);
    localStorage.setItem("qtd" + posicao, qtd);
    valor = valor * qtd;
    localStorage.setItem("valor" + posicao, valor);
    alert("Produto adicionado ao carrinho!");
}