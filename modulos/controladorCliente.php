<?php 
	include_once("clases/cliente.php");

	class ControladorCliente{

		//atributos
		private $cliente;

		//constructor e instancia de un cliente
		public function __construct(){
			$this->cliente = new Cliente();

		}

		public function listarCliente(){
			$resultado = $this->cliente->listarClientes();
			return $resultado;
		}


		public function verCliente($id){
			$resultado = $this->cliente->verCliente($id);
			return $resultado;
		}

		public function comprobarCuit($cuit){
			$resultado= $this->cliente->comprobarCuit($cuit);
			return $resultado;
		}


		public function crear($razonSocial,$cuit,$claveFiscal,$claveAtm,$claveSindicato,$email,$telefono,$checkbox){

			$this->cliente->set("razonSocial",$razonSocial);
			$this->cliente->set("cuit",$cuit);
			$this->cliente->set("claveFiscal",$claveFiscal);
			$this->cliente->set("claveAtm",$claveAtm);
			$this->cliente->set("claveSindicato",$claveSindicato);
			$this->cliente->set("email",$email);
			$this->cliente->set("telefono",$telefono);
			$this->cliente->set("servicios",$checkbox);

			$resultado=$this->cliente->crear();
			return $resultado;
		}

		public function actualizar($razonSocial,$cuit,$claveFiscal,$claveAtm,$claveSindicato,$email,$telefono,$id){

			$this->cliente->set("razonSocial",$razonSocial);
			$this->cliente->set("cuit",$cuit);
			$this->cliente->set("claveFiscal",$claveFiscal);
			$this->cliente->set("claveAtm",$claveAtm);
			$this->cliente->set("claveSindicato",$claveSindicato);
			$this->cliente->set("email",$email);
			$this->cliente->set("telefono",$telefono);
			$this->cliente->set("id",$id);
			

			$resultado=$this->cliente->actualizar();
			return $resultado;
		}


		public function actualizarServiciosActivos($nocheck,$checkbox){
			$this->cliente->set("servicios",$checkbox);
			$this->cliente->set("nocheck",$nocheck);
			$this->cliente->actualizarServiciosActivos();
		}



		public function verEstadoCuenta($cuit){
			$this->cliente->set("cuit",$cuit);
			$resultado=$this->cliente->verEstadoCuenta();
			return $resultado;
		}

		public function verHistorialPago($id){
			$this->cliente->set("cuit",$id);
			$resultado=$this->cliente->verHistorialPago();
			return $resultado;
		}

		public function verHistorialSaldoMensual($id){
			$this->cliente->set("cuit",$id);
			$resultado=$this->cliente->verHistorialSaldoMensual();
			return $resultado;
		}

		public function actualizarEstadoServicio($checkbox,$cuit){
			$this->cliente->set("cuit",$cuit);
			$this->cliente->set("servicios",$checkbox);
			$this->cliente->actualizarEstadoServicio();
						
		}

		public function resetEstadoServicio($cuit){
			$this->cliente->set("cuit",$cuit);
			$this->cliente->resetEstadoServicio();

		}

		public function actualizarSaldoCliente(){
			$this->cliente->actualizarEstadoHistoricoCuentaCliente();
			$this->cliente->actualizarSaldoCliente();	
			
		}

		public function procesarNuevoPago($pago,$cuit){
			$this->cliente->set("pago",$pago);
			$this->cliente->set("cuit",$cuit);
			$this->cliente->procesarNuevoPago();
		}


		public function eliminarCliente($id){
			$this->cliente->set("cuit",$id);
			$this->cliente->eliminarCliente();
		}

		public function aaa(){
			return "esta es la funcion aaa";
		}














	}





 ?>