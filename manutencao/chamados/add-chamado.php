<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Adicionar chamado";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#add-chamado").submit(function(e){
			e.preventDefault();
			$.ajax({
				url: "do-add-chamado.php",
				type: "POST",
				data: $("#add-chamado").serialize(),
				success: function(data){
					if(data == 1){
						var check = confirm("Chamado cadastrado com sucesso!Deseja cadastrar outro?");
						if(check){
							$("#add-chamado").each(function(){
								this.reset();
							});
						}else{
							window.location.href = "chamados.php";
						}
					}else{
						alert(data);
						console.log(data);
					}
				},
				error: function(data, textStatus){
					console.log(data);
					alert("Ocorreu algum erro" + textStatus);
				}
			});
		});
	});
</script>
<h1>Adicionar Chamado</h1>
<a href="<?php echo $TPL->base_url . 'chamados/'; ?>chamados.php">Voltar para Chamados</a>
<hr>
<div class="container">
	<form id="add-chamado">
		<div class="form-group">
			<label for="problema">Nome do responsável: *</label>
			<input type="text" class="form-control" required name="responsavel" id="responsavel">
		</div>
		<div class="form-group">
			<label for="problema">Setor: *</label>
			<input type="text" class="form-control" required name="setor" id="setor">
		</div>
		<div class="form-group">
			<label for="problema">Data do chamado: *</label>
			<input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" required="required" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="data" id="data">
		</div>
		<div class="form-group">
			<label for="problema">Problema: *</label>
			<textarea class="form-control" required name="problema" id="problema"></textarea>
		</div>
		<button type="submit" class="btn btn-default">Cadastrar</button>
	</form>
</div>