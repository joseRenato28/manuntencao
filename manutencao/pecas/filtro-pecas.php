<?php
$tipo_peca = $_POST["tipo_peca"];
$marca_peca = $_POST["marca_peca"];
$modelo_peca = $_POST["modelo_peca"];

include('../conexao.php');
$sql = "SELECT id_hardware, tipo_hardware, marca_hardware, modelo_hardware FROM hardware WHERE tipo_hardware = ? AND marca_hardware LIKE CONCAT('%', ?, '%') AND modelo_hardware LIKE CONCAT('%', ?, '%')";

$stmt = $conn->prepare($sql);
if(!$stmt){
	echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
}

$stmt->bind_param('iss', $tipo_peca, $marca_peca, $modelo_peca);
if($stmt->execute()){
	$stmt->bind_result($id_hardware, $tipo_hardware, $marca_hardware, $modelo_hardware);
	$stmt->store_result();
	if($stmt->num_rows){
		while ($stmt->fetch()) {
			if($tipo_hardware == "1"){
				$tipo_hardware = "Placa mãe";
			}else if($tipo_hardware == "2"){
				$tipo_hardware = "Fonte de Alimentação";
			}else if($tipo_hardware == "3"){
				$tipo_hardware = "Memoria ram";
			}else if($tipo_hardware == "4"){
				$tipo_hardware = "Processador";
			}else if($tipo_hardware == "5"){
				$tipo_hardware = "HD";
			}else if($tipo_hardware == "6"){
				$tipo_hardware = "Placa de Vídeo";
			}else if($tipo_hardware == "7"){
				$tipo_hardware = "Placa de rede Ethernet";
			}else if($tipo_hardware == "8"){
				$tipo_hardware = "Placa de rede Wireless";
			}else if($tipo_hardware == "9"){
				$tipo_hardware = "Placa USB";
			}else if($tipo_hardware == "10"){
				$tipo_hardware = "Gabinete";
			}else if($tipo_hardware == "11"){
				$tipo_hardware = "Outro";
			}
			?>
			<tr>
				<td> <?php echo $tipo_hardware; ?> </td>
				<td> <?php echo $marca_hardware; ?> </td>
				<td><a href="peca.php/<?php echo $id_hardware; ?>"> <?php echo $modelo_hardware; ?> </a></td>
				<td><a href="alterar-peca.php/<?php echo $id_hardware;?> ">Alterar</a> | <a href="#" class="deletar-peca" id="<?php echo $id_hardware;?>">Deletar</a></td>
			</tr>
			<?php
		}
	}else{
		echo "-1";
	}
}

$conn->close();
?>