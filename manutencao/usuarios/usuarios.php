<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Usuários";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		var id_usuario;
		$("body").on("click", ".deletar-usuario", function(e){
			e.preventDefault();
			id_usuario = $(this).attr("id");
			var check_deletar_peca = confirm("Deseja mesmo deletar este usuário?");
			if(check_deletar_peca){
				$.ajax({
					url: "do-deletar-usuario.php",
					type: "POST",
					data:{id_usuario: id_usuario},
					success: function(data){
						if(data == "1"){
							alert("Usuário deletado com sucesso");
							reloadTable(window.location.href);
						}else{
							alert(data);
						}
					},
					error: function(data, textStatus){
						console.log(data);
						alert("Ocorreu algum erro:" + textStatus);
					}
				});
			}
		})
		$("#filtro_usuarios").submit(function(e){
			e.preventDefault();
			
			$.ajax({
				url: "filtro-usuarios.php",
				type: "POST",
				dataType: "HTML",
				data: $("#filtro_usuarios").serialize(),
				success: function(data){
					if(data == '-1'){
						alert("Nenhum usuário encontrado");
					}else{
						$("table > tbody").html(data);
					}
				},
				error: function(data, textStatus){
					console.log(data);
					alert("Ocorreu algum erro para buscar os usuários:" + textStatus);
				}

			});
		});
	});
</script>
<style type="text/css">
	form div, form button{
		float: left;
		width: 100%;
		max-width: 250px;
		margin-left: 15px;
	}
	form div select, form div input{
		width: 100%;
	}
</style>
<h1>Usuários</h1>
<a href="add-usuario.php">Adicionar usuários</a>
<hr>
<div class="col-md-12">
	<h5 class="filtro">Filtro</h5>
	<form id="filtro_usuarios">
		<div class="form-group">
			<input type="text" name="nome_usuario" class="form-control" placeholder="Nome">
		</div>
		<div class="form-group">
			<input type="text" name="login_usuario" class="form-control" placeholder="Login">
		</div>
		<button type="submit" class="btn btn-default">Buscar</button>
	</form>
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Login</th>
			<th>Criado em</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php
		include('../conexao.php');
		$sql = "SELECT * FROM usuarios";
		$result = $conn->query($sql);

		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				?>
				<tr>
					<td> <?php echo $row["nome_usuario"] ?> </td>
					<td> <?php echo $row["login_usuario"] ?> </td>
					<td><?php echo $row["data_usuario"] ?> </td>
					<td><a href="alterar-usuario.php/<?php echo $row['id_usuario'];?> ">Alterar</a> | <a href="#" class="deletar-usuario" id="<?php echo $row['id_usuario'];?>">Deletar</a></td>
				</tr>
				<?php }
			}else{
				echo "<h2>Não há usuários</h2>";
			}
			$conn->close();
			?>
		</tbody>
</table>