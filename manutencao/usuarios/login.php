<?php 
	session_start();
	if(isset($_SESSION['id_usuario'])){
		$redirect = "../home.php";
		header("location:$redirect");
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("form").submit(function(e){
				e.preventDefault();
				$.ajax({
					url: "do-login.php",
					type: "POST",
					dataType: "HTML",
					data: $("form").serialize(),
					success: function(data){
						if(data == 1){
							window.location.href = "../home.php";
						}else{
							alert(data);
						}
					},
					error: function(data, textStatus){
						alert("Ocorreu algum erro: "+textStatus);
						console.log(data);
					}
				});
			});
		});
	</script>
	<style type="text/css">
		.content {
			position: absolute;
			top: 30%;
			left:45%;
			transform: translate(-50%,-50%);
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="text-center content">
			<h2>Área restrita</h2>
			<form class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Login:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" required id="login" name="login" placeholder="Entrar com login">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Senha:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" required id="senha" name="senha" placeholder="Entrar com a senha">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
							<label><input type="checkbox">Lembrar usuário</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Entrar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>