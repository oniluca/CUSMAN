<?php 
	
	$controlador = new ControladorServicios();

	if(isset($_POST['enviar'])){
		$resultado=$controlador->modificarServicio($_POST['servicio'],$_POST['valor'],$_GET['id']);
		header("location:?cargar=verServicio");
	}

 ?>