
 //activa o desactiva menu hamburguesa 
document.addEventListener('DOMContentLoaded', () => {

  // Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {

        // Get the target from the "data-target" attribute
        const target = el.dataset.target;
        const $target = document.getElementById(target);

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

});

//funcion para cerrar notificaciones
document.addEventListener('DOMContentLoaded', () => {
  (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
    var $notification = $delete.parentNode;

    $delete.addEventListener('click', () => {
      $notification.parentNode.removeChild($notification);
    });
     //setTimeout($notification.parentNode.removeChild($notification));
  });
});



//funcion para filtrar clientes en tiempo real
if(document.getElementById("buscar")){
    let textbuscar = document.getElementById("buscar");
    textbuscar.onkeyup = function(){
      buscar(this);
    }

    function buscar(inputbuscar){
      let valorabuscar = (inputbuscar.value).toLowerCase().trim();
      let tabla_tr = document.getElementById("tabla").getElementsByTagName("tbody")[0].rows;
      for(let i=0; i<tabla_tr.length; i++){
        let tr = tabla_tr[i];
        let textotr = (tr.innerText).toLowerCase();
        tr.className = (textotr.indexOf(valorabuscar)>=0)?"mostrar":"ocultar";

      }
    };
}

//fin funcion filtrado


//funcion para confirmar eliminacion cliente
document.getElementById('btnEliminarCliente').onclick=()=>{
  let btnEliminarCliente = document.querySelectorAll(".eliminarCliente");
   document.getElementById('modalEliminarCliente').classList.add('is-active');
  // document.getElementById('clienteModalEliminar').innerHTML= "¿Desea eliminar "+this.dataset.cliente+" ?";
   //document.getElementById('formModalEliminarServ').setAttribute("action",'?cargar=eliminarCliente&id='+this.dataset.id);
  
}
 
// funcion agregar animacion cargando cuando se apreta boton login

if(document.getElementById('enviarLogin')){
    document.getElementById('enviarLogin').onclick =()=>{
      document.getElementById('enviarLogin').classList.add('is-loading');
    } 
}


if( window.location.search.includes("verServicio")){ 

    // funcion lanzar modal para editar servicio y cargar datos cuando se presiona el boton modificar o confirmar eliminacion si se presiona el boton eliminar

  const btnModificar = document.querySelectorAll(".modalModificarServ");
  const clickModificar = function(evento){
    if(this.dataset.accion=="modificar"){
        document.getElementById('modalServicios').classList.add('is-active');
        document.getElementById('servicioModal').setAttribute("value",this.dataset.servicio);
        document.getElementById('precioServicioModal').setAttribute("value",this.dataset.precio);
        document.getElementById('formModalModificarServ').setAttribute("action",'?cargar=modificarServicio&id='+this.dataset.id);
    }else if (this.dataset.accion=="eliminar") {
        document.getElementById('modalEliminarServicios').classList.add('is-active');
        document.getElementById('servicioModalEliminar').innerHTML= "¿Desea eliminar "+this.dataset.servicio+" ?";
        document.getElementById('formModalEliminarServ').setAttribute("action",'?cargar=eliminarServicio&id='+this.dataset.id);
    }
  }


  btnModificar.forEach( boton=> {
    boton.addEventListener("click", clickModificar);
  });


  //funcion para cerrar modal servicios
  document.getElementById('cerrarModalModificarServicios').onclick=()=>{
    document.getElementById('modalServicios').classList.remove('is-active');;
  }

  document.getElementById('cerrarModalEliminarServicios').onclick=()=>{
    document.getElementById('modalEliminarServicios').classList.remove('is-active');
  }

  document.getElementById('cerrarModalEliminarCliente').onclick=()=>{
    document.getElementById('modalEliminarCliente').classList.remove('is-active');
  }

  //funcion para cerrar modal con esc
  window.onkeyup = (e)=>{

    if(e.keyCode==27){
      document.getElementById('modalServicios').classList.remove('is-active');
      document.getElementById('modalEliminarServicios').classList.remove('is-active');
      document.getElementById('modalEliminarCliente').classList.remove('is-active');
    }

  }

}

// hay que ver como hacer para que las funciones de cerrar funcionen independientemente de la pagina cargada,
// solo estan funcionando en la pagina de ver servicios por el condicional que le puse





function cerrarModal(modal){
  document.getElementById(modal).classList.remove('is-active');

}

  //funcion para cerrar modal servicios
  document.getElementById('cerrarModalEliminarCliente').onclick=()=>{
    cerrarModal('modalEliminarCliente');
  }


  //funcion para cerrar modal con esc
  window.onkeyup = (e)=>{

    if(e.keyCode==27){
      cerrarModal('modalEliminarCliente');
    }

  }

