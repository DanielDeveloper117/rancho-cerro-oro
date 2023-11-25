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
  <body>


<div class="container fondo">
    <h1 class="text-center">Modulo de Inventario</h1>

    <div class="row">
        <div class="col-2 offset-10">
            <div class="text-center">
                <!-- Button crear que abre el modal -->
                <button id="botonCrear" type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalUsuario">
                <i class="bi bi-plus-circle-fill"></i>Crear
                </button>
            </div>
                  
        </div>
    </div>
   
    <br/>
    <br/>

    <div class="table-responsive" >
        <table id="datos_usuario"  class="table table-bordered table-striped">
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
        
        </table>
    </div>

</div>


 <!-- MODAL START------------------------------------------------------>
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- FORM Formulario START------------------------------------------------>
      <form method="POST" id="formulario" enctype="multipart/form-data">
        
       <div class="modal-content">
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

            <div class="modal-footer">
                <input type="hidden" name="id_usuario" id="id_usuario" value="">
                <input type="hidden" name="operacion" id="operacion" value="Crear">
                <input class="btn btn-success" type="submit" name="action" id="action" value="Crear">
            </div>

        </div>
      </form>
      <!-- FORM Formulario END-------------------------------------------------->

      
     
    </div>
  </div>
</div>
 <!-- MODAL START------------------------------------------------------>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script type="text/javascript">

$(document).ready(function(){
// dar click en crear abre el modal
    $("#botonCrear").click(function(){
      $("#formulario")[0].reset();
      $(".modal-title").text("Crear usuario");
      $("#action").val("Crear");
      $("#operacion").val("Crear");
      $("#imagen_subida").html("");
    });


// Crear un objeto con los datos a enviar
    var datosEnviar = {
        "id": id_usuario,
        "nombre": nombre,
        "apellidos": apellidos,
        "telefono": telefono,
        "email": email,
        "imagen_usuario": imagen_usuario,
       
    };

// Convertir el objeto a una cadena JSON
    var datosEnJSON = JSON.stringify(datosEnviar);

// Configurar la llamada a DataTable con AJAX
    // $('#datos_usuario').DataTable({
    //     "processing": true,
    //     "serverSide": true,
    //     "ajax": {
    //         "url": "obtener_registros.php",
    //         "type": "POST",
    //         "data": {
    //             "datos": datosEnJSON // Enviar la cadena JSON como 'datos'
    //         },
    //         "dataType": 'json'
    //     },

    // });
$('#datos_usuario').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "obtener_registros.php",
        "type": "POST",
        "data": {
            "datos": datosEnJSON // Enviar la cadena JSON como 'datos'
        },
        "dataType": 'json'
    },
    "columnsDefs": [
        { 
          "targets":[0],
          "orderable": true, 
        } // Permitir la ordenación en todas las columnas
    ],
   
    "searching": true // Habilitar la función de búsqueda
});

//--------------------funcion para enviar formulario crear
    $(document).on('submit','#formulario', function(event){
        event.preventDefault();
        var nombres = $("#nombre").val();
        var apellidos = $("#apellidos").val();
        var telefono = $("#telefono").val();
        var email = $("#email").val();
        var extension = $("#imagen_usuario").val().split('.').pop().toLowerCase();

        if(extension != ''){
          if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1){
            alert("Formato de imagen no valido");
            $("#imagen_usuario").val('');
            return false;
          }
        }
        if(nombres != '' && apellidos != '' && email != ''){
          $.ajax({
            url: "crear.php",
            method: "POST",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){
              alert("Operacion exitosa");
              $('#formulario')[0].reset();
              $('#modalUsuario').modal('hide');
             // jsonValido.ajax.reload(null, true);
            }
          });
        }else{
          alert("Algunos campos son obligatorios.");
        }
    });

//------------------ funcion para editar registro
    $(document).on('click', '.editar', function(){
      var id_usuario = $(this).attr("id");
      $.ajax({
        url:"obtener_registro.php",
        method:"POST",
        data:{id_usuario:id_usuario},
        dataType: "json",
        success:function(data)
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
//--------------------funcion para eliminar registro
    $(document).on('click', '.borrar', function(){
      var id_usuario = $(this).attr("id");
      if(confirm("¿Está seguro de eliminar el registro con id = " + id_usuario +"?")){
        $.ajax({
          url: "borrar.php",
          method: "POST",
          data:{id_usuario:id_usuario},
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