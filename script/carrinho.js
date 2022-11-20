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

function adicionarProduto(id_p, nome_p, preco_p, img_p) {


    //localStorage.clear();
    //console.log(id_p);
    //console.log(nome_p);
    //console.log(preco_p);
    //console.log(img_p);
    console.clear();


    console.log(`ID do produto : ${id_p}`);
    console.log(`Nome do produto : ${nome_p}`);
    console.log(`Nome do produto : ${preco_p}`);

    if (isNaN(localStorage.getItem("produto" + id_p, nome_p)).NaN) {


        console.log(localStorage.getItem("produto" + id_p, nome_p));


    } else {
        localStorage.setItem("produto" + id_p, nome_p)

        produto = localStorage.getItem("qtd" + id_p);

        if (produto >= 1 || isNaN(produto)) {

            id__produto = id_p;
            produto = parseInt(produto) + 1;


            localStorage.setItem("produto_id" + id_p, id__produto)
            localStorage.setItem("qtd" + id_p, produto)

            preco_total = parseFloat(preco_p) * parseInt(produto);

            localStorage.setItem("valor" + id_p, preco_p)
            localStorage.setItem("valorTotal" + id_p, preco_total)

            localStorage.setItem("card" + id_p, img_p)

            console.log("Quantidade " + localStorage.getItem("qtd" + id_p, 1));


        } else {
            localStorage.setItem("qtd" + id_p, 1)

            localStorage.setItem("valorTotal" + id_p, preco_p)

            localStorage.setItem("valor" + id_p, preco_p)
            localStorage.setItem("card" + id_p, img_p)

            console.log("Quantidade " + localStorage.getItem("qtd" + id_p, 1));

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
    carrinho();
}

function carrinho() {

    var total = 0; // variável que retorna o total dos produtos que estão na LocalStorage.
    var i = 0; // variável que irá percorrer as posições
    var valortotalcarrinho = 0; // variável que irá receber o preço do produto convertido em Float.

    for (i = 1; i <= 99; i++) // verifica até 99 produtos registrados na localStorage
    {
        var prod = localStorage.getItem("produto" + i + ""); // verifica se há recheio nesta posição. 
        if (prod != null) {
            // exibe os dados da lista dentro da div itens

            img = localStorage.getItem("card" + i);
            document.getElementById("itens").innerHTML +=
                `<ul id="carrinhoLista">
                <li class="carrinhoItem">
                    <img class="produto_id${localStorage.getItem("produto_id" + i)}" 
                    src="${img}" alt="">
                    <div class="produtoInfo">
                        <div class="topInfo">
                           <h5 class="titulo">${localStorage.getItem("produto" + i)}
                           <p class="preco">${localStorage.getItem("qtd" + i)} x R$${localStorage.getItem("valor" + i)} </p>
                           </div>

                                <p class="bottomInfo">Total dos itens  R$   ${localStorage.getItem("valorTotal" + i)}</p>
                            </div>
                </liv>
            </ul>`;


            // calcula o total dos recheios
            valortotalcarrinho = parseFloat(localStorage.getItem("valorTotal" + i)); // valor convertido com o parseFloat()
            total = (total + valortotalcarrinho); // arredonda para 2 casas decimais com o .toFixed(2)
        }
    }
    // exibe o total dos recheios
    document.getElementById("total").innerHTML = total.toFixed(2);


}

carrinho();