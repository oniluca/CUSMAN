<?php 

	require_once("clases/servicios.php");


	class ControladorServicios{


		// atributos
		private $servicios;

	




		// metodos

		public function __construct(){
			$this->servicios = new Servicios();
		}

		public function crearServicio(){

		}

		public function modificarServicio($servicio,$valor,$id){
			$this->servicios->set('servicios',$servicio);
			$this->servicios->set('valor',$valor);
			$this->servicios->set('id',$id);
			$this->servicios->modificarServicio();
		}

		public function eliminarServicio($id){
			$this->servicios->set('id',$id);
			$this->servicios->eliminarServicio();

		}

		public function listarServicios(){
			$resultado= $this->servicios->listarServicios();
			return $resultado;
		}
		
		public function verServicios($id,$servicio){
			$this->servicios->set('id',$id);
			$this->servicios->set('servicios',$servicio);
			$resultado= $this->servicios->verServicios();
			return $resultado;

		}

		public function inicioMes(){
			$resultado=$this->servicios->inicioMes();
			return $resultado;
		}


		public function vencimientos(){
			$resultado=$this->servicios->vencimientosMensuales();
			$resultado2=$this->servicios->vencimientosAnuales();
			$resultado= array_merge($resultado,$resultado2);
			return $resultado;
		}

	}



 ?>