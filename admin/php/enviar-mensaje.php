<?php 
	include 'consultas.php';
	$query=extraerCorreoEmpresa();
	$row=$query->fetch_assoc();
	$email=$row['email'];
	$nombre=$row['nombre'];

	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // $cabeceras .='From: Portal SJS <noreply@sjs.edu.do>'."\r\n";
    $cabeceras .='From: '.$nombre.' <aventurerosveganosmtb@gmail.com>'."\r\n";
    // $cabeceras .='From: $nombre <$email>'."\r\n";
	$r= nombre_empresa(); 
	foreach ( $_POST['id'] as $row ) {
		// echo $row;
		 
					
 		mail($row,$_POST['evento'],"<!DOCTYPE html >
    <html xmlns='http://www.w3.org/1999/xhtml'>
      <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <meta name='viewport' content='width=device-width' />
        <!-- NOTE: external links are for testing only -->
       <!--  <link href='//cdn.muicss.com/mui-0.1.2/email/mui-email-styletag.css' rel='stylesheet' />
        <link href='//cdn.muicss.com/mui-0.1.2/email/mui-email-inline.css' rel='stylesheet' /> -->
        <link rel='stylesheet' href='http://mangusoft.com/proyecto/css/bootstrap.css'>
      </head>
      <body style='background-color:  white;
            font-family: arial,sans-serif;
            padding-top:10px;
            width: 1280;
            '>
      <div class='container' style='background-color: grey; 
            width: 1000px; 
            margin: 0 auto; 
            padding-bottom: 45px; 
            padding-top: 45px;
            background-image: url(http://mangusoft.com/crm_mangusoft2/admin/img/doodles.png);'>
     
      <div class='container2' style='background-color: white; 
            width: 900px; 
            margin: 0 auto;'>
        <table align='center'>
        
          <tr>
            <td  >            
              <center>
                <a href='http://mangusoft.com/'><img style='width:200px; margin-bottom: 25px; margin-top: 20px' src='http://mangusoft.com/crm_mangusoft2/admin/img/iconocorreo.png'>   </a>          
                <h2 style='margin-top: -5px!important; margin-bottom: 16px!important;'> ".$_POST['evento']."</h2> 
              </center>
            </td>
          </tr>

          <tr>
            <td>
                <center>
                <pre style='max-width: 90%; font-size: 18px; font-family:arial' align='justify' >
                 ".$_POST['msj']."

        </pre>
                </center>
            </td>
            
        </tr>


          <tr>
            <td >
              <br>

          <center style='font-size:15px;'>
                    <a href='http://mangusoft.com/'>ManguSoft &copy;</a> - ".date('Y')." - Sistema de Inscripci&oacute;n en L&iacute;nea - Todos los Derechos Reservados. </p>
            		</center>
             <!--  <center>
                <a href='http://mangusoft.com/proyecto' style='max-width: 90%' align='justify'><img src='http://mangusoft.com/proyecto/img/btn-correo.png' width='125px'></a>
                </center> -->
       
            </td>
          </tr> 

          <tr>

            		
          
            <hr width='90%'>
            <!-- <br> -->
            <center>
              <p style='font-weight: bold;max-width: 90%' align='justify'><span style='color: red'>".$nombre."</span> | ".$_POST['evento']."</p> 
              <!-- <p style='max-width: 90%' align='justify'>agustinianolavega.com | Tel .: (809) 573-1554  | Tel .: (809) 573-2468  </p> -->

              <p style='color: green; max-width: 90%' align='justify'>'No imprima este correo si no es necesario. Ahorrar papel protege el medio ambiente.' </p>

              <p style='max-width: 90%; margin-bottom:50px; ' align='justify'>Este mensaje puede contener informaci&oacute;n privilegiada y confidencial. Est&aacute; destinado &uacute;nicamente al uso de la persona o entidad a la que se dirige. Si el lector de este mensaje no es el destinatario, se le notifica que cualquier difusi&oacute;n, distribuci&oacute;n, reproducci&oacute;n o copia de esta comunicaci&oacute;n est&aacute; estrictamente prohibida. Si este es el caso, proceda a destruir el mensaje desde su computadora e informe al remitente a trav&eacute;s del correo de respuesta. 
              
              </p>
              </center>
            </td>
          </tr>

        </table>
        </div>
         
        </div>
      </body>
    </html>",$cabeceras); 

 	}
 	header("Location: ../mensajeria.php");

 ?>