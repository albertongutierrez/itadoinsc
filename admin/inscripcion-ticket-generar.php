<?php
	//Agregamos la libreria para genera códigos QR
	require "lib/phpqrcode/qrlib.php"; 
	require 'php/consultas.php';   
	session_start();

	//Declaramos una carpeta temporal para guardar la imagenes generadas
	$dir = 'temp/';
	// $txt='';
	$query=extraerTiketdataUDT($_GET['id']);
	$row=$query->fetch_assoc();
	//Si no existe la carpeta la creamos
	$img=$dir.$_GET['id'].$row['nombre'].$row['apellido'].'.png';

	if (!file_exists($dir))
	    mkdir($dir);

	    //Declaramos la ruta y nombre del archivo a generar
	$filename = $img;

	    //Parametros de Condiguración

	$tamaño = 10; //Tamaño de Pixel
	$level = 'H'; //Precisión Baja
	$framSize = 1; //Tamaño en blanco
	$contenido = $_GET['id']." ".$row['nombre']." ".$row['apellido']; //Texto
	    //Enviamos los parametros a la Función para generar código QR 
	QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

	    //Mostramos la imagen generada
	// $txt .='';
	$txt ='<!DOCTYPE html>
			<html>
			<head>
				<title></title>
			</head>
			<body style="margin:0mm ;padding:0mm; width:100%; ">
			<div style="border:3px black solid;margin-top:4px; ">
				<div style=" font-size:37.1px; width:98%; margin:0 auto;">
					<img src="'.$img.'" width="250px" style="float:right; margin-top:48px"/>
					<p>Estudiante: <br>
					<span style="font-weight:bold;">'.$row['nombre']." ".$row['apellido'].'</span></p>
					<p>Cedula:<br>
					<span style="font-weight:bold;">'.$row['cedula'].'</span></p>

					<p>Curso:<br>
					<span style="font-weight:bold; font-size:180%">'.$row['curso'].'</span></p>
				</div>	
			<div>
			</body>

			</html>
	'; 
	// echo $txt; 
?>
			
<?php
	use Dompdf\Dompdf;
	require_once'lib/dompdf/autoload.inc.php';
	$dumpdf= new DOMPDF();
	$dumpdf->loadHtml($txt);///se le envia el html
	$dumpdf->setPaper('a5',"landscape");
	$dumpdf->render();
	$pdf=$dumpdf->output();
	$filename='report.pdf';
	$dumpdf->stream($filename,array("Attachment" =>0));

?>