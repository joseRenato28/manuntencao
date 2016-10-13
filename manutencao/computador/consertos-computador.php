<?php
if(isset($_POST["id_pc"])){
	?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>
					Código
				</th>
				<th>
					Problema
				</th>
				<th>
					Solução
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include('../conexao.php');
			require_once('../template.php');
			$TPL = new Template();
			$id_pc = $_POST["id_pc"];

			$sql = "SELECT codigo_conserto, id_conserto, problema, solucao FROM conserto WHERE conserto.id_pc = ?";
			$stmt = $conn->prepare($sql);
			if(!$stmt){
				echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
			}

			$stmt->bind_param('i', $id_pc);
			if($stmt->execute()){
				$stmt->bind_result($codigo_conserto, $id_conserto, $problema, $solucao);
				$stmt->store_result();
				if($stmt->num_rows){
					while ($stmt->fetch()) {
						?>
						<tr>
							<td>
								<a href="<?php echo $TPL->base_url.'consertos/conserto.php/'.$id_conserto ?>"> <?php echo $codigo_conserto; ?> </a>
							</td>
							<td>
								<?php echo $problema; ?>
							</td>
							<td>
								<?php echo $solucao; ?>
							</td>
						</tr>
						<?php
					}
				}else{
					echo "<h5 style='color:#b30000'>Nenhum conserto encontrado</h5>";
				}
			}
			$conn->close();
			?>
		</tbody>
	</table>
	<?php
}else{	
	echo "Ocorreu algum erro para carregar os consertos deste computador";
}
?>