<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Peças";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		var id_peca;
		$("body").on("click", ".deletar-peca", function(e){
			e.preventDefault();
			id_peca = $(this).attr("id");
			var check_deletar_peca = confirm("Deseja mesmo deletar esta peça?");
			if(check_deletar_peca){
				$.ajax({
					url: "do-deletar-peca.php",
					type: "POST",
					data:{id_peca: id_peca},
					success: function(data){
						if(data == "1"){
							alert("Peça deletada com sucesso");
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
<h1>Peças</h1>
<a href="add-pecas.php">Adicionar Peça</a>
<hr>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Tipo</th>
			<th>Marca</th>
			<th>Modelo</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php
		include('../conexao.php');
		$sql = "SELECT * FROM hardware";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row["tipo_hardware"] == "1"){
					$row["tipo_hardware"] = "Placa mãe";
				}else if($row["tipo_hardware"] == "2"){
					$row["tipo_hardware"] = "Fonte de Alimentação";
				}else if($row["tipo_hardware"] == "3"){
					$row["tipo_hardware"] = "Memoria ram";
				}else if($row["tipo_hardware"] == "4"){
					$row["tipo_hardware"] = "Processador";
				}else if($row["tipo_hardware"] == "5"){
					$row["tipo_hardware"] = "HD";
				}else if($row["tipo_hardware"] == "6"){
					$row["tipo_hardware"] = "Placa de Vídeo";
				}else if($row["tipo_hardware"] == "7"){
					$row["tipo_hardware"] = "Placa de rede Ethernet";
				}else if($row["tipo_hardware"] == "8"){
					$row["tipo_hardware"] = "Placa de rede Wireless";
				}else if($row["tipo_hardware"] == "9"){
					$row["tipo_hardware"] = "Placa USB";
				}else if($row["tipo_hardware"] == "10"){
					$row["tipo_hardware"] = "Gabinete";
				}else if($row["tipo_hardware"] == "11"){
					$row["tipo_hardware"] = "Outro";
				}
				?>
				<tr>
					<td> <?php echo $row["tipo_hardware"] ?> </td>
					<td> <?php echo $row["marca_hardware"] ?> </td>
					<td><a href="peca.php/<?php echo $row['id_hardware']; ?>"> <?php echo $row["modelo_hardware"] ?> </a></td>
					<td><a href="alterar-peca.php/<?php echo $row['id_hardware'];?> ">Alterar</a> | <a href="#" class="deletar-peca" id="<?php echo $row['id_hardware'];?>">Deletar</a></td>
				</tr>

				<?php }
			} else {
				echo "<h2>Não há peças</h2>";
			}
			$conn->close();
			?>
		</tbody>
	</table>