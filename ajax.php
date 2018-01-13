<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set( 'upload_max_size' , '12M' );
ini_set( 'post_max_size', '13M');
ini_set( 'memory_limit', '15M' );
include "conex.php";
// include "PHPMailerAutoload.php";
foreach($_GET as $nombre_campo => $valor){
   	$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
   	eval($asignacion);
}

foreach($_POST as $nombre_campo => $valor){
   	$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
   	eval($asignacion);
}

function cmb_item_padre($codigo_padre){
	global $conexion;
	$sql="SELECT *
	from item_padre";
	$resulta = mysqli_query($conexion, $sql);
	$rows = mysqli_num_rows($resulta);
	if ($rows > 0) {
		while($row = mysqli_fetch_assoc($resulta)) {
			$selected=($codigo_padre==$row["codigo"]) ? "selected" : "";
			
			$res.="<option $selected value='".$row["codigo"]."'>".$row["nombre"]."</option>";
		}	
	}
	return $res;
}

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

switch ($causa) {

	case 'editarItemCon':
		if($_REQUEST["codigo_item"]!=""){
			$sql="UPDATE item_hijo
			set nombre='$_REQUEST[nombre]', unidad='$_REQUEST[unidad]', vlrunitario=$_REQUEST[vlrunitario], codigo=$_REQUEST[codigo_padre], codigo_cliente=$_REQUEST[cec]
			where id=$_REQUEST[codigo_item]";
		} else{
			// codigo: codigo del padre
			$sql="INSERT into item_hijo(codigo, nombre, unidad, vlrunitario, codigo_cliente) values($_REQUEST[codigo_padre], '$_REQUEST[nombre]', '$_REQUEST[unidad]', $_REQUEST[vlrunitario], $_REQUEST[cec])";
			// echo $sql;
		}
		$resulta = mysqli_query($conexion, $sql);
	break;

	case 'cmb_empresa_cliente': // select de empresa cliente
		$sql="select * from clientes";
		$resulta = mysqli_query($conexion, $sql);
		$rows = mysqli_num_rows($resulta);
		if ($rows > 0) {
			echo "<option value=''>Seleccione</option>";
			while($row = mysqli_fetch_assoc($resulta)) {
				echo "<option value='".$row["codigo"]."'>".$row["nombre"]."</option>";	
			}	
		}
		
	

	break;

	case 'editar_item_listado_herramientas':
		$unidades=array("grados","h","hday","hdof","hh ing","hh tec","kg","m2","m3","mes","ml","un","volt");
		$_REQUEST["vlrunitario"]=isset($_REQUEST["vlrunitario"]) ? $_REQUEST["vlrunitario"] : "";
		$codigo_padre=isset($_REQUEST["codigo_padre"]) ? $_REQUEST["codigo_padre"] : "";
		$cec=isset($_REQUEST["cec"]) ? $_REQUEST["cec"] : "";
		echo '
		<div class="input-group">
			<span class="input-group-addon">Precio</span>
			<input type="text" class="form-control" id="inpPrecio" value="'.$_REQUEST["vlrunitario"].'">
		</div>

		<div class="input-group">
			<span class="input-group-addon">Empresa</span>
			
			<select id="cmb_empresa_cliente" class="form-control" name="">%
				<option value="">Seleccione</option>';
				print cmb_empresa_cliente($cec);				
			echo '
			</select>
		</div>

		<div class="input-group">
			<span class="input-group-addon">Item padre</span>
			
			<select id="cmb_codigo_padre" class="form-control" name="">%
				<option value="">Seleccione</option>';
				print cmb_item_padre($codigo_padre);
				

				echo '
			</select>
		</div>

		<div class="input-group">
			<span class="input-group-addon">Unidad</span>
			<select class="form-control" name="" id="unidad">%
				<option value="">Seleccione</option>';

				foreach($unidades as $value){
					$selected=($_REQUEST["unidad"]==$value) ? "selected" : "";
					echo "<option $selected value='".$value."'>".$value."</option>";
				}

				echo '
			</select>
		</div>
		';
		
	break;

	case 'listado_herramientas':
		
		$sql="SELECT item_hijo.id as item_hijo_id, item_hijo.nombre as nombre_hijo, item_padre.codigo, item_padre.nombre as nombre_padre, item_hijo.unidad, item_hijo.vlrunitario, codigo_cliente
		FROM item_hijo 
		inner join item_padre 
		on item_hijo.codigo=item_padre.codigo
		";
		if($_REQUEST["cmb_empresa_cliente"]!="") $sql.="where item_hijo.codigo_cliente=$_REQUEST[cmb_empresa_cliente]";
		$sql.=" order by modify desc";
		$resulta = mysqli_query($conexion, $sql);
		$rows = mysqli_num_rows($resulta);
		$rows = array();
		while($row = mysqli_fetch_assoc($resulta)) {
			array_push($rows, json_encode($row, JSON_UNESCAPED_UNICODE));
		}	
		echo json_encode($rows);
	break;

	case 'subir_foto':
		$file = $_FILES[$name_element];
	    $nombre = $file["name"];
	    $tipo = $file["type"];
	    $ruta_provisional = $file["tmp_name"];
	    $size = $file["size"];
	    $dimensiones = getimagesize($ruta_provisional);
	    $width = $dimensiones[0];
	    $height = $dimensiones[1];
	    $carpeta = "images/captura_servicios/";
	    $fecha = new DateTime();
		$fecha->getTimestamp();
        echo $destino = $carpeta.$fecha->getTimestamp().".jpg";
        move_uploaded_file($ruta_provisional, $destino);
	break;

	case 'busca_cuadrilla_x_contratista':
		$sql = "select codigo, nombre from cuadrillas where cod_contratista = $cod_contratista";  // cod_cuadrilla es la variable que viene
		$resulta = mysqli_query($conexion, $sql);
		$rows = mysqli_num_rows($resulta);
		if (!$rows > 0) { echo '0';
		} else {
			while($data = mysqli_fetch_array($resulta)) {
				echo "<option value='".$data[0]."'>".$data[1]."</option>";
			}
		}	 
	break;

	case 'contratista':
		$cod_contratista = isset($cod_contratista) ? $cod_contratista : "0";
		
		$sql = "select nombre from usuarios where codigo = $cod_contratista";   // cod_contratista es la variable que viene
		$resulta = mysqli_query($conexion, $sql);
		$rows = mysqli_num_rows($resulta);
		if ($rows > 0) {
			while($nombre = mysqli_fetch_array($resulta)) {
				$contratista = $nombre[0];
				echo $contratista;
				$_SESSION["cod_contratista"] = $cod_contratista;
			}			
		} else {
			echo '0';
	   }
	break;

	case 'guardando_servicio':
		echo $sql =  "INSERT INTO servicios_cab VALUES (null, '$idservicio', $codigo_html_to_excel, '$busca_cuadrilla', '$busca_contratista', '$fecha', '$direccion', '$vlrtotal', null, '$descripcion', '$observaciones')";
		echo "<br>";
	
		if (!mysqli_query($conexion, $sql)) {
			echo "Error: " . mysqli_error($conexion);
		}

		// echo "<pre>"; print_r(json_decode($items)); echo "</pre>";
		foreach (json_decode($items) as $key => $value) {
			$sql = "INSERT into servicios_det values (null, '$idservicio', $codigo_html_to_excel, '$value->id_item', '".str_replace("<br>", " ", $value->cantidad)."', ".str_replace(",", ".", str_replace(".", "", $value->vlrtotal)).", null)";
			$resulta = mysqli_query($conexion, $sql);
		  	// echo("Error description: " . mysqli_error($resulta));

		}
	break;

	case 'guardando_tabla_servicios_html_excel':
		$sql = "insert into tbl_html_to_excel values(null, '".$codigo_servicio."', '".$tblExport."', null)";
		$resulta = mysqli_query($conexion, $sql);
		// echo 
		$codigo_html_to_excel = mysqli_insert_id($conexion);
		// enviando el correo        
        // echo 
        $sql = "SELECT mail_1, mail_2, mail_3, mail_4 FROM contratistas where codigo=".$contratista;
        $resulta = mysqli_query($conexion, $sql) or die ("error en consulta contratistas") ;
        $rows = mysqli_num_rows($resulta);
	    if ($rows > 0) {
	       	while($res = mysqli_fetch_array($resulta)) {
		       	for ($count=0; $count <= 3 ; $count++) {
		       		// echo "<br>Enviado a:";
		       		// echo $res[$count];
		       		$mensa = 'Sr Contratista usted puede visualizar el archivo de excel en el siguiente vinculo
		       		<a href="http://clsolutions.com.co/c-services/print_excel_servicio.php?codigo_documento='.$codigo_html_to_excel.'">
		       		http://clsolutions.com.co/c-services/print_excel_servicio.php?codigo_documento='.$codigo_html_to_excel."
		       		</a>";
		       		$cabeceras = 'MIME-Version: 1.0' . "\r\n";
					$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$cabeceras .= 'From: Abarreto <info@softwareydiseno.com>' . "\r\n";
					// Cabeceras adicionales
					// $cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
					// $cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
					// $cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
					// $cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		       		mail($res[$count], "Archivo Excel", $mensa, $cabeceras);
		       		// mail("nandoalvarado022@gmail.com", "Archivo Excel", $mensa, $cabeceras); break;
		       	}
	       	}
	    }
	    print json_encode(array('codigo_html_to_excel' => $codigo_html_to_excel));
	break;

	case 'item_hijo':
		$sql = "select subcodigo, nombre, unidad, vlrunitario from
		item_hijo ih where ih.codigo = ".$codigo_padre;

		$resulta = mysqli_query($conexion, $sql);
		$rows = mysqli_num_rows($resulta);
		if ($rows > 0) {
			echo "<option value=''>Seleccione</option>";
			while($registro=mysqli_fetch_row($resulta)){
				echo "<option data-vlrunitario='".$registro[3]."' data-unidad='".$registro[2]."' value='".$registro[0]."'>".utf8_encode($registro[1])."</option>";
			}
		} else{
			echo 0;
		}
	break;

	case 'cuadrilla':   		
		$sql = "select nombre from cuadrillas where codigo = $cod_cuadrilla";  // cod_cuadrilla es la variable que viene
		$resulta = mysqli_query($conexion, $sql);
		$rows = mysqli_num_rows($resulta);
		if (!$rows > 0) {
			echo '0';
		} else {
			while($nombre = mysqli_fetch_array($resulta)) {
				echo $cuadrilla = $nombre[0];
			}
		}	   
	break;

	case 'cliente':		
	   	$sql = "select nombre from clientes where cod_contratista = $_SESSION[cod_contratista] and codigo = $cod_cliente"; // cod_cliente es la variable que viene
	   	$resulta = mysqli_query($conexion, $sql);
	   	$rows = mysqli_num_rows($resulta);
	   	if (!$rows > 0) {
			echo '0';		  
		} else {
			while($nombre    = mysqli_fetch_array($resulta)) {
				echo $cliente = $nombre[0];
			}
		}	   
	break;
}