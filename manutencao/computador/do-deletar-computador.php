<?php
include('../conexao.php');

$id_pc = $_POST['id_pc'];


if($id_pc == null){
	echo "ocorreu algum erro para recuperar o número idenficador";
}else{
	$sql = "DELETE FROM pc WHERE id_pc = ?";

	$stmt = $conn->prepare($sql);
	if(!$stmt){
		echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
	}

	$stmt->bind_param('i', $id_pc);
	if($stmt->execute()){
		echo "1";
	}

	$conn->close();

}
?>