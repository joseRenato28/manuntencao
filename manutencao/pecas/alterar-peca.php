<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Alterar Peça";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
include('../conexao.php');
$id_peca = $_SERVER['REQUEST_URI'];
$id_peca_int = preg_replace("/[^0-9]/", "", $id_peca);

$sql = "SELECT * FROM hardware WHERE id_hardware = '$id_peca_int'";
$result = $conn->query($sql);
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#alterar-peca").submit(function(e){
			e.preventDefault();
			$.ajax({
				url: '<?php echo $TPL->base_url . 'pecas/'; ?>do-alterar-peca.php',
				type: "POST",
				data: $("#alterar-peca").serialize(),
				success: function(data){
					if(data == 1){
						alert("Peça alterada com sucesso!");
						window.location.href = "<?php echo $TPL->base_url . 'pecas/'; ?>pecas.php";
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
<h1>Alterar Peça</h1>
<a href="<?php echo $TPL->base_url . 'pecas/'; ?>pecas.php">Voltar para Peças</a>
<hr>
<?php
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {

		?>
		<div>
			<form id="alterar-peca">
				<input type="hidden" value="<?php echo $row['id_hardware']; ?>" name="id">
				<div class="form-group">
					<label for="tipo">Tipo de Hardware: *</label>
					<select name="tipo" required class="form-control" id="tipo">
						<option <?php if($row['tipo_hardware'] == 1){echo "selected";} ?> value="1">Placa mãe</option>
						<option <?php if($row['tipo_hardware'] == 2){echo "selected";} ?> value="2">Fonte de alimentação</option>
						<option <?php if($row['tipo_hardware'] == 3){echo "selected";} ?> value="3">Memoria ram</option>
						<option <?php if($row['tipo_hardware'] == 4){echo "selected";} ?> value="4">Processador</option>
						<option <?php if($row['tipo_hardware'] == 5){echo "selected";} ?> value="5">HD</option>
						<option <?php if($row['tipo_hardware'] == 6){echo "selected";} ?> value="6">Placa de video</option>
						<option <?php if($row['tipo_hardware'] == 7){echo "selected";} ?> value="7">Placa de rede Ethernet</option>
						<option <?php if($row['tipo_hardware'] == 8){echo "selected";} ?> value="8">Placa de rede Wireless</option>
						<option <?php if($row['tipo_hardware'] == 9){echo "selected";} ?> value="9">Placa USB</option>
						<option <?php if($row['tipo_hardware'] == 10){echo "selected";} ?> value="10">Gabinete</option>
						<option <?php if($row['tipo_hardware'] == 11){echo "selected";} ?> value="10">Outro</option>
					</select>
				</div>
				<div class="form-group">
					<label for="marca">Marca: *</label>
					<input type="text" class="form-control" value="<?php echo $row['marca_hardware'];?>" required name="marca" id="marca">
				</div>
				<div class="form-group">
					<label for="modelo">Modelo: *</label>
					<input type="text" class="form-control" value="<?php echo $row['modelo_hardware']; ?>" required name="modelo" id="modelo">
				</div>
				<div class="form-group">
					<label for="descricao">Descrição:</label>
					<textarea class="form-control" name="descricao" id="observacoes"><?php echo $row['descricao_hardware']; ?></textarea>
				</div>
				<button type="submit" class="btn btn-default">Alterar</button>
			</form>
		</div>
		
		<?php 
	}
} else {
	echo "<h2>Erro ao encontrar os dados desta peça</h2>";
}
$conn->close();
?>