<?php
require_once('../template.php');
include('../conexao.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Adicionar Computador";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#add-computador").submit(function(e){
			e.preventDefault();
			$.ajax({
				url: 'do-add-computador.php',
				type: "POST",
				data: $("#add-computador").serialize(),
				success: function(data){
					if(data == 1){
						var check = confirm("Computador cadastrado com sucesso!Deseja cadastrar outro?");
						if(check){
							$("#add-computador").each(function(){
								this.reset();
							});
						}else{
							window.location.href = "computadores.php";
						}
					}else{
						alert(data);
					}
				},
				error: function(textStatus, data){
					console.log(data);
					alert("Ocorreu algum erro" + textStatus);
				}
			});
		});
	});
</script>
<h1>Adicionar Computador</h1>
<a href="<?php echo $TPL->base_url . 'computador/'; ?>computadores.php">Voltar para Computadores</a>
<hr>
<div>
	<form id="add-computador">
		<div class="form-group">
			<label for="codigo-comptuador">Codigo do computador(nº patrimonio || nº de serie): *</label>
			<input type="text" class="form-control" required name="codigo-comptuador" id="codigo-comptuador">
		</div>
		<div class="form-group">
			<label for="tipo">Tipo de Computador: *</label>
			<select name="tipo" required class="form-control" id="tipo">
				<option value="1">Desktop</option>
				<option value="2">NoteBook</option>
			</select>
		</div>
		<div class="form-group">
			<label for="setor">Setor: *</label>
			<select name="setor" required class="form-control" id="setor">
				<?php
				$sql = "SELECT * FROM setor";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) { ?>
						<option value="<?php echo $row["id_setor"]; ?>"> <?php echo $row["nome_setor"]; ?> </option>

						<?php }
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="setor">Placa mãe: *</label>
				<select name="placa-mae-pc" required class="form-control" id="placa-mae-pc">
					<?php
					$sql = "SELECT * FROM hardware WHERE tipo_hardware = 1";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) { ?>
							<option value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

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
								<option value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

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
									<option value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

									<?php }
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="quantia-memoria-pc">Quantidade de pentes de memoria: *</label>
							<input type="number" required name="quantia-memoria-pc" id="quantia-memoria-pc">
						</div>
						<div class="form-group">
							<label for="setor">Processador: *</label>
							<select name="processador-pc" required class="form-control" id="processador-pc">
								<?php
								$sql = "SELECT * FROM hardware WHERE tipo_hardware = 4";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) { ?>
										<option value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

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
											<option value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

											<?php }
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="quantia-hd-pc">Quantidade de HDs: *</label>
									<input type="number" required name="quantia-hd-pc" id="quantia-hd-pc">
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
													<option value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

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
														<option value="<?php echo $row["id_hardware"]; ?>"> <?php echo $row["marca_hardware"]. " - " . $row["modelo_hardware"]; ?> </option>

														<?php }
													}
													$conn->close();
													?>
												</select>
											</div>
											<div class="form-group">
												<label for="descricao-pc">Descrição: </label>
												<textarea class="form-control" name="descricao-pc" id="descricao-pc"></textarea>
											</div>
											<button type="submit" class="btn btn-default">Cadastrar</button>
										</form>
									</div>