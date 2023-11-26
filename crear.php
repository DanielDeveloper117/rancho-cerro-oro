<?php

include("conexion.php");

/////////////////----------------------crear registro
if($_POST["operacion"]=="Crear"){// si el boton del modal es para crear usuario (depende de donde se le dio click)
    include("funciones.php");
    $imagen = '';
    if($_FILES["imagen_usuario"]["name"] != ''){
        $imagen = subir_imagen();
    }
    $stmt = $conexion->prepare("INSERT INTO usuarios(nombre,
     apellidos, imagen, telefono, email)VALUES(:nombre, :apellidos,
     :imagen, :telefono, :email)");

     $resultado = $stmt->execute(
        array(
            ':nombre' => $_POST["nombre"],
            ':apellidos' => $_POST["apellidos"],
            ':telefono' => $_POST["telefono"],
            ':email' => $_POST["email"],
            ':imagen' => $imagen
        )
     );
     
     if(!empty($resultado)){
        echo 'Registro creado.';
     }
}



//////////////// ----------------- editar un registro
if($_POST["operacion"]=="Editar"){// si el boton del modal es para editar registro (depende de donde se le dio click)
    include("obtener_registro.php");

    $imagen = '';
    if($_FILES["imagen_usuario"]["name"] != ''){
        $imagen = subir_imagen();
    }else{
        $imagen = $_POST["imagen_usuario_oculta"];
    }
   
    $stmt = $conexion->prepare("UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, telefono=:telefono, email=:email, imagen=:imagen WHERE id=:id");
     $resultado = $stmt->execute(
        array(
            
            ':nombre' => $_POST["nombre"],
            ':apellidos' => $_POST["apellidos"],
            ':telefono' => $_POST["telefono"],
            ':email' => $_POST["email"],
            ':imagen' => $imagen,
            ':id'  => $_POST["id_usuario"]
        )
     );
    
     if(!empty($resultado)){
        echo 'Registro actualizado.';
     }
}
?>