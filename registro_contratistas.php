<?php
      include "conex.php";
      if (isset ($_POST['nit'])) {
         $wnit    = $_POST['nit'];
         $wnombre = $_POST['nombre'];
         $email_1 = $_POST['mail_1'];
         $email_2 = '';
         $email_3 = '';
         $email_4 = '';

         if(isset($_POST['mail_2'])) {
           $email_2 = $_POST['mail_1'];           
         }

         if(isset($_POST['mail_3'])) {
           $email_3 = $_POST['mail_3'];           
         }

         if(isset($_POST['mail_4'])) {
           $email_4 = $_POST['mail_4'];           
         }

         $dbname      = 'id2431471_recursos';
         $resulta     = mysqli_query($conexion,"select codigo,nombre from contratistas where Codigo = $wnit");        
         $rows        = mysqli_num_rows($resulta);
         if ($rows > 0) {  
            header('Location: error_contratista.php');
            } else {
              $inserta =  "INSERT INTO contratistas (codigo,nombre,mail_1,mail_2,mail_3,mail_4) VALUES ('$wnit','$wnombre','$email_1','$email_2','$email_3','$email_4')";
              if (mysqli_query($conexion, $inserta)) {
                  mysqli_close($conexion);   
                  $conexion    = mysqli_connect('localhost','id2431471_proyecto_sistemas_uno','Jodienda0531@');
                  mysqli_select_db($conexion, $dbname);
                  $sql="UPDATE usuarios SET Grupo='CON' WHERE codigo='$wnit'";
                  mysqli_query($conexion,$sql);
//                $update = "UPDATE Usuarios SET Grupo='CON' where codigo='$wnit' " ;

//              if (mysqli_query($conexion, $update)) {
                header('Location: Success.html');
//              } else {
//                echo "ERROR: Could not able to execute $update. " . mysqli_error($conexion); 
//              }
              }
           }
      }		
?>