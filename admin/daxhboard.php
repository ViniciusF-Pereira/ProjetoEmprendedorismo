<?php

session_start();
ob_start();


include_once '../php/conexao.php';

$result_produtos_query = "SELECT * FROM produtos";
$result_produto_sTotal = mysqli_query($connect, $result_produtos_query);

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
<?php
 while ($rows_produtos = mysqli_fetch_assoc($result_produto_sTotal)) { ?>
<?php
  echo '<pre>';
  //var_dump($rows_produtos);
  echo '</pre>';
  extract($rows_produtos);

  echo '

  <tr>';
  echo 'id_produtos = '.$id_produtos . ' | 
  <table>

  <tr>
  <img src="'.$img_produtos.'"></img>
  <img src="'.$img_produtos2.'"></img>
    <td>nome_produtos = '.$nome_produtos.  '</td>
    <td>preco_produtos = '. $preco_produtos. '</td>
  </tr>';

  if ($preco_promo) {
  echo '<td>preco_produtos = '.$preco_produtos .  '</td>';
  }
  echo '<tr><p>descricao_produtos = '.$descricao_produtos.  '</p></tr>';
  echo '<td>tipo_produtos = '.$tipo_produtos.  '</td>';

  echo '<td>created '.$created.  '</td>';
  echo '<td>modified '.$modified.  '</td>';



  echo 
  '
  </table>
  </tr>
  
 ';


   

}
?>


</section>
  
<style>

</style>
<body>
</html>