<?php

	include("conexao.php");
	
	$descricao=$_POST['descricao'];
	$valor = floatval(str_replace(',', '.', $_POST['valor']));
	// $totalVendas = floatval($_POST['totalVendas']);
	
	
	$sql="INSERT INTO cadastro(descricao, valor )
	VALUES ('$descricao', '$valor' )";
	if(mysqli_query($conexao, $sql)){
		header("location: index.php");
	}else{
		echo "Erro". mysqli_connect_error($conexao);
	}


	mysqli_close($conexao);
?>