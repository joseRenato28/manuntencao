<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Chamados";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<h1>Chamados</h1>
<a href="add-chamado.php">Adicionar Chamado</a>
<hr>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Código</th>
			<th>Setor</th>
			<th>Responsavel</th>
			<th>Data</th>
		</tr>
	</thead>
	<tbody>
		<?php
		include('../conexao.php');
		$sql = "SELECT * FROM chamado";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				?>
				<tr>
					<td><a href="<?php echo $TPL->base_url; ?>chamados/chamado.php/<?php echo $row['id_chamado'];?>"><?php echo $row["codigo_chamado"]; ?></a> </td>
					<td> <?php echo $row["setor_chamado"] ?> </td>
					<td> <?php echo $row["responsavel_chamado"]; ?> </td>
					<td> <?php echo date('d/m/Y', strtotime($row["data_chamado"]));?></td>
				</tr>

				<?php }
			} else {
				echo "<h2>Não há chamados</h2>";
			}
			$conn->close();
			?>
	</tbody>
</table>