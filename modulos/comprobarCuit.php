<?php 
		 include_once("../clases/cliente.php");


		 $cliente = new Cliente();

		if (isset($_POST['cuit']) && !empty($_POST['cuit'])) {
			
			$cuit=$_POST['cuit'];

			$comprobarCuit = $cliente->comprobarCuit($cuit);

			if($comprobarCuit>0){
				 echo json_encode(array('success'=> 1));

			}else{
				 echo json_encode(array('success'=> 0));

			}
		}



 ?>