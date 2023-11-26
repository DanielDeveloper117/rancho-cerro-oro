<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="css/style.css">
    
    <title>Inventario</title>
</head>

<body style="background-color: #9ec5fe;">
<!-- ----- inicio del div contenedor de todo el contenido de la tabla -------------- -->
<div style="width: 98%; margin-bottom: 150px;" class=" container fondo">
    <h1 class="text-center">Modulo de Inventario</h1>

    <!-- ------inicio div renglon del boton azul primary +crear, el boton despliega el modal---- -->
    <div class="row">
        <div class="col-2 offset-10">
            <div class="text-center">
                <!-- Button crear que abre el modal -->
                <button id="botonCrear" type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalUsuario">
                <i style="margin-right:5px;" class="bi bi-plus-circle"></i>Crear</button>
            </div>
                  
        </div>
    </div>
    <!-- ------fin div renglon del boton azul primary +crear, el boton despliega el modal---- -->
    <br/>
    <br/>
    <!-- ----------- inicio div contenedor de la tabla------------- -->
    <div style="margin-bottom: 20px;" class="table-responsive " >
      
        <!-- ----------- inicio datatable de la tabla #datos_usuario---------->
        <table  id="datos_usuario"  class="table table-bordered table-striped border border-2" style="">
            <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Telefono</th>
                  <th>Email</th>
                  <th>Imagen</th>
                  <th>Fecha Creacion</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>
            </tbody>
        </table>
        <!-- ----------- fin datatable de la tabla #datos_usuario---------->
    </div>
    <!-- ----------- fin div contenedor de la tabla------------- -->
</div>
<!-- ----- fin del div contenedor de todo el contenido de la tabla -------------- -->


 <!-- inicio del div visble contenedor del formulario de crear usuario------------------------------------------------------>
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- inicio div header del modal, contiene el titulo y el boton cerrar -->
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear usuario</h5>
        <!-- boton cerrar modal del formulario -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- fin div header del modal, contiene el titulo y el boton cerrar -->

      <!-- FORM Formulario START------------------------------------------------>
      <form method="POST" id="formulario" enctype="multipart/form-data">
        <!-- ----- inicio div que contiene body y footer del modal-------------------- -->
        <div class="modal-content">
          <!-- ------inicio div del modal body, contiene todos los input---------- -->
            <div class="modal-body">
              <label for="nombre">Ingrese su nombre</label>
              <input class="form-control" type="text" name="nombre" id="nombre">
              <br/>

              <label for="apellidos">Ingrese sus apellidos</label>
              <input class="form-control" type="text" name="apellidos" id="apellidos">
              <br/>

              <label for="apellidos">Ingrese su telefono</label>
              <input class="form-control" type="text" name="telefono" id="telefono">
              <br/>

              <label for="email">Ingrese su email</label>
              <input class="form-control" type="email" name="email" id="email">
              <br/>

              <label for="imagen_usuario">Selecione una imagen</label>
              <input class="form-control" type="file" name="imagen_usuario" id="imagen_usuario">
              <span id="imagen_subida"></span>
              <br/>

            </div>  
            <!-- ------fin div del modal body, contiene todos los input---------- -->

            <!-- ----------inicio div que contiene el footer del modal, obtiene id_usuario, el boton crear y editar ------- -->
            <div class="modal-footer">
                <input type="hidden" name="id_usuario" id="id_usuario" value="">
                <input type="hidden" name="operacion" id="operacion" value="Crear">
                <input class="btn btn-success" type="submit" name="action" id="action" value="Crear"> <!--el boton crear puede transformarse en editar-->
            </div>
            <!-- -------------fin div que contiene el footer del modal---------------------------------------------- -->
        </div>
        <!-- ----- fin div que contiene body y footer del modal-------------------- -->
      </form>
      <!-- FORM Formulario END--------------------------------------------------> 
    </div>
  </div>
</div>
 <!-- fin del div visble contenedor del formulario de crear usuario------------------------------------------------------>

<!-- importar javascript de bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- etiqueta script que contiene toda la logica -->
<script type="text/javascript">
/// aqui dentro deben ir todas las funciones
$(document).ready(function(){

    // logica de dar click en crear abre el modal
    $("#botonCrear").click(function(){
      $("#formulario")[0].reset();
      $(".modal-title").text("Crear usuario");
      $("#action").val("Crear");
      $("#operacion").val("Crear");
      $("#imagen_subida").html("");
    });

    // Crear un objeto en una variable con los datos a enviar a la BD
    var datosEnviar = {
        "id": id_usuario,
        "nombre": nombre,
        "apellidos": apellidos,
        "telefono": telefono,
        "email": email,
        "imagen_usuario": imagen_usuario,
    };

    // Convertir el objeto a una cadena JSON para que lo pueda leer la tabla
    var datosEnJSON = JSON.stringify(datosEnviar);

    // -----------------Configuraciones de la datatable
    $('#datos_usuario').DataTable({
        "processing": true,// mensaje de "cargando..." cuando este cargando los datos
        "serverSide": true,
        "ajax": {
            "url": "obtener_registros.php", // mandar a llamar a ese script
            "type": "POST", //envio de informacion con el metodo post
            "data": {
                "datos": datosEnJSON // Enviar la cadena JSON como 'datos'
            },
            "dataType": 'json'// envio de informacion en formato json
        },
        ordering: false, //botones de ordenacion de las columnas
        //"orderable": true,
        "searching": true, // función de búsqueda activada
        search: {
           return: true
        },
        "language": { //lenguaje
          "decimal" : "",
          "emptyTable":"No hay registros",
          "info": "Mostrando _END_ de _TOTAL_ registros",
          "infoEmpty": "Mostrando 0 de 0 registros",
          "infoFiltered": "(Se filtraron _MAX_ registros)",
          "infoPostFix":"",
          "thousands": ", ",
          "lengthMenu": "Mostrar _MENU_ registros",
          "loadingRecords":"Cargando...",
          "processing": "Procesando...",
          "search": "Buscar: ",
          "zeroRecords":"No se encontraron resultados.",
          "paginate":{
            "first":"Primero",
            "last":"Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
          }
        },
        //"order": [], // Evitar la ordenación inicial
        
        "scrollY": "300px", // Altura del área de desplazamiento vertical
        "scrollCollapse": true // Colapso del scroll cuando no es necesario
    });

    //------------------------------------funcion para enviar formulario cuando es CREAR usuario
    $(document).on('submit','#formulario', function(event){
        event.preventDefault();
        var nombres = $("#nombre").val(); //obtener el valor del input nombre
        var apellidos = $("#apellidos").val();//obtener el valor del input apellidos
        var telefono = $("#telefono").val();//obtener el valor del input telefono
        var email = $("#email").val();//obtener el valor del input email
        var extension = $("#imagen_usuario").val().split('.').pop().toLowerCase();//obtener la extension de la imagen

        if(extension != ''){// si no tiene extension
          if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1){
            alert("Formato de imagen no valido");
            $("#imagen_usuario").val('');
            return false;
          }
        }
        if(nombres != '' && apellidos != '' && email != ''){// si esos tres campos no estan vacios
          $.ajax({//enviar solicitud ajax
            url: "crear.php", // enviar datos a ese script
            method: "POST",
            data: new FormData(this), // indicar que se enviaran todos los datos del formulario
            contentType:false,
            processData:false,
            success:function(data){//cuando es funcion exitosa
              alert("Operacion exitosa");
              $('#formulario')[0].reset();// el valor de los input se resetea/vacia
              $('#modalUsuario').modal('hide');//oculta el modal
             // jsonValido.ajax.reload(null, true);
            }
          });
        }else{
          alert("Algunos campos son obligatorios.");
        }
    });

    //----------------------------- funcion para EDITAR registro
    $(document).on('click', '.editar', function(){
      var id_usuario = $(this).attr("id"); // guardar el id del registro en el que se le dio click
      $.ajax({// solicitud ajax
        url:"obtener_registro.php",
        method:"POST",
        data:{id_usuario:id_usuario}, // enviar datos mediante solo la id
        dataType: "json",
        success:function(data)// cuando la funcion es exitosa obtener el valor de los siguientes input
          {
            $('#id_usuario').val(data.id_usuario);
            $('#modalUsuario').modal('show');
            $('#nombre').val(data.nombre);
            $('#apellidos').val(data.apellidos);
            $('#telefono').val(data.telefono);
            $('#email').val(data.email);
            $('.modal-title').text("Editar registro");
            $('#imagen_subida').html(data.imagen_usuario);
            $('#action').val("Editar");
            $('#operacion').val("Editar");
          },
          error: function(jqXHR, textStatus, errorThrown){
            console.log("ocurrio un error: ",textStatus, errorThrown);
          }
      });
    });

    //---------------------------funcion para ELIMINAR registro
    $(document).on('click', '.borrar', function(){
      var id_usuario = $(this).attr("id");// guardar el id del registro en el que se le dio click
      if(confirm("¿Está seguro de eliminar el registro con id = " + id_usuario +"?")){
        $.ajax({
          url: "borrar.php",
          method: "POST",
          data:{id_usuario:id_usuario}, // enviar la id
          dataType: "json",
          success:function(data)
          {
            alert("Operacion exitosa");
           
          }
        });
      }
      else{
        return false;
      }
    });

});
</script> 

</body>
</html>