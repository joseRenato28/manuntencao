<?php
include('../conexao.php');

$setor = $_POST['nome-setor'];

if($setor == null){
	echo "campos com * são obrigatórios";
}else{
	$sql = "INSERT INTO setor (nome_setor) VALUES (?)";

	$stmt = $conn->prepare($sql);
	if(!$stmt){
		echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
	}

	$stmt->bind_param('s', $setor);
	if($stmt->execute()){
		echo "1";
	}

	$conn->close();

}
?>