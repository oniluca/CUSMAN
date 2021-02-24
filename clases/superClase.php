<?php 
	 include_once('conexion.php');

	 class SuperClase{

	 	//atributos
	 	protected  $con;


		//metodos
		
		//crea un objeto conexion
		public function __construct(){
			$this->con = new Conexion();
		}

		//lista resultados de la consulta que recibe por parametro
		public function listar($sql){
			$resultado=$this->con->consultaRetorno($sql);
			return $resultado;

		}

		public function ejecutarSentencia($sql){
			$this->con->consultaSimple($sql);
		}

	 }

 ?>