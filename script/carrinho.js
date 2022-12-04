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





function adicionarProduto(id_p, nome_p, preco_p, img_p) {

    let carrinho = document.getElementById("botao__carinho");

    carrinho.classList.add("carrinhoAberto");

    id__produto = id_p;
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



        localStorage.removeItem("produto" + id_p)
        localStorage.removeItem("qtd" + id_p)
        localStorage.removeItem("produto_id" + id_p)
        localStorage.removeItem("valorTotal" + id_p)

        localStorage.removeItem("valor" + id_p)
        localStorage.removeItem("card" + id_p)



    } else {

        var div = document.getElementById(`produto${id_p}`);


        produto = localStorage.getItem("qtd" + id_p);
        setTimeout(() => {
            if (produto >= 1) {
                adicionarProdutos(id_p, 1);
                return;


            }
            if ((produto < 1) || (produto) == null || div == null) {
                localStorage.setItem("produto" + id_p, nome_p)

                localStorage.setItem("qtd" + id_p, 1)
                localStorage.setItem("produto_id" + id_p, id__produto)
                localStorage.setItem("valorTotal" + id_p, preco_p)

                localStorage.setItem("valor" + id_p, preco_p)
                localStorage.setItem("card" + id_p, img_p)

                console.log("Quantidade " + localStorage.getItem("qtd" + id_p, 1));

                oid = id_p;

                // exibe os dados da lista dentro da div itens

                document.getElementById("itens").innerHTML +=
                    `<div class="CartaoCarrinho" id="produto${id_p}"> 
                        <ul id="carrinhoLista">
                        <li class="carrinhoItem" id="carrinhoItem${id_p}">
                            <img class="produto_id produto_id${id_p}" 
                            src="${img_p}" alt="">
                            <div class="produtoInfo">
                            <button id="button_id${oid}" class"button_id" onclick="removerProduto(${oid})" 
                            style=" margin-left: 50%;     
                            width: 20%;"
                            >DELETAR</button>
                            

                                <div class="topInfo">
                                <h5 class="titulo">${nome_p}
                                <p id="preco${id_p}" class="preco">1 x R$${preco_p} </p>
                                </div>
                                        <p id="total_id${id_p}" class="bottomInfo">Total dos itens  R$   ${preco_p}</p>
                                    </div>
                                 
                            </li>
                             
                            </ul>
                            <button id="alterarMais${oid}" class"alterarMais" onclick="alterar(${oid}, 1)">ADICIONAR</button>
                            <button id="alterarMenos${oid}" class"alterarMenos" onclick="alterar(${oid}, 0)">REMOVER</button>
                     </di>`;


                verificaTotal();


                carrinhoItem_id = document.getElementById(`carrinhoItem${oid}`);

                carrinhoItem_id.style.animation = 'produtouau 0.18s linear';


                setTimeout(() => {

                    carrinhoItem_id.style.animation = 'none';

                }, 200)






            }
            // exibe o total dos recheios

        }, 100)


        var clickX = event.clientX + document.body.scrollLeft;
        var clickY = event.clientY + document.body.scrollTop;

        adicionou = document.querySelector('.adicionou');

        adicionou.style.top = clickY + (-150) + 'px';
        adicionou.style.left = clickX + (-50) + 'px';


        //console.log(clickY);



        adicionou.classList.add('sumiu');


        setTimeout(() => {

            adicionou.classList.remove('sumiu');

        }, 2000)



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


function vereficaCarrinho(id, valor, quantidade, valortotal) {

    var total = 0; // variável que retorna o total dos produtos que estão na LocalStorage.

    var valortotalcarrinho = 0; // variável que irá receber o preço do produto convertido em Float.

    // exibe os dados da lista dentro da div itens
    oid = id;

    total = (document.getElementById("total_full"));
    preco_id = document.getElementById(`preco${oid}`);
    total_id = document.getElementById(`total_id${oid}`);






    console.log(preco_id);
    preco_id.innerHTML = `${quantidade} x R$${parseFloat(valor)}`;
    total_id.innerHTML = `Total dos itens R$ ${parseFloat(valortotal)}`;


    // calcula o total dos recheios
    verificaTotal();



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
            oid = localStorage.getItem("produto_id" + i);
            img = localStorage.getItem("card" + i);
            document.getElementById("itens").innerHTML +=
                `<div class="CartaoCarrinho" id="produto${oid}"> <ul id="carrinhoLista">
            <li class="carrinhoItem" id="carrinhoItem${i}">
                <img class="produto_id produto_id${localStorage.getItem("produto_id" + i)}" 
                src="${img}" alt="">
                <div class="produtoInfo">
                <button id="button_id${oid}" class"button_id" onclick="removerProduto(${oid})" 
                style=" margin-left: 50%;     
                max-width: 50%;"
                >DELETAR</button>
                

                    <div class="topInfo">
                       <h5 class="titulo">${localStorage.getItem("produto" + i)}
                       <p id="preco${oid}" class="preco">${localStorage.getItem("qtd" + i)} x R$${localStorage.getItem("valor" + i)} </p>
                       </div>
                            <p id="total_id${oid}" class="bottomInfo">Total dos itens  R$   ${localStorage.getItem("valorTotal" + i)}</p>
                        </div>
                     
                                          
            </liv>
         </ul>
         <button id="alterarMais${oid}" class"alterarMais" onclick="alterar(${oid}, 1)">ADICIONAR</button>
         <button id="alterarMenos${oid}" class"alterarMenos" onclick="alterar(${oid}, 0)">REMOVER</button>
        </div>`;

            // calcula o total dos recheios
            valortotalcarrinho = parseFloat(localStorage.getItem("valorTotal" + i)); // valor convertido com o parseFloat()
            total = (total + valortotalcarrinho); // arredonda para 2 casas decimais com o .toFixed(2)





        }
    }


    // exibe o total dos recheios
    document.getElementById("total").innerHTML = total.toFixed(2);
    document.getElementById("total2").innerHTML = total.toFixed(2);

    document.getElementById("total_full").innerHTML = total.toFixed(2);




}
carrinho();



function removerProduto(oid) {

    var prod = localStorage.getItem("produto" + oid + ""); // verifica se há recheio nesta posição. 
    var div = document.getElementById(`produto${oid}`);

    if (prod != null) {

        div.outerHTML = ""

        localStorage.removeItem("produto" + oid)
        localStorage.removeItem("qtd" + oid)
        localStorage.removeItem("produto_id" + oid)
        localStorage.removeItem("valorTotal" + oid)

        localStorage.removeItem("valor" + oid)
        localStorage.removeItem("card" + oid)



        verificaTotal();
    }


}

function adicionarProdutos(oid, valor) {
    produto = localStorage.getItem("qtd" + oid);
    preco_p = localStorage.getItem("valor" + oid);
    //aqui e o seguinte, vou receber dois valores

    if (valor == 1) {



        produto = parseInt(localStorage.getItem("qtd" + oid)) + 1;

        localStorage.setItem("qtd" + oid, produto)

        preco_total = parseFloat(preco_p) * parseInt(produto);

        localStorage.setItem("valorTotal" + oid, preco_total)

        console.log("Quantidade " + localStorage.getItem("qtd" + oid));


        vereficaCarrinho(oid, preco_p, produto, preco_total);

        carrinhoItem_id = document.getElementById(`carrinhoItem${oid}`);

        carrinhoItem_id = document.getElementById(`carrinhoItem${oid}`);

        carrinhoItem_id.style.animation = 'produtouau 0.18s linear';


        setTimeout(() => {

            carrinhoItem_id.style.animation = 'none';

        }, 200)

        verificaTotal();

    }

}

function alterar(oid, valor) {


    produto = localStorage.getItem("qtd" + oid);
    preco_p = localStorage.getItem("valor" + oid);
    //aqui e o seguinte, vou receber dois valores

    if (valor == 1) {



        produto = parseInt(localStorage.getItem("qtd" + oid)) + 1;

        localStorage.setItem("qtd" + oid, produto)

        preco_total = parseFloat(preco_p) * parseInt(produto);

        localStorage.setItem("valorTotal" + oid, preco_total)

        console.log("Quantidade " + localStorage.getItem("qtd" + oid));


        vereficaCarrinho(oid, preco_p, produto, preco_total);

        carrinhoItem_id = document.getElementById(`carrinhoItem${oid}`);

        carrinhoItem_id = document.getElementById(`carrinhoItem${oid}`);

        carrinhoItem_id.style.animation = 'produtouau 0.18s linear';


        setTimeout(() => {

            carrinhoItem_id.style.animation = 'none';

        }, 200)

        verificaTotal();

    }

    if (valor == 0) {

        produto = parseInt(produto) - 1;

        localStorage.setItem("qtd" + oid, produto)

        preco_total = parseFloat(preco_p) * parseInt(produto);

        localStorage.setItem("valorTotal" + oid, preco_total)

        console.log("Quantidade " + localStorage.getItem("qtd" + oid));


        vereficaCarrinho(oid, preco_p, produto, preco_total);

        carrinhoItem_id = document.getElementById(`carrinhoItem${oid}`);

        carrinhoItem_id = document.getElementById(`carrinhoItem${oid}`);

        carrinhoItem_id.style.animation = 'produtouau 0.18s linear';


        setTimeout(() => {

            carrinhoItem_id.style.animation = 'none';


        }, 200)

        verificaTotal();

        if (produto <= 0 || produto == null) {

            removerProduto(oid);
        }


    }
}

function verificaTotal() {
    var total = 0; // variável que retorna o total dos produtos que estão na LocalStorage.
    var i = 0; // variável que irá percorrer as posições
    var valortotalcarrinho = 0; // variável que irá receber o preço do produto convertido em Float.

    for (i = 1; i <= 99; i++) // verifica até 99 produtos registrados na localStorage
    {
        var prod = localStorage.getItem("produto" + i + ""); // verifica se há recheio nesta posição. 
        if (prod != null) {
            // exibe o total dos recheios
            valortotalcarrinho = parseFloat(localStorage.getItem("valorTotal" + i)); // valor convertido com o parseFloat()
            total = (total + valortotalcarrinho); // arredonda para 2 casas decimais com o .toFixed(2)
        }
    }
    // exibe o total dos recheios
    document.getElementById("total").innerHTML = total.toFixed(2);
    document.getElementById("total2").innerHTML = total.toFixed(2);

    document.getElementById("total_full").innerHTML = total.toFixed(2);
}