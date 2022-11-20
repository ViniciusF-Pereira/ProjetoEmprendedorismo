<?php 
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

//Selecionar todos os produtos da tabela

$result_produtos_query = "SELECT * FROM produtos";
$result_produto_sTotal = mysqli_query($connect, $result_produtos_query);

//Contar o total de produtos

$total_produtos = mysqli_num_rows($result_produto_sTotal);

//Seta a quantidade de produtos por pagina

$quantidade_pg = 9;


//calcular o número de pagina necessárias para apresentar os produtos

$num_pagina = ceil($total_produtos/$quantidade_pg);


//Calcular o inicio da visualizacao

$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os produtos a serem apresentado na página
$result_produtos_querys = "SELECT * FROM produtos ORDER BY id_produtos DESC limit $incio, $quantidade_pg ";
$result_produto_sTotals = mysqli_query($connect, $result_produtos_querys);
$total_produtos = mysqli_num_rows($result_produto_sTotal);

