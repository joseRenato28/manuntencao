<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Hardware Antigo";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
include('../conexao.php');
$id_hardware_antigo = $_SERVER['REQUEST_URI'];
$id_hardware_antigo_int = preg_replace("/[^0-9]/", "", $id_hardware_antigo);

$sql = "SELECT pc_hardware_antigo.*, setor.nome_setor FROM pc_hardware_antigo inner join setor on pc_hardware_antigo.setor_pc_antigo = setor.id_setor WHERE pc_hardware_antigo.id_pc_hardware_antigo = '$id_hardware_antigo_int'";
$result = $conn->query($sql);
?>
<h1>Hardware Alterado</h1>
<hr>
<div class="col-md-12">
<?php
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if($row["tipo_pc_antigo"] == "1"){
			$row["tipo_pc_antigo"] = "Desktop";
		}else if($row["tipo_pc_antigo"] == "2"){
			$row["tipo_pc_antigo"] = "NoteBook";
		}
		?>
			<div class="col-md-10">
				<h3><a title="Verificar como esta este computador atualmente" href="<?php echo $TPL->base_url. 'computador/'?>computador.php/<?php echo $row['id_pc_antigo'];?>"> <?php echo $row["codigo_pc_antigo"]." - ".$row["tipo_pc_antigo"];?></a></h3>
				<div class="col-md-6">
					<h4>Data de alteração <?php echo date('d/m/Y', strtotime($row["data_pc_antigo"])); ?></h4>
				</div>
			</div>
			<div class="col-md-10">
				<h5>Setor: <?php echo $row["nome_setor"]; ?> </h5>
			</div>
		<?php 
	}
} else {
	echo "<h2>Erro ao encontrar os dados desta alteração de hardware</h2>";
}
// placa mae
$sql_placamae = "SELECT hardware.* FROM pc_hardware_antigo inner join hardware on pc_hardware_antigo.placa_mae_pc_antigo = hardware.id_hardware WHERE pc_hardware_antigo.id_pc_hardware_antigo ='$id_hardware_antigo_int'";
$result = $conn->query($sql_placamae);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Placa mãe </h4>
			<h5> <?php echo "<a href='".$TPL->base_url."pecas/peca.php/".$row["id_hardware"]."'>".$row["marca_hardware"] . " - ". $row["modelo_hardware"]."</a>"; ?> </h5>
		</div>
		<?php
	}
}else{
	?>
		<div class="col-md-10">
			<h5 style="color:#b30000">Não foi possivel encontrar os dados da placa mãe</h5>
		</div>
	<?php
}

// fonte de alimentação
$sql_fonte_de_alimentação = "SELECT hardware.* FROM pc_hardware_antigo inner join hardware on pc_hardware_antigo.fonte_pc_antigo = hardware.id_hardware WHERE pc_hardware_antigo.id_pc_hardware_antigo ='$id_hardware_antigo_int'";
$result = $conn->query($sql_fonte_de_alimentação);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Fonte de alimentação </h4>
			<h5> <?php echo "<a href='".$TPL->base_url."pecas/peca.php/".$row["id_hardware"]."'>".$row["marca_hardware"] . " - ". $row["modelo_hardware"]."</a>"; ?> </h5>
		</div>
		<?php
	}
}else{
		?>
		<div class="col-md-10">
			<h5 style="color:#b30000">Não foi possivel encontrar os dados da fonte de alimentação</h5>
		</div>
	<?php
}

// memoria ram
$sql_memoria = "SELECT hardware.*,	 pc_hardware_antigo.quantia_memoria_pc_antigo FROM pc_hardware_antigo inner join hardware on pc_hardware_antigo.memoria_pc_antigo = hardware.id_hardware WHERE pc_hardware_antigo.id_pc_hardware_antigo ='$id_hardware_antigo_int'";
$result = $conn->query($sql_memoria);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Memoria ram </h4>
			<h5> <?php echo "<a href='".$TPL->base_url."pecas/peca.php/".$row["id_hardware"]."'>".$row["marca_hardware"] . " - ". $row["modelo_hardware"]. " | quantia - ". $row["quantia_memoria_pc_antigo"]."</a>"; ?> </h5>
		</div>
		<?php
	}
}else{
		?>
		<div class="col-md-10">
			<h5 style="color:#b30000">Não foi possivel encontrar os dados da memoria ram</h5>
		</div>
	<?php
}

// processador
$sql_processador = "SELECT hardware.* FROM pc_hardware_antigo inner join hardware on pc_hardware_antigo.processador_pc_antigo = hardware.id_hardware WHERE pc_hardware_antigo.id_pc_hardware_antigo ='$id_hardware_antigo_int'";
$result = $conn->query($sql_processador);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Processador </h4>
			<h5> <?php echo "<a href='".$TPL->base_url."pecas/peca.php/".$row["id_hardware"]."'>".$row["marca_hardware"] . " - ". $row["modelo_hardware"]."</a>"; ?> </h5>
		</div>
		<?php
	}
}else{
		?>
		<div class="col-md-10">
			<h5 style="color:#b30000">Não foi possivel encontrar os dados do processador</h5>
		</div>
	<?php
}

// HD
$sql_hd = "SELECT hardware.*, pc_hardware_antigo.quantia_hd_pc_antigo FROM pc_hardware_antigo inner join hardware on pc_hardware_antigo.hd_pc_antigo = hardware.id_hardware WHERE pc_hardware_antigo.id_pc_hardware_antigo ='$id_hardware_antigo_int'";
$result = $conn->query($sql_hd);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> HD </h4>
			<h5> <?php echo "<a href='".$TPL->base_url."pecas/peca.php/".$row["id_hardware"]."'>".$row["marca_hardware"] . " - ". $row["modelo_hardware"]. " | quantia - ". $row["quantia_hd_pc_antigo"]."</a>"; ?> </h5>
		</div>
		<?php
	}
}else{
		?>
		<div class="col-md-10">
			<h5 style="color:#b30000">Não foi possivel encontrar os dados do HD</h5>
		</div>
	<?php
}

// off-board
$sql_off_board = "SELECT hardware.* FROM pc_hardware_antigo inner join hardware on pc_hardware_antigo.off_board_pc_antigo = hardware.id_hardware WHERE pc_hardware_antigo.id_pc_hardware_antigo ='$id_hardware_antigo_int'";
$result = $conn->query($sql_off_board);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Placa off-board </h4>
			<h5> <?php echo "<a href='".$TPL->base_url."pecas/peca.php/".$row["id_hardware"]."'>".$row["marca_hardware"] . " - ". $row["modelo_hardware"]."</a>"; ?> </h5>
		</div>
		<?php
	}
}

// gabinete
$sql_gabinete = "SELECT hardware.* FROM pc_hardware_antigo inner join hardware on pc_hardware_antigo.gabinete_pc_antigo = hardware.id_hardware WHERE pc_hardware_antigo.id_pc_hardware_antigo ='$id_hardware_antigo_int'";
$result = $conn->query($sql_gabinete);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<div class="col-md-10">
			<h4> Gabinete </h4>
			<h5> <?php echo "<a href='".$TPL->base_url."pecas/peca.php/".$row["id_hardware"]."'>".$row["marca_hardware"] . " - ". $row["modelo_hardware"]."</a>"; ?> </h5>
		</div>
		<?php
	}
}
$conn->close();
?>
</div>