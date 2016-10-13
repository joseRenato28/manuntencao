<?php
include('../conexao.php');
$id_pc = 0;
$id_chamado = 0;
if(isset($_POST["id_pc"])){
	$id_pc = $_POST["id_pc"];
}
if(isset($_POST["id_chamado"])){
	$id_chamado = $_POST["id_chamado"];
}

$alterar_hardware = $_POST["alterar_hardware"];
$problema = $_POST["problema"];
$data_entrada = $_POST["data_entrada"];
$solucao = $_POST["solucao"];
$data_entrega = $_POST["data_entrega"];

$placa_mae;
$fonte;
$memoria;
$quantia_memoria;
$processador;
$hd;
$quantia_hd;
$off;
$gabinete;

function validateDate($date, $format = 'Y-m-d'){
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}
function validateDateBR($date, $format = 'd/m/Y'){
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}

if($alterar_hardware == 1){
	$placa_mae = $_POST["placa_mae"];
	$fonte = $_POST["fonte"];
	$memoria = $_POST["memoria_ram"];
	$quantia_memoria = $_POST["quantia_memoria"];
	$processador = $_POST["processador"];
	$hd = $_POST["hd"];
	$quantia_hd = $_POST["quantia_hd"];
	$off = $_POST["off"];
	$gabinete = $_POST["gabinete"];
}

if(empty($id_pc) || $id_pc == 0){
	echo "Não foi possivel recuperar o número idenficador do computador";
}else{
	$id_pc_int = preg_replace("/[^0-9]/", "", $id_pc);
	if($alterar_hardware == 0){
		if(empty($problema) || empty($data_entrega) || empty($solucao) || empty($data_entrega)){
			echo "campos com * são obrigatórios";
		}else{
			if(validateDate($data_entrada) || validateDateBR($data_entrada) && validateDate($data_entrega) || validateDateBR($data_entrega)){
				$codigo;
				do{
					$codigo = mt_rand(100000, 999999);
					$sql_verifica = $conn->query("SELECT codigo_conserto FROM conserto WHERE codigo_conserto = '$codigo'");
					if(mysqli_num_rows($sql_verifica) <= 0){
						break;
					}
				}while(mysqli_num_rows($sql_verifica) > 0);
				$codigo .= 51;
				$sql = "INSERT INTO conserto(codigo_conserto, id_pc, id_chamado, problema, data_recebeu, solucao, data_entrega) VALUES (?, ?, ?, ?, ?, ?, ?)";

				$stmt = $conn->prepare($sql);
				if(!$stmt){
					echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
				}

				$stmt->bind_param('iiissss', $codigo, $id_pc, $id_chamado, $problema, $data_entrada, $solucao, $data_entrega);
				if($stmt->execute()){
					echo "1";
				}else{
					echo "Ocorreu algum erro para cadastrar este conserto";
				}			

				$conn->close();

			}else{
				echo "Formato de data invalido(formatods validos: d-m-A | A-m-d";
			}
		}
	}else if($alterar_hardware == 1){
		$data_pc_antigo = date("Y-m-d");
		$id_pc_hardware_antigo;
		if(validateDate($data_entrada) || validateDateBR($data_entrada) && validateDate($data_entrega) || validateDateBR($data_entrega)){

			$sql_hardware_antigo = "INSERT INTO pc_hardware_antigo(id_pc_antigo, tipo_pc_antigo, setor_pc_antigo, codigo_pc_antigo, placa_mae_pc_antigo, processador_pc_antigo, fonte_pc_antigo, memoria_pc_antigo, quantia_memoria_pc_antigo, 	hd_pc_antigo, quantia_hd_pc_antigo, off_board_pc_antigo, gabinete_pc_antigo) SELECT id_pc, tipo_pc, setor_pc, codigo_pc, placa_mae_pc, processador_pc, fonte_pc, memoria_pc, memoria_quantia, hd_pc, hd_quantia, off_board_pc, 	gabinete_pc FROM pc WHERE id_pc = '$id_pc_int'";
			

			if ($conn->query($sql_hardware_antigo) === TRUE) {
				$id_pc_hardware_antigo =  $conn->insert_id;
				$sql_hardware_antigo_data = "UPDATE pc_hardware_antigo SET data_pc_antigo = '$data_pc_antigo' WHERE id_pc_hardware_antigo = '$id_pc_hardware_antigo'";
				$conn->query($sql_hardware_antigo_data);

				if($placa_mae == null || $fonte == null || $memoria == null || $quantia_memoria == null || $problema == null || $hd == null || $quantia_hd == null || $off == null || $gabinete == null){
					echo "Ocorreu algum erro para recuperar os dados de alteração do computador";
				}else{
					$sql_alterar_hardware = "UPDATE pc SET placa_mae_pc = '$placa_mae', processador_pc = '$processador', memoria_pc = '$memoria', fonte_pc = '$fonte', hd_pc = '$hd', gabinete_pc = '$gabinete', off_board_pc = '$off', memoria_quantia = '$quantia_memoria', hd_quantia = '$quantia_hd' WHERE id_pc = '$id_pc_int'";
					if ($conn->query($sql_alterar_hardware) === TRUE) {

						if($problema == null || $data_entrega == null || $solucao == null || $data_entrega == null){
							echo "campos com * são obrigatórios";
						}else{
							$codigo;
							do{
								$codigo = mt_rand(100000, 999999);
								$sql_verifica = $conn->query("SELECT codigo_conserto FROM conserto WHERE codigo_conserto = '$codigo'");
								if(mysqli_num_rows($sql_verifica) <= 0){
									break;
								}
							}while(mysqli_num_rows($sql_verifica) > 0);
							$codigo .= 51;
							$sql = "INSERT INTO conserto(codigo_conserto,  id_pc, id_chamado, id_pc_hardware_antigo, problema, data_recebeu, solucao, data_entrega) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

							$stmt = $conn->prepare($sql);
							if(!$stmt){
								echo 'Erro para inserir os dados do conserto:'. $conn->errno .' - '. $conn->error;
							}

							$stmt->bind_param('iiiissss',$codigo, $id_pc, $id_chamado, $id_pc_hardware_antigo, $problema, $data_entrada, $solucao, $data_entrega);
							if($stmt->execute()){
								echo "1";
							}

							$conn->close();
						}
					}else{
						echo "Erro para alterar o hardware do computador: " . $sql_hardware_antigo . "<br>" . $conn->error;
					}
				}
			}else{
				echo "Erro para inserir os dados do hardware antigo: " . $sql_hardware_antigo . "<br>" . $conn->error;
			}

		}else{
			echo "Formato de data invalido(formatods validos: d-m-A | A-m-d";
		}
	}else{
		echo "Ocorreu algum erro interno";
	}
}

?>