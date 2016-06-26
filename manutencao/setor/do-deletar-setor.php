<?php
include('../conexao.php');

$id_setor = $_POST['id_setor'];


if($id_setor == null){
	echo "ocorreu algum erro para recuperar o número idenficador";
}else{
	$check = "SELECT setor_pc FROM pc WHERE setor_pc = '$id_setor'";
	$result = $conn->query($check);
	if ($result->num_rows > 0){
		echo "Há computadores usando este setor. Impossivel deletar ele!";
	}else{
		$sql = "DELETE FROM setor WHERE id_setor = ?";

		$stmt = $conn->prepare($sql);
		if(!$stmt){
			echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
		}

		$stmt->bind_param('i', $id_setor);
		if($stmt->execute()){
			echo "1";
		}

		$conn->close();
		}

}
?>