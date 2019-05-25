<?php
header('Content-Type: application/json');
function registros()
{
    include "conexion.php";
    $query = ("SELECT * FROM usuario");
    $result = $conn->query($query);
    $arreglo = [];
    $arreglo["info"] = array(
        "status"=> "Ok"
    );
    while ($todou = mysqli_fetch_array($result)) {
        $registro[] = [
            "Nombre" => $todou["nombres_usuario"],
            "Apellidos" => $todou["apellidos_usuario"],
            "Cargo" => $todou["cargo_usuario"],
            "Ciudad" => $todou["ciudadp"],
            // "Pass" => $todou["pass"],
            "Correo" => $todou["correo_usuario"],
            "Boletin"=> $todou["boletin"]
        ];
    }
    $arreglo["data"] = $registro;
    return $arreglo;
}
function login()
{
    include "conexion.php";
    $data = json_decode(file_get_contents('php://input'), true);
    $correo = $data["correo"];
    $contrasenia = $data["pass"];
    $query = ("SELECT * FROM usuario  WHERE correo_usuario = '$correo' and pass = '$contrasenia'");
    $result = $conn->query($query);
    $row_count = $result->num_rows;
    $arreglo = [];
    if ($row_count == 1) {
        $arreglo["info"] = array(
            "status"=> "1"
        );
    } else {
        $arreglo["info"] = array(
            "status"=> "0"
        );
    }
    return $arreglo;
}
function registro()
{
    include "conexion.php";
    $query = ("SELECT correo_usuario FROM usuario");
    $result = $conn->query($query);
    $data = json_decode(file_get_contents('php://input'), true);

    $arreglo = [];
    $arreglo["info"] = [
        "status"=> "Ok"
    ];
    while ($todou = mysqli_fetch_array($result)) {
        $registro[] = $todou["correo_usuario"];
    }
    $search = array_search($data['correo'], $registro);
    if ($search === false) {
        $nombre = $data["nombres"];
        $apellido = $data["apellidos"];
        $cargo = $data["cargo"];
        $ciudadp = $data["ciudad_pais"];
        $email = $data["correo"];
        $pass = $data["pass"];
        if ($data['boletin']) {
            $boletin = 1;
        } else {
            $boletin = 0;
        }
        $query = ("INSERT INTO usuario (nombres_usuario, apellidos_usuario, cargo_usuario, ciudadp, correo_usuario, pass, boletin)
        VALUES ('$nombre', '$apellido', '$cargo', '$ciudadp', '$email', '$pass', '$boletin')");
        $result = $conn->query("$query");
        $arreglo["data"] = [
            "result"=>"Usuario registrado",
            "code"=>1
        ];
    } else {
        $arreglo["data"] = [
                "result" => "Ya existe un usuario con este correo",
                "code"=>0
            ];
    }
    return $arreglo;
}
switch ($_GET['url']) {
    case 'login':
        $resultados = login();
    break;
    case 'registro':
        $resultados = registro();
    break;
    case 'registros':
        $resultados = registros();
    break;
    default:
        header('HTTP/1.1 405 Method Not Allowed');
        exit;
    break;
}
echo json_encode($resultados);
