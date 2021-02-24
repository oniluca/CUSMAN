<?php 
	include_once("../clases/usuario.php");

	class ValidacionUsuario{

		// atributos
		private $usuario;



		// metodos

		public function __construct(){
			$this->usuario = new Usuario();
		}

		
		public function validarUsuario($usuario,$clave){

			$this->usuario->set('usuario',$usuario);
			$this->usuario->set('clave',$clave);
			$resultado=$this->usuario->login();
			return $resultado;
		}

		public function logout(){
			$this->usuario->logout();

		}



	}



 ?>