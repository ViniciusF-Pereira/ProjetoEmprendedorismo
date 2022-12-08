<?php


session_start();
ob_start();


include_once '../php/conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){

    $_SESSION['msg']= "<p style='color: #ff0000'> Erro, pagina restrida; Usuário não conectado]! </p>";

    header("Location: ../index.php");


    
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset ($_SESSION['msg']);
    }
   
}

$__id = $_SESSION['id'];
$__logradouro = '';
$__bairro = '';
$__localidade = '';
$__uf = '';
$__cep = '';
$__nome_endereco = '';



$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($dados["Voltar"])){

    header("Location: dashboard.php");
 }
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


  $__cep = "";


  }
  else {
  $__cep = $dados["cep"];
  $url = sprintf('http://viacep.com.br/ws/%s/json/ ', $__cep);
  $result = json_decode(webClient($url));
  
  if( $result){



    
      $__nome_endereco = $dados['nome_endereco'];
      $__logradouro = $result->logradouro;
      $__bairro = $result->bairro;
      $__localidade = $result->localidade;
      $__uf = $result->uf;
  



  //echo $logradouro;
  //echo "<pre>";
  //var_dump($result);
  //echo "</pre>";
  }
  else {

  }
  }


if (!empty($dados["CadastrarEndereco"])) {

  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  $_SESSION['id'];
  $__complemento = $dados["complemento"];

  // echo "<pre>";
  // var_dump($dados);
  // echo "</pre>";


  try {

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cad_endereco = "INSERT INTO enderecos (nome_endereco , cep, logradouro, complemento, usuario_id) 
      VALUES ('$__nome_endereco' , '$__cep', '$__logradouro','$__complemento', '$__id')";



  

    if ($conn->exec($cad_endereco)) {

      $id = $conn->lastInsertId();

      $valor = 0;
      $query_dashboard_enderecos ="SELECT id_endereco, usuario_id, principal
      FROM enderecos 
      WHERE usuario_id =:usuario_id
      AND principal = 1";        


      $result_dashboard_enderecos = $conn->prepare($query_dashboard_enderecos);
      $result_dashboard_enderecos -> bindParam(':usuario_id', $_SESSION['id'], PDO::PARAM_STR);     
      $result_dashboard_enderecos -> execute();

      if(($result_dashboard_enderecos) and ($result_dashboard_enderecos->rowCount() == 0)){
       

          $query_Favoritar =
            "UPDATE enderecos 
                  SET principal = 1;
                  WHERE id_endereco =$id";


          $result__Favoritar = $conn->prepare($query_Favoritar);
          $result__Favoritar->execute();
          header("Location: dashboard.php");

        
      }
   


    }

    // use exec() because no results are returned
  } catch (PDOException $e) {
    echo $cad_endereco . "<br>" . $e->getMessage();
  }


}

?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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


<body>



    <div class="btn_usuarios">
    <button type="submit" onclick="GerenciarEndereco()" name="GerenciarEndereco">Gerenciar Endereços</button>

    <button type="submit" onclick="AdicionarEndereco()" name="AdicionarEndereco">Adicionar Endereços </button>

    <button type="submit" onclick="AlterarSenha()" name="AdicionarEndereco">Informações do Usuário </button>
    </div>

    <div>     
    <section class="dashboard">

       
      <h1>Informações do Usuário
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
                        

              

                          echo ' <a href=" trocarsenha.php">
                                      <button>Alterar Senha</button>
                                </a>
                                <br>';

                                echo '<div class="enderecos">';


                          if ($id_endereco != null && $id_endereco != '' && $id_endereco != 0){

                              $Endereco_antigo = $id_endereco;

                          } 
                          else{

                            $Endereco_antigo = null;
                            
                          }
                      
                 
                  }

                  $valor = 0;
                  $query_dashboard_enderecos ="SELECT id_endereco, nome_endereco, cep, logradouro, complemento, usuario_id, principal
                  FROM enderecos 
                  WHERE usuario_id =:usuario_id
                  AND principal is not null AND principal != $valor
                  ORDER BY principal ";        


                  $result_dashboard_enderecos = $conn->prepare($query_dashboard_enderecos);
                  $result_dashboard_enderecos -> bindParam(':usuario_id', $_SESSION['id'], PDO::PARAM_STR);     
                  $result_dashboard_enderecos -> execute();

                  if(($result_dashboard_enderecos) and ($result_dashboard_enderecos->rowCount() != 0)){
                      while ($row_result_dashboard_enderecos = $result_dashboard_enderecos->fetch(PDO::FETCH_ASSOC)){

                          extract($row_result_dashboard_enderecos);
                                                
                          
                        $_SESSION['principal'] = $id_endereco;

                          echo '<div class=row_EnderecosMenu>';
                          
                          echo "<P class='EnderecoPrincipal'> Endereço Principal </p>
                                <h4 class='nome_endereco'>$nome_endereco</h4> <br>
                          
                                <h4 class='CEP'>CEP: $cep  </h4><br>
                                <h4 class='Logradouro'>Logradouro: $logradouro  </h4><br>
                                <h4 class='Complemento'>Complemento: $complemento  </h4><br>
                              
                            

                              </div>

                          "; 
                          
                        
                                                            
                      
                          
                          

                      }
                  }
                  ?>
  </div>
  </section>
</div>

<div class="adicionarEnderecoArea">
    <section class="EnderecoContainer <?php if(!empty($dados['Deletar']) || !empty($dados['Favoritar'])){echo "visible";}?>">
       <div class="enderecos">
        <?php 

        $query_dashboard ="SELECT id, nome, cpf, usuario, senha_usuario
        FROM usuarios 
        WHERE id =:id
        LIMIT 1";        


        $result_dashboard = $conn->prepare($query_dashboard);
        $result_dashboard -> bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);     
        $result_dashboard -> execute();


        if(($result_dashboard) and ($result_dashboard->rowCount() != 0)){

            $row_dashboard = $result_dashboard->fetch(PDO::FETCH_ASSOC);

          
        }

        $query_dashboard_enderecos ="SELECT id_endereco, nome_endereco, cep, logradouro, complemento, usuario_id, id_endereco
        FROM enderecos 
        WHERE usuario_id =:usuario_id";        


        $result_dashboard_enderecos = $conn->prepare($query_dashboard_enderecos);
        $result_dashboard_enderecos -> bindParam(':usuario_id', $_SESSION['id'], PDO::PARAM_STR);     
        $result_dashboard_enderecos -> execute();

        $valor = 1;
        $query_dashboard_enderecos ="SELECT id_endereco, nome_endereco, cep, logradouro, complemento, usuario_id, principal
        FROM enderecos 
        WHERE usuario_id =:usuario_id
        AND principal != $valor
        ORDER BY principal ";        

        $query_principal ="SELECT id_endereco, principal 
        FROM enderecos 
        WHERE usuario_id =:usuario_id
        AND principal = $valor";
        $result_principal = $conn->prepare($query_principal);
        $result_principal -> bindParam(':usuario_id', $_SESSION['id'], PDO::PARAM_STR);     
        $result_principal -> execute();
        $row_principal = $result_principal->fetch(PDO::FETCH_ASSOC);

        if (!isset($_SESSION['principal'])) {
          $_SESSION['principal'] = $row_principal['id_endereco'];
        }

        $result_dashboard_enderecos = $conn->prepare($query_dashboard_enderecos);
        $result_dashboard_enderecos -> bindParam(':usuario_id', $_SESSION['id'], PDO::PARAM_STR);     
        $result_dashboard_enderecos -> execute();

        
        //  texto 
        
        $valor = 0;
        $_dashboard_enderecos ="SELECT id_endereco, nome_endereco, cep, logradouro, complemento, usuario_id, principal
        FROM enderecos 
        WHERE usuario_id =:usuario_id
        AND principal is not null AND principal != $valor
        ORDER BY principal ";        


        $resu_dashboard_enderecos = $conn->prepare($_dashboard_enderecos);
        $resu_dashboard_enderecos -> bindParam(':usuario_id', $_SESSION['id'], PDO::PARAM_STR);     
        $resu_dashboard_enderecos -> execute();

      
               // texto

        if (($resu_dashboard_enderecos) and ($resu_dashboard_enderecos->rowCount() != 0)) {
          ($row_resu_dashboard_enderecos = $resu_dashboard_enderecos->fetch(PDO::FETCH_ASSOC));

          extract($row_resu_dashboard_enderecos);


          $_SESSION['principal'] = $id_endereco;


          echo '<div class=row_EnderecosMenu>';

          echo '
                       
                         <div class="valores">';

          if ($principal != null && $principal != 0) {
            echo '<p class="principal">Endereço Favorito</p>';
          }



          echo '
                               
                               <p class="nome_endereco">' . $nome_endereco . '</p>
                             
                               <p class="CEP">CEP: ' . $cep . '  </p>
                               <p class="Logradouro">Logradouro: ' . $logradouro . '  </p>
                               <p class="Complemento">Complemento: ' . $complemento . '  </p>
                         </div>
                           
                               
                               <form method="POST" action="">
                             
                               <input class="Deletar" type="submit" value="Deletar" name="Deletar' . $id_endereco . '"  > 
                               </form>
                     
   
                       </div>
   
                   ';

          if (!empty($dados['Deletar' . $id_endereco . ''])) {


            $query_Deletar =
              "DELETE FROM enderecos WHERE id_endereco =$id_endereco";

            $result__Deletar = $conn->prepare($query_Deletar);
            $result__Deletar->execute();

            header("location: dashboard.php");
          }


          if (($result_dashboard_enderecos) and ($result_dashboard_enderecos->rowCount() != 0)) {


            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            while ($row_result_dashboard_enderecos = $result_dashboard_enderecos->fetch(PDO::FETCH_ASSOC)) {

              extract($row_result_dashboard_enderecos);


              echo '<div class=row_EnderecosMenu>';

              echo '
                    
                      <div class="valores">';

              if ($principal != null && $principal != 0) {
                echo '<p class="principal">Endereço Favorito</p>';
              }



              echo '
                            
                            <p class="nome_endereco">' . $nome_endereco . '</p>
                          
                            <p class="CEP">CEP: ' . $cep . '  </p>
                            <p class="Logradouro">Logradouro: ' . $logradouro . '  </p>
                            <p class="Complemento">Complemento: ' . $complemento . '  </p>
                      </div>
                        
                            
                            <form method="POST" action="">
                            <input class="Favoritar" type="submit" value="Favoritar" name="Favoritar' . $id_endereco . '"  > 
                            <input class="Deletar" type="submit" value="Deletar" name="Deletar' . $id_endereco . '"  > 
                            </form>
                  

                    </div>

                ';

              if (!empty($dados['Deletar' . $id_endereco . ''])) {


                $query_Deletar =
                  "DELETE FROM enderecos WHERE id_endereco =$id_endereco";

                $result__Deletar = $conn->prepare($query_Deletar);
                $result__Deletar->execute();

                header("location: dashboard.php");
              }
              if (!empty($dados['Favoritar' . $id_endereco . ''])) {

                $principal_antigo = $_SESSION['principal'];

                $query_RemoverAnterior =
                  "UPDATE enderecos 
                  SET principal = 0
                  WHERE usuario_id =:usuario_id
                  AND principal = 1";

                $query_Favoritar =
                  "UPDATE enderecos 
                  SET principal = 1
                  WHERE id_endereco =:id_endereco";


                $query_favoritos =
                  "UPDATE usuarios
                   SET id_endereco = '$id_endereco'
                  WHERE id =:id";


                $result__favoritos = $conn->prepare($query_favoritos);
                $result__favoritos->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
                $result__favoritos->execute();

                $_SESSION['principal'] = $id_endereco;

                $result__RemoverAnterior = $conn->prepare($query_RemoverAnterior);
                $result__RemoverAnterior->bindParam(':usuario_id', $_SESSION['id'], PDO::PARAM_STR);
                $result__RemoverAnterior->execute();


                $result__Favoritar = $conn->prepare($query_Favoritar);
                $result__Favoritar->bindParam(':id_endereco', $id_endereco, PDO::PARAM_STR);
                $result__Favoritar->execute();

                header("location: dashboard.php");
              }
            }



        
        }
      } else {
        echo "
      
        <p class='vazio'> 
        Nenhum endereço cadastrado..
        </p>";


      }
        ?>
        
 </div> 
</section>

  <section  class="adicionarEnderecoContainer <?php if(!empty($dados['getCep']) || (!empty($dados['Deletar'])) || (!isset($_SESSION['principal'])) ){echo "visible";}?>">
 
             
                  
                  <h1>Cadastrar Endereço</h1>
                   <form method="POST" action="">
                  
                    <label>Tipo de endereço:</label>
                    <input class="inputs_endereco" type="text" name="nome_endereco" placeholder="DEFINIR ENDEREÇO (CASA, TRABALHO)"  value="<?php  echo ''.$__nome_endereco.''; ?>">
                
                    <?php 

                    echo '<label>CEP:</label>
                    <input class="inputs_endereco CEP" type="" name="cep" placeholder="Digite o CEP" id=""  value="'.$__cep.'">
                    <input class="inputs_PROCURAR" type="submit" value="PROCURAR" name="getCep"  > 

                    
                    
                    <label>Logradouro:</label>
                    <input  class="inputs_endereco Logradouro" type="" name="logradouro" placeholder="Digite o logradouro"id="" value="'.$__logradouro.'">
                    
            
       
                    <label>Complemento:</label>
                    <input class="inputs_endereco complemento" type="" name="complemento" placeholder="Digite o complemento"id="" value="">
                         
                    <div class="endereco_final">
                      <div>
                          <label>Bairro:</label>
                         <input class="inputs_endereco bairro" type="" name="bairro" placeholder="Bairro"id="" value="'.$__bairro.'" readonly>
                      </div>
                      <div>
                         <label>Cidade:</label>
                         <input class="inputs_endereco localidade" type="" name="localidade" placeholder="Cidade" id="" value="'.$__localidade.'" readonly>
                      </div>             
                      <div>
                         <label>ESTADO:</label>
                         <input class="inputs_endereco uf" type="" name="uf" placeholder="UF"id="" value="'.$__uf.'" readonly>
                      </div>
                    </div>
                    <BR>

                    <input class="inputs_CadastrarEndereco" type="submit" value="Cadastrar Endereco" name="CadastrarEndereco">
                
                

         ';

         

?>
</section>   
              
    
</form>
</div>   



</body>
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