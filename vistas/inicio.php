<?php 
    
    $controlador = new ControladorCliente();
    $resultado= $controlador->listarCliente();
    $controladorServicios = new ControladorServicios();
    $resultadoVencimientos=$controladorServicios->vencimientos();
 ?>

<br>
<div class="columns">
  <div class="column">
     <div class="control has-icons-right">
      <input class="input is-small" type="text" id="buscar" placeholder="Buscar">
      <span class="icon is-small is-right">
        <i class="fas fa-search"></i>  
      </span>
   </div>

      <div>
       <table class="table is-fullwidth" id="tabla">
         <thead>
           <tr>
             <th>Cliente</th>
             <th>Cuit</th>
           </tr>
         </thead>
         <tbody>
            <?php if($resultado): while($row = mysqli_fetch_array($resultado)){ ?>
               <tr>
                 <td><a href="?cargar=verCliente&id=<?php echo $row['cuit'];?>"><?php echo $row['razon_social']?></a></td>
                 <td><?php echo $row['cuit'] ?></td>
                 
                 <td><a href="?cargar=modificarCliente&id=<?php echo $row['cuit'];?>"><span class="icon"><i class="fas fa-pen"></i></span></a></td>

                  <td><a id="btnEliminarCliente" data-target="#modalEliminarCliente" class="eliminarCliente" data-cliente="<?php echo $row['razon_social']?>" data-id="<?php echo $row['cuit'];?>"><span class="icon"><i class="fas fa-trash"></i></span></a></td>
               </tr>
            <?php } endif ?>
         </tbody>
       </table>
      </div>
  </div>
  <div class="column">
    <div class="box">
      <h1 class="title is-5">Vencimiento Iva</h1>
      <div class="content">
         Del <?php echo $resultadoVencimientos['iva_inicio']?> al <?php echo $resultadoVencimientos['iva_fin']?> de <?php echo $resultadoVencimientos['mes_iva']?>
      </div>  
    </div>

     <div class="box">
      <h1 class="title is-5">Vencimiento Ganancias</h1>
      <div class="content">
         faltan 3 dias
      </div>  
    </div>

     <div class="box">
      <h1 class="title is-5">Vencimiento DDJJ </h1>
      <div class="content">
        Del <?php echo $resultadoVencimientos['ddjj_inicio']?> al <?php echo $resultadoVencimientos['ddjj_fin']?> de <?php echo $resultadoVencimientos['mes_ddjj']?>
      </div>  
    </div>

    <div class="box">
      <h1 class="title is-5">Vencimiento Recategorizaciones</h1>
      <div class="content">
         <?php echo $resultadoVencimientos['recategorizacion'] ?>
      </div>  
    </div>

     <div class="box">
      <h1 class="title is-5">Vencimiento DDJJ Anual</h1>
      <div class="content">
          <?php echo $resultadoVencimientos['ddjj'] ?>
      </div>  
    </div>
    
  </div>
  
</div>



<div id=modalEliminarCliente class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <section class="modal-card-body">
      <form  id="formModalEliminarServ" action="" method="POST">
        <div class="field is-horizontal">
        <div class="field-label is normal">
          <center><h1 class="subtitle is-5" id="clienteModalEliminar"> </h1></center>
        </div>
          
      </div>
      <div class="columns is-centered">
          <button class="button is-success is-outlined estiloModal" type="submit" name="eliminar" value="Eliminar">Eliminar</button>
        <a   class="button is-danger is-outlined estiloModal" href="index.php">Calcelar</a> 
      </div>
      </form>
    </section>
  </div>
  <button id="cerrarModalEliminarCliente" class="modal-close is-large" aria-label="close"></button>
</div>

