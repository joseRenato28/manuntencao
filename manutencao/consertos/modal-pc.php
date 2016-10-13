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
				<form id="add-computador">
					<div class="form-group">
						<label for="setor">Placa mãe: *</label>
						<select name="placa-mae-pc" required class="form-control" id="placa-mae-pc">
							<?php
							$sql = "SELECT * FROM hardware WHERE tipo_hardware = 1";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) { ?>
								<option <?php if($row['id_hardware'] == $placa_mae){ ?> selected  <?php } ?> value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

								<?php }
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="setor">Fonte de Alimentação: *</label>
						<select name="fonte-pc" required class="form-control" id="fonte-pc">
							<?php
							$sql = "SELECT * FROM hardware WHERE tipo_hardware = 2";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) { ?>
								<option <?php if($row['id_hardware'] == $fonte){ ?> selected  <?php } ?> value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

								<?php }
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="setor">Memoria Ram: *</label>
						<select name="memoria-ram-pc" required class="form-control" id="memoria-ram-pc">
							<?php
							$sql = "SELECT * FROM hardware WHERE tipo_hardware = 3";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) { ?>
								<option <?php if($row['id_hardware'] == $memoria){ ?> selected  <?php } ?> value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

								<?php }
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="quantia-memoria-pc">Quantidade de pentes de memoria: *</label>
						<input type="number" required name="quantia-memoria-pc" value="<?php echo $quandia_memoria; ?>" id="quantia-memoria-pc">
					</div>
					<div class="form-group">
						<label for="setor">Processador: *</label>
						<select name="processador-pc" required class="form-control" id="processador-pc">
							<?php
							$sql = "SELECT * FROM hardware WHERE tipo_hardware = 4";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) { ?>
								<option <?php if($row['id_hardware'] == $processador){ ?> selected  <?php } ?> value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

								<?php }
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="setor">HD: *</label>
						<select name="hd-pc" required class="form-control" id="hd-pc">
							<?php
							$sql = "SELECT * FROM hardware WHERE tipo_hardware = 5";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) { ?>
								<option <?php if($row['id_hardware'] == $hd){ ?> selected  <?php } ?> value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

								<?php }
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="quantia-hd-pc">Quantidade de HDs: *</label>
						<input type="number" required name="quantia-hd-pc" value="<?php echo $quantia_hd; ?>" id="quantia-hd-pc">
					</div>
					<div class="form-group">
						<label for="setor">Placa off-board: </label>
						<select name="off-pc" class="form-control" id="off-pc">
							<option value="0" selected >Selecione algum dispositivo off-board</option>
							<?php
							$sql = "SELECT * FROM hardware WHERE tipo_hardware in(6, 7, 8, 9, 11)";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) { ?>
								<option <?php if($row['id_hardware'] == $off){ ?> selected  <?php } ?> value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

								<?php }
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="setor">Gabinete: </label>
						<select name="gabinete-pc" class="form-control" id="gabinete-pc">
							<option value="0" selected >Selecione algum gabinete</option>
							<?php
							$sql = "SELECT * FROM hardware WHERE tipo_hardware = 10";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) { ?>
								<option <?php if($row['id_hardware'] == $gabinete){ ?> selected  <?php } ?> value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

								<?php }
							}
							$conn->close();
							?>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Fechar</button>
				<button type="button" id="alterar_hardware" class="btn btn-primary" data-dismiss="modal">Alterar</button>
			</div>
		</div>
	</div>
</div>