<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Adicionar setor";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#add-setor").submit(function(e){
			e.preventDefault();
			$.ajax({
				url: 'do-add-setor.php',
				type: "POST",
				data: $("#add-setor").serialize(),
				success: function(data){
					if(data == 1){
						var check = confirm("Setor cadastrado com sucesso!Deseja cadastrar outro?");
						if(check){
							$("#add-setor").each(function(){
								this.reset();
							});
						}else{
							window.location.href = "setores.php";
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
<h1>Adicionar Setor</h1>
<a href="<?php echo $TPL->base_url . 'setor/'; ?>setores.php">Voltar para Setores</a>
<hr>
<div>
	<form id="add-setor">
		<div class="form-group">
			<label for="nome-setor">Nome do Setor: *</label>
			<input type="text" class="form-control" required name="nome-setor" id="nome-setor">
		</div>
		<button type="submit" class="btn btn-default">Cadastrar</button>
	</form>
</div>