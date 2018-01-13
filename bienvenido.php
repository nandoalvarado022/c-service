<div id="bienvenido">
	<?php
	if($_SESSION['nomuser']=="") header('Location: /softwareydiseno?error=Debe iniciar sessión.');?>
	<div class="row" id="menu_principal">
		<div class="col-xs-4" style="color: white;"><b>C-SERVICES</b></div>
		<div class="col-xs-4">
			
			<span class="text-uppercase" style="color: white;">
				<span style="font-size: 20px" class="glyphicon glyphicon-user"></span>
				<span class="texto"><?php print $_SESSION['nomuser']?></span>
			</span>
		</div>
		
		<div class="col-xs-4" style="cursor: pointer; color: white;" onclick="javascript: $('#menu_principal_nav').toggleClass('active')">
			<span style="font-size: 20px" class="glyphicon glyphicon-align-justify"></span>
			<span class="texto desktop">MENU</span>
		</div>
	</div>

	<ul class="nav" id="menu_principal_nav">
		<?php 
		if (in_array($_SESSION['grpuser'], array("ADM", "CUA", "CON"))) {?>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
					<li>
						<span class="glyphicon glyphicon-folder-open"></span>
						<a href="crea_cabecera.php">Actualizar Servicio ó Captura de Actividad</a>
					</li>
				</div>
			</div>
			<?php 
		}

		if (in_array($_SESSION['grpuser'], array("ADM", "CON"))) {?>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
					<li>
						<span class="glyphicon glyphicon-user"></span>
						<a href="crea_clientes.php">Creación de Servicio</a>
					</li>
				</div>
			</div>
			<?php 
		}

		if (in_array($_SESSION['grpuser'], array("ADM", "CON"))) {?>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
					<li>
						<span class="glyphicon glyphicon-flag"></span>
						<a href="crea_cuadrilla.php">Creación De Cuadrillas</a>
					</li>
				</div>
			</div>
			<?php 
		}
		
		if (in_array($_SESSION['grpuser'], array("ADM"))) {?>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
					<li>
						<span class="glyphicon glyphicon-folder-open"></span>
						<a href="crea_usuarios.php">Creación de Coordinador</a>
					</li>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
					<li>
						<span class="glyphicon glyphicon glyphicon-cog"></span>
						<a href="admin_herramientas.php">Administrar Herramientas</a>
					</li>
				</div>
			</div>
			<?php
		}

		if (in_array($_SESSION['grpuser'], array("ADM", "CON"))) {?>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
					<li>
						<span class="glyphicon glyphicon-list-alt"></span>
						<a href="first-informe.php">Informes</a>
					</li>
				</div>
			</div>
			<?php 
		}

		if (in_array($_SESSION['grpuser'], array("ADM", "CUA", "CON"))) {?>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
					<li>
						<span class="glyphicon glyphicon-remove"></span>
						<a href="salir.php">Salir</a>
					</li>
				</div>
			</div>
			<?php 
		}?>
	</ul>

	
</div>