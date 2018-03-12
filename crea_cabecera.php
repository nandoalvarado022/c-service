<?php // session_start();?>
<?php // if($_SESSION['nomuser'] == "") header('Location: index.php');
?>
<?php include "conex.php";
$cod_contratista=isset($_SESSION["cod_contratista"]) ? $_SESSION["cod_contratista"] : ""; 

	
	// print_r($_SESSION);
	
	


?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include "header.php";?>
	</head>

	<body id="crea_cabecera">
		<div class="container">

			<header>
				<?php					
					//$cad = "Bienvenido Usuario ".$_SESSION['nomuser'].$_SESSION['grpuser'];
					include "bienvenido.php";
				?>  
				
			</header>

			<h3 style="margin: 20px 0 30px; text-align: center;">Registro de <span class="label label-default">Servicios/Proyectos</span></h3>
			
			<form id="first_form" action="captura_servicios.php" method="POST">
				<div>
					<?php
					if($cod_contratista){?>
						<input value="<?php print $cod_contratista?>" readonly type="number" name="busca_contratista" id="busca_contratista" class="form-control hidden"></input>	
						<?php
					} else{?>
						<label for="contratista">Coordinador </label>
							<input type="number" name="busca_contratista" id="busca_contratista" class="form-control"></input>
							<input data-validar="false" readonly class="form-control" id = "contratista" name="contratista" placeholder="Digite codigo del contratista"/> 
						<?php
					}?>
					
				</div>
					
				<?php
				if(isset($_SESSION["cod_cuadrilla"])){
					echo '<select name="busca_cuadrilla" id="busca_cuadrilla" class="form-control hidden">';
					echo "<option value='$_SESSION[cod_cuadrilla]'>$_SESSION[nomuser]</option>";
					echo '</select>';
				} else{?>
					<label for="cuadrilla">Cuadrilla </label>
					<div>
						<select name="busca_cuadrilla" id="busca_cuadrilla" class="form-control">
							<?php 
								if ($_SESSION["cod_contratista"]!="") {
									echo "<option value=''>Seleccione</option>";
									$sql = "SELECT codigo, nombre FROM cuadrillas
									where cod_contratista=$cod_contratista";
									$resulta = mysqli_query($conexion, $sql);
									while($data = mysqli_fetch_array($resulta)) {
										echo "<option value='$data[codigo]'>".$data["nombre"]."</option>";
									}
								}
							?>
						</select>
					</div>
					<?php
				}?>

				

				<div style="margin: 20px 0;">
					<label for="cliente">ID de Servicio/Proyecto</label>
					<div>
						<select name="id_servicio" id="id_servicio" class="form-control">
						
						<?php print cmb_servicio_proyecto();?>
							<!-- <input name="busca_cliente" id="busca_cliente" class="form-control"></input> -->
							<!-- <input data-validar="false" readonly type="text" class="form-control" id = "cliente" name="cliente" placeholder="Digite codigo de cliente" />  -->
						</select>
					</div>
				</div>						

				<label for="idservicio">Descripción</label>
				<div>
					<input type="text" class="form-control" name="idservicio" placeholder="Digite resumen breve de la actividad" /> 
				</div>
				
				<div style="margin: 20px 0;">
					<label for="fecha">Fecha</label>
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<input type="date" class="form-control" name="fecha" placeholder="Digite fecha servicio" /> 
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<label for="direccion">Dirección </label>
						<div>
							<input type="text" class="form-control" name="direccion" placeholder="Digite direccion servicio" /> 
						</div>
					</div>
				</div>

				<br>

				<div class="row">
					<div class="col-md-3 col-xs-4 text-center col-xs-offset-2">
	                    <input class="btn btn-default" onClick="window.location.href='entro.php'" name="submit" type="button" value="Volver">
					</div>
					<div class="col-md-3 col-xs-4 text-center">
						<input class="btn btn-success" name="submit" type="submit" value="Continuar" />
					</div>
                </div>
			</form>
		</div>

		<script>
			var valida_form = true;
			Date.prototype.toDateInputValue = (function() {
			    var local = new Date(this);
			    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
			    return local.toJSON().slice(0, 10);
			});

			$(document).ready( function() {
				<?php if($cod_contratista!="") echo "validar_contratista();";?>				
			    $('[name="fecha"]').val(new Date().toDateInputValue());
			    $("#busca_contratista").blur(function(){ // validando contratista
			    	validar_contratista();
				}); // validando contratista

				// $("#busca_cuadrilla").blur(function(){ // validando cuadrilla
				// 	validar_cuadrilla();
				// }); // validando cuadrilla
				
				/*
				$("#busca_cliente").blur(function(){ // // validando cliente
					if(this.value=="") return false;
					$.ajax({
						url: "ajax.php",
						data: "causa=cliente&busca_cliente="+busca_cliente.value,
						type: "GET",
						async: true,
						beforeSend: function(){
							cliente.value = "Consultando...";
						},
						success: function(res){
							if (res!="0"){
								cliente.value = res; 
								$(cliente).attr("data-validar", "true");
							} else{
								cliente.value = "Cliente no registrado";
								$(cliente).attr("data-validar", "false");
							}
						},
						error: function(xhr, status, error) {
						  	alert("Se ha producido un error, por favor comuníquese con el administrador");						  	
						}
					})		
				}); // validando cliente
				*/

				/*$("input[type='submit']").click(function(e){
					if($(contratista).attr("data-validar") == "false" || $(cliente).attr("data-validar") == "false"){
						e.preventDefault();
						alert("Fallo la validación de campos");
					}
				});*/
			});

			

			function validar_contratista(){
				datos = "causa=contratista&cod_contratista="+busca_contratista.value;
				if(busca_contratista.value=="") return false;
				$.ajax({
					url: "ajax.php",
					data: datos,
					type: "GET",
					// async: false,
					beforeSend: function(){
						if(typeof contratista!="undefined") contratista.value = "Consultando...";
					},
					success: function(res){
						if (res!="0"){
							if(typeof contratista!="undefined"){
								contratista.value = res; 
								$(contratista).attr("data-validar", true);
								cargar_cuadrilla();
							}
						} else{
							contratista.value = "Contratista no registrado";
							$(contratista).attr("data-valida", 0);
						}
					},
					error: function(xhr, status, error) {
						// var err = eval("(" + xhr.responseText + ")");
					  	alert("Se ha producido un error, por favor comuníquese con el administrador");
					}
				})
			}

			function cargar_cuadrilla(){
				datos = "causa=busca_cuadrilla_x_contratista&cod_contratista="+busca_contratista.value;
				$.ajax({
					url: "ajax.php",
					data: datos,
					type: "GET",
					// async: false,
					beforeSend: function(){
						// contratista.value = "Consultando...";
					},
					success: function(res){
						busca_cuadrilla.innerHTML = res;
					}
				});
			}

			// function validar_cuadrilla(){
			// 	$.ajax({
			// 		url: "ajax.php",
			// 		data: "causa=cuadrilla&cod_cuadrilla="+busca_cuadrilla.value,
			// 		type: "GET",
			// 		async: false,
			// 		beforeSend: function(){
			// 			cuadrilla.value = "Consultando...";
			// 		},
			// 		success: function(res){
			// 			if (res!="0"){
			// 				cuadrilla.value = res;
			// 				$(cuadrilla).attr("data-validar", true);
			// 			} else{
			// 				cuadrilla.value = "Cuadrilla no registrada";
			// 				$(cuadrilla).attr("data-valida", 0);
			// 			} 
			// 		},
			// 		error: function(xhr, status, error) {
			// 		  	alert("Se ha producido un error, por favor comuníquese con el administrador");						  	
			// 		}
			// 	})
			// }

		</script>
		<?php 
			include("footer.html");
		?>
		
	</body>
</html>