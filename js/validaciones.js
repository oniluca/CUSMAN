//expresiones regulares para realizar validaciones
const expresiones = {
        usuario: /^[a-zA-Z0-9\_\-&.@]{4,16}$/, // Letras, numeros, guion y guion_bajo
        cuit: /^([0-9])*$/,//numeros del 0 al 9
        razonSocial: /^[a-zA-Z0-9\s]{1,30}$/, // Letras numeros y espacios, pueden llevar acentos.
        password: /^.{4,12}$/, // 4 a 12 digitos.
        claves : /^[a-zA-Z0-9\_\-\.\@]{10,30}$/,//letras numeros guion bajo y medio y @
        email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
        telefono: /^\d{7,13}$/ // 7 a 13 numeros.
    }


let URLactual = window.location.search;

// funcion para validar cuit
let enviar=false;
if(document.getElementById("cuit")){

     if(URLactual.includes("modificarCliente")){
        enviar=true;
    }

     document.getElementById("cuit").onchange=()=>{
        enviar=false;
     }

    let cuitActual = document.getElementById("cuit").value;
    document.getElementById("cuit").onblur =()=>{
         
            let cuit = document.getElementById("cuit");
            let expLog = /^([0-9])*$/;

            //ingresa letras
          if(expresiones.cuit.test(cuit.value)!=true){
                document.getElementById('cuit').classList.add('is-danger');
                document.getElementById('mensajeCuit').innerHTML="Ingrese solo numeros";
                document.getElementById('mensajeCuit').classList.remove('ocultar');
                document.getElementById('mensajeCuit').classList.add('mostrar');
                 
          }else{
                //ingresa menos numeros 
                if (cuit.value.length<11 ) {
                    document.getElementById('cuit').classList.add('is-danger');
                    document.getElementById('mensajeCuit').innerHTML="Ingrese cuit completo";
                    document.getElementById('mensajeCuit').classList.remove('ocultar');
                    document.getElementById('mensajeCuit').classList.add('mostrar');
                    
                }else if(cuitActual!=cuit.value){
         
                    //envia datos para consulta por medio de fetch
                    let datos = new FormData();
                    datos.append("cuit", cuit.value);
                    fetch('modulos/comprobarCuit.php', {
                            method: 'POST',
                            body: datos
                        }).then(Response => Response.json())
                        .then(({ success }) => {
                            if (success === 0) {
                               //si el cuit no se encuentra en la base de datos informa que habilita para el ingreso
                                 document.getElementById('cuit').classList.add('is-success');
                                 document.getElementById('cuit').classList.remove('is-danger');
                                 document.getElementById('mensajeCuit').classList.remove('mostrar');
                                 document.getElementById('mensajeCuit').classList.add('ocultar');
                                 enviar=true;
                            } else {
                                //si el cuit se encuentra en la base de datos informa que no habilita el ingreso
                                 document.getElementById('cuit').classList.add('is-danger');
                                 document.getElementById('mensajeCuit').innerHTML="Cuit ya registrado";
                                 document.getElementById('mensajeCuit').classList.remove('ocultar');
                                 document.getElementById('mensajeCuit').classList.add('mostrar');
                                 enviar=false;
                            }
                        });
                    }

                }   
    }
}


//funcion para validar formulario
    
    //intercepta el evento submit para realizar las comprobaciones

if(URLactual.includes("nuevoCliente") || URLactual.includes("modificarCliente")){   
    formulario.addEventListener("submit", (e)=>{
    let formulario = document.getElementById('formulario');
    let inputs= formulario.querySelectorAll('input');

        //validacion razon social
        if(inputs[0].value!=="" && expresiones.razonSocial.test(inputs[0].value)!=true || inputs[0].value ===""){
            e.preventDefault();
            document.getElementById('razonSocial').classList.add('is-danger');
        }else{
            document.getElementById('razonSocial').classList.remove('is-danger');
        }

        //comprueba si razon social o cuit estan vacios o no aptos para envio
        if(inputs[0].value ==="" || inputs[1].value ==="" || enviar===false){
                e.preventDefault();      
        }else{
            //compueba que si los campos no estan vacios cumplan con las expresiones regulares si no lanza aviso error
            let desmarcarError=document.getElementsByClassName('desmarcarError');             

            for(let i=2;i<7;i++){
                if(inputs[i].value !==""){
                    switch (i) {
                        case 2:
                               if( expresiones.claves.test(inputs[2].value)!=true){
                                    document.getElementById('claveFiscal').classList.add('is-danger');
                                    e.preventDefault();
                                 }else{
                                        document.getElementById('claveFiscal').classList.remove('is-danger');
                                }
                            break;
                        case 3:
                                if( expresiones.claves.test(inputs[3].value)!=true){
                                    document.getElementById('claveAtm').classList.add('is-danger');
                                    e.preventDefault();
                                  }else{
                                        document.getElementById('claveAtm').classList.remove('is-danger');
                                }
                            break;
                        case 4:
                                if( expresiones.claves.test(inputs[4].value)!=true){
                                    document.getElementById('claveSindicato').classList.add('is-danger');
                                e.preventDefault();
                                  }else{
                                        document.getElementById('claveSindicato').classList.remove('is-danger');
                                }
                            break;
                        case 5:
                                if( expresiones.email.test(inputs[5].value)!=true){
                                   document.getElementById('email').classList.add('is-danger');
                                   e.preventDefault();
                                  }else{
                                        document.getElementById('email').classList.remove('is-danger');
                                    }
                            break;
                        case 6:
                                if( expresiones.telefono.test(inputs[6].value)!=true){
                                    document.getElementById('telefono').classList.add('is-danger');
                                    e.preventDefault();
                                  }else{
                                        document.getElementById('telefono').classList.remove('is-danger');
                                    }
                            break;
                        default:
                               
                            break;
                    }

                }else{  
                        //quita la alerta en caso de que el campo se modifico correctamente o borro
                         document.getElementById(desmarcarError[i-2].id).classList.remove('is-danger');
                }
            }
            

        }
          
    });
}


   



