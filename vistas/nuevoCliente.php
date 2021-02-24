<?php 
		$controladorServicios = new ControladorServicios();
		$servicios = $controladorServicios->listarServicios();
		$controladorCliente = new ControladorCliente();

		//si recibe por post datos del formulario envia los datos al metodo del controlador para guardarlos

		if(isset($_POST['enviar'])){
			$resultado = $controladorCliente->crear($_POST['razonSocial'],$_POST['cuit'],$_POST['claveFiscal'],$_POST['claveAtm'],$_POST['claveSindicato'],$_POST['email'],$_POST['telefono'],$_POST['checkbox']);
			
			if($resultado){
				echo '<div class="notification is-primary is-light">
  					<button class="delete"></button>
  					Nuevo cliente creado.
				</div>';

			}else{
				echo '<div class="notification is-danger is-light">
  					<button class="delete"></button>
  					Nuevo cliente no pudo ser creado.
				</div>';

			}
		} 

 ?>


<div>
	<form action="" method="POST" id="formulario">

		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Razon Social</label>
		 	</div>

		 	<div class="field-body">
		 		<input class="input" type="text" id ="razonSocial" name="razonSocial" placeholder="Ingrese Razon Social "  title="Solo caracteres alfanumericos sin puntos ni caracteres especiales" maxlength="30" >
		 	</div>
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Cuit</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input" type="text" name="cuit" id="cuit" placeholder="Ingrese Cuit" pattern="[0-9]*" title="Solo caracteres numericos sin guiones" minlength="11" maxlength="11" required>	
		 		<p id="mensajeCuit" class="help is-danger ocultar"></p>
		 	</div>		 	
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Clave Fiscal</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input desmarcarError" type="text" id="claveFiscal" name="claveFiscal" placeholder="Ingrese Clave Fiscal" maxlength="30" title="Solo caracteres alfanumericos - _ o @">
		 	</div>
		 	
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Clave ATM</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input desmarcarError" type="text" id="claveAtm" name="claveAtm" placeholder="Ingrese Clave ATM" maxlength="30" title="Solo caracteres alfanumericos - _ o @">
		 	</div>
		 	
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Clave Sindicato</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input desmarcarError" type="text" id="claveSindicato" name="claveSindicato" placeholder="Ingrese Clave Sindicato" maxlength="30" title="Solo caracteres alfanumericos - _ o @">
		 	</div>
		 	
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Email</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input desmarcarError" type="email" id="email" name="email" placeholder="Ingrese Email" maxlength="30" title="Solo caracteres alfanumericos - _ . o @">
		 	</div>
		 	
		 	
		 </div>
		 <div class="field is-horizontal">
		 	<div class="field-label is normal">
		 		<label class="label">Telefono</label>
		 	</div>

		 	<div class="field-body" >
		 		<input class="input desmarcarError" type="text" id="telefono" name="telefono" placeholder="Ingrese Telefono"  title="Solo caracteres numericos sin guiones" minlength="7" maxlength="13">
		 	</div>
		 	
		 	
		 </div>

		 <div>

		 	<?php while($row = mysqli_fetch_array($servicios)){ ?>
		 
		 	<label class="checkbox">
			  <input type="checkbox" id="ckeck.<?php  echo $row['id']; ?>" name="checkbox[]" value="<?php  echo $row['id']; ?>">
  				<?php  echo $row['servicio']; ?>
			</label>
		 	<?php } ?>
		 </div>

		 <button class="button is-success is-outlined" type="submit" name="enviar" value="Guardar">Guardar</button>
		 <a   class="button is-danger is-outlined" href="index.php">Calcelar</a>	
	</form>

</div>
 