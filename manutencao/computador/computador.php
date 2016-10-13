<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Computador";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#menu-computador > ul > li").click(function(){
			$("li").removeClass("active");
			$(this).addClass("active");
			var id = $(this).attr("id");
			var pagina;

			if(id == "descricao"){
				$("#conteudo-secundario").html("");
				$("#conteudo-primario").show();
				return false;
			}else if(id == "consertos"){
				pagina = 'consertos-computador.php';
			}else if(id == "alteracoes"){
				pagina = 'alteracoes-computador.php';
			}else{
				return false;
			}

			$.ajax({
				type: "POST",
				url: "../"+pagina,
				data: {id_pc: $("#id_pc").val()},
				success: function(data){
					$("#conteudo-primario").hide();
					$("#conteudo-secundario").html(data);
				},
				error: function(textStatus, data){
					console.log(data);
					alert("Ocorreu algum erro" + textStatus);
				}
			});
		});

	});
</script>
<?php
include('../conexao.php');
$id_pc = $_SERVER['REQUEST_URI'];
$id_pc_int = preg_replace("/[^0-9]/", "", $id_pc);

$sql = "SELECT *, setor.nome_setor FROM pc inner join setor on pc.setor_pc = setor.id_setor WHERE id_pc = '$id_pc_int'";
$result = $conn->query($sql);
?>
<h1>Computador</h1>
<a href="<?php echo $TPL->base_url . 'computador/'; ?>computadores.php">Voltar para Computadores</a>
<hr>
<div id="menu-computador" class="col-md-3">
	<ul class="nav nav-pills nav-stacked">
		<li id="descricao" class="active"><a href="#">Descrição</a></li>
		<li id="consertos"><a href="#">Consertos</a></li>
		<li id="alteracoes"><a href="#">Alterações de Hardware</a></li>
	</ul>
</div>
<div id="conteudo-primario" class="col-md-9">
	<?php
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$tipo_pc = $row["tipo_pc"];
			if($row["tipo_pc"] == "1"){
				$row["tipo_pc"] = "Desktop";
			}else if($row["tipo_pc"] == "2"){
				$row["tipo_pc"] = "NoteBook";
			}
			?>
			<input type="hidden" id="id_pc" value="<?php echo $row['id_pc']; ?>"></input>
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
	if($tipo_pc == "1"){

	// placa mae
		$sql_placamae = "SELECT hardware.* FROM pc inner join hardware on pc.placa_mae_pc = hardware.id_hardware WHERE pc.id_pc ='$id_pc_int'";
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
		$sql_fonte_de_alimentação = "SELECT hardware.* FROM pc inner join hardware on pc.fonte_pc = hardware.id_hardware WHERE pc.id_pc ='$id_pc_int'";
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
		$sql_memoria = "SELECT hardware.*,	 pc.memoria_quantia FROM pc inner join hardware on pc.memoria_pc = hardware.id_hardware WHERE pc.id_pc ='$id_pc_int'";
		$result = $conn->query($sql_memoria);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				?>
				<div class="col-md-10">
					<h4> Memoria ram </h4>
					<h5> <?php echo "<a href='".$TPL->base_url."pecas/peca.php/".$row["id_hardware"]."'>".$row["marca_hardware"] . " - ". $row["modelo_hardware"]. " | quantia - ". $row["memoria_quantia"]."</a>"; ?> </h5>
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
		$sql_processador = "SELECT hardware.* FROM pc inner join hardware on pc.processador_pc = hardware.id_hardware WHERE pc.id_pc ='$id_pc_int'";
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
		$sql_hd = "SELECT hardware.*, pc.hd_quantia FROM pc inner join hardware on pc.hd_pc = hardware.id_hardware WHERE pc.id_pc ='$id_pc_int'";
		$result = $conn->query($sql_hd);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				?>
				<div class="col-md-10">
					<h4> HD </h4>
					<h5> <?php echo "<a href='".$TPL->base_url."pecas/peca.php/".$row["id_hardware"]."'>".$row["marca_hardware"] . " - ". $row["modelo_hardware"]. " | quantia - ". $row["hd_quantia"]."</a>"; ?> </h5>
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
		$sql_off_board = "SELECT hardware.* FROM pc inner join hardware on pc.off_board_pc = hardware.id_hardware WHERE pc.id_pc ='$id_pc_int'";
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
		$sql_gabinete = "SELECT hardware.* FROM pc inner join hardware on pc.gabinete_pc = hardware.id_hardware WHERE pc.id_pc ='$id_pc_int'";
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

	}else if($tipo_pc == 2){
		$marca_pc = "SELECT modelo_pc, marca_pc FROM pc WHERE id_pc = '$id_pc_int'";
		$result = $conn->query($marca_pc);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				?>
				<div class="col-md-10">
					<h4>Marca</h4>
					<h5> <?php echo $row["marca_pc"]; ?> </h5>
					<h4>Modelo</h4>
					<h5> <?php echo $row["modelo_pc"]; ?> </h5>
				</div>
				<?php
			}
		}
	}else{
		echo "Tipo de computador invalido";
	}


// descrição
	$sql_descricao = "SELECT descricao_pc FROM pc WHERE id_pc = '$id_pc_int'";
	$result = $conn->query($sql_descricao);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			?>
			<div class="col-md-10">
				<h4> Descrição </h4>
				<p> <?php echo nl2br($row["descricao_pc"]);?> </p>
			</div>
			<?php
		}
	}
	$conn->close();
	?>
</div>
<div id="conteudo-secundario" class="col-md-9"></div>