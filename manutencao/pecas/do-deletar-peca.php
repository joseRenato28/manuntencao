<?php
include('../conexao.php');

$id_peca = $_POST['id_peca'];


if($id_peca == null){
	echo "ocorreu algum erro para recuperar o número idenficador";
}else{
	$sql = "DELETE FROM hardware WHERE id_hardware = ?";

	$stmt = $conn->prepare($sql);
	if(!$stmt){
		echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
	}

	$stmt->bind_param('i', $id_peca);
	if($stmt->execute()){
		echo "1";
	}

	$conn->close();

}
?>