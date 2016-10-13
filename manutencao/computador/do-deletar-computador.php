<?php
include('../conexao.php');

$id_pc = $_POST['id_pc'];


if($id_pc == null){
	echo "ocorreu algum erro para recuperar o número idenficador";
}else{
	$check = "SELECT conserto.id_pc FROM conserto inner join pc on conserto.id_pc = pc.id_pc WHERE conserto.id_pc = '$id_pc'";
	$result = $conn->query($check);
	if(!$result){
		echo $conn->error;
	}
	if($result->num_rows > 0){
		echo "Há consertos e/ou chamados para este computador. Impossivel deletar!";
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

}
?>