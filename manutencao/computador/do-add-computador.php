<?php
include('../conexao.php');

$codigo = $_POST['codigo-comptuador'];
$tipo = $_POST['tipo'];
$setor = $_POST['setor'];
$placa_mae = $_POST['placa-mae-pc'];
$fonte = $_POST['fonte-pc'];
$memoria_ram = $_POST['memoria-ram-pc'];
$quantia_memoria = $_POST['quantia-memoria-pc'];
$hd = $_POST['hd-pc'];
$quantia_hd = $_POST['quantia-hd-pc'];
$off = $_POST['off-pc'];
$gabinete = $_POST['gabinete-pc'];
$processador = $_POST['processador-pc'];
$descricao = $_POST['descricao-pc'];

$marca = $_POST["marca-comptuador"];
$modelo = $_POST["modelo-comptuador"];

if($tipo == 1){
	if($codigo == null || $tipo == null || $setor == null || $placa_mae == null || $fonte == null || $memoria_ram == null || $quantia_memoria == null || $hd == null ||$quantia_hd == null || $processador == null){
		echo "campos com * são obrigatórios";
	}else{
		$sql = "INSERT INTO pc (codigo_pc, tipo_pc, setor_pc, placa_mae_pc, fonte_pc, memoria_pc, memoria_quantia, hd_pc, hd_quantia, off_board_pc, gabinete_pc, processador_pc, descricao_pc) VALUES (?, ? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $conn->prepare($sql);
		if(!$stmt){
			echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
		}

		$stmt->bind_param('siiiiiiiiiiis', $codigo, $tipo, $setor, $placa_mae, $fonte, $memoria_ram, $quantia_memoria, $hd, $quantia_hd, $off, $gabinete, $processador, $descricao);
		if($stmt->execute()){
			echo "1";
		}

		$conn->close();

	}
}else if($tipo == 2){
	if($codigo == null || $tipo == null || $setor == null || $marca == null || $modelo == null){
		echo "campos com * são obrigatórios";
	}else{
		$sql = "INSERT INTO pc (codigo_pc, tipo_pc, setor_pc, modelo_pc, marca_pc, descricao_pc) VALUES (?, ? ,?, ?, ?, ?)";

		$stmt = $conn->prepare($sql);
		if(!$stmt){
			echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
		}

		$stmt->bind_param('siisss', $codigo, $tipo, $setor, $modelo, $marca $descricao);
		if($stmt->execute()){
			echo "1";
		}

		$conn->close();

	}
}else{
	echo "Tipo de computador invalido";
}
?>