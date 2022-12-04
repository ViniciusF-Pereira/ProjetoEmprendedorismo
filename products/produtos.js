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
                style=";     
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
         <div class="botoesai">
         <button id="alterarMais${oid}" class"alterarMais" onclick="alterar(${oid}, 1)">ADICIONAR</button>
         <button id="alterarMenos${oid}" class"alterarMenos" onclick="alterar(${oid}, 0)">REMOVER</button>
         </div
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
carrinho()