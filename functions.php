<?php
setlocale(LC_ALL,"es_ES");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
function tbl_proyectos_activos(){
	global $_SESSION, $conexion, $meses;
	$rows = [];
	if($_SESSION["grpuser"]=="CON"){
		$sql="select
		se.id,
		se.nombre as nombre_proyecto,
		cl.nombre as nombre_cliente,
		se.created
		from servicios se 
		inner join clientes cl on se.id=cl.codigo 
		where se.estado=1 and se.empresa=".$_SESSION["empresa_cliente"];
		$res = mysqli_query($conexion, $sql);
		while($row = mysqli_fetch_assoc($res)){
			$fecha=strtotime($row["created"]);
			$mes=$meses[date("n", $fecha)-1];
			$row["created"]=date("d", $fecha)." ".$mes." ".date("Y", $fecha);
			array_push($rows, $row);
		}
		// print_r($rows);
		return $rows;
	}
}

function cmb_empresa_cliente($cec=""){
	// cec: codigo empresa cliente
	// cep: codigo empresa padre
	global $conexion;
	$res="";
	if($_SESSION["grpuser"]=="EP") $cep=$_SESSION["coduser"];
	// echo "SESSION"; print_r($_SESSION);
	$sql="SELECT *
	from clientes";
	$sql.=isset($cep) ? " where empresa_padre=".$cep : "";
	$res.=$sql;
	$resulta = mysqli_query($conexion, $sql);
	$rows = mysqli_num_rows($resulta);
	
	if ($rows > 0) {
		while($row = mysqli_fetch_assoc($resulta)) {
			$selected=($cec==$row["codigo"]) ? "selected" : "";
			
			$res.="<option $selected value='".$row["codigo"]."'>".$row["nombre"]."</option>";
		}	
	}
	return $res;
}

function cmb_servicio_proyecto(){
	// definiciones de variables
	global $conexion;
	$sql="SELECT *
	from servicios
	WHERE empresa=$_SESSION[empresa_cliente]";
	$resulta = mysqli_query($conexion, $sql);
	$rows = mysqli_num_rows($resulta);
	$res="";
	if ($rows > 0) {
		while($row = mysqli_fetch_assoc($resulta)) {
			$res.="<option value='".$row["id"]."'>".$row["nombre"]."</option>";
		}	
	}
	return $res;
}
?>

