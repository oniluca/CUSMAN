<?php 

	include_once("modulos/controladorCliente.php");

	$controlador = new ControladorCliente();


	if(isset($_GET['id'])){
		$controlador->eliminarCliente($_GET['id']);

	}

 ?>