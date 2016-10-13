<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Peça";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
include('../conexao.php');
$id_peca = $_SERVER['REQUEST_URI'];
$id_peca_int = preg_replace("/[^0-9]/", "", $id_peca);

$sql = "SELECT * FROM hardware WHERE id_hardware = '$id_peca_int'";
$result = $conn->query($sql);
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
			}else if(id == "estatisticas"){
				pagina = 'estatisticas-peca.php';
			}else{
				return false;
			}

			$.ajax({
				type: "POST",
				url: "../"+pagina,
				data: {id_peca: $("#id_peca").val()},
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
<h1>Peça</h1>
<a href="<?php echo $TPL->base_url . 'pecas/'; ?>pecas.php">Voltar para Peças</a>
<hr>
<div id="menu-computador" class="col-md-3">
	<ul class="nav nav-pills nav-stacked">
	  <li id="descricao" class="active"><a href="#">Descrição</a></li>
	  <li id="estatisticas"><a href="#">Estatísticas</a></li>
	</ul>
</div>
<?php
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
		<div id="conteudo-primario" class="col-md-9">
			<input type="hidden" id="id_peca" value="<?php echo $row['id_hardware']; ?>"></input>
			<div class="col-md-10">
				<h2> <?php echo $row["tipo_hardware"] . " - " . $row["marca_hardware"]; ?> </h2>
			</div>
			<div class="col-md-9">
				<h4> <?php echo $row["modelo_hardware"]; ?> </h4>
			</div>
			<div class="col-md-12">
				<p><strong>Descrição:</strong><br> <?php echo nl2br($row["descricao_hardware"]); ?> </p>
			</div>
		</div>
		
		<?php 
	}
} else {
	echo "<h2>Erro ao encontrar os dados desta peça</h2>";
}
$conn->close();
?>
<div id="conteudo-secundario">
	
</div>