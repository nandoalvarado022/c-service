<?php 
include "conex.php";
	foreach($_POST as $nombre_campo => $valor){ 
		$asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
		eval($asignacion); 
	}
// echo "<pre>"; print_r($_POST); echo "</pre>";
?>
<script>
	function cambiaProducto(oSelect){
	  alert(oSelect.value);
	}
</script>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb18030">
		<?php include "header.php";?>
	</head>
	<body id="captura_servicios">
		<div class="container">

			<form style="display: none;">
				<input value ="<?php echo $_POST[busca_contratista]?>" name="busca_contratista">
				<input value ="<?php echo $_POST[busca_cuadrilla]?>" name="busca_cuadrilla">
				<input value ="<?php echo $_POST[direccion]?>" name="direccion">
				<input value ="<?php echo $_POST[busca_cliente]?>" name="idservicio"> 
				<input value ="<?php echo $_POST[fecha]?>" name="fecha"> 
				<input value ="<?php echo $_POST[idservicio]?>" name="descripcion"> 
			</form>

			<header>
				<?php
					//$cad = "Bienvenido Usuario ".$_SESSION['nomuser'].$_SESSION['grpuser'];
					include "bienvenido.php";
				?>  
				
			</header>
			
			<div id="seleccionar_file" style="display: none;">
				<p>Seleccionar archivo excel.</p>
				<input type="file" value="Seleccionar archivo">
			</div>

			<h2 style="text-align: center;">
				<span>Actualizar Servicio ó Captura de Actividad</span>
			</h2>
			
			<?php 
				if(@$_POST["contratista"] != "") $_SESSION["contratista"] = $_POST["contratista"];
				if(@$_POST["cuadrilla"] != "") $_SESSION["cuadrilla"] = $_POST["cuadrilla"];
				if(@$_POST["cliente"] != "") $_SESSION["cliente"] = $_POST["cliente"];
				if(@$_POST["busca_cliente"] != "") $_SESSION["busca_cliente"] = $_POST["busca_cliente"];
				if(@$_POST["fecha"] != "") $_SESSION["fecha"] = $_POST["fecha"];
				if(@$_POST["direccion"] != "") $_SESSION["direccion"] = $_POST["direccion"];
			?>	
		
			<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
				<table align="center" border="1" class="table encabezado">
					<tr>
						<th class="hidden">Coordinador:</th>
						<td class="hidden"><?php echo $_POST["contratista"]?></td>
					</tr>

					<tr>
						<th>Cuadrilla:</th>
						<td>
							<?php 
							$sql = "SELECT nombre FROM usuarios
							where codigo=$_POST[busca_cuadrilla]";
							$resulta = mysqli_query($conexion, $sql);
							while($data = mysqli_fetch_array($resulta)) {
								echo $data[0];
							}
							?>
						</td>
					</tr>

					<tr>
						<th>ID de Servicio/Proyecto</th>
						<td>
							<?php echo $_POST["busca_cliente"]?> - <?php echo $_POST["cliente"]?>
						</td>
					</tr>
					<tr>

						<th>Dirección:</th>
						<td><?php echo $_POST["direccion"]?></td>
					</tr>

					<tr>
						<th>Fecha:</th>
						<td><?php echo $_POST["fecha"]?></td>
					</tr>

					<tr>
						<th>Descripción</th>
						<td><?php echo $_POST["idservicio"]?></td>
					</tr>

					<tr>
						<th>Foto antes</th>
						<td>
							<input data-ubicacion="" id="foto_antes" name="foto_antes" type="file">
							<div class="preview"></div>
						</td>
					</tr>

					<tr>
						<th>Foto despues</th>
						<td>
							<input data-ubicacion="" id="foto_despues" name="foto_despues" type="file">
							<div class="preview"></div>							
						</td>
					</tr>

					<tr>
						<th>Foto adicional</th>
						<td>
							<input data-ubicacion="" id="foto_adicional" name="foto_adicional" type="file">
							<div class="preview"></div>							
						</td>
					</tr>
					<tr>
						<td colspan="2" id="td_observaciones">
							<textarea class="form-control" name="observaciones" id="observaciones" cols="2" rows="10" placeholder="Obsrvaciones"></textarea>
						</td>
					</tr>
				</table>
			</form>

			<div id="condif_add">
				<div>
					<?php 
					?>
					<select class="form-control" id='item_padre' name='menu'>
						<option selected>Seleccione Servicio</option>
							<?php
								$sql = "select nombre, codigo from item_padre where codigo_contratista=$_SESSION[cod_contratista]";
								$resulta = mysqli_query($conexion, $sql);
								$rows = mysqli_num_rows($resulta);
								while($registro = mysqli_fetch_row($resulta)){
									echo "<option value='".$registro[1]."'>".utf8_encode($registro[1].". ".$registro[0])."</option>";
								}
							?>
					</select>
				</div>
				<br>

				<div>
					<select class="form-control" name="" id="item_hijo" onchange="validarCampos(this)">
						<option value="">Seleccione trabajo</option>
					</select>
				</div>

				<br>

				<div>
					<p>
						<input type="number" aria-describedby="sizing-addon2" class="form-control" style="display: none" id="cantidad" placeholder="Cantidad | Si el valor es decimal utilice punto (.)">
					</p>

					</p>
						<input type="number" aria-describedby="sizing-addon2" class="form-control" style="display: none" id="largo" placeholder="Largo | Si el valor es decimal utilice punto (.)">
					</p>

					<p>
						<input type="number" aria-describedby="sizing-addon2" class="form-control" style="display: none" id="ancho" placeholder="Ancho | Si el valor es decimal utilice punto (.)">
					</p>
					
					<p>
						<input type="number" aria-describedby="sizing-addon2" class="form-control" style="display: none" id="longitud" placeholder="Longitud | Si el valor es decimal utilice punto (.)">
					</p>
					 
					<p>
						<input type="number" aria-describedby="sizing-addon2" class="form-control" style="display: none" id="altura" placeholder="Altura | Si el valor es decimal utilice punto (.)">
					</p>
				</div>

				<div>
					<button style="outline: none;" class="btn btn-success glyphicon glyphicon-plus" onclick="btn_anadir_item()"></button>
				</div>
			</div>

			<div id="table_wrapper" class="table-responsive">

				<table class="table table-bordered table-striped" id="listado_obras">
					<thead>
						<th>No.</th>
						
						<th>DESCRIPCIÓN</th>
						<th>UNIDAD</th>
						<th>CANTIDAD</th>
						<th class="hidden">CANTIDAD TOTAL</th>
						<th class="hidden">VALOR UNITARIO</th>
						<th class="hidden">VALOR TOTAL</th>
						<!-- <th>VALOR TOTAL</th> -->
						<th class="thd_remove">
							
						</th>
						
					</thead>

					<tbody>
						
					</tbody>
				</table>
			</div>

			<div style="text-align: center;">
				
			</div>

			<div id="espacio_footer" class="bg-info">
				<table class="table" style="margin: 0px;">
					<thead>
						<td>
							<a class="btn btn-warning" href="/c-services/crea_cabecera.php">Volver</button>
						</td>
						<th class="hidden">TOTAL:</th>
						<th class="hidden">
							<span id="e_vtotal">$0</span>
						</th>
						<td>
							<button title="Guardar y enviar, genera PDF y envia archivo EXCEL a correos configurados" id="btnExport" class="btn btn-success"></button>
						</td>
					</thead>
				</table>
			</div>

			<table id="tblExport" class="table" border="1" style="display: none;"><!-- tabla a exportar -->
			</table>
		</div>
	</body>

	<script>
		var total = 0;
		$(function(){
			$("#foto_antes, #foto_despues, #foto_adicional").change(function(){
				$element = $(this);
				$element.parent().find(".preview").html("Cargando...");
				ubicacion_image = $element.attr("data-ubicacion");
				name_element = $(this).attr('id');
				var formData = new FormData($("#uploadimage")[0]);
				ruta='ajax.php?causa=subir_foto&name_element='+name_element;
				console.log(ruta);
				$.ajax({
					url: ruta,
					type: "POST",
					data: formData,
					contentType: false,
                	processData: false,
                	beforeSend: function(){
						$element.parent().find(".preview").html("Cargando...");
                	},
					success:function(res){
						console.log(res);
						html = `
							<a href="http://www.clsolutions.com.co/c-services/${res}" target="_BLANK">
								<img src="${res}">
							</a>
							<div>
							<a class="hidden" href="http://www.clsolutions.com.co/c-services/${res}" target="_BLANK">http://www.clsolutions.com.co/c-services/${res}</a>
							</div>`;
						$element.parent().find(".preview").html(html);
					},
					error: function(jqXHR, textStatus, errorThrown){
						$element.parent().find(".preview").html("Inténtelo nuevamente.");
						// $element.parent().find(".preview").html(jqXHR+" "+textStatus+" "+errorThrown);
						// debugger;
					}
				})
			});

			$(item_padre).change(function(){
				cantidad.style.display = "none";
				largo.style.display = "none";
				ancho.style.display = "none";
				longitud.style.display = "none";
				altura.style.display = "none";

				$.ajax({
					url: "ajax.php",
					async: false,
					data: "causa=item_hijo&codigo_padre="+$(item_padre).val(),
					type: "GET",
					success: function(res){
						if (res!="0") {
							$(item_hijo).fadeIn();
							$(item_hijo).html(res);
						} else{
							$(item_hijo).fadeOut();
						}
					}
				})
			})
		});

		var unidad;
		function validarCampos(item_hijo){
			unidad = $(item_hijo).find("option:selected").attr("data-unidad");
			if (unidad=="ml" || unidad=="un" || unidad=="hh ing" || unidad=="hh tec" || unidad=="hday" || unidad=="hdof" || unidad=="mes" || unidad=="kg" || unidad=="volt" || unidad=="grados" || unidad=="%") {
				cantidad.style.display = "block";
				largo.style.display = "none";
				ancho.style.display = "none";
				longitud.style.display = "none";
				altura.style.display = "none";
			} else if(unidad=="m2"){
				cantidad.style.display = "none";
				largo.style.display = "block";
				ancho.style.display = "block";
				longitud.style.display = "none";
				altura.style.display = "none";

			} else if(unidad=="m3"){
				cantidad.style.display = "none";
				largo.style.display = "block";
				ancho.style.display = "block";
				altura.style.display = "block";

			} else if(unidad=="null"){
				cantidad.style.display = "none";
				largo.style.display = "none";
				ancho.style.display = "none";
				altura.style.display = "none";
			}
		}

		function btn_remover_item(element){
			valor_remover = parseFloat($(element).attr("data-valor"));
			total = ((total - valor_remover) < 0 ? 0 : (total - valor_remover));
			e_vtotal.innerHTML = "$"+total.toLocaleString();
			$(element).parent().parent().remove()
		}

		function btn_anadir_item(){
			// valor = Math.round($(item_hijo).find("option:selected").attr("data-vlrunitario"));
			valor_unitario = $(item_hijo).find("option:selected").attr("data-vlrunitario");
			valor = valor_unitario;
			unidad = $(item_hijo).find("option:selected").attr("data-unidad");
			
			if (unidad=="ml" || unidad=="un" || unidad=="hh ing" || unidad=="hh tec" || unidad=="hday" || unidad=="hdof" || unidad=="mes" || unidad=="kg" || unidad=="volt" || unidad=="grados" || unidad=="%" || unidad=="null") {
				valor = cantidad.value * valor;
				texto_columna = cantidad.value;
				cantidad_total = cantidad.value;
			} else if(unidad=="m2"){
				valor = valor * (parseFloat(largo.value) * parseFloat(ancho.value));
				texto_columna = "Largo: "+largo.value+"<br>Ancho: "+ancho.value;
				cantidad_total = largo.value * ancho.value;
			} else if(unidad=="m3"){
				valor = valor * ((parseFloat(largo.value) * parseFloat(ancho.value) * parseFloat(altura.value)));
				texto_columna = "Largo: "+largo.value+"<br>Ancho: "+ancho.value+"<br>Altura: "+altura.value;
				cantidad_total = largo.value * ancho.value * altura.value;
			}

			total = total + valor;
			e_vtotal.innerHTML = "$"+total.toLocaleString();

			// <td>${$(item_padre).find("option:selected").html()}</td>

			id_item = $(item_hijo).find("option:selected").val();
			html=`
				<tr data-cantidad="${texto_columna}" data-id-item="${id_item}" data-vlrtotal="${valor.toLocaleString()}">
					<td class="id">${id_item}</td>

					<td>${$(item_hijo).find("option:selected").html()}</td>

					<td>
						${unidad}
					</td>

					<td class="cantidad">
						${texto_columna}
					</td>

					<td class="hidden"> <!-- cantidad total -->
						${cantidad_total}
					</td>

					<td class="hidden">
						$${parseFloat(valor_unitario).toLocaleString()}
					</td>

					<td class="hidden">
						$${valor.toLocaleString()}
					</td>

					<td class="thd_remove">
						<button onclick="btn_remover_item(this);" data-valor="${valor}" class="btn btn-danger glyphicon glyphicon-remove"></button>
					</td>

				</tr>
			`;

			$("table#listado_obras tbody").prepend(html);

			cantidad.value = "";
			largo.value = "";
			ancho.value = "";
			altura.value = "";
		}			

		function limpiar(){
			$("input[type='text']").val("");
		}

		$(document).ready(function() {
			$("[title='Hosted on free web hosting 000webhost.com. Host your own website for FREE.']").parent().remove();
		});

		var codigo_html_to_excel;
		$("#btnExport").click(function(e) {
			e.preventDefault();
			observaciones_value = $("#observaciones").val();
			$("body").find("#td_observaciones").html("<b>Observaciones: </b>"+observaciones_value); // observaciones pasandolo a texto
			htmlExport = `
				<table class="table table-bordered table-striped">${$(".table.encabezado").html()}</table>
				<div id="table_wrapper" class="table-responsive">
					<table class="table table-bordered table-striped" id="listado_obras">
						${$("#listado_obras thead").html()}
						${$("#listado_obras tbody").html()}
						<tr>
							<td colspan="5"></td>
							<td>Total</td>
							<td>
								$${total.toLocaleString()}	
							</td>
						</tr>
					</table>
				</div>
			`;

			// $("#tblExport").html(html);
			// guardando en la bd como excel
				$.ajax({
					url: "ajax.php",
					async: false,
					type: "POST",
					data: {
						tblExport: htmlExport,
						causa: "guardando_tabla_servicios_html_excel",
						contratista: $("[name='busca_contratista']").val(),
						codigo_servicio: $("[name='idservicio']").val()
					},
					success:function(res){
						codigo_html_to_excel = JSON.parse(res).codigo_html_to_excel;
						alert("Se ha guardado el servicio.");
						console.log("El id del documento es: "+res);
					}
				})
			// guardando en la bd como excel

			// guardando en la bd
				items = Array();
				$("#listado_obras tbody tr").each(function(index, element){
					item = {
						id_item: $(element).attr("data-id-item"),
						cantidad: $(element).attr("data-cantidad"),
						vlrtotal: $(element).attr("data-vlrtotal")
					}
					items.push(item)
				});

				datos = $("form").serialize()+"&causa=guardando_servicio&items="+JSON.stringify(items)+"&vlrtotal="+total+"&codigo_html_to_excel="+codigo_html_to_excel+"&observaciones="+observaciones_value;
				$.ajax({
					url: "ajax.php",
					async: false,
					type: "GET",
					data: datos,
					success:function(res){
						console.log(res);
					}
				})
			// guardando en la bd			

		});
	</script>

	<style>
		table{
			width: 90%;
			margin: 30px auto;
			background: #ececec;
			text-align: center;
		}	
		table th{
			text-align: center;
		}
		#condif_add{
			width: 90%;
			margin: 50px auto 0;
			text-align: center;
		}
		#condif_add input{
			
		}
		#condif_add input, #condif_add select{
			font-size: 14px !important;
			padding: 2px 10px !important;
			margin: 0 auto;
			text-transform: uppercase !important;
		}
		
		#espacio_footer{
			position: fixed;
			bottom: 0px;
			left: 0px;
			border-top: solid 2px #81cdf3;
			width: 100%;
		}
		input[type='file']{
			color: transparent;
	    	width: 170px;
    	}
		#table_wrapper{
			width: 90%;
			margin: 0 auto;
			display: block;
		}
		.preview img{
			max-width: 100%;
		}

		body{
			margin: 20px 0 100px 0;
		}
		#btnExport{
			background-image: url(images/icon_excel.png);
			height: 40px;
			background-repeat: no-repeat;
			width: 40px;
			background-position: 5px 5px;
			background-color: white;
		}
		#btnExport:hover{
			background-color: #d9edf7;
		}
		.hidden{
			/*display: none;*/
		}
		input[type="file"]{
		    margin: 0 auto 10px;
    		width: 156px;
		}
	</style>
</html>

