<?php
function cmb_empresa_cliente($cec){
	// cec: codigo empresa cliente
	// cep: codigo empresa padre
	if($_SESSION["grpuser"]=="EP") $cep=$_SESSION["coduser"];
	global $conexion;
	$sql="SELECT *
	from clientes";
	$sql.=isset($cep) ? " where empresa_padre=".$cep : "";
	$resulta = mysqli_query($conexion, $sql);
	$rows = mysqli_num_rows($resulta);
	$res="";
	if ($rows > 0) {
		while($row = mysqli_fetch_assoc($resulta)) {
			$selected=($cec==$row["codigo"]) ? "selected" : "";
			
			$res.="<option $selected value='".$row["codigo"]."'>".$row["nombre"]."</option>";
		}	
	}
	return $res;
}
?>