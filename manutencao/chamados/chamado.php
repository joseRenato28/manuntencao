<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Conserto";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
include('../conexao.php');
$id_chamado = $_SERVER['REQUEST_URI'];
$id_chamado_int = preg_replace("/[^0-9]/", "", $id_chamado);

$sql = "SELECT * FROM chamado WHERE id_chamado = '$id_chamado_int'";
$result = $conn->query($sql);
?>
<h1>Chamado</h1>
<a href="<?php echo $TPL->base_url . 'chamados/'; ?>chamados.php">Voltar para Chamados</a>
<hr>

<div class="col-md-12">
<?php
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		?>
			<div class="col-md-10">
				<h3>Código <?php echo $row["codigo_chamado"];?></h3>
			</div>
			<div class="col-md-10">
				<h4>Responsável: <?php echo $row["responsavel_chamado"]; ?></h4><h5> Setor: <?php echo $row["setor_chamado"]; ?> Data <?php echo $row["data_chamado"]; ?></h5>
			</div>
			<div class="col-md-10">
				<p><h5>Problema:</h5> <?php echo nl2br($row["problema_chamado"]); ?></p>
			</div>
		<?php 
	}
} else {
	echo "<h2>Erro ao encontrar os dados deste chamado</h2>";
}
?>
</div>