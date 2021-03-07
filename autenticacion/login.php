<?php 
		include_once("validacion.php");


		$usuario = new ValidacionUsuario(); 
		
		if(isset($_POST['enviarLogin'])){
			if($_POST['usuario']!= null && $_POST['clave']!=null){
				$nombreUsuario=$_POST['usuario'];
				$clave=hash ( 'sha512' , $_POST['clave'] ,true );	
				$resultado=$usuario->validarUsuario($nombreUsuario,$clave);
			}
			if(isset($resultado)){	
				if($resultado==true){
					header("location:../index.php");
				}else{
					echo '<div class="notification is-danger is-light">
	  					<button class="delete"></button>
	  					Error al iniciar sesion, usuario y/o contraseña erronea, por favor vuelva a intentarlo.
					</div>';

				}	
			}else{
				echo '<div class="notification is-danger is-light">
  					<button class="delete"></button>
  					Error al iniciar sesion, debe completar todos los campos, por favor vuelva a intentarlo.
				</div>';

			}
		}else{
			$usuario->logout();
			//header("location:../index.php");
			
		}
	
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CUSMAN</title>

    <link rel="shortcut icon" type="image/png" href="../imagenes/logo3.png">
    <link rel="stylesheet" href="../css/bulma.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/all.css">
   
 </head>
 <body>
 	<form action="" method="POST">
 		<div class="div-background">
		 	<div class="container section">
		 		<div class="column is-half is-offset-3 has-background-white">
			 		<form class="box">
			 		  <figure class="image  is-5by3">
					  		<img src="../imagenes/logo2.png">
					  </figure>
					  <div class="field">
					    <label class="label">Usuario</label>
					    <div class="control">
					      <input class="input" type="text" name="usuario" placeholder="Usuario">
					    </div>
					  </div>

					  <div class="field">
					    <label class="label">Contraseña</label>
					    <div class="control">
					      <input class="input" type="password" name="clave" placeholder="********">
					    </div>
					  </div>

					 <button type="submit" name="enviarLogin" id="enviarLogin" class="button is-centered is-primary">Ingresar</button>
					</form>
				</div>
			</div>
		</div>
 	</form>
 	<script type="text/javascript" src="../js/js.js"></script>
 </body>
 </html>