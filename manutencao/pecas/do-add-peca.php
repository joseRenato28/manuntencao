<?php
include('../conexao.php');

$tipo = $_POST['tipo'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$observacoes = $_POST['descricao'];

if($tipo == null || $marca == null || $modelo == null){
	echo "campos com * são obrigatórios";
}else{
	$sql = "INSERT INTO hardware (tipo_hardware, marca_hardware, modelo_hardware, descricao_hardware) VALUES (?, ?, ?, ?)";

	$stmt = $conn->prepare($sql);
	if(!$stmt){
		echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
	}

	$stmt->bind_param('ssss', $tipo, $marca, $modelo, $observacoes);
	if($stmt->execute()){
		echo "1";
	}

	$conn->close();

}
?>