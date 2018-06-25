<?php include "conex.php";?>
<!DOCTYPE html>
<html lang="es">
	<head>		
		<link rel="stylesheet" type="text/css" href="diseño_forms.css">		
		<?php include "header.php";?>
	</head>
	<body id="first_informe">
		<div class="container">
			<header>
				<?php include "bienvenido.php";?>	
			</header>

			<main>
				<br>
				<div class="panel panel-success"> 
					<div class="panel-heading"> 
						<h3 class="panel-title">Configurar informe</h3> 
					</div> 

					<div class="panel-body">

						<form action="first-informe.php" mehtod="GET">
							<div class="row">
								<div class="col-md-5">
									<select name="codigo_contratista" class="form-control" id="codigo_contratista" onchange="busca_cuadrilla_x_contratista()">
										<?php 
											if ($_SESSION["cod_contratista"]=="") {
												echo "<option value=''>Seleccione contratista</option>";
												$sql = "SELECT co.codigo, us.nombre 
												FROM contratistas as co 
												inner join usuarios as us 
												on co.codigo = us.codigo";
												$sql .= (isset($_SESSION["cod_contratista"])) ? "where cod_contratista=$_SESSION[cod_contratista]" : "";
												// echo $sql;
												$resulta = mysqli_query($conexion, $sql);
												while($data = mysqli_fetch_array($resulta)) {
													echo "<option value='$data[codigo]'>".$data["nombre"]."</option>";
												}
											} else{
												echo "<option value='$_SESSION[cod_contratista]'>$_SESSION[nomuser]</option>";
											}
										?>
									</select>
								</div>

								<div class="col-md-5 col-md-offset-2">
									<select name="codigo_cuadrilla" id="codigo_cuadrilla" class="form-control">
										<?php 
											if ($_SESSION["cod_cuadrilla"]=="") {
												echo "<option value=''>Seleccione cuadrilla</option>";
												$sql = "SELECT codigo, nombre FROM cuadrillas
												where cod_contratista=$_SESSION[cod_contratista]";
												$resulta = mysqli_query($conexion, $sql);
												while($data = mysqli_fetch_array($resulta)) {
													echo "<option value='$data[codigo]'>".$data["nombre"]."</option>";
												}
											} else{
												echo "<option value='$_SESSION[cod_cuadrilla]'>$_SESSION[nomuser]</option>";
											}
										?>
									</select>
								</div>

							</div>
							<br>

							<div class="row">
								<div class="col-md-5">
									<div id="fecha_desde">
										Fecha desde
										<input class="form-control" type="date" placeholder="Seleccione fecha" name="fecha_desde">
									</div>
								</div>

								<div class="col-md-5 col-md-offset-2">
									<div id="fecha_hasta">
										Fecha hasta
										<input class="form-control" type="date" placeholder="Seleccione fecha" name="fecha_hasta">
									</div>
								</div>
							</div>
							<br>

							<div class="row">
								<div class="col-md-offset-4 col-md-2">
									<a href="entro.php" class="form-control btn btn-default">Volver</a>
								</div>

								<div class="col-md-2">
									<button type="submit" class="form-control btn btn-success">Consultar</button>
								</div>
							</div>
						</form>
					</div> 
				</div>

				
				
				<?php 
					if ($_GET) {
						$index = 0;
						$query = "SELECT sc.codigo_servicio, html.codigo as codigo_documento, 
						cl.nombre as nombre_cliente, sc.created as fecha_sistema 
						from servicios_cab as sc 
						left join tbl_html_to_excel as html 
						on sc.codigo_html_to_excel = html.codigo 
						left join clientes cl 
						on sc.codigo_servicio = cl.codigo 
						where  sc.codigo_servicio != ''";
						$query .= ($_GET["codigo_contratista"] != "") ? " and sc.codigo_contratista = '$_GET[codigo_contratista]'" : "";
						$query .= ($_GET["codigo_cuadrilla"] != "") ? " and sc.codigo_cuadrilla = $_GET[codigo_cuadrilla]" : "";
						$query .= ($_GET["fecha_desde"] != "") ? " and sc.fecha between '$_GET[fecha_desde] 00:00:00' and 						 '$_GET[fecha_hasta] 23:59:59'" : "";
						
						// echo "<pre>"; print_r($query); echo "</pre>";
								
						$res = mysqli_query($conexion, $query);?>
					    <table class="table table-bordered table-striped" id="listado_obras">
				    		<tr>
				    			<td>Registros encontrados: </td>
				    			<td><?php echo mysqli_num_rows($res);?></td>
				    		</tr>
							<tr>
								<th>Consecutivo</th>
								<th>Archivo</th>
								<th>Cliente</th>
								<th>Fecha sistema</th>
							</tr>
							<?php
							while($data = mysqli_fetch_array($res)) {
								$index++;
								echo "<pre style='display: none;'>"; print_r($data); echo "</pre>";
								?>
								<tr>
									<td>#<?php print $index?></td>
									<td>
										<a href="print_excel_servicio.php?codigo_documento=<?php print $data['codigo_documento']?>" target="_BLANK">
											<span class="glyphicon glyphicon-list-alt"></span>
											Descargar archivo
										</a>
									</td>
									<td>
										<?php print $data["nombre_cliente"] ?>
									</td>
									<td>
										<?php print $data["fecha_sistema"] ?>
									</td>
								</tr>
								<?php
							}
							?>
						</table>
						<?php
					}
				?>
			</main>
		</div>

		<script>
			Date.prototype.toDateInputValue = (function() {
			    var local = new Date(this);
			    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
			    return local.toJSON().slice(0, 10);
			});

			$(document).ready( function() {
			    $('[name="fecha_desde"], [name="fecha_hasta"]').val(new Date().toDateInputValue());
			});

			function busca_cuadrilla_x_contratista(){
				datos = "causa=busca_cuadrilla_x_contratista&cod_contratista="+codigo_contratista.value;
				$.ajax({
					url: "ajax.php",
					data: datos,
					type: "GET",
					async: false,
					success: function(res){
						console.log(res);
						$("#codigo_cuadrilla").html(res);
					},
					error: function(xhr, status, error) {
						// var err = eval("(" + xhr.responseText + ")");
					  	alert("Se ha producido un error, por favor comuníquese con el administrador");
					}
				})
			}
		</script>
	</body>
</html>