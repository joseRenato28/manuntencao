<?php
if(isset($_POST["id_pc"])){
	?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>
					Data de alteração
				</th>
				<th>
					Ir para alteração
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include('../conexao.php');
			require_once('../template.php');
			$TPL = new Template();
			$id_pc = $_POST["id_pc"];

			$sql = "SELECT id_pc_hardware_antigo, data_pc_antigo FROM pc_hardware_antigo WHERE id_pc_antigo = ?";
			$stmt = $conn->prepare($sql);
			if(!$stmt){
				echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
			}

			$stmt->bind_param('i', $id_pc);
			if($stmt->execute()){
				$stmt->bind_result($id_pc_hardware_antigo, $data_pc_antigo);
				$stmt->store_result();
				if($stmt->num_rows){
					while ($stmt->fetch()) {
						?>
						<tr>
							<td>
								<?php echo $data_pc_antigo; ?>
							</td>
							<td>
								<a href="<?php echo $TPL->base_url.'hardware-antigo/hardware.php/'.$id_pc_hardware_antigo ?>">--></a>
							</td>
						</tr>
						<?php
					}
				}else{
					echo "<h5 style='color:#b30000'>Nenhuma alteração de hardware encontrada</h5>";
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