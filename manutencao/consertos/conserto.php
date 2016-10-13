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
$id_conserto = $_SERVER['REQUEST_URI'];
$id_conserto_int = preg_replace("/[^0-9]/", "", $id_conserto);
$sql = "SELECT conserto.*, setor.nome_setor, pc.codigo_pc FROM conserto inner join pc on conserto.id_pc = pc.id_pc inner join pc_hardware_antigo on conserto.id_pc_hardware_antigo = pc_hardware_antigo.id_pc_hardware_antigo inner join setor on pc.setor_pc = setor.id_setor WHERE conserto.id_conserto = '$id_conserto_int'";
$result = $conn->query($sql);
?>
<h1>Conserto</h1>
<a href="<?php echo $TPL->base_url . 'consertos/'; ?>consertos.php">Voltar para Consertos</a>
<hr>

<div class="col-md-12">
<?php
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		?>
			<div class="col-md-10">
				<h3> <?php echo $row["codigo_pc"]." - ".$row["nome_setor"];?></h3>
				<h5>
					<?php
						if($row["id_chamado"] != 0){
							$id_chamado = $row["id_chamado"];
							$sql_chamado = "SELECT codigo_chamado, id_chamado FROM chamado WHERE id_chamado = '$id_chamado'";
							$result = $conn->query($sql_chamado);
							if($result->num_rows > 0){
								$row_chamado = $result->fetch_assoc();
								?>
									Chamado: <a href="<?php echo $TPL->base_url . 'chamados/chamado/'. $row_chamado['id_chamado'];?>"><?php $row["codigo_chamado"]; ?></a>
								<?php
							}else{	
								echo "Ocorreu algum erro para recuperar o chamado";
							}
						}
					?>
				</h5>
			</div>
			<div class="col-md-4"><h4><p>Data de recebimento</p><?php echo date('d/m/Y', strtotime($row["data_recebeu"]));?></h4></div>
			<div class="col-md-4"><h4><p>Data de entrega</p><?php echo date('d/m/Y', strtotime($row["data_entrega"]));?></h4></div>
			<div class="col-md-4">
				<a href="<?php echo $TPL->base_url. 'hardware-antigo/';?>hardware.php/<?php echo $row['id_pc_hardware_antigo'] ?>">Visualizar Hardware alterado</a>
			</div>
			<div class="col-md-6"><p><h4>Problema</h4> <?php echo nl2br($row["problema"]); ?></p></div>
			<div class="col-md-6"><p><h4>Solução</h4> <?php echo nl2br($row["solucao"]); ?></p></div>
		<?php 
	}
} else {
	$sql_sem_hardware_antigo = "SELECT conserto.*, setor.nome_setor, pc.codigo_pc FROM conserto inner join pc on conserto.id_pc = pc.id_pc inner join setor on pc.setor_pc = setor.id_setor WHERE conserto.id_conserto = '$id_conserto_int'";
	$result_sem_hardware_antigo = $conn->query($sql_sem_hardware_antigo);

	if ($result_sem_hardware_antigo->num_rows > 0) {
	while($row = $result_sem_hardware_antigo->fetch_assoc()) {
		?>
			<div class="col-md-10">
				<h3> <?php echo $row["codigo_pc"]." - ".$row["nome_setor"];?></h3>
				<h5>
					<?php
						if($row["id_chamado"] != 0){
							$id_chamado = $row["id_chamado"];
							$sql_chamado = "SELECT codigo_chamado, id_chamado FROM chamado WHERE id_chamado = '$id_chamado'";
							$result = $conn->query($sql_chamado);
							if($result->num_rows > 0){
								$row_chamado = $result->fetch_assoc();
								?>
									Chamado: <a href="<?php echo $TPL->base_url . 'chamados/chamado.php/'. $row_chamado['id_chamado'];?>"> <?php echo $row_chamado["codigo_chamado"]; ?></a>
								<?php
							}else{	
								echo "Ocorreu algum erro para recuperar o chamado";
							}
						}
					?>
				</h5>
			</div>
			<div class="col-md-4"><h4><p>Data de recebimento</p><?php echo date('d/m/Y', strtotime($row["data_recebeu"]));?></h4></div>
			<div class="col-md-4"><h4><p>Data de entrega</p><?php echo date('d/m/Y', strtotime($row["data_entrega"]));?></h4></div>
			<div class="col-md-4">
				<h5>Não há alterações de hardware</h5>
			</div>
			<div class="col-md-6"><p><h4>Problema</h4> <?php echo nl2br($row["problema"]); ?></p></div>
			<div class="col-md-6"><p><h4>Solução</h4> <?php echo nl2br($row["solucao"]); ?></p></div>
		<?php 
	}
}else{
	echo "<h2>Erro ao encontrar os dados deste conserto</h2>";
}
}
?>
</div>