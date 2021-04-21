<?php 
		$controlador = new ControladorServicios();
		$resultado= $controlador->listarServicios();


 ?>


<div>
	<div class="tabla">
       <table class="table is-fullwidth" id="tablaServicios">
         <thead>
           <tr>
             <th>Servicio</th>
             <th>Precio</th>
           </tr>
         </thead>
         <tbody>
            <?php while($row= mysqli_fetch_array($resultado)){ ?>
               <tr>
                 <td><?php echo $row['servicio']?></td>
                 <td><?php echo $row['precio'] ?></td>
                 
                 <td><a data-accion="modificar" id="<?php echo $row['id']?>" class="modalModificarServ" data-target="#modalServicios" data-servicio="<?php echo $row['servicio']?>" data-precio="<?php echo $row['precio']?>" data-id="<?php echo $row['id']?>"><span class="icon"><i class="fas fa-pen"></i></span></a></td>
         
                  <td><a data-accion="eliminar" class="modalModificarServ" data-target="#modalEliminarServicios" data-servicio="<?php echo $row['servicio']?>" data-id="<?php echo $row['id']?>"><span class="icon"><i class="fas fa-trash"></i></span></a></td>
               </tr>
            <?php } ?>
         </tbody>
       </table>
   </div>
</div>



<div id=modalServicios class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
  	<section class="modal-card-body">
    	<form  id="formModalModificarServ" action="" method="POST">
    		<div class="field is-horizontal">
			 	<div class="field-label is normal">
			 		<label class="label">Servicio</label>
			 	</div>

			 	<div class="field-body">
			 		<input class="input" value="" type="text" name="servicio"  id="servicioModal" placeholder="Ingrese denominacion servicio "  title="Solo caracteres alfanumericos sin puntos ni caracteres especiales" maxlength="30" >
			 	</div>
				 	
			</div>
			<div class="field is-horizontal">
			 	<div class="field-label is normal">
			 		<label class="label">Precio</label>
			 	</div>

			 	<div class="field-body">
			 		<input class="input" value="" type="text" name="valor" id="precioServicioModal" placeholder="Ingrese valor servicio "  title="Solo caracteres numericos" maxlength="30" >
			 	</div>
				 	
			</div>
			<div class="columns is-centered">
    			<button class="button is-success is-outlined estiloModal" type="submit" name="enviar" value="Guardar">Guardar</button>
				<a   class="button is-danger is-outlined estiloModal" href="?cargar=verServicio">Calcelar</a>	
			</div>
    	</form>
    </section>
  </div>
  <button id="cerrarModalModificarServicios" class="modal-close is-large" aria-label="close"></button>
</div>



<div id=modalEliminarServicios class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
  	<section class="modal-card-body">
    	<form  id="formModalEliminarServ" action="" method="POST">
    		<div class="field is-horizontal">
			 	<div class="field-label is normal">
			 		<center><h1 class="subtitle is-5" id="servicioModalEliminar"> </h1></center>
			 	</div>
				 	
			</div>
			<div class="columns is-centered">
    			<button class="button is-success is-outlined estiloModal" type="submit" name="eliminar" value="Eliminar">Eliminar</button>
				<a   class="button is-danger is-outlined estiloModal" href="?cargar=verServicio">Calcelar</a>	
			</div>
    	</form>
    </section>
  </div>
  <button id="cerrarModalEliminarServicios" class="modal-close is-large" aria-label="close"></button>
</div>
