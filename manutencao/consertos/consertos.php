<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Consertos";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<h1>Consertos</h1>
<a href="add-conserto.php">Adicionar Conserto</a>
<hr>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Código</th>
			<th>Computador</th>
			<th>Problema</th>
			<th>Solução</th>
		</tr>
	</thead>
	<tbody>
		<?php
		include('../conexao.php');
		$sql = "SELECT * FROM conserto inner join pc on conserto.id_pc = pc.id_pc inner join setor on pc.setor_pc =  setor.id_setor";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				?>
				<tr>
					<td><a href="conserto.php/<?php echo $row['id_conserto']; ?>"><?php echo $row["codigo_conserto"]; ?></a></td>
					<td><a href="<?php echo $TPL->base_url; ?>/computador/computador.php/<?php echo $row['id_pc'];?>"><?php echo $row["codigo_pc"] . " - " . $row["nome_setor"] ?></a> </td>
					<td> <?php echo $row["problema"] ?> </td>
					<td> <?php echo $row["solucao"]; ?> </td>
				</tr>
				<?php }
			} else {
				echo "<h2>Não há consertos</h2>";
			}
			$conn->close();
			?>
	</tbody>
</table>