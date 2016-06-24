<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Setores";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		var id_setor;
		$("body").on("click", ".deletar-setor", function(e){
			e.preventDefault();
			id_setor = $(this).attr("id");
			var check_deletar_peca = confirm("Deseja mesmo deletar este setor?");
			if(check_deletar_peca){
				$.ajax({
					url: "do-deletar-setor.php",
					type: "POST",
					data:{id_setor: id_setor},
					success: function(data){
						if(data == "1"){
							alert("Setor deletado com sucesso");
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
	});
</script>
<h1>Setores</h1>
<a href="add-setor.php">Adicionar Setor</a>
<hr>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Setor</th>
			<th>Ação</th>
		</tr>
	</thead>
	<tbody>
				<?php
		include('../conexao.php');
		$sql = "SELECT * FROM setor";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) { ?>
				<tr>
					<td> <?php echo $row["nome_setor"] ?> </td>
					<td><a href="#" class="deletar-setor" id="<?php echo $row['id_setor'];?>">Deletar</a></td>
				</tr>

				<?php }
			} else {
				echo "<h2>Não há setores</h2>";
			}
			$conn->close();
			?>
	</tbody>
</table>