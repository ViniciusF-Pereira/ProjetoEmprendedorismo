<?php
session_start();
ob_start();


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



    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
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

<?php if (isset($_GET['product_id']) && $_GET['product_id'] !== '') { ?> <?php
        $product_id = $_GET['product_id'];



        $result_produtos_query = "SELECT * FROM produtos WHERE id_produtos  = $product_id ";
        $result_produto_sTotal = mysqli_query($connect, $result_produtos_query);

        $rows_produtos = mysqli_fetch_assoc($result_produto_sTotal);

        $id_p = $rows_produtos['id_produtos'];
        $nome_p = $rows_produtos['nome_produtos'];
        $preco_p = $rows_produtos['preco_produtos'];
        $promo_p = $rows_produtos['preco_promo'];
        $img_p = $rows_produtos['img_produtos'];

        $img_p1 = $rows_produtos['img_produtos'];
        $img_p2 = $rows_produtos['img_produtos2'];


        $array_produto = [$id_p, $nome_p, $preco_p];

        extract($rows_produtos);

        echo '
    <div class="produtos">';

        echo ' 
    <div>
   <form method="POST" action="">
    <input type="submit" value="Deletar" name="Deletar' . $id_produtos . '">
    <input type="submit" value="Editar Preços" name="Editar' . $id_produtos . '">
    <input type="submit" onclick="EditarPreco" value="Editar" name="Editar' . $id_produtos . '">
  </form> 
    </div>
    <div>id_produtos = ' . $id_produtos . ' </div>
    <div>nome_produtos = ' . $nome_produtos . ' </div>
    
  
    <div class="tag">
          <div class="imgs"> <img src="' . $img_produtos . '"></img></div>
          <div class="imgs"> <img src="' . $img_produtos2 . '"></img></div>
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



        ?>
<div class="produtos_price">

<input type="checkbox" id="preco_check" onclick="preco_check()">
<?php if (!$preco_promo) {
            echo '<button onclick="add_promo()">Adicionar valor promocional R$:</button>
        <input type="checkbox" id="promo_check" onclick="promo_check()">';
        } else {
            echo ' <button onclick="add_promo()">Editar valor promocional R$:</button>
            <input type="checkbox" id="promo_check" onclick="promo_check()">';

        }
?>
<button onclick="preco_finalizarcheck()">SALVAR</button>
<form method="POST" action="">
<label>Editar Preço R$:</label>
    <input type="price"  readonly name="preco_produtos" placeholder="digite o valor do produto"id="preco_produtos">
  
 
<?php
        if (!$preco_promo) {
            echo '
        <div class="preco_promo">
        

    <label>preco_promo</label>
   
            <input type="price"  readonly name="preco_promo" placeholder="digite o valor da promoção"id="preco_promo" >
  

    </div>
    ';
        } else {
            echo '
      
        <div class="preco_promo">
    <label>Editar valor promocional R$:</label>
   
            <input type="price"  readonly name="preco_promo" placeholder="digite o valor da promoção"id="preco_promo" value="' . $preco_promo . '">
           
    
    </div>
    ';
        }

?>
    
        <div class="Digite_senha">
            <label>Digite a senha</label>
        <div>
            <input type="password"  name="Digite_senha" placeholder="Digite a Senha do Usuário"id="Digite_senha">
          
       
        <input type="submit" value="Salvar_preco" name="Salvar_preco">

        </form>
     

        <?php
        if (!empty($dados["Salvar_preco"])) {


            if (password_verify($dados["Digite_senha"], $row_administrador["senha_admin"])) {


            

                    $preco__promo = ($dados["preco_promo"]);
                    $preco_produtos =($dados["preco_produtos"]);
                    $query_preco =
                        "UPDATE produtos
                        SET 
                         preco_promo  = '$preco__promo' ,
                         preco_produtos  = '$preco__produtos' 
                        WHERE id_produtos  =$product_id";

                    $result__preco = $conn->prepare($query_preco);
                    if($result__preco->execute()){
                        echo "salvo";
                    }
                    else{
                        echo "nao salvo";
                    }
                  

                
           
            }
            else{
                echo 'senha invalida';
            }
        }
        ?>
        </div>
    </div>
</div>
<div class="produtos_img">
<label>Editar LINK da Imagem 1</label>
    <input type="price"  readonly name="img_produtos" placeholder="digite o valor do img_produtos 1"id="" value="<?php
        echo $img_produtos; ?>">

<label>Editar LINK da Imagem 2</label>
    <input type="price"  readonly name="img_produtos2" placeholder="digite o valor da imgagem produtos 2"id="" value="<?php
        echo $img_produtos2; ?>">
    <button type="submit">Adicionar Imagens</button>
    <img class="img1"/><img class="img2"/>
</div>
<div class="descricao_produtos">
<label>Editar Descrição </label>
    <input type="price"  readonly name="descricao_produtos" placeholder="digite o valor do descricao ao produtos"id="" value="<?php
        echo $descricao_produtos; ?>">

</div>
<?php }
?>
</section>
  
<script src="produtos.js"></script>
<?php } ?>
<body>
</html>