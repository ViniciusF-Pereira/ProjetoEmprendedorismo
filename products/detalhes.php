<?php 


if(isset($_GET['product_id']) && $_GET['product_id'] !== ''){
  $product_id = $_GET['product_id'];
  echo $product_id;
} else {
  echo "failed";
}
?>
<?php


session_start();
ob_start();





include_once '../php/conexao.php';




?>

<!DOCTYPE html>
<html lang="pt-br">
  
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="sobre.css">
    <link rel="stylesheet" href="../css/footer.css">

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

    <title>Sobre</title>
    <link
      rel="shortcut icon"
      href="../images/kisspng_gray_wolf_logo_mascot_clip_art_wolf_5ab4467dd78141_1.png"
    />
  </head>

  <body>
    <header>
       <!-- Barra de navegação ------------------------------------------------------  Barra de navegação    -->
       <nav>
        
      <div class="navContainer">
        <!-- Mobile Hamburguer -->
        <button id="hamburguerBtn" class="navBtn">
          <i class="fa fa-bars"></i>
        </button>

        <a href="index.php" class="logoArea">
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
              <li>
              <a href="../index.php"> Home </a>
            </li>
            </li>

            <li><a href="../products/produtos.php">Produtos</a></li>

            <li>
              <a href="../contato/contato.php"> Contato </a>
            </li>
         
          </ul>

          <div class="navItems2">
            <button class="navBtn">
            <?php
                      if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
                
                  
    
                        echo  '<a href="../user/login.php"> <i class="fa fa-user"></i></a></span>';                      }
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
          
    </header>
    <section class="produto_x">
        <div> 
                <div>
                    <div class="produtoContainer">
						<div class="thumbnail">
                 
                       <?php

                                $id_p = $rows_produtos['id_produtos'];
                                $nome_p = $rows_produtos['nome_produtos'];
                                $preco_p = $rows_produtos['preco_produtos'];
                                $promo_p = $rows_produtos['preco_promo'];
                                $img_p = $rows_produtos['img_produtos'];


                                $array_produto = [ $id_p, $nome_p,  $preco_p ];

                        echo '<div class="Div_produtos_vitrine" id="Produto_id_'. $id_p.'">';
                        echo '<div class="div_produto">
                        <a href="detalhes.php?product_id='.$id_p.'">
                        <img class= Imagem_produtos_exibidos src="'. $rows_produtos['img_produtos'].'" alt="whey__wolffit">';


                        echo '
                        
                        <input type="hidden" name="id_'.$rows_produtos['id_produtos'].'" placeholder="'.$rows_produtos['id_produtos'].'" id="'.$rows_produtos['id_produtos'].'" value="'.$rows_produtos['id_produtos'].'" readonly>

                        ';
                                                               
                      
                              echo 
                              '
                              <div class="produtoInfo">
                              <p class="Id_produtos_id" id="i_id_'. $id_p.'">ID:' . $rows_produtos['id_produtos'].' </p>
                              <p class="Nome_produtos_id" id="N_id_'. $id_p.'"> '. $rows_produtos['nome_produtos']. '</p>';

                              if(  $promo_p != 0  && $promo_p != null ){
                                echo '<p class="Preco_produtos_id Promo" id="P_id_'. $id_p.'">R$ ' . number_format($rows_produtos['preco_produtos'], 2, ",",'.'). '</p>';
                                echo '<p class="Preco_promo_id" id="P_promo_'. $id_p.'"> RS '.number_format($rows_produtos['preco_promo'], 2, ",",".").'</p>';
                              }
                              else{
                              echo '<p class="Preco_produtos_id" id="P_id_'. $id_p.'">R$ ' . number_format($rows_produtos['preco_produtos'], 2, ",",'.'). '</p>';
                              }
                              echo '<p class="Descricao_produtos_id" id="D_id_'. $id_p.'">Descrição: ' . $rows_produtos['descricao_produtos'].' </p>
                              </a> </div>

                              <button 
                              class="butonn_produtos_id" id="B_id_'. $id_p.'"
                              onclick="adicionarProduto(`'.$id_p.'`,`'. $nome_p.'`,';
                              if( $promo_p != 0  && $promo_p != null){
                                echo '`'.$promo_p.'`,`'.$img_p.'`)">COMPRAR</button>';
                              }
                              else{
                                echo '`'.$preco_p.'`,`'.$img_p.'`)">COMPRAR</button>';
                              }
                        
                                                      
                               //echo "<pre>";
                              // echo json_encode( $array_produto );
                               //echo "</pre>";
                               echo ' </div>';
                            
                         echo '</div>';       
                        ?>
                     

                              
                            
						</div>
					</div>
                    </div>

        
        </div>
    </section>
 

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
      
        <div class="extras">
          <h5>Extras</h5>
          <a href="https://www.instagram.com/wolffit848/" target="_blank"
            >Instagram <i class="fa-brands fa-instagram"></i
          ></a>
          <a href="../sobre/sobre.php"> Sobre Nós</a>
          <a href="../contato/contato.php">Fale Conosco</a>
        </div>

                    
        </div>
      </div>
      <div>Wolf-Fit suplementos LTDA©2022</div>
    </footer>
    <script src="../script/hamburguer.js"></script>
  </body>
  <script src="../../JS/carrinho.js"></script>
</html>
