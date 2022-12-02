<?php


session_start();
ob_start();





    include_once '../php/conexao.php';

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

//Selecionar todos os produtos da tabela

$result_produtos_query = "SELECT * FROM produtos";
$result_produto_sTotal = mysqli_query($connect, $result_produtos_query);

//Contar o total de produtos

$total_produtos = mysqli_num_rows($result_produto_sTotal);

//Seta a quantidade de produtos por pagina

$quantidade_pg = 16;


//calcular o número de pagina necessárias para apresentar os produtos

$num_pagina = ceil($total_produtos/$quantidade_pg);


//Calcular o inicio da visualizacao

$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os produtos a serem apresentado na página
$result_produtos_querys = "SELECT * FROM produtos ORDER BY id_produtos  DESC limit $incio, $quantidade_pg ";
$result_produto_sTotals = mysqli_query($connect, $result_produtos_querys);
$total_produtos = mysqli_num_rows($result_produto_sTotal);

if(!empty($dados["Preco_baixo"])){
  $result_produtos_querys = "SELECT * FROM produtos ORDER BY preco_produtos ASC limit $incio, $quantidade_pg ";
  $result_produto_sTotals = mysqli_query($connect, $result_produtos_querys);
  $total_produtos = mysqli_num_rows($result_produto_sTotal);
}
if(!empty($dados["Preco_alto"])){
  $result_produtos_querys = "SELECT * FROM produtos ORDER BY preco_produtos DESC limit $incio, $quantidade_pg ";
  $result_produto_sTotals = mysqli_query($connect, $result_produtos_querys);
  $total_produtos = mysqli_num_rows($result_produto_sTotal);
}
if(!empty($dados["ordemAfabetica_asc"])){
  $result_produtos_querys = "SELECT * FROM produtos ORDER BY nome_produtos ASC limit $incio, $quantidade_pg ";
  $result_produto_sTotals = mysqli_query($connect, $result_produtos_querys);
  $total_produtos = mysqli_num_rows($result_produto_sTotal);
}
if(!empty($dados["ordemAfabetica_desc"])){
  $result_produtos_querys = "SELECT * FROM produtos ORDER BY nome_produtos DESC limit $incio, $quantidade_pg ";
  $result_produto_sTotals = mysqli_query($connect, $result_produtos_querys);
  $total_produtos = mysqli_num_rows($result_produto_sTotal);
}



?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/footer.css">

    <!-- CSS DO PRODUTOS                                                                 CSS DO PRODUTOS -->
    <link rel="stylesheet" href="./produtos.css">
    <!-- CSS DO PRODUTOS                                                                 CSS DO PRODUTOS -->
	<link
      href="https://fonts.googleapis.com/css?family=Inter&display=swap"
      rel="stylesheet"
    />

    <!-- FONT AWESOME BRAND TAGS -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/brands.min.css"
      integrity="sha512-bSncow0ApIhONbz+pNI52n0trz5fMWbgteHsonaPk42JbunIeM9ee+zTYAUP1eLPky5wP0XZ7MSLAPxKkwnlzw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />

    <!-- Script JAVASCRIPT para o carousel -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"
    ></script>

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />

    <title>WOLF FIT</title>



</head>

<body>

   
    <header>
        <p class="primeiroTitulo ">Ganhe 10% + FRETE GRÁTIS na primeira compra com o cupom: BEMVINDO</p>
        <p class="segundoTitulo">
            Frete Grátis, vide as regras | 1ª Troca sem custo* | Entrega realizada em até 7 dias úteis</p>
            <?php 
            if (isset($_SESSION['id'])) {


              echo    '<p class="primeiroTitulo ">Bem Vindo ' . $_SESSION['nome'] . '</p>';
            }
            ?>
    </header>


 <!-- Barra de navegação ------------------------------------------------------  Barra de navegação    -->
 <nav>
    <div class="navContainer">
        <!-- Mobile Hamburguer -->
        <button id="hamburguerBtn" class="navBtn">
          <i class="fa fa-bars"></i>
        </button>

        <a href="../index.php" class="logoArea">
          <img
            src="../images/kisspng_gray_wolf_logo_mascot_clip_art_wolf_5ab4467dd78141_1.png"
            alt="Logo"
         
          />
          <span class="companyName">Wolf-Fit</span>
        </a>

        <div class="navMenu">
          <ul class="navItems">
          <li>
              <div id="produtosListaDropDown">
                <a> <span>Destaques</span> <i class="fa fa-caret-down"></i> </a>
                <ul id="produtosListaDropDownUl">
                  <li id="promocaoBtn">Promoções</li>
                  <li id="maisVendidosBtn">Mais vendidos</li>
                </ul>
              </div>
            </li>
            

            <li>
                <a href="../index.php">Home</a>
            </li>
            
            <li>
                <a href="../contato/contato.php">Contato</a>
            </li>

            <li>
                <a href="../sobre/sobre.php">Sobre</a>
            </li>
          </ul>

          <div class="navItems2">
            <button class="navBtn">
            <?php
                        if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
                
                  
    
                          echo  '<a href="user/login.php"> <i class="fa fa-user"></i><span class="nav2ItemNome">Login</span></a>';
                        }
                         else {
            
                          echo  '<span class="menuItem"><a href="../user/dashboard.php">Configurações</a></span>';
            
                          echo    '<a href="../user/sair.php">SAIR</a>';
                        
                      }
            ?>
            </button>
            <button id="abrirCarrinhoBtn" class="navBtn" onclick="">
              <i class="fa fa-cart-shopping"></i>
              <span class="nav2ItemNome">Carrinho</span>
            </button>
          </div>
        </div>
      </div>
    </nav>

   
  <div id="botao__carinho" class="botao__carinho">
      <h3>Carrinho <i class="fa fa-cart-shopping"></i></h3>
      <button
        type="button"
        class="limparCarrinhoBtn"
        onclick=" localStorage.clear(); location.reload();"
      >
        Limpar
      </button>
      <button
        type="button"
        class="limparCarrinhoBtn"
        onclick=" location.reload();"
      >
        Atualizar
      </button>
      <div>Total R$: <span id="total"></span> </div>            
      <div id="botao__carinho___tabela">
      <div id="itens"> </div>
      <div class="total2">Total R$: <span id="total2"></span> 
      <input type="hidden" value="" id="total_full"></input></div>
        
      </div>

      

      

      <button id="fecharCarrinhoBtn"><i class="fa fa-close"></i></button>
    </div>



    <div class="cabecalho">
      <img class="cabecalhoImg" src="../images/background/suplementosBg.jpg" alt="">
      <h1 class="titulo">Suplementos</h1>
    </div>


    <!-- Produtos -->

    <div class="container theme-showcase" role="main">
            <div class= "Vitrine">
          <form  id="formFiltro" method="POST" action=""> 
            <input name="Preco_baixo" value="Preco_baixo" type="submit">
            <input name="Preco_alto" value="Preco_alto" type="submit">
            <input name="ordemAfabetica_desc" value="ordemAfabetica_desc" type="submit">
            <input name="ordemAfabetica_asc" value="ordemAfabetica_asc" type="submit">
          </form>
        	<div class="row">
         
				<?php while($rows_produtos = mysqli_fetch_assoc($result_produto_sTotals)){ ?>
					<div class="produtoContainer">
						<div class="thumbnail">
                 
                       <?php

                                $id_p = $rows_produtos['id_produtos'];
                                $nome_p = $rows_produtos['nome_produtos'];
                                $preco_p = $rows_produtos['preco_produtos'];
                                $img_p = $rows_produtos['img_produtos'];

                                $array_produto = [ $id_p, $nome_p,  $preco_p ];

                        echo '<div class="Div_produtos_vitrine" id="Produto_id_'. $id_p.'">';
                        echo '<div class="div_produto">
                        <img class= Imagem_produtos_exibidos src="'. $rows_produtos['img_produtos'].'" alt="whey__wolffit">';


                        echo '
                        
                        <input type="hidden" name="id_'.$rows_produtos['id_produtos'].'" placeholder="'.$rows_produtos['id_produtos'].'" id="'.$rows_produtos['id_produtos'].'" value="'.$rows_produtos['id_produtos'].'" readonly>

                        ';
                                                               
                      
                              echo 
                              '
                              <div class="produtoInfo">
                              <p class="Id_produtos_id" id="i_id_'. $id_p.'">ID:' . $rows_produtos['id_produtos'].' </p>
                              <p class="Nome_produtos_id" id="N_id_'. $id_p.'"> '. $rows_produtos['nome_produtos']. '</p>
                              <p class="Preco_produtos_id" id="P_id_'. $id_p.'">R$ ' . number_format($rows_produtos['preco_produtos'], 2, ",",'.'). '</p>
                              <p class="Descricao_produtos_id" id="D_id_'. $id_p.'">Descrição: ' . $rows_produtos['descricao_produtos'].' </p>
                              </div>

                              <button 
                              class="butonn_produtos_id" id="B_id_'. $id_p.'"
                              onclick="adicionarProduto(`'.$id_p.'`,`'. $nome_p.'`,`'.$preco_p.'`,`'.$img_p.'`)">COMPRAR</button>';

                                    
                               //echo "<pre>";
                              // echo json_encode( $array_produto );
                               //echo "</pre>";
                               echo '</div>';
                            
                         echo '</div>';       
                        ?>
                              
                            
						</div>
					</div>
				<?php } ?>
        <div class="adicionou">Produto Adicionado 
          <i class="fas fa-cart-fill"></i>
          <i class="fas fa-check-circle-fill"></i>
         </div>


			    </div>
            </div>
			<?php
				//Verificar a pagina anterior e posterior
				$pagina_anterior = $pagina - 1;
				$pagina_posterior = $pagina + 1;
			?>
			<nav class="text-center">
				<ul class="pagination">
					<li>
						<?php
						if($pagina_anterior != 0){ ?>
							<a href="produtos.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&laquo;</span>
					<?php }  ?>
					</li>
					<?php 
					//Apresentar a paginacao
					for($i = 1; $i < $num_pagina + 1; $i++){ ?>
						<li><a href="produtos.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php } ?>
					<li>
						<?php
						if($pagina_posterior <= $num_pagina){ ?>
							<a href="produtos.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
								<span aria-hidden="true">&raquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&raquo;</span>
					<?php }  ?>
					</li>
				</ul>
			</nav>
		</div>


    
    <!-- Footer -->
    <footer>
      <div class="cadastroEmail">
        <p>
          <i class="fas fa-envelope"></i> RECEBA OFERTAS E NOVIDADES POR E-MAIL:
        </p>

        <form>
          <input type="email" placeholder="E-mail" />
          <button class="cadastrarBtn">Cadastrar</button>
        </form>
      </div>

      <div class="creditos">
        <div class="criadores">
          <h5>Criadores</h5>
          <a href="https://github.com/Alcantara-Diego" target="_blank"
            >Diego Alcântara</a
          >
          <a href="https://github.com/jhoneshark" target="_blank">Jhoneshark</a>
          <a href="https://github.com/Claitonok" target="_blank"
            >Claiton Silva</a
          >
          <a href="https://github.com/Digao46" target="_blank">Diogo Melo</a>
        </div>

        <div class="extras">
          <h5>Extras</h5>
          <a href="https://www.instagram.com/wolffit848/" target="_blank"
            >Instagram <i class="fa-brands fa-instagram"></i
          ></a>
          <a href="/components/sobre/sobre.html"> Sobre Nós</a>
          <a href="/components/contato/contato.html">Fale Conosco</a>
        </div>

        <div class="imagens">
          <h5>Imagens</h5>

          <a
            href="https://unsplash.com/@sxoxm?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
            >Sven Mieke</a
          >

          <a
            href="https://www.freepik.com/free-psd/protein-powder-container-mockup_17197932.htm#query=whey&position=5&from_view=search&track=sph"
            target="_blank"
            >xvector</a
          >

          <a
            href="https://unsplash.com/@visualsbyroyalz?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
            target="_blank"
            >Anastase Maragos</a
          >
        </div>
      </div>
      <div>Wolf-Fit suplementos LTDA©2022</div>
    </footer>


    <script src="../script/hamburguer.js"></script>
</body>


<script type="text/javascript" src="../script/carrinho.js"> </script>
</html>