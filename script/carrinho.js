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

function adicionarProduto(id) {

    //localStorage.clear();



    console.log(`ID do produto : ${id}`);

    if (isNaN(localStorage.getItem(`produto_${id}`)).NaN) {

        localStorage.setItem(`produto_${id}`, 1)
        console.log(localStorage.getItem(`produto_${id}`));
    } else {
        produto = localStorage.getItem(`produto_${id}`);

        if (produto >= 1 || isNaN(produto)) {

            produto = parseInt(produto) + 1;
            localStorage.setItem(`produto_${id}`, produto)
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