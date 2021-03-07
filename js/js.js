
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
 
// funcion agregar imagen cargando cuando se apreta boton 

if(document.getElementById('enviarLogin')){
    document.getElementById('enviarLogin').onclick =()=>{
      document.getElementById('enviarLogin').classList.add('is-loading');
    } 
}


// funcion para lanzar modal para editar servicio
let ts = document.getElementById("tablaServicios");
ts.onclick=()=>{alert("esto es una prueba");}



document.getElementById('modalModificarServ').onclick=()=>{
  alert("prueba");
  document.getElementById('modalServicios').classList.add('is-active');
  let data =document.getElementById('modalModificarServ');

  document.getElementById('servicioModal').setAttribute("value",data.dataset.servicio);
  document.getElementById('precioServicioModal').setAttribute("value",data.dataset.precio);
}


//funcion para cerrar modal con esc
document.getElementById('cerrarModalServicios').onclick=()=>{
  document.getElementById('modalServicios').classList.remove('is-active');
}

window.onkeyup = (e)=>{

  if(e.keyCode==27){
    document.getElementById('modalServicios').classList.remove('is-active');
  }

}




