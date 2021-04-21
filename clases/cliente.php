<?php 

	
	require_once('superClase.php');

	class Cliente extends SuperClase{


		//atributos

		private $id;
		private $cuit;
		private $razonSocial;
		private $claveFiscal;
		private $claveAtm;
		private $claveSindicato;
		private $email;
		private $telefono;
		private $cliente;
		private $servicios;
		private $reset;
		private $nocheck;
		private $pago;
	

		//metodos

		//setea los atributos de la clase mediante los valores que recibe	
		public function set($atributo, $contenido){
			$this->$atributo = $contenido;
		}
		
		//obtiene el valor de una variable
		public function get ($atributo){
			return $this->$atributo;
		}

		//obtiene todos los clientes de la base de datos
		public function listarClientes(){
			$sql="select * from clientes";
			$resultado= $this->listar($sql);
			if(!$resultado){
				return [];
			}
			return $resultado;

		}

		//obtiene todos los datos de un cliente determinado
		public function verCliente($id){
			$sql="SELECT * from clientes WHERE cuit='$id'";
			$resultado= $this->listar($sql);
			$resultado= mysqli_fetch_assoc($resultado);
			return $resultado;
		}

		//comprueba que el cuit ingresado no exista para evitar duplicacion de datos
		public function comprobarCuit($cuit){
			$sql="SELECT cuit from clientes where cuit ='$cuit'";
			$resultado = $this->listar($sql);
			if(mysqli_num_rows($resultado)>0){
				$resultado=1;
			}else{
				$resultado=0;
			}
			return $resultado;
		}

		//obtiene todos los datos del estado de cuenta de un determinado cliente
		public function verEstadoCuenta(){
			$sql="SELECT saldo,iva_a_pagar,iva_a_favor,ganancias_a_pagar,ganancias_a_favor,saldo_mensual,SUM(saldo+saldo_mensual)AS saldo_total from estado_cuenta_cliente where id_cliente='$this->cuit'";
			$resultado= $this->listar($sql);
			$resultado= mysqli_fetch_assoc($resultado);
			return $resultado;
		}


		public function verHistorialPago(){
			$sql="SELECT DATE_FORMAT(fecha,'%d-%m-%Y') as fecha,monto from historial_pago where id_cliente='$this->cuit'";
			$resultado=$this->listar($sql);
			// $resultado=mysqli_fetch_assoc($resultado);
			return $resultado;
		}

		public function verHistorialSaldoMensual(){
			$sql="SET lc_time_names = 'es_AR'";
			$sql2="SELECT MONTHNAME(mes) AS mes,YEAR(mes) AS anio ,monto from estado_historico_cuenta_cliente where cuit='$this->cuit' ORDER BY mes DESC";
			$this->listar($sql);
			$resultado=$this->listar($sql2);
			return $resultado;
		}

		//crea un nuevo cliente, servicios activos y estado de cuenta
		public function crear(){
			//crea cliente
			$sql="INSERT into clientes (cuit, razon_social, clave_fiscal, clave_atm, clave_sindicato, email, tel) values('$this->cuit','$this->razonSocial','$this->claveFiscal','$this->claveAtm','$this->claveSindicato','$this->email','$this->telefono') ";

			//habilita los servicios seleccionados para ese cliente
			$sql2 = "INSERT into cliente_servicios (cuit_cliente, id_servicios) values('$this->cuit',".implode("),('$this->cuit',",$this->servicios).");";
			
			 //crea un estado de cuenta para el cliente creado
			$sql3= "Insert into estado_cuenta_cliente (id_cliente, saldo, iva_a_pagar,iva_a_favor,ganancias_a_pagar,ganancias_a_favor,saldo_mensual) values('$this->cuit',0,0,0,0,0,0)";

			$this->ejecutarSentencia($sql);
			$this->ejecutarSentencia($sql2);
			$this->ejecutarSentencia($sql3);
			return true;
		}

		//funcion para actualizar los datos del cliente
		public function actualizar(){
			$sql="UPDATE clientes SET cuit='$this->cuit', razon_social='$this->razonSocial', clave_fiscal='$this->claveFiscal', clave_atm='$this->claveAtm',clave_sindicato='$this->claveSindicato', email='$this->email', tel='$this->telefono' WHERE cuit='$this->id'";

			$this->ejecutarSentencia($sql);

			if($this->cuit != $this->id){
				$sql2="update cliente_servicios set cuit_cliente=$this->cuit where cuit_cliente=$this->id";
				$sql3="update estado_cuenta_cliente set id_cliente=$this->cuit where id_cliente=$this->id";
				$sql4="update historial_pago set id_cliente=$this->cuit where id_cliente=$this->id";

				$this->ejecutarSentencia($sql2);
				$this->ejecutarSentencia($sql3);
				$this->ejecutarSentencia($sql4);
			}
			
			return true;
		}


		public function actualizarServiciosActivos(){
			
			$sql="INSERT IGNORE INTO cliente_servicios (cuit_cliente,id_servicios,estado_servicio) VALUES('$this->cuit',".implode(",0),('$this->cuit',",$this->servicios).",0);";

			$sql2="DELETE FROM cliente_servicios where cuit_cliente='$this->cuit' AND id_servicios=".implode(" OR cuit_cliente='$this->cuit' AND id_servicios=",$this->nocheck);
			
			if ($this->servicios=null){
					$this->ejecutarSentencia($sql2);
			}else if($this->nocheck=null){
						$this->ejecutarSentencia($sql2);
				}else{
						$this->ejecutarSentencia($sql);
						$this->ejecutarSentencia($sql2);
				}
			}


		public function actualizarEstadoServicio(){
			//actualiza los servicios seleccionados en los check
			$sql="UPDATE cliente_servicios SET estado_servicio = CASE id_servicios WHEN ".implode(" THEN 1 WHEN ",$this->servicios)." THEN 1 END WHERE cuit_cliente IN ($this->cuit)";
			//consulta los valores de los servicios seleccionados en los check para actualizar el saldo de cliente
			$sql2="SELECT SUM(precio) as saldo FROM servicios INNER JOIN cliente_servicios WHERE servicios.id = cliente_servicios.id_servicios AND cliente_servicios.estado_servicio = 1 AND cliente_servicios.cuit_cliente = '$this->cuit'";

			$this->ejecutarSentencia($sql);
			$resultado=$this->listar($sql2);
			$resultado= mysqli_fetch_assoc($resultado);
			$resultado=$resultado['saldo'];
			//actualiza el saldo de cliente
			$sql3="UPDATE estado_cuenta_cliente set saldo_mensual =$resultado where id_cliente = $this->cuit";
			
			$this->ejecutarSentencia($sql3);
		}

		//resetea el estado de los servicios a un determinado cliente si recibe un id, sino lo hace al total de los registros
		public function resetEstadoServicio(){
			if($this->cuit!== null){
				$sql="UPDATE cliente_servicios SET estado_servicio = 0 WHERE cuit_cliente ='$this->cuit'";
				$this->ejecutarSentencia($sql);

			}else{
				if($this->cuit=== null){
					$sql="UPDATE cliente_servicios SET estado_servicio = 0";
					$this->ejecutarSentencia($sql);
				}
			}
		}

		//actualizar saldo de cliente al inicio del mes
		public function actualizarSaldoCLiente(){
			$sql="UPDATE estado_cuenta_cliente SET saldo = estado_cuenta_cliente.saldo + estado_cuenta_cliente.saldo_mensual";
			$sql2="UPDATE estado_cuenta_cliente set saldo_mensual=0";
			$this->ejecutarSentencia($sql);
			$this->ejecutarSentencia($sql2);
		}

		public function actualizarEstadoHistoricoCuentaCliente(){
			$sql="INSERT INTO estado_historico_cuenta_cliente (mes,monto,cuit) SELECT DATE_SUB(NOW(),INTERVAL '1' MONTH), saldo_mensual,id_cliente FROM estado_cuenta_cliente ";
			$this->ejecutarSentencia($sql);
		}


		public function procesarNuevoPago(){
			$sql="INSERT into historial_pago (id_cliente,fecha,monto) values ('$this->cuit',CURDATE(),'$this->pago')";
			$sql2="UPDATE estado_cuenta_cliente SET saldo = estado_cuenta_cliente.saldo - '$this->pago' where id_cliente = '$this->cuit'";
			$this->ejecutarSentencia($sql);
			$this->ejecutarSentencia($sql2);
		}


		public function eliminarCliente(){
			$sql="DELETE from clientes where cuit='$this->cuit'";
			$sql2="DELETE from cliente_servicios where cuit_cliente='$this->cuit'";
			$sql3="DELETE from estado_cuenta_cliente where id_cliente='$this->cuit'";
			$sql4="DELETE from estado_historico_cuenta_cliente where cuit='$this->cuit'";
			$sql5="DELETE from historial_pago where id_cliente='$this->cuit'";
			$this->ejecutarSentencia($sql);
			$this->ejecutarSentencia($sql2);
			$this->ejecutarSentencia($sql3);
			$this->ejecutarSentencia($sql4);
			$this->ejecutarSentencia($sql5);

		}




	}

	




 ?>