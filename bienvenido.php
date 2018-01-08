<?php session_start();
if($_SESSION['nomuser']=="") header('Location: /softwareydiseno?error=Debe iniciar sessión.');?>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4 text-center">
		<span class="glyphicon glyphicon-user"></span>
		<?php
			// echo "<pre>"; print_r($_SESSION); echo "</pre>";
		?>
		<span>
			Bienvenido Usuario 
			<span class="label label-primary text-uppercase"><?php print $_SESSION['nomuser']?></span>
		</span>
	</div>
	<div class="col-md-4"></div>
</div>