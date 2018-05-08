<?php  
//iniciamos la sesión   
// session_start();  
    //sino, calculamos el tiempo transcurrido  
    $fechaGuardada = $_SESSION["vTiempo"];  
    $ahora = time();  
    $tiempo_transcurrido = $ahora-$fechaGuardada;   

    //comparamos el tiempo transcurrido  
     if($tiempo_transcurrido >= 600) {  
     //si pasaron 10 minutos o más  
      session_destroy(); // destruyo la sesión  
      header("Location: index.php?status=errt"); //envío al usuario a la pag. de autenticación  
      //sino, actualizo la fecha de la sesión  
    }
    else {  
    $_SESSION["vTiempo"] = $ahora;  
   }  
 
?>