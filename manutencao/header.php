<?php
require_once('template.php');
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
				<a class="navbar-brand" href="#">Brand</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo $TPL->base_url; ?>home.php">Home <span class="sr-only">(current)</span></a></li>
					<li><a href="<?php echo $TPL->base_url; ?>pecas/pecas.php">Peças</a></li>
					<li><a href="<?php echo $TPL->base_url; ?>computador/computadores.php">Computadores</a></li>
					<li><a href="<?php echo $TPL->base_url; ?>chamados/chamados.php">Chamados</a></li>
					<li><a href="<?php echo $TPL->base_url; ?>consertos/consertos.php">Consertos</a></li>
					<li><a href="<?php echo $TPL->base_url; ?>setor/setores.php">Setores</a></li>
				</ul>
				</div>
			</div>
		</nav>
		<div id="content" class="container">
			<?php if(isset($TPL->ContentBody)) { include $TPL->ContentBody; } ?>
		</div>
	</body>
	</html>