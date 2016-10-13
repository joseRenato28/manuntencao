<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Adicionar Peças";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#add-peca").submit(function(e){
			e.preventDefault();
			$.ajax({
				url: 'do-add-peca.php',
				type: "POST",
				data: $("#add-peca").serialize(),
				success: function(data){
					if(data == 1){
						var check = confirm("Peça cadastrada com sucesso!Deseja cadastrar outra?");
						if(check){
							$("#add-peca").each(function(){
								this.reset();
							});
						}else{
							window.location.href = "pecas.php";
						}
					}else{
						$("#div-modal").html(data);
					}
				},
				error: function(textStatus, data){
					console.log(data);
					alert("Ocorreu algum erro" + textStatus);
				}
			});
		});
		$("body").on("click", "#cadastrar-mesmo-assim", function(){
			$.ajax({
				url: 'do-add-peca.php',
				type: "POST",
				data: {
					cadastrar: 1,
					tipo: $("#tipo").val(),
					marca: $("#marca").val(),
					modelo: $("#modelo").val(),
					descricao: $("#descricao").val()
				},
				success: function(data){
					if(data == 1){
						var check = confirm("Peça cadastrada com sucesso!Deseja cadastrar outra?");
						if(check){
							$("#add-peca").each(function(){
								this.reset();
								$("#myModal").modal('hide');
							});
						}else{
							window.location.href = "pecas.php";
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
<h1>Adicionar Peças</h1>
<a href="<?php echo $TPL->base_url . 'pecas/'; ?>pecas.php">Voltar para Peças</a>
<hr>
<div>
	<form id="add-peca">
		<div class="form-group">
			<label for="tipo">Tipo de Hardware: *</label>
			<select name="tipo" required class="form-control" id="tipo">
				<option value="1">Placa mãe</option>
				<option value="2">Fonte de alimentação</option>
				<option value="3">Memoria ram</option>
				<option value="4">Processador</option>
				<option value="5">HD</option>
				<option value="6">Placa de video</option>
				<option value="7">Placa de rede Ethernet</option>
				<option value="8">Placa de rede Wireless</option>
				<option value="9">Placa USB</option>
				<option value="10">Gabinete</option>
				<option value="11">Outro</option>
			</select>
		</div>
		<div class="form-group">
			<label for="marca">Marca: *</label>
			<input type="text" class="form-control" required name="marca" id="marca">
		</div>
		<div class="form-group">
			<label for="modelo">Modelo: *</label>
			<input type="text" class="form-control" required name="modelo" id="modelo">
		</div>
		<div class="form-group">
			<label for="descricao">Descrição:</label>
			<textarea class="form-control" name="descricao" id="descricao"></textarea>
		</div>
		<button type="submit" class="btn btn-default">Cadastrar</button>
	</form>
</div>
<div id="div-modal">
	
</div>