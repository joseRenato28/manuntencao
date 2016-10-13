<?php
	if(!isset($_POST["id_peca"])){
		echo "Ocorreu algum problema para recuperar o numero identificador desta peça";
	}else{
		$id_peca = $_POST["id_peca"];
		$id_peca_int = preg_replace("/[^0-9]/", "", $id_peca);

	}
?>