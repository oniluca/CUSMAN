<?php 
	
	$controlador = new ControladorServicios();


	if(isset($_POST['eliminar'])){
		$r=$controlador->eliminarServicio($_GET['id']);
		 header("location:?cargar=verServicio");
	}

 ?>