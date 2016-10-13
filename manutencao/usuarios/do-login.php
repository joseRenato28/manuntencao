<?php

$login = $_POST["login"];
$senha = md5($_POST["senha"]);

include('../conexao.php');

$check_login = "SELECT id_usuario, nivel_usuario, login_usuario, nome_usuario FROM usuarios WHERE login_usuario = ? AND senha_usuario = ?";
$stmt = $conn->prepare($check_login);
if(!$stmt){
	echo 'erro para verificar este usuário no banco de dados: '. $conn->errno .' - '. $conn->error;
}

$stmt->bind_param('ss', $login, $senha);

if($stmt->execute()){
	$stmt->bind_result($id_usuario, $nivel_usuario, $login_usuario, $nome_usuario);
	$stmt->store_result();
	if($stmt->num_rows > 0){
		while ($stmt->fetch()) {
			echo 1;
			
  			if (!isset($_SESSION)){session_start();}
			$_SESSION['id_usuario'] = $id_usuario;
			$_SESSION['nivel_usuario'] = $nivel_usuario;
			$_SESSION['login_usuario'] = $login_usuario;
			$_SESSION['nome_usuario'] = $nome_usuario;
		}
	}else{
		echo "Login ou senha incorretos";
	}
}
?>