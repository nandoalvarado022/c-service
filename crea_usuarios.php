<?php 
$cod_contratista=isset($_SESSION["cod_contratista"]) ? $_SESSION["cod_contratista"] : ""; ?>
<?php include "conex.php";
print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
	<head>		
		<?php include "header.php";?>			 
	</head>  
	<body>
		<div class="container">
			<header>
				<?php include "bienvenido.php";?>
			</header>

            <h3 style="margin: 20px 0 30px; text-align: center;">Creación de <span class="label label-default">Usuarios y Empresas</span></h3>

			<div class="group container">
				<form action="registro_usuarios.php" method="POST">
					<div class="margin-bottom col-md-6 col-md-offset-3">
						<select name="tipo_usuario" id="" class="form-control">
							<option value="">Seleccione tipo de usuario</option>
							<?php if($_SESSION["grpuser"]=="ADM"){ // si es empresa padre usuario logueado?>
								<option value="EP">Empresa padre</option>								
							<?php }
							
							// print "asd".$_SESSION["grpuser"];
							if(in_array($_SESSION["grpuser"], array("EP", "CON"))){ // si es empresa padre usuario logueado?>
								<option value="EC">Empresa cliente</option>
							<?php }?>
							<?php if($_SESSION["grpuser"]=="EP"){ // si es empresa padre usuario logueado?>
								<option value="COO">Coordinador</option>
							<?php }?>
						</select>
					</div>
					
					<div class="margin-bottom col-md-6 col-md-offset-3">
						<input type="number" name="codigo" placeholder="Codigo" class="form-control">
					</div>

					<div class="margin-bottom col-md-6 col-md-offset-3">
						<input type="text" name="nit" placeholder="Nit" class="form-control">
					</div>

					<div class="margin-bottom col-md-6 col-md-offset-3">
						<select name="cmb_empresa_cliente" id="" class="form-control">
							<option value="">Seleccione empresa cliente</option>
							<?php print cmb_empresa_cliente("")?>
						</select>
					</div>
					
					<div class="margin-bottom col-md-6 col-md-offset-3">
						<input type="text" name="nombre" placeholder="Nombre" class="form-control" required>
					</div>

					<div class="margin-bottom col-md-6 col-md-offset-3">
						<input type="text" name="email" placeholder="Correo electrónico" class="form-control" >
					</div>
					 
					<div class="margin-bottom col-md-6 col-md-offset-3">
						<input type="password" name="clave" placeholder="Contraseña" class="form-control">
					</div>

					
					<div class="margin-bottom col-md-6 col-md-offset-3 text-center">
						<input class="btn btn-default margin-right" onClick="window.location.href='entro.php'" name="submit" type="button" value="Volver">
						<input class="btn btn-success" name="submit" type="submit" value="Registrar" />
					</div>
					
				</form>
			</div>
		</div>

		<script>
			$("[name='tipo_usuario'").change(function(a, b){
				valor=$(this).val();
				$("[name='clave'], [name='email'], [name='codigo']").show();
				$("[name='cmb_empresa_cliente']").parent().hide();
				switch (valor) {
					case "EC":
						$("[name='clave'], [name='email'], [name='codigo']").parent().hide();
					break;

					case "COO":
					$("[name='cmb_empresa_cliente']").show();
					break;
				}
			});

			<?php 
			$msg = isset($_GET["msg"]) ? $_GET["msg"] : "";
			if($msg!=""){?>
				$.notify("<?php echo $_GET['msg']?>", "info");
				<?php
			}?>
		</script>
	</body>
</html>