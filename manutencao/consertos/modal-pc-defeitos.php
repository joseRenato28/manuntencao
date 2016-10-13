<script type="text/javascript">
	$(document).ready(function(){
		$("#myModal").modal("show");
	});
</script>
<?php
include('../conexao.php');

$placa_mae;
$processador;
$fonte;
$hd;
$quantia_hd;
$memoria;
$quandia_memoria;
$gabinete;
$off;

$id_pc = $_POST['id_pc'];
$id_pc_int = preg_replace("/[^0-9]/", "", $id_pc);
$sql_pc = "SELECT * FROM pc WHERE id_pc = '$id_pc_int'";
$result = $conn->query($sql_pc);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$placa_mae = $row["placa_mae_pc"];
		$processador = $row["processador_pc"];
		$fonte = $row["fonte_pc"];
		$hd = $row["hd_pc"];
		$quantia_hd = $row["hd_quantia"];
		$memoria = $row["memoria_pc"];
		$quandia_memoria = $row["memoria_quantia"];
		$gabinete = $row["gabinete_pc"];
		$off = $row["off_board_pc"];
	}
}else{
	echo "Erro ao encontrar as peças deste computador";
}
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php
				$sql = "SELECT *, setor.nome_setor FROM pc inner join setor on pc.setor_pc = setor.id_setor WHERE id_pc = '$id_pc_int'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						if($row["tipo_pc"] == "1"){
							$row["tipo_pc"] = "Desktop";
						}else if($row["tipo_pc"] == "2"){
							$row["tipo_pc"] = "NoteBook";
						}
						?>
						<div class="col-md-10">
							<h3> <?php echo $row["codigo_pc"]." - ".$row["tipo_pc"];?></h3>
							<h5>Selecione as peças que apresentaram defeitos</h5>
						</div>
						<?php 
					}
				} else {
					echo "<h2>Erro ao encontrar os dados deste computador</h2>";
				}
				?>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label>Placa mãe:</label>
							<?php
							$sql = "SELECT hardware.* FROM pc inner join hardware on pc.placa_mae_pc = hardware.id_hardware WHERE pc.id_pc ='$id_pc_int'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) { ?>
									<input type="checkbox" value="<?php echo $row["id_hardware"]; ?>">
									<?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?>
									</input>
								<?php }
								}
								?>
					</div>

					<div class="form-group">
						<label>Fonte de alimentação:</label>
							<?php
							$sql = "SELECT hardware.* FROM pc inner join hardware on pc.fonte_pc = hardware.id_hardware WHERE pc.id_pc ='$id_pc_int'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) { ?>
									<input type="checkbox" value="<?php echo $row["id_hardware"]; ?>">
									<?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?>
									</input>
								<?php }
								}
							?>
					</div>

					<div class="form-group">
						<label>Memória Ram:</label>
							<?php
							$sql = "SELECT hardware.* FROM pc inner join hardware on pc.memoria_pc = hardware.id_hardware WHERE pc.id_pc ='$id_pc_int'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) { ?>
									<input type="checkbox" value="<?php echo $row["id_hardware"]; ?>">
									<?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?>
									</input>
								<?php }
								}
							?>
					</div>

					<div class="form-group">
						<label>Processador:</label>
							<?php
							$sql = "SELECT hardware.* FROM pc inner join hardware on pc.processador_pc = hardware.id_hardware WHERE pc.id_pc ='$id_pc_int'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) { ?>
									<input type="checkbox" value="<?php echo $row["id_hardware"]; ?>">
									<?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?>
									</input>
								<?php }
								}
							?>
					</div>
				</form>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default">Fechar</button>
					<button type="button" id="defeitos" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
				</div>
			</div>
		</div>
	</div>