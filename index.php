
<?php 
	session_start();
	setlocale(LC_TIME,'spanish');
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	//session_destroy();
	if(empty($_SESSION['login'])){
		header("location:autenticacion/login.php");
	}
	include_once('modulos/enrutador.php');
	include_once('modulos/controladorCliente.php');
	include_once('modulos/controladorServicios.php');
 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CUSMAN</title>

    <link rel="shortcut icon" type="image/png" href="imagenes/logo3.png">
    <link rel="stylesheet" href="css/bulma.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/all.css">
   
  
  </head>
  


  <body>
  	<header>

		<nav class="navbar is-light " role="navigation" aria-label="main navigation">
		  <div class="navbar-brand">
		    <a class="navbar-item" href="index.php">
		      <img src="imagenes/logo2.png" width="112" height="28">
		    </a>

		    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
		      <span aria-hidden="true"></span>
		      <span aria-hidden="true"></span>
		      <span aria-hidden="true"></span>
		    </a>
		  </div>

		  <div id="navbarBasicExample" class="navbar-menu">
		    <div class="navbar-start">
		      <a class="navbar-item" href="index.php">
		        Inicio
		      </a>

		      <div class="navbar-item has-dropdown is-hoverable">
		        <a class="navbar-link">
		          Clientes
		        </a>

		        <div class="navbar-dropdown">
		          <a class="navbar-item" href="?cargar=nuevoCliente">
		          	Nuevo
		          </a>
		         <!--  <a class="navbar-item" href="?cargar=modificarCliente">
		            Modificar
		          </a>
		          <a class="navbar-item" href="?cargar=eliminarCliente">
		            Eliminar
		          </a> -->
		        </div>
		      </div>

		      <div class="navbar-item has-dropdown is-hoverable">
		        <a class="navbar-link">
		          Servicio
		        </a>	

		        <div class="navbar-dropdown">
			        <a class="navbar-item" href="?cargar=verServicio">
			          	Ver
			        </a>
			        <a class="navbar-item" href="?cargar=nuevoServicio">
			          	Nuevo
			        </a>
		          <!-- <a class="navbar-item" href="?cargar=modificarServicio">
		            Modificar
		          </a>
		          <a class="navbar-item" href="?cargar=eliminarServicio">
		            Eliminar
		          </a>
		          <hr class="navbar-divider">
		          <a class="navbar-item">
		            Report an issue
		          </a> -->
		        </div>
		      </div> 

		      <div class="navbar-item has-dropdown is-hoverable">
		        <a class="navbar-link">
		          Vencimientos
		        </a>	

		        <div class="navbar-dropdown">
		         <a class="navbar-item" href="?cargar=verVencimientos">
		          	Ver
		          </a>
		          <a class="navbar-item" href="?cargar=modificarVencimientos">
		            Modificar
		          </a>
		        </div>
		      </div> 
		    </div>

		    <div class="navbar-end">
		      	<div class="navbar-item has-dropdown is-hoverable">
			        <a class="navbar-link">
			           <figure class="image is-32x32">
					     <img class="is-rounded" src= <?php echo $_SESSION['imgPerfil'];?>>
					   </figure>
			        </a>
			        <div class="navbar-dropdown is-right">
			         <p class="navbar-item">
			          	<?php echo $_SESSION['login']; ?>
			          </p>
			         <a class="navbar-item" href="autenticacion/login.php">
			          	Cerrar sesion
			          </a>
			        </div>
			      </div>
		     </div>

		    </div>
		  </div>
		</nav>  		
  		
  	</header><!-- /header -->

	  <section>
	  	<?php 
	  		$enrutador = new Enrutador();
	  		if ($enrutador->validarGet(isset($_GET["cargar"]))){
	  			$enrutador->cargarVista($_GET["cargar"]);
	  		}
	  	 ?>
	    
	  </section>


	  <footer>
	  	
	  </footer>
   <script type="text/javascript" src="js/js.js"></script>
    <script type="text/javascript" src="js/validaciones.js"></script>
  </body>
 

</html>