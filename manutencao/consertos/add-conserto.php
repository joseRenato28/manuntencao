<?php
require_once('../template.php');
if (!isset($TPL)) {
	$TPL = new Template();
	$TPL->PageTitle = "Adicionar conserto";
	$TPL->ContentBody = __FILE__;
	include "../header.php";
	exit;
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		var alterar_hardware = 0;
		/**** Keyups ****/
		// COMPUTADOR
		$("#codigo-comptuador").keyup(function(){
			if($(this).val().length > 1){
				$.ajax({
					url: "do-keyup-codigo-pc.php",
					type: "POST",
					data: {codigo_comptuador: $(this).val()},
					success: function(data){
						$(".auto-complete-codigo-pc > .list-group").html(data);
					},
					error: function(textStatus, data){
						console.log(data);
						alert("Ocorreu algum erro" + textStatus);
					}
				});
			}
		});
		$("body").on("click", ".escolhe-pc", function(){
			$(".auto-complete-codigo-pc > .list-group-item").removeClass("active");
			$(this).addClass("active");
			$(".pc-selecionado > .list-group").html("<a class='list-group-item active'>" +$(this).html()+"<br><span style='margin-right:15px;' id='abrir-modal'>Alterar Hardware</span><span id='abrir-modal-defeitos'>Defeitos</span></a>");
			$(".auto-complete-codigo-pc > .list-group").html("");
			var codigo = $(".pc-selecionado > .list-group > a").text().split("-");
			
			$("#codigo-comptuador").val(codigo[0].replace(/^\s+|\s+$/g,""));
		});
		// CHAMADO
		$("#chamado").keyup(function(){
			if($(this).val().length > 1){
				$.ajax({
					url: "do-keyup-chamado.php",
					type: "POST",
					data: {chamado: $(this).val()},
					success: function(data){
						$(".auto-complete-codigo-chamado > .list-group").html(data);
					},
					error: function(textStatus, data){
						console.log(data);
						alert("Ocorreu algum erro" + textStatus);
					}
				});
			}
		});
		$("body").on("click", ".escolhe-chamado", function(e){
			e.preventDefault();
			$(".auto-complete-codigo-chamado > .list-group-item").removeClass("active");
			$(this).addClass("active");
			$(".chamado-selecionado > .list-group").html("<a class='list-group-item active'>" +$(this).html()+"</a>");
			$(".auto-complete-codigo-chamado > .list-group").html("");
		});
		/*** keyups ***/

		//MODAL TROCA DE HARDWARE
		$("body").on("click", "#abrir-modal", function(){
			$.ajax({
				url: "modal-pc.php",
				type: "POST",
				data: {id_pc: $("#id_pc").val()},
				success: function(data){
					$("#modal").html(data);
				},
				error: function(data, textStatus){
					console.log(data);
					alert("Ocorreu algum erro para carregar o modal"+textStatus);
				}
			});
		});

		//MODAL DEFEITOS
		$("body").on("click", "#abrir-modal-defeitos", function(){
			$.ajax({
				url: "modal-pc-defeitos.php",
				type: "POST",
				data: {id_pc: $("#id_pc").val()},
				success: function(data){
					$("#modal").html(data);
				},
				error: function(data, textStatus){
					console.log(data);
					alert("Ocorreu algum erro para carregar o modal"+textStatus);
				}
			});
		});
		$("body").on("click", "#alterar_hardware", function(){
			alterar_hardware = 1;
		});
		//LIMPAR MODAL E ALTERAÇÃO DE HARDWARE
		$("body").on("click", ".auto-complete-codigo-pc > .list-group", function(){
			$("#modal").html("");
			alterar_hardware = 0;
		});
		
		/*** ADICIONAR CONSERTO ***/
		$("body").on("submit", "#add-conserto", function(e){
			e.preventDefault();
			if(alterar_hardware == 0){
				$.ajax({
					url: "do-add-conserto.php",
					type: "POST",
					data: {
						alterar_hardware : alterar_hardware,
						id_pc : $(".pc-selecionado > .list-group > a > #id_pc").val(),
						id_chamado: $(".chamado-selecionado > .list-group > a > #id_chamado").val(),
						problema : $("#problema").val(),
						data_entrada: $("#data-entrada").val(),
						solucao: $("#solucao").val(),
						data_entrega: $("#data-entrega").val()
					},
					success: function(data){
						if(data == 1){
							alert("Conserto cadastrado com sucesso");
							window.location.href = "consertos.php";
						}else{
							alert(data);
						}
					},
					error: function(data, textStatus){
						console.log(data);
						alert("Ocorreu algum erro " + textStatus);
					}
				});
			}else if(alterar_hardware == 1){
				$.ajax({
					url: "do-add-conserto.php",
					type: "POST",
					data: {
						alterar_hardware : alterar_hardware,
						id_pc : $(".pc-selecionado > .list-group > a > #id_pc").val(),
						id_chamado: $(".chamado-selecionado > .list-group > a > #id_chamado").val(),
						problema : $("#problema").val(),
						data_entrada: $("#data-entrada").val(),
						solucao: $("#solucao").val(),
						data_entrega: $("#data-entrega").val(),
						placa_mae: $("#placa-mae-pc option:selected").val(),
						fonte: $("#fonte-pc option:selected").val(),
						memoria_ram: $("#memoria-ram-pc option:selected").val(),
						quantia_memoria: $("#quantia-memoria-pc").val(),
						processador: $("#processador-pc option:selected").val(),
						hd: $("#hd-pc option:selected").val(),
						quantia_hd: $("#quantia-hd-pc").val(),
						off: $("#off-pc option:selected").val(),
						gabinete: $("#gabinete-pc option:selected").val()
					},
					success: function(data){
						if(data == 1){
							alert("Conserto cadastrado com sucesso");
							window.location.href = "consertos.php";
						}else{
							alert(data);
						}
					},
					error: function(data, textStatus){
						console.log(data);
						alert("Ocorreu algum erro " + textStatus);
					}
				});
			}else{
				alert("Ocorreu algum problema");
			}
		});
		/*** ***/
	});
</script>
<style type="text/css">
	.selecionar-pc{
		margin: 0; 
		max-width: 450px; 
		width:100%; 
		padding: 0;
		word-wrap: break-word;
	}
	span{
		cursor: pointer;
	}
	span:hover{
		color: #d6d6c2;
	}
</style>
<h1>Adicionar Conserto</h1>
<a href="<?php echo $TPL->base_url . 'consertos/'; ?>consertos.php">Voltar para Consertos</a>
<hr>
<div class="container">
	<form id="add-conserto">
		<div class="form-group">
			<label for="codigo-comptuador">Codigo do computador(nº patrimonio || nº de serie): *</label>
			<input type="text" class="form-control" required name="codigo-comptuador" autocomplete="off" id="codigo-comptuador">
			<div class="auto-complete-codigo-pc selecionar-pc">
				<div class="list-group"></div>
			</div>
			<div class="pc-selecionado selecionar-pc">
				<div class="list-group"></div>
			</div>
		</div>
		<div class="form-group">
			<label for="problema">Problema: *</label>
			<textarea class="form-control" required name="problema" id="problema"></textarea>
		</div>
		<div class="form-group">
			<label for="data-entrada">Data que recebeu o PC: *</label>
			<input type="date" class="form-control" required="required" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="data-entrada" id="data-entrada">
		</div>
		<div class="form-group">
			<label for="solucao">Solução: *</label>
			<textarea class="form-control" required name="solucao" id="solucao"></textarea>
		</div>
		<div class="form-group">
			<label for="data-entrega">Data de entrega: *</label>
			<input type="date" class="form-control" required="required" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="data-entrega" id="data-entrega">
		</div>
		<div class="form-group">
			<label for="data-entrega">Vincular chamado(Codigo do chamado):</label>
			<input type="text" autocomplete="off" class="form-control" name="chamado" id="chamado">
			<div class="auto-complete-codigo-chamado selecionar-pc">
				<div class="list-group"></div>
			</div>
			<div class="chamado-selecionado selecionar-pc">
				<div class="list-group"></div>
			</div>
		</div>
		<button type="submit" class="btn btn-default">Cadastrar</button>
	</form>
</div>
<div id="modal">
	
</div>