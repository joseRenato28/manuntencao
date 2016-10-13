<?php
	include('../conexao.php');
	$responsavel = $_POST["responsavel"];
	$setor = $_POST["setor"];
	$data = $_POST["data"];
	$problema = $_POST["problema"];
	$codigo;
	function validateDate($date, $format = 'Y-m-d'){
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}
	function validateDateBR($date, $format = 'd-m-Y'){
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}

	if($responsavel == null || $setor == null || $data == null || $problema == null){
		echo "campos com * são obrigatórios";
	}else{
		if(validateDate($data) || validateDateBR($data)){
			do{
				$codigo = mt_rand(100000, 999999);
				$sql_verifica = $conn->query("SELECT codigo_chamado FROM chamado WHERE codigo_chamado = '$codigo'");
				if(mysqli_num_rows($sql_verifica) <= 0){
					break;
				}
			}while(mysqli_num_rows($sql_verifica) > 0);
			$sql = "INSERT INTO chamado(codigo_chamado, responsavel_chamado, setor_chamado, data_chamado, problema_chamado) VALUES (?, ?, ?, ?, ?)";

			$stmt = $conn->prepare($sql);
			if(!$stmt){
				echo 'Erro ao inserir um novo chamado: '. $conn->errno .' - '. $conn->error;
			}

			$stmt->bind_param('issss', $codigo, $responsavel, $setor, $data, $problema);
			if($stmt->execute()){
				echo "1";
			}else{
				echo 'Erro ao inserir um novo chamado: '. $conn->errno .' - '. $conn->error;
			}

			$conn->close();
		}else{
			echo "Formato de data invalido(formatods validos: d-m-A | A-m-d";
		}
	}
?>