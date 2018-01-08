<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb18030">
		<?php include "header.php";?>
		<!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	 -->
	</head>
	<body id="print_excel_servicio">
		<div class="container">
			<h2>Reporte</h2>
			<?php 
			include "conex.php";
			foreach($_GET as $nombre_campo => $valor){ 
			   	$asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
			   	eval($asignacion); 
			}

			$sql = "select html, codigo_servicio from tbl_html_to_excel where codigo = ".$codigo_documento;

			$resulta = mysqli_query($conexion, $sql);
			$rows = mysqli_num_rows($resulta);
			if ($rows > 0) {	
				while($res=mysqli_fetch_row($resulta)){
					$codigo_servicio=$res[1];
					echo "<div id='archivo_excel'>";
					echo $res[0];
					echo "</div>";
				}
			} else{
				echo "No se ha encontrado el documento.";
			}
			?>
		</div>
		
		<script>	
			$(document).ready(function(){
				$(".thd_remove").remove(); // removiendo los campos que no van
				$(".hidden").removeClass("hidden"); // activando los campos ocultos para el excel
			});
			
			var data_type = 'data:application/vnd.ms-excel';
			var table_html = document.getElementById('print_excel_servicio').outerHTML.replace(/ /g, '%20');
			var a = document.createElement('a');
			a.class = "btn btn-success";
			a.href = data_type + ', ' + table_html;
			a.download = "servicio_cod_<?php echo $codigo_servicio?>.xls";
			texto = document.createTextNode("Descargar archivo");
			a.appendChild(texto);
			$(a).addClass("btn btn-success descargar_archivo");
			// a.click();
			$("body").append(a);
		</script>



	</body>
</html>