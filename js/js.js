function alertDelete(nombre, id){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-outline-success m-2 border-2",
          cancelButton: "btn btn-outline-danger m-2 border-2"
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        title: "¿Estas seguro(a) de eliminar el registro de: "+ "<h3 style='color:red; padding-top: 10px '>" + nombre + "</h3>",
        text: "¡Esta acción es irreversible!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector("#formDataDelete"+id).submit();
        }else {
            preventDefault();
        }
    }); 
}

function menuAction(){
    //crear la variable que contenga todos los elementos con el mismo id.
    const elementos = document.querySelectorAll("span");
    //ciclo para llamar los elementos 
    for (let index = 0; index < span.length; index++) {
                        //propiedad para anhadir o quitar clases 
        elementos[index].classList.toggle("visually-hidden");
    }
    
    let elementBody = document.getElementById("body");
    let elementBody1 = document.getElementById("body1");
    let elementBody2 = document.getElementById("body2");
    let elementFooter = document.getElementById("footer");
    let elementNav = document.getElementById("nav");

    let clase = elementNav.getAttribute("class");
   
    if (clase == "navbar fixed-top bg-black rounded justify-content-end margin-left-nav") {
        
        elementBody.classList.replace("margin-left","margin-left-width");
        elementBody1.classList.replace("margin-left","margin-left-width");
        elementBody2.classList.replace("margin-left","margin-left-width");
        elementFooter.classList.replace("margin-left","margin-left-width");
        elementNav.classList.replace("margin-left-nav","margin-left-width-nav");
    
    }else if(clase == "navbar fixed-top bg-black rounded justify-content-end margin-left-width-nav"){
        
        elementBody.classList.remove("margin-left-width");
        elementBody1.classList.remove("margin-left-width");
        elementBody2.classList.remove("margin-left-width");
        elementFooter.classList.remove("margin-left-width");
        elementNav.classList.remove("margin-left-width-nav");
        
        elementBody.classList.add("margin-left");
        elementBody1.classList.add("margin-left");
        elementBody2.classList.add("margin-left");
        elementFooter.classList.add("margin-left");
        elementNav.classList.add("margin-left-nav");
    }
    
    
    let elemento = document.getElementById("Menu");
    let atributo = elemento.getAttribute("style");
    
    if (atributo == "width:16%; transition: all 0.4s;" ) {
        elemento.setAttribute("style" , "width:6%; transition: all 0.4s;");    
    }else if(atributo == "width:6%; transition: all 0.4s;"){
        elemento.setAttribute("style", "width:16%; transition: all 0.4s;");
    }
    
}

function correo() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-primary"
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire("📧 jijoseantoniopaez6@gmail.com");
}

function phone() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-primary"
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire("📞 0424-7763963");
}

function ubicacion() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-primary"
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        title: "🗺️ El Vigía - Mérida, Venezuela",
        text: "Urbanización Páez, Municipio Alberto Adriani",
        imageUrl: "img/ubicacion.png",
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: "Custom image"
      });
}
function verPass(pass){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-primary"
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        title : 'Contraseña: ' + pass,
        text : 'Si con frecuencia olvidas la contraseña, intenta cambiarla',
        icon : 'info'
      });
}

function mostrarVistaPrevia(event) {
  const input = event.target;
  const vistaPrevia = document.getElementById('vista-previa');
  if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
          vistaPrevia.src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
  }
}