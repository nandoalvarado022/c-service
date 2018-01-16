<?php
function cmb_empresa_cliente($cec){
	// cec: codigo empresa cliente
	global $conexion;
	$sql="SELECT *
	from clientes";
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