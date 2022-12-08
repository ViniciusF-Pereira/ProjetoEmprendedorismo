<?php


session_start();
ob_start();


include_once '../php/conexao.php';




if((isset($_SESSION['id'])) AND (isset($_SESSION['nome']))){

    $_SESSION['msg']= "<p style='color: #ff0000'> Erro, pagina restrida; Usuário não conectado]! </p>";

    header("Location: ../index.php");


    
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset ($_SESSION['msg']);
    }

    

}

?>

<?php


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

{

   
    function webClient ($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    if(empty($dados["cep"]))
    {


    $cep = "";


    }
    else {
    $cep = $dados["cep"];
    $url = sprintf('http://viacep.com.br/ws/%s/json/ ', $cep);
    $result = json_decode(webClient($url));
    
   

    
    if($dados["cep"] != '') {
        $logradouro = $result->logradouro;
        $bairro = $result->bairro;
        $localidade = $result->localidade;
        $uf = $result->uf;
    }


    //echo $logradouro;
    //echo "<pre>";
    //var_dump($result);
    //echo "</pre>";
    }
}




?>

<?php

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($dados["SendCadastro"])){

    



    
   // echo "<pre>";
   // var_dump($dados);
   // echo "</pre>";





      $query_usuario ="SELECT id, nome, cpf, usuario, senha_usuario
          FROM usuarios 
          WHERE usuario =:usuario
          LIMIT 1";      
          
      $query_cpf ="SELECT id, nome, cpf, usuario, senha_usuario
      FROM usuarios 
      WHERE cpf =:cpf
      LIMIT 1";   
          


    $result_usuario = $conn->prepare($query_usuario);
    $result_cpf = $conn->prepare($query_cpf);
    $result_usuario -> bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);         
    $result_cpf -> bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);         
    $result_cpf -> execute();
    $result_usuario -> execute();


    

  if(($result_usuario) AND ($result_usuario->rowCount() == 0)){
    if(($result_cpf) AND ($result_cpf->rowCount() == 0)){
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);


          $_a = $dados['nome'];
          $_b = $dados['usuario'];
          $_c = $dados['senha_usuario'];
          $_c2 = $dados['senha_usuario_2'];
          $_d = $dados['cpf'];

        if($_c !=  $_c2 || $_a  == NULL || $_b  == NULL || $_c  == NULL || $_c2  == NULL || $_d  == NULL){
            $_SESSION['msg']= "<p style='color: RED'> Senhas digitadas não são indenticas.! </p>";
  
      
        } else {


        $_nome = $dados['nome'];
        $_usuario = $dados['usuario'];
        $_cpf = $dados['cpf'];
        $_senha = password_hash($dados['senha_usuario_2'], PASSWORD_DEFAULT);
        $_number = $randomNumber = rand();
        $_hash = password_hash($_number, PASSWORD_DEFAULT );
 

          try {
      
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO usuarios (nome , cpf, usuario, senha_usuario, id_number, id_hash) 
            VALUES ('$_nome','$_cpf','$_usuario','$_senha','$_number','$_hash')";
            // use exec() because no results are returned
           

          if ($conn->exec($sql)) {
              try {

                $query_usuario ="SELECT id, nome, cpf, usuario, senha_usuario, id_number
                FROM usuarios 
                WHERE usuario =:usuario
                LIMIT 1";        
                
                $result_usuario = $conn->prepare($query_usuario);
                $result_usuario -> bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);         
                
                $result_usuario -> execute();

                if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

                                
                    $_SESSION['id_number'] = $row_usuario['id_number'];
                    $_SESSION['id'] = $row_usuario['id'];
                    $_SESSION['nome'] = $row_usuario['nome'];

                    header("Location: ../user/dashboard.php");
                  
                    
              
               }
              }
              catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
              }
    
            }
          } 
          catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
          }

    
     


      }                      
    }
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
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="user.css">

    
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
       <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/style.css">

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
                         
                     
                                echo  '<a href="login.php"> <i class="fa fa-user"></i></a></span>';
                              
                          
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




    <section>

   



    <div class="CadastroArea">
<section class="CadastroContainer">
    <h1>Cadastro</h1>

<form method="POST" action="">

    <label>Nome:</label>
        <input type="text" name="nome" placeholder="digite o nome completo"id="" value="<?php if(isset($dados['nome']))
        {echo $dados['nome']; } ?>">

        
        <br>
        <br>
        <label>CPF:</label>
        <input type="text" name="cpf" placeholder="digite o e-cpf"id="" value="<?php if(isset($dados['cpf']))
        {echo $dados['cpf']; } ?>">


        <br>
        <br>
        <label>Usuário:</label>
        <input type="email" name="usuario" placeholder="digite o e-mail"id="" value="<?php if(isset($dados['usuario']))
        {echo $dados['usuario']; } ?>">

        <br>
        <br>

        <label >Senha:</label>
        <input type="password" name="senha_usuario" placeholder="digite a senha"id="" value="<?php if(isset($dados['senha_usuario']))
        {echo $dados['senha_usuario'];} ?>">

        <br>
        <br>

        <label >Digite novamente a senha:</label>
        <input type="password" name="senha_usuario_2" placeholder="digite a senha novamente"id="" value="<?php if(isset($dados['senha_usuario']))
        {echo $dados['senha_usuario'];} ?>">

        <br>
        <br>

        <input type="submit" value="Cadastrar" name="SendCadastro"> 
</form>


    </section>

      <div class="overlay"></div>
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

</html>