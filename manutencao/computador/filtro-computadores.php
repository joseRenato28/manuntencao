<?php
$codigo_pc = $_POST["codigo_pc"];
$tipo_pc = $_POST["tipo_pc"];
$setor = $_POST["setor"];

include('../conexao.php');
$sql = "SELECT id_pc, codigo_pc, tipo_pc, setor.nome_setor FROM pc inner join setor on pc.setor_pc = setor.id_setor WHERE  tipo_pc = ? OR setor.id_setor = ? OR codigo_pc LIKE CONCAT('%', ?, '%')";

$stmt = $conn->prepare($sql);
if(!$stmt){
	echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
}

$stmt->bind_param('iis', $tipo_pc, $setor, $codigo_pc);
if($stmt->execute()){
	$stmt->bind_result($id_pc, $codigo_pc, $tipo_pc, $nome_setor);
	$stmt->store_result();
	if($stmt->num_rows){
		while ($stmt->fetch()) {
			if($tipo_pc == "1"){
				$tipo_pc = "Desktop";
			}else if($tipo_pc == "2"){
				$tipo_pc = "NoteBook";
			}
			?>
			<tr>
				<td><a href="computador.php/<?php echo $id_pc;?>"><?php echo $codigo_pc; ?> </a></td>
				<td> <?php echo $tipo_pc; ?> </td>
				<td> <?php echo $nome_setor; ?> </td>
				<td><a href="#" class="deletar-pc" id="<?php echo $id_pc;?>">Deletar</a></td>
			</tr>
			<?php
		}
	}else{
		echo "-1";
	}
}

$conn->close();
?>