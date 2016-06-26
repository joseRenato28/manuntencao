<?php
include('../conexao.php');

$id_peca = $_POST['id_peca'];


if($id_peca == null){
	echo "ocorreu algum erro para recuperar o número idenficador";
}else{
	$check = "SELECT * FROM pc WHERE placa_mae_pc = '$id_peca' or processador_pc = '$id_peca' or memoria_pc = '$id_peca' or 	fonte_pc = '$id_peca' or hd_pc = '$id_peca' or gabinete_pc = '$id_peca' or off_board_pc = '$id_peca'";
	$result = $conn->query($check);
	if ($result->num_rows > 0){
		echo "Há computadores usando esta peça. Impossivel deletar ela!";
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

}
?>