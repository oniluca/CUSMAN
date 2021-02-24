<?php 

	$controlador = new ControladorCliente();
	$controladorServicio = new ControladorServicios();

	//comprueba si es el primer dia del mes para restablecer los servicios
	$resultado=$controladorServicio->inicioMes();
	echo $resultado;
	if ($resultado == true){
		$controlador->resetEstadoServicio(null);
		$controlador->actualizarSaldoCliente();
	}
	 

	//actualiza los cambios recibidos en el checkbox de servicios
	if(isset($_POST['enviar'])){
		if(!empty($_POST['checkbox'])){
			$controlador->actualizarEstadoServicio($_POST['checkbox'],$_GET['id']);
		}else{
			$controlador->resetEstadoServicio($_GET['id']);
		}
		
		header($_SERVER['PHP_SELF']);	
	}

	//si recibe datos de un nuevo pago lo procesa
	if(isset($_POST["enviarPago"])){
		$controlador->procesarNuevoPago($_POST['txtPago'],$_GET['id']);
	}


	//si recibe un id ejecuta metodo de clase controlador para listar datos de el id recibido 
	if (isset($_GET['id'])){
		$rowCliente=$controlador->verCliente($_GET['id']);
		$rowClienteEstado= $controlador->verEstadoCuenta($_GET['id']);
		$rowServicios=$controladorServicio->verServicios($_GET['id'],null);
		$rowHistorial=$controlador->verHistorialPago($_GET['id']);	
		$rowHistorialMensual=$controlador->verHistorialSaldoMensual($_GET['id']);

	}


 ?>
 <!-- carga datos cliente -->
 <div class ="columns">
	<div class="column is-three-fifths">
		<center><h1 class="title is-5">Cliente</h1></center>
		<br><br>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Razon Social</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input" type="text" value= '<?php echo $rowCliente['razon_social'];?>' readonly>
		 	</div>
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Cuit</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input" type="text" value='<?php echo $rowCliente['cuit'];?>' readonly>
		 	</div>
		 	
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Clave Fiscal</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input" type="text" value='<?php echo $rowCliente['clave_fiscal'];?>' readonly>
		 	</div>
		 	
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Clave ATM</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input" type="text" value='<?php echo $rowCliente['clave_atm'];?>' readonly>
		 	</div>
		 	
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Clave Sindicato</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input" type="text" value='<?php echo $rowCliente['clave_sindicato'];?>' readonly>
		 	</div>
		 	
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Email</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input" type="text" value='<?php echo $rowCliente['email'];?>' readonly>
		 	</div>
		 	
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Telefono</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input" type="text" value='<?php echo $rowCliente['tel'];?>' readonly>
		 	</div>
		 	
		 <!-- historial de los pagos realizados	 -->
		 </div>	
		 <br>
		 <div class=column>
			<div class="box">
				<center><h1 class="title is-5">Historial de pago</h1></center>
				<div class="navbar-end">
				<div class="dropdown is-hoverable">
				  <div class="dropdown-trigger">
				    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu5">
				      <span>Ingresar Pago</span>
				      <span class="icon is-small">
				        <i class="fas fa-angle-down" aria-hidden="true"></i>
				      </span>
				    </button>
				  </div>
				  <div class="dropdown-menu" id="dropdown-menu5" role="menu">
				    <div class="dropdown-content">
				      <div class="dropdown-item">
				        <form action="" method="POST">
				        	<input class="input" type="text" name="txtPago" placeholder="Ingrese monto" pattern="[0-9]*" title="Solo numeros" autocomplete="off">
				        	<button class="button is-success is-outlined" type="submit" name="enviarPago">Guardar</button>
				        </form>
				      </div>
				    </div>
				  </div>
				</div>
			</div>

				<div class="content">
					<div class="scroll">
					     <table class="table" id="tabla">
					       <thead>
					         <tr>
					           <th>Fecha</th>
					           <th>Monto entregado</th>
					         </tr>
					       </thead>
					       <tbody>
					          <?php while($row= mysqli_fetch_array($rowHistorial)){ ?>
					             <tr>
					               <td><?php echo $row['fecha']?></td>
					               <td><?php echo $row['monto'] ?></td>
					             </tr>
					          <?php } ?>
					       </tbody>
					     </table>
				    </div>
				</div>	
			</div>
		
		</div>
		<!-- historial de los saldos mensuales por trabajos realizados -->
		 <br>
		 <div class=column>
			<div class="box">
				<center><h1 class="title is-5">Historial de saldo mensual</h1></center>
				<div class="content">
					<div class="scroll">
					     <table class="table" id="tablaMensual">
					       <thead>
					         <tr>
					           <th>Mes</th>
					           <th>Año</th>
					           <th>Importe</th>
					         </tr>
					       </thead>
					       <tbody>
					          <?php while($row= mysqli_fetch_array($rowHistorialMensual)){ ?>
					             <tr>
					               <td><?php echo $row['mes']?></td>
					               <td><?php echo $row['anio']?></td>
					               <td><?php echo $row['monto'] ?></td>
					             </tr>
					          <?php } ?>
					       </tbody>
					     </table>
				    </div>
				</div>	
			</div>
		
		</div>

	</div>

<!-- carga servicios activos del cliente -->
	<form action="" method="POST">
		<div class="column">
			<h1 class="title is-5">Servicios activos</h1>
			<?php while ($row= mysqli_fetch_array($rowServicios)) {?>
				<label class="checkbox">
	  				<input type="checkbox" id="ckeck.<?php  echo $row['id_servicios']; ?>" name="checkbox[]" value="<?php  echo $row['id_servicios']; ?>" <?php if($row['estado_servicio']==1){echo 'checked' ; } ?> >
	  				<?php  echo $row['servicio']; ?>
				</label><br>
			<?php } ?>
		</div>

		<button class="button is-success is-outlined" type="submit" name="enviar" value="Guardar">Guardar</button>
		<a   class="button is-danger is-outlined" href="index.php">Calcelar</a>
	</form>

<!-- carga saldos del cliente -->
	<div class="column">
		<div class="box">
			<h1 class="title is-5">Saldo</h1>
			
			<?php if($rowClienteEstado['saldo_total']>0){?>
						<h6 class="subtitle is-7 has-text-danger">Pendiente pago</h6>
				<?php }else if($rowClienteEstado['saldo_total']<0){ ?>
						<h6 class="subtitle is-7 has-text-success">Favor cliente</h6>
					<?php }  ?>

			<div class="content">
				<p> $ <?php echo abs($rowClienteEstado['saldo_total']); ?></p>
			</div>			
		</div>
		<div class="box">
			<h1 class="title is-5">Iva a pagar</h1>
			<div class="content">
				<p> $ <?php echo $rowClienteEstado['iva_a_pagar']; ?></p>
			</div>	
		</div>
		<div class="box">
			<h1 class="title is-5">Iva a favor</h1>
			<div class="content">
				<p> $ <?php echo $rowClienteEstado['iva_a_favor']; ?></p>
			</div>	
		</div>
		<div class="box">
			<h1 class="title is-5">Ganancias a pagar</h1>
			<div class="content">
				<p> $ <?php echo $rowClienteEstado['ganancias_a_pagar']; ?></p>
			</div>	
		</div>
		<div class="box">
			<h1 class="title is-5">Ganancias a favor</h1>
			<div class="content">
				<p> $ <?php echo $rowClienteEstado['ganancias_a_favor']; ?></p>
			</div>	
		</div>
	</div>
 
 </div>

	
	


