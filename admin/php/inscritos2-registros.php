<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){
		// $codigo = strtoupper($_POST['codigo']);
		// $descripcion = strtoupper($_POST['descripcion']);
		// $estado = 'A';
		// // $codempresa = $_SESSION['crmEmpresa'];
		// // --------------------------------
		// if ($_SESSION['crmRanking']==1){
		// 	$codempresa = $_POST['codempresa'];
		// }
		// elseif($_SESSION['crmRanking']==2){
		// 	$codempresa = $_SESSION['crmEmpresa'];
		// }
		// else {
		// 	$qstring = '?status=err';			
		// }
		// // ----------------------------------
		// $usuario = $_SESSION['crmUsername'];
		// $sql="INSERT INTO `inscrito_en`(`codinscritoen`, `codempresa`,`descripcion`,`estado`,  `usuario`) 
		// VALUES ('$codigo','$codempresa','$descripcion', '$estado', '$usuario')";
		
		// if($mysqli->query($sql)){
		// 	$qstring = '?status=succ';
		// }
		// else{
		// 	$qstring = '?status=err';			
		// }
		$qstring = '?status=err';			
	header("Location: ../inscritos2-mant.php".$qstring);	

	}
	if ($i=='UDT'){	
		$Nordenini 	= ($_POST['ordenini']);
		$Nordenfin 	= ($_POST['ordenfin']);
		$pagar		= ($_POST['totalpagar']);	
		$pagado		= ($_POST['totalpagado']);
		$pendiente	= ($_POST['totalpendiente']);	
		$devolver	= ($_POST['monto_devuelto']);
			if (!empty($_FILES["imagen"]) and ($_FILES["imagen"]["size"]>0))
			{
			echo "string";
				$tamanio = $_FILES["imagen"]["size"];
				$archivo = $_FILES["imagen"]["tmp_name"]; 
				$fp = fopen($archivo, "rb");
				$contenido = fread($fp, $tamanio);
				$contenido = addslashes($contenido);
				fclose($fp); 
				$sql="
					UPDATE `inscripcion` SET 
						`nombre` = '".$_POST['nombre']."',
						`apellido` = '".$_POST['apellido']."',
						`telefono` = '".$_POST['telefono']."',
						`email` = '".$_POST['email']."',
						`cedula` = '".$_POST['cedula']."',
						`fecha_inscripcion` = '".$_POST['fecha_inscripcion']."',
						`codpais` = '".$_POST['pais']."',
						`codprovincia` = '".$_POST['provincia']."',
						`codgrupo` = '".$_POST['grupo']."',
						`otro_grupo` = '".$_POST['otrogrupo']."',
						`contacto_emergencia` = '".$_POST['contactoe']."',
						`telefono_emergencia` = '".$_POST['emergenciat']."',
						`comentario` = '".$_POST['comentario']."',
						`cant_participante` = '".$_POST['ciclistas']."',
						`cant_acom_mayor` = '".$_POST['invitados']."',
						`cant_acomp_menor` = '".$_POST['menores']."',
						`revisado`='".$_POST['estado']."',
						`comentario_revisado`='".$_POST['comentario_revisado']."',
						`orden_ini`='$Nordenini',
						`orden_fin`='$Nordenfin',
						`pagado`='$pagar',
						`pendiente`='$pendiente',
						`recibido`='$pagado',
						`monto_devuelto`= '$devolver',
						`foto_deposito`='$contenido',
						`usuario`='".$_SESSION['crmUsername']."'
						WHERE codinscripcion = '".$_POST['codigo']."'						
						AND codempresa = '".$_POST['codempresa']."'
					 ";
		}
		else 
		{
				$sql="
					UPDATE `inscripcion` SET 
						`nombre` = '".$_POST['nombre']."',
						`apellido` = '".$_POST['apellido']."',
						`telefono` = '".$_POST['telefono']."',
						`email` = '".$_POST['email']."',
						`cedula` = '".$_POST['cedula']."',
						`fecha_inscripcion` = '".$_POST['fecha_inscripcion']."',
						`codpais` = '".$_POST['pais']."',
						`codprovincia` = '".$_POST['provincia']."',
						`codgrupo` = '".$_POST['grupo']."',
						`otro_grupo` = '".$_POST['otrogrupo']."',
						`contacto_emergencia` = '".$_POST['contactoe']."',
						`telefono_emergencia` = '".$_POST['emergenciat']."',
						`comentario` = '".$_POST['comentario']."',
						`cant_participante` = '".$_POST['ciclistas']."',
			  			`cant_acom_mayor` = '".$_POST['invitados']."',
			  			`cant_acomp_menor` = '".$_POST['menores']."',
						`revisado`='".$_POST['estado']."',
						`comentario_revisado`='".$_POST['comentario_revisado']."',
						`orden_ini`='$Nordenini',
						`orden_fin`='$Nordenfin',
						`pagado`='$pagar',
						`pendiente`='$pendiente',
						`recibido`='$pagado',
						`monto_devuelto`= '$devolver',
						`usuario`='".$_SESSION['crmUsername']."'
						WHERE codinscripcion = '".$_POST['codigo']."'						
						AND codempresa = '".$_POST['codempresa']."'
					 ";
		}
		
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}
		header("Location: ../inscritos2-mant.php".$qstring);

	}
	if ($i=='DLT'){ //solo afecta la inscripcion en linea
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$codempresa = $_GET['empresa'];
			$sql="
				UPDATE 
					`inscripcion` 
				SET 
				`estado_inscripcion`='B',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				codinscripcion = '$id'
				AND inscrito_en = 'L' 
				AND codempresa = '$codempresa'
				 ";

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				header("Location: ../../inscritos2-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../inscritos2-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			
			header("Location: ../../inscritos2-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>

