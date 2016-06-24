<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Computador";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
include('../conexao.php');
$id_pc = $_SERVER['REQUEST_URI'];
$id_pc_int = preg_replace("/[^0-9]/", "", $id_pc);

$sql = "SELECT *, setor.nome_setor FROM pc inner join setor on pc.setor_pc = setor.id_setor WHERE id_pc = '$id_pc_int'";
$result = $conn->query($sql);
?>
<h1>Computador</h1>
<a href="<?php echo $TPL->base_url . 'computador/'; ?>computadores.php">Voltar para Computadores</a>
<hr>
<div class="col-md-12">
<?php
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if($row["tipo_pc"] == "1"){
			$row["tipo_pc"] = "Desktop";
		}else if($row["tipo_pc"] == "2"){
			$row["tipo_pc"] = "NoteBook";
		}
		?>
			<div class="col-md-10">
				<h3> <?php echo $row["codigo_pc"]." - ".$row["tipo_pc"];?></h3>
			</div>
			<div class="col-md-10">
				<h5>Setor: <?php echo $row["nome_setor"]; ?> </h5>
			</div>
		<?php 
	}
} else {
	echo "<h2>Erro ao encontrar os dados deste computador</h2>";
}
// placa mae
$sql_placamae = "SELECT hardware.* FROM pc inner join hardware on pc.placa_mae_pc = hardware.id_hardware";
$result = $conn->query($sql_placamae);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Placa mãe </h4>
			<h5> <?php echo $row["marca_hardware"] . " - ". $row["modelo_hardware"] ?> </h5>
		</div>
		<?php
	}
}else{
	echo "<h2>Erro ao encontrar os dados da placa mãe deste computador";
}

// fonte de alimentação
$sql_fonte_de_alimentação = "SELECT hardware.* FROM pc inner join hardware on pc.fonte_pc = hardware.id_hardware";
$result = $conn->query($sql_fonte_de_alimentação);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Fonte de alimentação </h4>
			<h5> <?php echo $row["marca_hardware"] . " - ". $row["modelo_hardware"] ?> </h5>
		</div>
		<?php
	}
}else{
	echo "<h2>Erro ao encontrar os dados da fonte de alimentação deste computador";
}

// memoria ram
$sql_memoria = "SELECT hardware.*,	 pc.memoria_quantia FROM pc inner join hardware on pc.memoria_pc = hardware.id_hardware";
$result = $conn->query($sql_memoria);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Memoria ram </h4>
			<h5> <?php echo $row["marca_hardware"] . " - ". $row["modelo_hardware"] . " | quandia - ". $row["memoria_quantia"];?> </h5>
		</div>
		<?php
	}
}else{
	echo "<h2>Erro ao encontrar os dados da memoria ram deste computador";
}

// processador
$sql_processador = "SELECT hardware.* FROM pc inner join hardware on pc.processador_pc = hardware.id_hardware";
$result = $conn->query($sql_processador);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Processador </h4>
			<h5> <?php echo $row["marca_hardware"] . " - ". $row["modelo_hardware"];?> </h5>
		</div>
		<?php
	}
}else{
	echo "<h2>Erro ao encontrar os dados do processador deste computador";
}

// HD
$sql_hd = "SELECT hardware.*, pc.hd_quantia FROM pc inner join hardware on pc.hd_pc = hardware.id_hardware";
$result = $conn->query($sql_hd);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> HD </h4>
			<h5> <?php echo $row["marca_hardware"] . " - ". $row["modelo_hardware"] . " | quandia - ". $row["hd_quantia"];?> </h5>
		</div>
		<?php
	}
}else{
	echo "<h2>Erro ao encontrar os dados do HD deste computador";
}

// off-board
$sql_off_board = "SELECT hardware.* FROM pc inner join hardware on pc.off_board_pc = hardware.id_hardware";
$result = $conn->query($sql_off_board);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Placa off-board </h4>
			<h5> <?php echo $row["marca_hardware"] . " - ". $row["modelo_hardware"];?> </h5>
		</div>
		<?php
	}
}

// gabinete
$sql_gabinete = "SELECT hardware.* FROM pc inner join hardware on pc.gabinete_pc = hardware.id_hardware";
$result = $conn->query($sql_gabinete);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Gabinete </h4>
			<h5> <?php echo $row["marca_hardware"] . " - ". $row["modelo_hardware"];?> </h5>
		</div>
		<?php
	}
}

// descrição
$sql_descricao = "SELECT hardware.* FROM pc inner join hardware on pc.descricao_pc = hardware.id_hardware";
$result = $conn->query($sql_descricao);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Descrição </h4>
			<p> <?php echo $row["descricao_pc"];?> </p>
		</div>
		<?php
	}
}
?>
</div>