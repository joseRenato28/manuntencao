<?php
include('../conexao.php');

$id_peca = $_POST['id'];
$tipo = $_POST['tipo'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$observacoes = $_POST['descricao'];
$cadastrar;

if(!isset($_POST["cadastrar"])){
	$cadastrar = 0;
}else{
	$cadastrar = $_POST["cadastrar"];
}


if($id_peca == null){
	echo "ocorreu algum erro para recuperar o número idenficador";
}else{
	if($cadastrar == 0){
		$check = "SELECT marca_hardware, modelo_hardware FROM hardware WHERE marca_hardware LIKE CONCAT('%', ?, '%') AND modelo_hardware LIKE CONCAT('%', ?, '%')";
		$stmt = $conn->prepare($check);
		
	}else{
		if($tipo == null || $marca == null || $modelo == null){
			echo "campos com * são obrigatórios";

		}else{
			$sql = "UPDATE hardware SET tipo_hardware = ?, marca_hardware = ?, modelo_hardware = ?, descricao_hardware = ? WHERE id_hardware = ?";

			$stmt = $conn->prepare($sql);
			if(!$stmt){
				echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
			}

			$stmt->bind_param('ssssi', $tipo, $marca, $modelo, $observacoes, $id_peca);
			if($stmt->execute()){
				echo "1";
			}

			$conn->close();
		}
	}
}
?>