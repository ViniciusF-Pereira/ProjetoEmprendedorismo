<?php


session_start();
ob_start();


include_once '../php/conexao.php';





if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){

    $_SESSION['msg']= "<p style='color: #ff0000'> Erro, pagina restrida; Usuário não conectado]! </p>";

    header("Location: ../index.php");


    
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset ($_SESSION['msg']);
    }

    

}

?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nav.css">
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
              <a href="../products/produtos.php">Produtos</a>
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
                    if((!($_SESSION['id'])) AND (!($_SESSION['nome']))){
                         
                     
                          echo  '<a href="login.php"> <i class="fa fa-user"></i></a></span>';
                        
                        } else {
                          echo  '<span class="menuItem"><a href="dashboard.php">Configurações</a></span>';
            
                          echo    '<a href="sair.php">SAIR</a>';
                        
                                     
                        }
                      
            ?>
            </button>
            <button id="abrirCarrinhoBtn" class="navBtn">
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





    <section class="dashboard"  >

    <h1>Informações do Usuario
    </h1>
    
                <?php 

                $query_dashboard ="SELECT id, nome, cpf, usuario, senha_usuario, id_endereco
                FROM usuarios 
                WHERE id =:id
                LIMIT 1";        


                $result_dashboard = $conn->prepare($query_dashboard);
                $result_dashboard -> bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);     
                $result_dashboard -> execute();
                


                if(($result_dashboard) and ($result_dashboard->rowCount() != 0)){

                    $row_dashboard = $result_dashboard->fetch(PDO::FETCH_ASSOC);

                  
                        extract($row_dashboard);
                        echo "ID: $id <br>"; 
                        echo "nome: $nome <br>"; 
                        echo "cpf: $cpf <br>"; 
                        echo "usuario: $usuario <br>"; 
                        echo '<div class="enderecos">';

            

                        echo ' <a href=" trocarsenha.php">
                                     <button>Alterar Senha</button>
                               </a>
                               <br>';

                    




                
                }

                $query_dashboard_enderecos ="SELECT id_endereco, nome_endereco, cep, logradouro, complemento, usuario_id, principal
                FROM enderecos 
                WHERE usuario_id =:usuario_id
                ORDER BY principal DESC";        


                $result_dashboard_enderecos = $conn->prepare($query_dashboard_enderecos);
                $result_dashboard_enderecos -> bindParam(':usuario_id', $_SESSION['id'], PDO::PARAM_STR);     
                $result_dashboard_enderecos -> execute();



                if(($result_dashboard_enderecos) and ($result_dashboard_enderecos->rowCount() != 0)){
                    while ($row_result_dashboard_enderecos = $result_dashboard_enderecos->fetch(PDO::FETCH_ASSOC)){
                        
                        extract($row_result_dashboard_enderecos);
                                              
                             
                        echo '<div class=row_EnderecosMenu>';
                        
                        echo '<form action="" method="post">';
                        if($row_dashboard['id_endereco'] == $row_result_dashboard_enderecos['id_endereco']){

                          echo "Endereço Principal <br>"; 
                        }
                        echo '<input type="radio" name="botao'.$id_endereco.'" value="'.$usuario_id.'"/>';
                        echo ""; 
                                                          
                        echo "<h4>$nome_endereco</h4> <br>"; 
                        
                        echo "CEP: $cep <br>"; 
                        echo "Logradouro: $logradouro <br>"; 
                        echo "Complemento: $complemento <br>"; 

                        echo ' <input class="estrela" type="submit" name="favoritar" value="★" />';

                        echo ' <input type="submit" name="deletar" value="DELETAR ENDEREÇO" />';
                        echo '</div>';
                        if (isset($_POST['botao'.$id_endereco.''])) {
                        

                          if(!empty($dados['deletar'])){
                            $delete_dashboard_enderecos = "DELETE from enderecos WHERE id_endereco ='$id_endereco'";
                            $qdelete_dashboard_enderecos = $conn->prepare($delete_dashboard_enderecos);
                            $qdelete_dashboard_enderecos->execute();

                            echo "Endereço deletado com sucesso";
                            
                            header("Location: dashboard.php");
                         }
                         if(!empty($dados['favoritar'])){
                          
                         
                          $query_enderecoPrincipal ="UPDATE usuarios SET id_endereco =:id_endereco WHERE id =:id";       
   
                          
                          $result_enderecoPrincipal = $conn->prepare($query_enderecoPrincipal);

                          $result_enderecoPrincipal -> bindParam(':id', $_SESSION['id']);  
                          $result_enderecoPrincipal -> bindParam(':id_endereco', $id_endereco);  
                                                        

                          

                          
                          $result_enderecoPrincipal -> execute();

                          
                         header("Location: dashboard.php");

                         }

                        } else {
                        
                        }
                        echo '</form>';
                       
                    
                            
                        

                    }
                }
                ?>




<a href="adicionarEndereco.php">
      <button>Adicionar Endereco</button>
</a>


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


<script type="text/javascript" src="../script/carrinho.js"> </script>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/nav.css">
<link rel="stylesheet" href="../css/footer.css">
</html>