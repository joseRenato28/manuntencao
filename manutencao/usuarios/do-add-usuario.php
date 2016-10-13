<?php

if(!isset($_POST["nome"]) || !isset($_POST["login"]) || !isset($_POST["senha"])){
	echo "Ocorreu algum erro para recuperar alguns dados";
}else if(!isset($_POST["menu"])){
	echo "Selecione as permissoes de menu";
}else{
	$nome = $_POST["nome"];
	$login = $_POST["login"];
	$senha = $_POST["senha"];
	$menus = $_POST["menu"];
	$check = false;
	if(empty($nome) || empty($login) || empty($senha)){
		echo "Campos com * são obritagórios";
	}else if(empty($menus)){
		echo "Nenhuma permissão de menu selecionada";
	}else{
		$id_usuario;
		include('../conexao.php');

		$sql = "INSERT INTO usuarios (nome_usuario, login_usuario, senha_usuario, data_usuario) VALUES (?, ?, ?, current_date())";
		$stmt = $conn->prepare($sql);
		if(!$stmt){
			echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
		}
		$md5_senha = md5($senha);
		$stmt->bind_param('sss', $nome, $login, $md5_senha);

		if(!$stmt->execute()){
			echo "Ocorreu algum erro para cadastrar o usuário";
		}
		$id_usuario = $stmt->insert_id;
		foreach ($menus as $key => $menu) {
			$permissao = "INSERT INTO permissoes (id_usuario, id_menu) VALUES (?, ?)";
			$stmt = $conn->prepare($permissao);
			if(!$stmt){
				echo 'erro na consulta: '. $conn->errno . ' - '.$conn->error;
			}
			$stmt->bind_param('ii', $id_usuario, $menu);
			if($stmt->execute()){
				$check = true;
			}
		}
		if($check){
			echo 1;
		}
		$conn->close();
	}
}
?>