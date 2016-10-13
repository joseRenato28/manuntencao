<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Computadores";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
include('../conexao.php');
?>
<script type="text/javascript">
	$(document).ready(function(){
		var id_pc
		$("body").on("click", ".deletar-pc", function(e){
			e.preventDefault();
			id_pc = $(this).attr("id");
			var check_deletar_pc = confirm("Deseja mesmo deletar este computador?");
			if(check_deletar_pc){
				$.ajax({
					url: "do-deletar-computador.php",
					type: "POST",
					data:{id_pc: id_pc},
					success: function(data){
						if(data == "1"){
							alert("Computador deletado com sucesso");
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
		});
		$("#filtro_pc").submit(function(e){
			e.preventDefault();
			$.ajax({
				url: "filtro-computadores.php",
				type: "POST",
				dataType: "HTML",
				data: $("#filtro_pc").serialize(),
				success: function(data){
					if(data == '-1'){
						alert("Nenhum computador encontrado");
					}else{
						$("table > tbody").html(data);
					}
				},
				error: function(data, textStatus){
					console.log(data);
					alert("Ocorreu algum erro para fazer a busca:" + textStatus);
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
<h1>Computadores</h1>
<a href="add-computador.php">Adicionar Computador</a>
<hr>
<div class="col-md-12">
	<h5 class="filtro">Filtro</h5>
	<form id="filtro_pc">
		<div class="form-group">
			<input type="text" name="codigo_pc" class="form-control" placeholder="Código">
		</div>
		<div class="form-group">
			<select name="tipo_pc">
				<option value="0">Tipo</option>
				<option value="1">Desktop</option>
				<option value="2">NoteBook</option>
			</select>
		</div>
		<div class="form-group">
			<?php
			$setor = "SELECT * FROM setor";
			$result = $conn->query($setor);

			if($result->num_rows > 0){
				?>
				<select name="setor">
					<option value="0">Setores</option>
					<?php
					while($row = $result->fetch_assoc()) {
						?>
						<option value="<?php echo $row["id_setor"]; ?>"> <?php echo $row["nome_setor"]; ?> </option>
						<?php 
					}
					?>
				</select>
				<?php
			}
			?>
		</div>
		<button type="submit" class="btn btn-default">Buscar</button>
	</form>
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Tipo</th>
			<th>Setor</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT id_pc, codigo_pc, tipo_pc, setor.nome_setor FROM pc inner join setor on pc.setor_pc = setor.id_setor";
		$result = $conn->query($sql);

		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				if($row["tipo_pc"] == "1"){
					$row["tipo_pc"] = "Desktop";
				}else if($row["tipo_pc"] == "2"){
					$row["tipo_pc"] = "NoteBook";
				}
				?>
				<tr>
					<td><a href="computador.php/<?php echo $row['id_pc'];?>"><?php echo $row["codigo_pc"] ?> </a></td>
					<td> <?php echo $row["tipo_pc"] ?> </td>
					<td> <?php echo $row["nome_setor"] ?> </td>
					<td><a href="#" class="deletar-pc" id="<?php echo $row['id_pc'];?>">Deletar</a></td>
				</tr>

				<?php }
			}else{
				echo "<h2>Não há computadores</h2>";
			}
			$conn->close();
			?>
	</tbody>
</table>

