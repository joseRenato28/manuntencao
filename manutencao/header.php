<?php
require_once('template.php');
$TPL->login();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo $TPL->base_url; ?>assets/css/master.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="<?php echo $TPL->base_url; ?>assets/js/master.js"></script>
	<title><?php if(isset($TPL->PageTitle)) { echo $TPL->PageTitle; } ?></title>
	<?php if(isset($TPL->ContentHead)) { include $TPL->ContentHead; } ?>
	
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?php echo $_SESSION['nome_usuario']; ?></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo $TPL->base_url; ?>home.php">Home <span class="sr-only">(current)</span></a></li>
					<?php
					include('conexao.php');
					$id_usuario = $_SESSION["id_usuario"];
					$nivel_usuario = $_SESSION["nivel_usuario"];
					if($nivel_usuario == 2){
						$sql = "SELECT menus.* FROM menus";

						$result = $conn->query($sql);
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){
								?>
								<li><a href="<?php echo $TPL->base_url.$row["link"]; ?>"><?php echo $row["nome_menu"]; ?></a></li>
								<?php
							}
						}
					}else{
						$sql = "SELECT menus.* FROM menus inner join permissoes on menus.id_menu = permissoes.id_menu WHERE permissoes.id_usuario = '$id_usuario'";

						$result = $conn->query($sql);
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){
								?>
								<li><a href="<?php echo $TPL->base_url.$row["link"]; ?>"><?php echo $row["nome_menu"]; ?></a></li>
								<?php
							}
						}
						
					}
					?>
					<li><a href="<?php echo $TPL->base_url;?>usuarios/sair.php">Sair</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div id="content" class="container">
		<?php if(isset($TPL->ContentBody)) { include $TPL->ContentBody; } ?>
	</div>
</body>
</html>