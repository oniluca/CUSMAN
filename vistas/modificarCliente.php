<?php 

	$controlador = new ControladorCliente();
	$controladorServicio = new ControladorServicios();

	//si recibe por post datos del formulario envia los datos al metodo del controlador para guardarlos

	if(isset($_POST['enviar'])){
					
		$resultado = $controlador->actualizar($_POST['razonSocial'],$_POST['cuit'],$_POST['claveFiscal'],$_POST['claveAtm'],$_POST['claveSindicato'],$_POST['email'],$_POST['telefono'],$_GET['id']);
		if($resultado){
			echo '<div class="notification is-primary is-light">
					<button class="delete"></button>
					Cliente modificado.
			</div>';

		}else{
			echo '<div class="notification is-danger is-light">
					<button class="delete"></button>
					El cliente no pudo ser modificado.
			</div>';

		}

		//si recibe por post check envia check y no check  // si no recibe envia solo no check

		if(empty($_POST['checkbox'])){
			$checkbox=[null];
		}else{
			$checkbox=$_POST['checkbox'];
		}
		$indice=0;
		$nocheck=[null];
		for($i=1;$i<=$_POST['nocheck'];$i++){
			if(in_array($i,$checkbox)==false){
				$nocheck[$indice]=$i;
				$indice++;
			}
		}

		if($checkbox!=null && $nocheck!=null){
			$controlador->actualizarServiciosActivos($nocheck,$checkbox);
		}else if($checkbox!=null && $nocheck=null){
				$controlador->actualizarServiciosActivos(null,$checkbox);
			}else if($checkbox=null && $nocheck=!null){
				$controlador->actualizarServiciosActivos($nocheck,null);
			}

	} 

	//si recibe un id ejecuta metodo de clase controlador para listar datos de el id recibido 
	if (isset($_GET['id'])){
		$rowCliente=$controlador->verCliente($_GET['id']);
		$listar="actualizar";	
		$rowServicios=$controladorServicio->verServicios($_GET['id'],$listar);
				
	}



 ?>
 <!-- carga datos cliente -->
 <form action="" method="POST" id="formulario">
	 <div class ="columns">
			<div class="column is-three-fifths">
				<center><h1 class="title is-5">Modificar Cliente</h1></center>
				<br><br><br>


				 <div class="field is-horizontal">
				 	<div class="field-label is normal">
				 		<label class="label">Razon Social</label>
				 	</div>

				 	<div class="field-body">
				 		<input value= '<?php echo $rowCliente['razon_social'];?>' class="input" type="text" id ="razonSocial" name="razonSocial" placeholder="Ingrese Razon Social "  title="Solo caracteres alfanumericos sin puntos ni caracteres especiales" maxlength="30" >
				 	</div>
				 	
				 </div>
				 <div class="field is-horizontal">
				 	<div class="field-label is normal">
				 		<label class="label">Cuit</label>
				 	</div>

				 	<div class="field-body" >
				 		<input value='<?php echo $rowCliente['cuit'];?>' class="input" type="text" name="cuit" id="cuit" placeholder="Ingrese Cuit" pattern="[0-9]*" title="Solo caracteres numericos sin guiones" minlength="11" maxlength="11" required>	
				 		<p id="mensajeCuit" class="help is-danger ocultar"></p>
				 	</div>		 	
				 	
				 </div>
				 <div class="field is-horizontal">
				 	<div class="field-label is normal">
				 		<label class="label">Clave Fiscal</label>
				 	</div>

				 	<div class="field-body" >
				 		<input value='<?php echo $rowCliente['clave_fiscal'];?>' class="input desmarcarError" type="text" id="claveFiscal" name="claveFiscal" placeholder="Ingrese Clave Fiscal" maxlength="30" title="Solo caracteres alfanumericos - _ o @">
				 	</div>
				 	
				 	
				 </div>
				 <div class="field is-horizontal">
				 	<div class="field-label is normal">
				 		<label class="label">Clave ATM</label>
				 	</div>

				 	<div class="field-body" >
				 		<input value='<?php echo $rowCliente['clave_atm'];?>' class="input desmarcarError" type="text" id="claveAtm" name="claveAtm" placeholder="Ingrese Clave ATM" maxlength="30" title="Solo caracteres alfanumericos - _ o @">
				 	</div>
				 	
				 	
				 </div>
				 <div class="field is-horizontal">
				 	<div class="field-label is normal">
				 		<label class="label">Clave Sindicato</label>
				 	</div>

				 	<div class="field-body" >
				 		<input value='<?php echo $rowCliente['clave_sindicato'];?>' class="input desmarcarError" type="text" id="claveSindicato" name="claveSindicato" placeholder="Ingrese Clave Sindicato" maxlength="30" title="Solo caracteres alfanumericos - _ o @">
				 	</div>
				 	
				 	
				 </div>
				 <div class="field is-horizontal">
				 	<div class="field-label is normal">
				 		<label class="label">Email</label>
				 	</div>

				 	<div class="field-body" >
				 		<input value='<?php echo $rowCliente['email'];?>' class="input desmarcarError" type="email" id="email" name="email" placeholder="Ingrese Email" maxlength="30" title="Solo caracteres alfanumericos - _ . o @">
				 	</div>
				 	
				 	
				 </div>
				 <div class="field is-horizontal">
				 	<div class="field-label is normal">
				 		<label class="label">Telefono</label>
				 	</div>

				 	<div class="field-body" >
				 		<input value='<?php echo $rowCliente['tel'];?>' class="input desmarcarError" type="text" id="telefono" name="telefono" placeholder="Ingrese Telefono"  title="Solo caracteres numericos sin guiones" minlength="7" maxlength="13">
				 	</div>
				 	
				 	
				 </div>

			</div>

			<div class="column">
				<h1 class="title is-5">Servicios Activos</h1>
				<?php while ($row= mysqli_fetch_array($rowServicios)) {?>
					<label class="checkbox">
		  				<input type="checkbox" id="ckeck.<?php  echo $row['id']; ?>" name="checkbox[]" value="<?php  echo $row['id']; ?>" <?php if($row['id_servicios']!=null){echo 'checked' ; } ?> >
		  				<?php  echo $row['servicio']; ?>
					</label><br>
				<?php } ?>
			</div>

			<input type="hidden" name="nocheck" value="<?php echo mysqli_num_rows($rowServicios);?>">
	</div>
		 <div class="columns is-centered">
		 	<button class="button is-success is-outlined" type="submit" name="enviar" value="Guardar">Guardar</button>

			<a class="button is-danger is-outlined" href="index.php">Calcelar</a>
			</div>
</form>
