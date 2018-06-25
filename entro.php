<!DOCTYPE html>
<html lang="es">
	<head>		
		<link rel="stylesheet" type="text/css" href="cabecera.css">
		<?php 
		include "conex.php";
		include "header.php";?>
	</head>
	<body id="panel_entro">
		<div class="container">
		<header>
			<?php include "bienvenido.php";?>
		</header>
			
		<?php 
		print isset($_GET["msg"]) ? '<br><div class="alert alert-warning" role="alert">'.$_GET["msg"].'</div>' : "";
		
		// listado de proyectos activos
			if($_SESSION["grpuser"]=="CON"){
				$rows = tbl_proyectos_activos();
				// echo "<pre>";print_r($rows);
				?>
				<div class="panel panel-default m-t-20">
					<div class="panel-heading">PROYECTOS ACTIVOS</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Id proyecto</th>
									<th>Nombre proyecto</th>
									<th>Nombre cliente</th>
									<th>Fecha</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($rows as $row){?>
								<tr>
									<td><?=$row["id"]?></td>
									<td><?=$row["nombre_proyecto"]?></td>
									<td><?=$row["nombre_cliente"]?></td>
									<td><?=$row["created"]?></td>
									<td>
										<button type="button" onclick="terminarProyecto(<?=$row['id']?>)" class="btn btn-warning">Terminar</button>
									</td>
								</tr>	
								<?php
							}?>
							</tbody>
						</table>		
					</div>
				</div>
				<?php
			}
		// listado de proyectos activos?>
		

		<?php include("footer.html");?>
		<script>
			terminarProyecto = (id_servicio) => {
				if(confirm("¿Desea terminar el proyecto?")){
					$.ajax({
						url: "ajax.php",
						data:{
							id_servicio: id_servicio,
							causa: "terminarProyecto"
						},
						success:function(res){
							location.reload();
						}
					})
				}

			}
		</script>
	</body>
</html>