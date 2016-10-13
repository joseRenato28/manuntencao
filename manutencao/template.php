<?php
class Template{
	public $ContentHead;
	public $PageTitle;
	public $ContentBody;
	public $base_url = 'http://192.168.1.213/manutencao/';

	public function login(){
		session_start();
		if(!isset($_SESSION['id_usuario'])){
			$redirect = $this->base_url."usuarios/login.php";
			header("location:$redirect");
		}	
	}
}