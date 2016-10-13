<?php
$nome = $_POST["nome_usuario"];
$login = $_POST["login_usuario"];

include('../conexao.php');
$sql = "SELECT id_usuario, nome_usuario, login_usuario, data_usuario FROM usuarios WHERE nome_usuario LIKE CONCAT('%', ?, '%') AND login_usuario LIKE CONCAT('%', ?, '%')";

$stmt = $conn->prepare($sql);
if(!$stmt){
	echo 'erro na consulta: '. $conn->errno .' - '. $conn->error;
}

$stmt->bind_param('ss', $nome, $login);
if($stmt->execute()){
	$stmt->bind_result($id_usuario, $nome_usuario, $login_usuario, $data_usuario);
	$stmt->store_result();
	if($stmt->num_rows){
		while ($stmt->fetch()) {

			?>
			<tr>
				<td> <?php echo $nome_usuario; ?> </td>
				<td> <?php echo $login_usuario; ?> </td>
				<td><?php echo $data_usuario; ?></td>
				<td><a href="alterar-usuario.php/<?php echo $id_usuario;?> ">Alterar</a> | <a href="#" class="deletar-usuario" id="<?php echo $id_usuario;?>">Deletar</a></td>
			</tr>
			<?php
		}
	}else{
		echo "-1";
	}
}

$conn->close();
?>