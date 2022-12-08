<?php

session_start();
ob_start();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

include_once '../php/conexao.php';

$ID__ = $_SESSION['id'];
$query_administrador ="SELECT id_admin , senha_admin	
FROM administrador 
WHERE id_admin =:id_admin
LIMIT 1";        

$result_administrador = $conn->prepare($query_administrador);
$result_administrador -> bindParam(':id_admin', $ID__, PDO::PARAM_STR);         

$result_administrador -> execute();

if ($result_administrador and ($result_administrador->rowCount() != 0)) {
  $row_administrador = $result_administrador->fetch(PDO::FETCH_ASSOC);





  $result_produtos_query = "SELECT * FROM produtos";
  $result_produto_sTotals = mysqli_query($connect, $result_produtos_query);


  if (!empty($dados["Preco_promo"])) {
    $result_produtos_query = "SELECT * FROM produtos WHERE preco_promo is not null ORDER BY preco_promo ASC ";
    $result_produto_sTotals = mysqli_query($connect, $result_produtos_query);

  }
  if (!empty($dados["Preco_baixo"])) {
    $result_produtos_query = "SELECT * FROM produtos
  ORDER BY preco_promo IS  NULL, preco_promo,preco_produtos ASC";
    $result_produto_sTotals = mysqli_query($connect, $result_produtos_query);

  }
  if (!empty($dados["Preco_alto"])) {
    $result_produtos_query = "SELECT * FROM produtos ORDER BY preco_produtos ";
    $result_produto_sTotals = mysqli_query($connect, $result_produtos_query);

  }
  if (!empty($dados["ordemAfabetica_asc"])) {
    $result_produtos_query = "SELECT * FROM produtos ORDER BY nome_produtos ASC";
    $result_produto_sTotals = mysqli_query($connect, $result_produtos_query);

  }
  if (!empty($dados["ordemAfabetica_desc"])) {
    $result_produtos_query = "SELECT * FROM produtos ORDER BY nome_produtos DESC ";
    $result_produto_sTotalss = mysqli_query($connect, $result_produtos_query);

  }

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="admin.css">

</head>

<title>Painel Administrativo</title>

<body>
<section class="FullArea">
  <div><h1>Painel Administrativo</h1></div>

  <div></div>

</section>

<!-- SEPARAR POR ORDEM -->

<!-- LISTAR/EDITAR/REMOVER/ADICIONAR PRODUTOS. -->
<section class="ProdutosArea">
<form  id="formFiltro" method="POST" action=""> 
            <input name="Preco_promo" value="Promoções" type="submit">
            <input name="Preco_baixo" value="Preço - Baixo" type="submit">
            <input name="Preco_alto" value="Praço - Alto" type="submit">
            <input name="ordemAfabetica_asc" value="Ordenar A - Z " type="submit">
            <input name="ordemAfabetica_desc" value="Ordenar Z - A " type="submit">
         
          </form>
<?php
  while ($rows_produtos = mysqli_fetch_assoc($result_produto_sTotals)) { ?>
<?php

    extract($rows_produtos);

    echo '
  <div class="produtos">';

    echo ' 
  <div>
 <form method="POST" action="">
  <input type="submit" value="Deletar"  name="Deletar' . $id_produtos . '">
  <input type="submit" value="Editar" name="Editar' . $id_produtos . '">
</form> 
  </div>
  <div>id_produtos = ' . $id_produtos . ' </div>
  <div>nome_produtos = ' . $nome_produtos . ' </div>
  

  <div class="tag">
        <div> <img src="' . $img_produtos . '"></img></div>
        <div> <img src="' . $img_produtos2 . '"></img></div>
        <div> preco_produtos = ' . $preco_produtos . '</div>
        
      ';
    if ($preco_promo) {
      echo '<div> preco_promo = ' . $preco_promo . '</div>';
    }

    echo '
      
  </div>
  tipo_produtos = ' . $tipo_produtos . '
  <br>
  <br>descricao_produtos 
  <p>' . $descricao_produtos . '
  
    <div class="status">  
    created ' . $created . ' |
    modified ' . $modified . '
    </div>

    </div> 
 ';


    if (!empty($dados['Deletar' . $id_produtos . ''])) {

      try {
        $query_Deletar =
          "DELETE FROM produtos WHERE id_produtos =$id_produtos";

        $result__Deletar = $conn->prepare($query_Deletar);
        if ($result__Deletar->execute()) {
          header("Location: daxhboard.php");
        }


      } catch (PDOException $e) {
        echo $id_produtos . "<br>" . $e->getMessage();
      }



    }
    if (!empty($dados['Editar' . $id_produtos . ''])) {



      header("location: ProdutosAdmin.php?product_id=$id_produtos");
    }


  }

}else {
  echo "Acesso negado.";
}
?>


</section>
  
<style>

</style>
<body>
</html>