<?php 
	require_once("superClase.php");


	class Usuario extends SuperClase{

		//atributos

		private $usuario;
		private $clave;





		// metodos}

		//setea los atributos de la clase mediante los valores que recibe	
		public function set($atributo, $contenido){
			$this->$atributo = $contenido;
		}

		public function login(){
			$sql="SELECT * from usuario where usuario='$this->usuario' and clave='$this->clave'";
			$resultado=$this->listar($sql);
			$resultado2=mysqli_fetch_assoc($resultado);
			if(mysqli_num_rows($resultado)==1){
				session_start();
				$_SESSION['login']=$resultado2['usuario'];
				$_SESSION['imgPerfil']=$resultado2['imagen'];
				return true;
			}else{
				return false;
			}

		}


		public function logout(){

			session_start();
			session_unset();
			session_destroy();
		}

	}




 ?>