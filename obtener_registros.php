<?php
include("conexion.php");
include("funciones.php");


$query = "SELECT * FROM usuarios; ";

if (isset($_POST["search"]["value"])) {
    $query .= ' WHERE nombre LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= ' OR apellidos LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]['dir'];
} else {
    $query .= ' ORDER BY id DESC ';
}

if ($_POST["length"] != -1) {
    $query .= ' LIMIT ' . $_POST["start"] . ', ' . $_POST["length"];
}

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();

$datos = array();
$filtered_rows = $stmt->rowCount();

foreach ($resultado as $fila) {
    $imagen = '';
    if ($fila["imagen"] != '') {
        $imagen = '<img src="img/' . $fila["imagen"] . '" class="img-thumbnail" width="35" height="35"/>';
    }

    $sub_array = array();
    $sub_array[] = $fila["id"];
    $sub_array[] = $fila["nombre"];
    $sub_array[] = $fila["apellidos"];
    $sub_array[] = $fila["telefono"];
    $sub_array[] = $fila["email"];
    $sub_array[] = $imagen;
    $sub_array[] = $fila["fecha_creacion"];
    $sub_array[] = '<button type="button" name="editar" id="' . $fila["id"] . '" class="btn btn-warning btn-xs editar">Editar</button>';
    $sub_array[] = '<button type="button" name="borrar" id="' . $fila["id"] . '" class="btn btn-danger btn-xs borrar">Eliminar</button>';
    
    $datos[] = $sub_array; // Agregar el subarray al arreglo de datos
}

// Crear la respuesta en formato JSON
$salida = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => obtener_todos_registros(),
    "recordsFiltered" => $filtered_rows,
    "data" => $datos // Utilizar los datos obtenidos del bucle
);

echo json_encode($salida);

?>

