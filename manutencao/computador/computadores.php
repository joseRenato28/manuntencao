<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Computadores";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<h1>Computadores</h1>
<a href="add-computador.php">Adicionar Computador</a>
<hr>
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
			include('../conexao.php');
			$sql = "SELECT id_pc, codigo_pc, tipo_pc, setor.nome_setor FROM pc inner join setor on pc.setor_pc = setor.id_setor";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
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
				} else {
					echo "<h2>Não há computadores</h2>";
				}
				$conn->close();
		?>
</table>

