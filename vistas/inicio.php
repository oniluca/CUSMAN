<?php 
    
    $controlador = new ControladorCliente();
    $resultado= $controlador->listarCliente();
    $controladorServicios = new ControladorServicios();
    $resultadoVencimientos=$controladorServicios->vencimientos();
    // echo ($r['iva_inicio']);
    // echo ($r['iva_fin']);
    // echo ($r['ddjj_inicio']);
    // echo ($r['ddjj_fin']);
    // echo $resultadoVencimientos['recategorizacion'];
    // echo "<br>";
    // echo $resultadoVencimientos['ddjj'];
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

                  <td><a href="?cargar=eliminarCliente&id=<?php echo $row['cuit'];?>"><span class="icon"><i class="fas fa-trash"></i></span></a></td>
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

