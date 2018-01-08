<?php
  include "conex.php";
  $servicios  = array();
  $a = $_SESSION["cliente"];
  $b = $_SESSION["cuadrilla"];
  $c = $_SESSION["contratista"];
  $d = $_SESSION["fecha"];
  $e = $_SESSION["direccion"];

  $inserta =  "INSERT INTO servicios (codigo_cliente,codigo_cuadrilla, codigo_contratista, fecha, direccion) VALUES ('$a','$b','$c','$d','$e')";

  if (mysqli_query($conexion, $inserta)) {
    echo 'registro grabado exitosamente'
  } else {
    echo "ERROR: No Se Pudo Ejecutar La Consulta $resulta. " . mysqli_error($conexion);
  }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistema De Registro De Servicios</title>
       <link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
</body>
</html>
