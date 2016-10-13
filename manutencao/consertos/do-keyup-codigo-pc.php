<?php
include('../conexao.php');
	
	$codigo = $_POST['codigo_comptuador'];
	$sql = "SELECT id_pc, codigo_pc, setor.nome_setor, descricao_pc FROM pc inner join setor on pc.setor_pc = setor.id_setor WHERE codigo_pc LIKE CONCAT('%', ?, '%') LIMIT 3";

	$stmt = $conn->prepare($sql);
	if(!$stmt){
		echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
	}

	$stmt->bind_param('s', $codigo);
	if($stmt->execute()){
		$stmt->bind_result($id_pc, $codigo_pc, $nome_setor, $descricao_pc);
		$stmt->store_result();
		if($stmt->num_rows){
			while ($stmt->fetch()) {
				?>
					<a href="#" class="list-group-item escolhe-pc">
					    <h4 class="list-group-item-heading"> <?php echo $codigo_pc. " - ".$nome_setor; ?></h4>
					    <p class="list-group-item-text"> <?php echo $descricao_pc; ?></p>
					    <input type="hidden" id="id_pc" value="<?php echo $id_pc ?>" />
				    </a>
				<?php
			}
		}else{
			echo "<h5 style='color:#b30000'>Nenhum computador encontrado</h5>";
		}
	}

	$conn->close();
?>