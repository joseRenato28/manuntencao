<?php
include('../conexao.php');

$tipo = $_POST['tipo'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$observacoes = $_POST['descricao'];
$cadastrar;
if(!isset($_POST["cadastrar"])){
	$cadastrar = 0;
}else{
	$cadastrar = $_POST["cadastrar"];
}

if($tipo == null || $marca == null || $modelo == null){
	echo "campos com * são obrigatórios";
}else{
	if($cadastrar == 0){
		$check = "SELECT marca_hardware, modelo_hardware FROM hardware WHERE marca_hardware LIKE CONCAT('%', ?, '%') AND modelo_hardware LIKE CONCAT('%', ?, '%')";
		$stmt = $conn->prepare($check);
		if(!$stmt){
			echo 'erro para verificar se esta peça já existe: '. $conn->errno .' - '. $conn->error;
		}
		$stmt->bind_param('ss', $marca, $modelo);
		if($stmt->execute()){
			$stmt->bind_result($marca_hardware, $modelo_hardware);
			$stmt->store_result();
			if($stmt->num_rows){
				?>
				<script type="text/javascript">
					$(document).ready(function(){
						$("#myModal").modal("show");
					});
				</script>
				<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Aviso</h4>
								<p>Encontramos peças já cadastrada parecida com esta<p>
								</div>
								<div class="modal-body">
									<?php
									while ($stmt->fetch()){
										?>
										<h4> <?php echo $marca_hardware; ?> - <?php echo $modelo_hardware ?></h4>
										<?php
									}
									?>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" id="cadastrar-mesmo-assim">Cadastrar mesmo assim</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								</div>
							</div>

						</div>
					</div>
					<?php

				}else{
					$sql = "INSERT INTO hardware (tipo_hardware, marca_hardware, modelo_hardware, descricao_hardware) VALUES (?, ?, ?, ?)";

					$stmt = $conn->prepare($sql);
					if(!$stmt){
						echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
					}

					$stmt->bind_param('ssss', $tipo, $marca, $modelo, $observacoes);
					if($stmt->execute()){
						echo "1";
					}

					$conn->close();
				}
			}
		}else{
			$sql = "INSERT INTO hardware (tipo_hardware, marca_hardware, modelo_hardware, descricao_hardware) VALUES (?, ?, ?, ?)";

			$stmt = $conn->prepare($sql);
			if(!$stmt){
				echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
			}

			$stmt->bind_param('ssss', $tipo, $marca, $modelo, $observacoes);
			if($stmt->execute()){
				echo "1";
			}

			$conn->close();
		}
	}
		?>