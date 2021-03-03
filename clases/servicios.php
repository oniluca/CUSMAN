<?php 

	require_once('superClase.php');

	class Servicios extends SuperClase{

		// atributos

		 private $id;
		 private $servicios;

		// metodos

		 //setea los atributos de la clase mediante los valores que recibe	
		public function set($atributo, $contenido){
			$this->$atributo = $contenido;
		}
		
		//obtiene el valor de una variable
		public function get ($atributo){
			return $this->$atributo;
		}

		//lista todos los servicios disponibles
		public function listarServicios(){

			$sql="SELECT id, servicio, precio FROM servicios ORDER BY servicio ASC";
			$resultado= $this->listar($sql);
			return $resultado;
		}

		public function verServicios(){
			if($this->servicios =="actualizar"){
				$sql="SELECT servicios.id,servicios.servicio,cliente_servicios.id_servicios FROM cusman.servicios LEFT JOIN cusman.cliente_servicios ON cliente_servicios.id_servicios=servicios.id AND cliente_servicios.cuit_cliente='$this->id' ORDER BY servicios.servicio ASC";

			}else if($this->servicios==null){
				$sql="SELECT servicios.servicio,cliente_servicios.id_servicios,cliente_servicios.estado_servicio FROM cusman.servicios JOIN cusman.cliente_servicios ON servicios.id=cliente_servicios.id_servicios AND cliente_servicios.cuit_cliente='$this->id' ORDER BY cliente_servicios.id_servicios ASC ";
			}
			
			$resultado=$this->listar($sql);
			return $resultado;
		}


		//comprueba que sea el inicio de mes para volver servicios realizados a cero
		public function inicioMes(){
			$sql="select inicio_mes from configuracion";
			$resultado=$this->listar($sql);
			$resultado=mysqli_fetch_assoc($resultado);
			$resultado=$resultado['inicio_mes'];
			if((date("j") >= 1) && (date("j") <= 3)  && $resultado == 1){
				$sql="UPDATE configuracion set inicio_mes = 0 where id = 1";
				$this->ejecutarSentencia($sql);
				return true;

			}else if(date("j") > 3 && $resultado == 0 ){
				$sql="UPDATE configuracion set inicio_mes = 1 where id = 1";
				$this->ejecutarSentencia($sql);
				return false;	
			}

		}


		//devuelve los vencimientos proximos
		public function vencimientosMensuales(){

			// $dia=date("j");
			// $mes=date("F");
			$dia=strftime("%#d");
			$mes=strftime("%B");
			$mesSiguiente=strftime('%B',strtotime("+1 month"));

			$sql="SELECT vencimientos_iva.0_1 AS iva_inicio,vencimientos_iva.8_9 AS iva_fin,vencimientos_ddjj.0_1_2 AS ddjj_inicio,vencimientos_ddjj.8_9 AS ddjj_fin,vencimientos_iva.mes As mes_iva,vencimientos_ddjj.mes As mes_ddjj FROM vencimientos_iva JOIN vencimientos_ddjj ON vencimientos_ddjj.mes LIKE '%$mes%' AND vencimientos_iva.mes LIKE '%$mes%'";
			$resultado=$this->listar($sql);
			$resultado=mysqli_fetch_array($resultado);
			
			if($resultado['iva_inicio'] > $dia && $resultado['ddjj_inicio'] > $dia || ($resultado['iva_inicio'] < $dia && $resultado['ddjj_inicio'] < $dia && $resultado['iva_fin'] > $dia && $resultado['ddjj_fin'] > $dia) ){
				return $resultado;
			}

			if($resultado['iva_inicio'] < $dia && $resultado['ddjj_inicio'] < $dia && $resultado['iva_fin'] < $dia && $resultado['ddjj_fin'] < $dia){
				// consulta por el mes siguiente
				$sql="SELECT vencimientos_iva.0_1 AS iva_inicio,vencimientos_iva.8_9 AS iva_fin,vencimientos_ddjj.0_1_2 AS ddjj_inicio,vencimientos_ddjj.8_9 AS ddjj_fin,vencimientos_iva.mes As mes_iva,vencimientos_ddjj.mes As mes_ddjj FROM vencimientos_iva JOIN vencimientos_ddjj ON vencimientos_ddjj.mes LIKE '%$mesSiguiente%' AND vencimientos_iva.mes LIKE '%$mesSiguiente%'";
				$resultado=$this->listar($sql);
				$resultado=mysqli_fetch_array($resultado);
				return $resultado;
			}

			if($resultado['iva_fin'] < $dia && $resultado['ddjj_fin'] > $dia){
				$sql="SELECT vencimientos_iva.0_1 AS iva_inicio,vencimientos_iva.8_9 AS iva_fin,vencimientos_ddjj.0_1_2 AS ddjj_inicio,vencimientos_ddjj.8_9 AS ddjj_fin,vencimientos_iva.mes As mes_iva,vencimientos_ddjj.mes As mes_ddjj FROM vencimientos_iva JOIN vencimientos_ddjj ON vencimientos_ddjj.mes LIKE '%$mes%' AND vencimientos_iva.mes LIKE '%$mesSiguiente%'";
				$resultado=$this->listar($sql);
				$resultado=mysqli_fetch_array($resultado);
				return $resultado;
			}

			if($resultado['iva_fin'] > $dia && $resultado['ddjj_fin'] < $dia){
				$sql="SELECT vencimientos_iva.0_1 AS iva_inicio,vencimientos_iva.8_9 AS iva_fin,vencimientos_ddjj.0_1_2 AS ddjj_inicio,vencimientos_ddjj.8_9 AS ddjj_fin,vencimientos_iva.mes As mes_iva,vencimientos_ddjj.mes As mes_ddjj FROM vencimientos_iva JOIN vencimientos_ddjj ON vencimientos_ddjj.mes LIKE '%$mesSiguiente%' AND vencimientos_iva.mes LIKE '%$mes%'";
				$resultado=$this->listar($sql);
				$resultado=mysqli_fetch_array($resultado);
				return $resultado;
			}




		}


		// comprueba fecha actual y dependiendo de ella muestra los proximos vencimientos anuales
		public function vencimientosAnuales(){
			$fecha =date("Y-m-d");

			$sql="select * from vencimientos_anuales";
			$resultado=$this->listar($sql);
			$i=0;
			while($row=mysqli_fetch_array($resultado)){
				$resultado2[$i][0]=$row['fecha'];
				$resultado2[$i][1]=$row['servicio'];
				$i++;
			}
		
			if($fecha > $resultado2[0][0] && $resultado2[2][0] >= $fecha ){
				$vencimientos['recategorizacion'] = strftime("%d", strtotime($resultado2[2][0])).' de '.strftime("%B", strtotime($resultado2[2][0]));
				$vencimientos['ddjj'] = strftime("%d", strtotime($resultado2[1][0])).' de '.strftime("%B", strtotime($resultado2[1][0]));
				return $vencimientos; 
				
				
			 }else{
				$vencimientos['recategorizacion'] = strftime("%d", strtotime($resultado2[0][0])).' de '.strftime("%B", strtotime($resultado2[0][0]));
				$vencimientos['ddjj'] = strftime("%d", strtotime($resultado2[1][0])).' de '.strftime("%B", strtotime($resultado2[1][0]));
				return $vencimientos;
			}
		}



	}







 ?>