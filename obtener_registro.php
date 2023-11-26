<?php
include('conexion.php');
include('funciones.php');

if(isset($_POST["id_usuario"])){// si se recive el id_usuario
    $salida = array(); // salida es un arreglo que contendra los datos que devuelva la consulta
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = '".$_POST["id_usuario"].
    "' LIMIT 1"); // preparar la consulta
    $stmt->execute();// ejecutar la consulta
    $resultado = $stmt->fetchAll(); // indicar que el resultado sera recorrido por un for
    foreach($resultado as $fila){ // for/foreach que imprimira los datos en los input del modal
        $salida["id_usuario"]=$fila["id"];
        $salida["nombre"] = $fila["nombre"];
        $salida["apellidos"] = $fila["apellidos"];
        $salida["telefono"] = $fila["telefono"];
        $salida["email"] = $fila["email"];
        if($fila["imagen"] != ""){
            $salida["imagen_usuario"] = '<img src="img/' . $fila["imagen"] . '" 
            class="" width="60" height="60"/>
            <input type="hidden" name="imagen_usuario_oculta" value="'.$fila["imagen"].'" />';

        }else{
            $salida["imagen_usuario"] = '<input type="hidden" name="imagen_usuario_oculta" value="" />' ;
        }
    }
    echo json_encode($salida);
}

?>