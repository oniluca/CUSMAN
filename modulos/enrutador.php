<?php 


	class Enrutador{


		//funcion que se encarga de cargar la vista dependiendo de que se elija en el menu
		public function cargarVista($vista){

			switch ($vista) {
				case 'inicio':
					include_once('vistas/'.$vista.'.php');
					break;
				case 'nuevoCliente':
					include_once('vistas/'.$vista.'.php');
					break;
				case 'modificarCliente':
					include_once('vistas/'.$vista.'.php');
					break;
				case 'eliminarCliente':
					include_once('vistas/'.$vista.'.php');
					break;
				case 'nuevoServicio':
					include_once('vistas/'.$vista.'.php');
					break;
				case 'modificarServicio':
					include_once('vistas/'.$vista.'.php');
					break;
				case 'eliminarServicio':
					include_once('vistas/'.$vista.'.php');
					break;
				case 'verCliente':
					include_once('vistas/'.$vista.'.php');
					break;
				case 'verVencimientos':
					include_once('vistas/'.$vista.'.php');
					break;
				case 'modificarVencimientos':
					include_once('vistas/'.$vista.'.php');
					break;
				

				default:
					include_once('vistas/error.php');
					break;
			}
		}


		//funcion que carga la vista por defeco si no recibe nada
		public function validarGet($variable){
			if(empty($variable)){
				include_once('vistas/inicio.php');
			}else{
				return true;
			}
		}
	}

 ?>