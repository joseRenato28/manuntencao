<?php
include('../conexao.php');

$id_usuario = $_POST['id_usuario'];


if($id_usuario == null){
	echo "ocorreu algum erro para recuperar o número idenficador";
}else{
	$permissoes = "DELETE FROM permissoes WHERE id_usuario = ?";
	$stmt = $conn->prepare($permissoes);
	if(!$stmt){
		echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
	}

	$stmt->bind_param('i', $id_usuario);
	if(!$stmt->execute()){
		echo "Erro para exluir as permissoes de usuário";
	}

	$sql = "DELETE FROM usuarios WHERE id_usuario = ?";

	$stmt = $conn->prepare($sql);
	if(!$stmt){
		echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
	}

	$stmt->bind_param('i', $id_usuario);
	if($stmt->execute()){
		echo "1";
	}

	$conn->close();
}
?>