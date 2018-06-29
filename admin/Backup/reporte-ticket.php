<!-- <a href="php/output.php?t=pdf" target="_blank">Pdf</a> -->

<?php 
  session_start();
  // include("php/tiempo.php");
  require('php/consultas.php');
  if(!isset($_SESSION['crmUsername']) && !isset($_SESSION['crmEmpresa']) && !isset($_SESSION['crmRanking'])){
    header("Location: index.php?status=errns");
  }

  if ($_SESSION['crmRanking']>2){
  echo"<script language='javascript'>window.location='main.php'</script>;";
  }

  if(!empty($_GET['act'])){
    $gact = $_GET['act'];
    $grev = $_GET['rev']; //SOLO MOSTRAR LOS FORMALIZADOS
  }
  else{
    $gact = '0';
    $grev = 'A'; //SOLO MOSTRAR LOS FORMALIZADOS
  }

 ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">        
<meta name="viewport" content="width=device-width">        
<!-- NOTE: external links are for testing only -->       
<!--  <link href="//cdn.muicss.com/mui-0.1.2/email/mui-email-styletag.css" rel="stylesheet" />        
<link href="//cdn.muicss.com/mui-0.1.2/email/mui-email-inline.css" rel="stylesheet" /> -->        
<link rel="stylesheet" href="http://sjs.edu.do/sjsweb/css/bootstrap.css">                  
<?php ob_start(); ?>
<?php 
    $query=extraerImpresionTicket2($_SESSION['crmRanking'],$_SESSION['crmEmpresa'], $gact, $grev);
    if($query->num_rows > 0){
      
      while ( $row= $query->fetch_assoc()) {?>      
          <div class="container">           
          
          <!-- style="background-color: grey; width: 1000px; margin: 0 auto; padding-bottom: 45px; padding-top: 45px; background-repeat: repeat; background-image: url(http://aventurerosveganos.com/wp-content/uploads/2017/07/geometry.png);" -->

          <div class="container2"> 
           <!-- style="background-color: white; width: 900px; margin: 0 auto;" -->
          <center>
          <!-- http://mangusoft.com/crm_mangusoft2/admin/img/logo-aventureros.png -->  
          <!-- style="width:300px; margin-bottom: 25px; margin-top: 20px"       -->
            <!-- <img style="width:300px; margin-bottom: 25px; margin-top: 20px" src="http://mangusoft.com/crm_mangusoft2/admin/img/logo-aventureros.png" scale="0"/>                      -->
            <br>
            <br>
            <br>
            <br>
            <img src="img/tikectaventureros.jpg" width="300">
           </center>   

           <div id="content" align="center">            
           <h2> CONTROL DE PARTICIPACION <br> <?php  echo $row['actividad']?></h2>
           
                    <table border-collapse="collapse" border="1" style="margin: 1 auto;">
                          <thead>
                            <tr>
                              <td colspan="7" style="text-align:center;"><h1><b>REGISTRO NO.: <?php  echo $row['registro'].'-'.$row['inscrito_en']?></b></h1></td>                            
                            </tr>
                            <tr>
                              <td colspan="7"><br></td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td colspan="7" style="text-align:center;"><b>DETALLE PERSONA INSCRITA</b></td>
                              <br>
                            </tr>
                            <tr>
                              <td colspan="3">FECHA SALDO:</td>
                              <td colspan="4"><?php  echo $row['fecha_saldo']?></td>
                            </tr>
                         

                            <tr>
                              <td colspan="3">NOMBRES:</td>
                              <td colspan="4"><?php  echo $row['nombre_representante']?></td>
                            </tr>
                            <tr>
                              <td colspan="3">GRUPO:</td>
                              <td colspan="4"><?php  echo $row['grupo']?></td>
                            </tr>
                            <tr>
                              <td colspan="3">CICLISTAS</td>
                              <td colspan="4"><?php  echo $row['participantes']?></td>
                            </tr>
                            <tr>
                              <td colspan="3">ADULTOS</td>
                              <td colspan="4"><?php  echo $row['invitados']?></td>
                            </tr>
                            <tr>
                              <td colspan="3">NI&Ntilde;OS</td>
                              <td colspan="4"><?php  echo $row['invitados_menor']?></td>
                            </tr>
                            <tr>
                              <td colspan="3">SECUENCIA INSCRITO</td>
                              <td colspan="4"><?php  echo $row['secuencia_kit']?></td>
                            </tr>      
                          </tbody>
                        </table>
                  
                  <div align="center">
                    <b>ESPERAMOS QUE DISFRUTEN TODO LO QUE HEMOS PREPARADO</b>
                      <br> 
                    <p><b>Aventurernos Veganos MTB-Club &copy; - AVENTOUR <?php echo date('Y');?> </b>
                      <br>
                    ManguSoft &copy; - <?php echo date('Y');?> - Sistema de Inscripci&oacute;n en L&iacute;nea - Todos los Derechos Reservados. </p>
                  </div>

           </div>          
          </div>

          <hr width="90%">
                <br>
                <!-- //Salto de pagina -->
                <br><table style='page-break-after:always;'></br></table><br>   
                <!-- //Definir nueva tabla  -->
                <table border='0' align='center' cellspacing='4' cellpadding='0' width='100%'>  
      <?php }
    }
?>
<?php

// require_once 'lib/dompdf/autoload.inc.php';
// // reference the Dompdf namespace
// use Dompdf\Dompdf;
// $dompdf = new DOMPDF();
// $dompdf->loadHtml(ob_get_clean());
// $dompdf->render();
// $pdf = $dompdf->output();
// $filename = "tikect".time().'.pdf';
// file_put_contents($filename, $pdf);
// $dompdf->stream($filename);

?>


