<?php
include('../conexao.php');
	
	$codigo = $_POST['chamado'];
	$sql = "SELECT codigo_chamado, id_chamado, setor_chamado FROM chamado  WHERE codigo_chamado LIKE CONCAT('%', ?, '%') LIMIT 3";

	$stmt = $conn->prepare($sql);
	if(!$stmt){
		echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
	}

	$stmt->bind_param('s', $codigo);
	if($stmt->execute()){
		$stmt->bind_result($codigo_chamado, $id_chamado, $setor_chamado);
		$stmt->store_result();
		if($stmt->num_rows){
			while ($stmt->fetch()) {
				?>
					<a href="#" class="list-group-item escolhe-chamado">
					    <h4 class="list-group-item-heading"> <?php echo $codigo_chamado. " - ".$setor_chamado; ?></h4>
					    <input type="hidden" id="id_chamado" value="<?php echo $id_chamado ?>" />
				    </a>
				<?php
			}
		}else{
			echo "<h5 style='color:#b30000'>Nenhum chamado encontrado</h5>";
		}
	}

	$conn->close();
?>