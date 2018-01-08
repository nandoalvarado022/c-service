<?php
  ob_start();
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistema De Registro De Servicios</title>
       <link href="estilos.css" rel="stylesheet" type="text/css">
</head>  
<body>
     <div class="group">
         <form action="registro_contratistas.php" method="POST">
              <h2><em>Registro De Contratistas</em></h2>  
                  <label for="Nit">Nit o Cedula <span><em>(requerido)</em></span></label>
                  <input type="text" name="nit" class="form-input" required/>   
                  <label for="Nombre">Nombre <span><em>(requerido)</em></span></label>
                  <input type="text" name="nombre" class="form-input" required/>  

                  <label for="Mail_1">mail_1 <span><em>(requerido)</em></span></label>
                  <input type="text" name="mail_1" class="form-input" required/>  

                  <label for="Mail_2">mail_2 <span><em></em></span></label>
                  <input type="text" name="mail_2" class="form-input" />  

                  <label for="Mail_3">mail_3 <span><em></em></span></label>
                  <input type="text" name="mail_3" class="form-input" />  

                  <label for="Mail_4">mail_4 <span><em></em></span></label>
                  <input type="text" name="mail_4" class="form-input" />  

                  <align> <input class="form-btn" name="submit" type="submit" value="Registrar" /></align>
                  <align> <input class="form-btn" onClick="window.location.href='entro.php'" name="submit" type="button" value="Volver">

         </form>
     </div>
</body>
</html>