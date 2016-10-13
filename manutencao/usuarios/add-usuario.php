<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Adicionar Usuários";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#add-usuario").submit(function(e){
			e.preventDefault();
			if($("input[name=confirmar_senha]").val() != $("input[name=senha]").val()){
				$("input[name=senha]").css("border-bottom", "1px solid red");
				$("input[name=confirmar_senha]").css("border-bottom", "1px solid red").focus();
				return false;
			}else{
				$.ajax({
					url: 'do-add-usuario.php',
					type: "POST",
					data: $("#add-usuario").serialize(),
					success: function(data){
						if(data == 1){
							var check = confirm("Usuário cadastrado com sucesso!Deseja cadastrar outro?");
							if(check){
								$("#add-usuario").each(function(){
									this.reset();
								});
							}else{
								window.location.href = "usuarios.php";
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
			}
		});
	});
</script>
<h1>Adicionar Usuários</h1>
<a href="<?php echo $TPL->base_url . 'usuarios/'; ?>usuarios.php">Voltar para Usuários</a>
<hr>
<div>
	<form id="add-usuario">

		<div class="form-group">
			<label for="marca">Nome: *</label>
			<input type="text" class="form-control" required name="nome" id="nome">
		</div>
		<div class="form-group">
			<label for="modelo">Login: *</label>
			<input type="text" class="form-control" required name="login" id="login">
		</div>
		<div class="form-group">
			<label for="modelo">Senha: *</label>
			<input type="password" class="form-control" required name="senha" id="senha">
		</div>
		<div class="form-group">
			<label for="modelo">Confirmar senha: *</label>
			<input type="password" class="form-control" required name="confirmar_senha" id="confirmar_senha">
		</div>
		<div>
			<button type="button" class="btn" data-toggle="modal" data-target="#myModal">Permissões</button>

			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Selecione o que este usuário poderá acessar</h4>
						</div>
						<div class="modal-body">
							<?php
							include('../conexao.php');
							$sql = "SELECT * FROM menus";
							$result = $conn->query($sql);

							if ($result->num_rows > 0){
								while($row = $result->fetch_assoc()){
									?>
									<div class="checkbox">
										<label><input type="checkbox" name="menu[]" value="<?php echo $row['id_menu']; ?>"><?php echo $row['nome_menu']; ?></label>
									</div>
									<?php }
								}else{
									echo "<h2>Não há menus</h2>";
								}
								$conn->close();
								?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Finalizar</button>
							</div>
						</div>

					</div>
				</div>
			</div>
			<br>
			<button type="submit" class="btn btn-default">Cadastrar</button>
		</form>
	</div>
	<div id="div-modal">

	</div>