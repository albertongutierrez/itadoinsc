<?php
include'conectar.php';
session_start();

	function extraerOrdenMayor($empresa){
		include('conectar.php');
		
		$sql="SELECT max(orden_fin) as maxorden
				FROM inscripcion a
				WHERE a.codempresa = '$empresa'
				and a.estado_inscripcion = 'P'
				and a.inscrito_en = 'L'
				";		
		return $mysqli->query($sql);
	} 

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){
		$nombre = strtoupper($_POST['nombre']);
		$rango1 = ($_POST['rango1']);
		$rango2 = ($_POST['rango2']);
		$rango3 = ($_POST['rango3']);
		$vinscrito = ($_POST['codinscritoen']);
		
		$pagar = ($_POST['pagar']);;		
		$pagado = ($_POST['pagado']);

		$devolver = ($pagado-$pagar);

		$estado = 'A';		
		$codactividad = ($_POST['codactividad']);
		$verror=0;

		$hoy = date("Y/m/d");
		if(isset($_POST['ordenini'])){
			$ini=$_POST['ordenini'];
		}
		else{
			$ini=0;
		}

		if(isset($_POST['ordenfin'])){
			$fin=$_POST['ordenfin'];
		}
		else{
			$fin=0;
		}

		// $codempresa = $_SESSION['crmEmpresa'];
		// --------------------------------
		if ($_SESSION['crmRanking']==1){
			$codempresa = $_POST['codempresa'];
		}
		elseif($_SESSION['crmRanking']==2){
			$codempresa = $_SESSION['crmEmpresa'];
		}		 
			// ----------------------------------
		$usuario = $_SESSION['crmUsername'];
			// echo ($hoy);
			
		$sql="INSERT INTO `inscripcion`(
		`fecha_inscripcion`, 
		`nombre`, 
		`apellido`, 
		`genero`, 
		`codpais`, 
		`codprovincia`, 
		`codgrupo`,
		`cant_participante`, 
		`cant_acom_mayor`, 
		`cant_acomp_menor`, 
		`acuerdo_termino`, 
		`codempresa`, 
		`codactividad`, 
		`codnacionalidad`, 
		`estado_inscripcion`,
		`usuario`, 
		`revisado`, 
		`orden_ini`, 
		`orden_fin`, 
		`pagado`, 
		`pendiente`, 
		`recibido`, 
		`monto_devuelto`, 
		`fecha_saldo`, 
		`inscrito_en`, 
		`comentario_revisado`, 
		`entregado`
		) 
		VALUES 
		(
		'$hoy',
		'$nombre', 
		'-', 
		'N',
		'1',
		'320001',
		'134',
		'$rango1',
		'$rango2',
		'$rango3',
		'checked',
		'$codempresa',
		'$codactividad',
		'1',
		'P',
		'$usuario', 
		'S', 
		'$ini', 
		'$fin', 
		'$pagar',
		'0',
		'$pagado', 
		'$devolver', 
		'$hoy', 
		'$vinscrito', 
		'INSCRITO EN EL CLUB', 
		'N'
		)";
		
		if($mysqli->query($sql))
		{
			$qstring = '?status=succ';				
		}
		else
		{
			$qstring = '?status=err';			
		}
		if(isset($_POST['ordenini']) and isset($_POST['ordenfin'])){
			$sql="SELECT max(codinscripcion)as maximo from inscripcion WHERE codempresa='".$_SESSION['crmEmpresa']."'";
			$q=$mysqli->query($sql);
			$r=$q->fetch_assoc();
			$codigo=$r['maximo'];

			$sql="INSERT INTO `control_kit`(
				`codinscripcion`, 
				`inscrito_en`, 
				`monto`, 
				`fecha_deposito`, 
				`cant_participante`, 
				`cant_acom_mayor`, 
				`cant_acomp_menor`, 
				`orden_ini`, 
				`orden_fin`, 
				`comentario`, 
				`estado`, 
				`codempresa`
				) VALUES 
				(
				'$codigo',
				'$vinscrito',
				'$pagar',
				'$hoy',
				'$rango1',
				'$rango2',
				'$rango3',
				'$ini',
				'$fin',
				'INSCRITO EN EL CLUB',
				'A',
				'$codempresa'
				);";

				if($mysqli->query($sql))
			{
				$qstring = '?status=succ';				
			}
			else
			{
				$qstring = '?status=err';			
			}
		}
		else{
			$sql="SELECT max(codinscripcion)as maximo from inscripcion WHERE codempresa='".$_SESSION['crmEmpresa']."'";
			$q=$mysqli->query($sql);
			$r=$q->fetch_assoc();
			$codigo=$r['maximo'];

			$sql="INSERT INTO `control_kit`(
				`codinscripcion`, 
				`inscrito_en`, 
				`monto`, 
				`fecha_deposito`, 
				`cant_participante`, 
				`cant_acom_mayor`, 
				`cant_acomp_menor`, 
				`orden_ini`, 
				`orden_fin`, 
				`comentario`, 
				`estado`, 
				`codempresa`
				) VALUES 
				(
				'$codigo',
				'$vinscrito',
				'$pagar',
				'$hoy',
				'$rango1',
				'$rango2',
				'$rango3',
				'0',
				'0',
				'INSCRITO EN EL CLUB',
				'A',
				'$codempresa'
				);";

				if($mysqli->query($sql))
			{
				$qstring = '?status=succ';				
			}
			else
			{
				$qstring = '?status=err';			
			}
		}
	 header("Location: ../inscritos-club-mant.php".$qstring);	

	}
	if ($i=='UDT'){
		// $hoy = date("Y/m/d");
		$hoy = $_POST['fecha_saldo']; //asigno la efcha que recibo
		$verror=0; //controlo la variable del error
		$pagar = ($_POST['totalpagar']);		
		$pagado = ($_POST['totalpagado']);
		//recibiendo 
		$Nordenini = ($_POST['ordenini']);
		$Nordenfin = ($_POST['ordenfin']);

		$costo1 = $_POST['costo1'];
		$costo2 = $_POST['costo2'];
		$costo3 = $_POST['costo3'];

		$participantes = ($_POST['ciclistas'] + $_POST['invitados'] + $_POST['menores']);
		$monto_pagar = (($_POST['ciclistas']*$costo1) + 
						($_POST['invitados']*$costo2) + 
						($_POST['menores']*$costo3)
					   );
		$devolver = ($pagado-$pagar);
		$pendiente = ($pagado-$pagar)-$devolver;

			$totalpendiente = $_POST['totalpagar'] -  $_POST['totalpagado'];

			if ($pendiente == 0) {
				$estado_inscripcion = 'P'; //pagada
			}
			else
			{
				$estado_inscripcion = 'A'; //estado activa pendiente	
			}

			  ///Solo aplica la secuencia cuando el estado es pagado y que no 			
				if (($Nordenini == 0) and ($Nordenfin == 0)) {
					$query=extraerOrdenMayor($_POST['codempresa']);
					$row=$query->fetch_assoc();

					$Nordenini = ($row['maxorden'] + 1);
					$Nordenfin = ($row['maxorden'] + $_POST['ciclistas']);
				}
			
			if ($participantes > 0) { //controlar cantidad participantes
				if ($monto_pagar <= $_POST['totalpagado']){ //controlar monto a pagar
					if (($pagado == 0) || ($pagado < $pagar)) { //controlar monto a pagar 
						$qstring = '?status=errP1';
						$verror = 1;				
					}		
					else
					{		
						if (!empty($_FILES["imagen"]) and ($_FILES["imagen"]["size"]>0)){
							echo "string";
							$tamanio = $_FILES["imagen"]["size"];
							$archivo = $_FILES["imagen"]["tmp_name"]; 
							$fp = fopen($archivo, "rb");
							$contenido = fread($fp, $tamanio);
							$contenido = addslashes($contenido);
							fclose($fp); 
							$sql="
								UPDATE `inscripcion` SET 
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
								`estado_inscripcion`='$estado_inscripcion',
								`fecha_saldo`='$hoy',
								`foto_deposito`='$contenido',
								`usuario`='".$_SESSION['crmUsername']."'
								WHERE codinscripcion = '".$_POST['codigo']."'						
								AND codempresa = '".$_POST['codempresa']."'
								 ";
							 }
						else {
							$sql="
							UPDATE `inscripcion` SET 
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
							`estado_inscripcion`='$estado_inscripcion',
							`fecha_saldo`='$hoy',							
							`usuario`='".$_SESSION['crmUsername']."'
							WHERE codinscripcion = '".$_POST['codigo']."'						
							AND codempresa = '".$_POST['codempresa']."'
							 ";
						}
					}
				}
				else {
					$qstring = '?status=errP1';
					$verror = 1;
				}
			}
			else{
				$qstring = '?status=errP2';
				$verror = 1;
			}

		if ($verror == 0){
			if($mysqli->query($sql)){
				$qstring = '?status=succudt';
			}
			else{
				$qstring = '?status=errudt';
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		 header("Location: ../inscritos-mant.php".$qstring);

	}

	if ($i=='UDT2'){
		$fecha=date('Y-m-d',strtotime($_POST['fecha_saldo']));					
		if (!empty($_FILES["imagen"]) and ($_FILES["imagen"]["size"]>0)){
			// con foto de deposito
			$tamanio = $_FILES["imagen"]["size"];
			$archivo = $_FILES["imagen"]["tmp_name"]; 
			$fp = fopen($archivo, "rb");
			$contenido = fread($fp, $tamanio);
			$contenido = addslashes($contenido);
			fclose($fp); 
			$sql="INSERT INTO `control_kit`(
			`codinscripcion`, 
			`inscrito_en`, 
			`monto`, 
			`fecha_deposito`, 
			`cant_participante`, 
			`cant_acom_mayor`, 
			`cant_acomp_menor`, 
			`orden_ini`, 
			`orden_fin`, 
			`comentario`, 
			`deposito`, 
			`estado`, 
			`codempresa`
			) VALUES 
			(
			'".$_POST['codigo']."',
			'".$_POST['inscrito_en']."',
			'".$_POST['totalpagado']."',
			'$fecha',
			'".$_POST['participantes']."',
			'".$_POST['acompanantes']."',
			'".$_POST['ninos']."',
			'".$_POST['ordenini']."',
			'".$_POST['ordenfin']."',
			'".$_POST['comentario_revisado']."',
			'$contenido',
			'A',
			'".$_SESSION['crmEmpresa']."'
			);";
			 }
		else {
			// sin foto de desposito
			$sql="
			INSERT INTO `control_kit`(
			`codinscripcion`, 
			`inscrito_en`, 
			`monto`, 
			`fecha_deposito`, 
			`cant_participante`, 
			`cant_acom_mayor`, 
			`cant_acomp_menor`, 
			`orden_ini`, 
			`orden_fin`, 
			`comentario`, 
			`estado`, 
			`codempresa`
			) VALUES 
			(
			'".$_POST['codigo']."',
			'".$_POST['inscrito_en']."',
			'".$_POST['totalpagado']."',
			'$fecha',
			'".$_POST['participantes']."',
			'".$_POST['acompanantes']."',
			'".$_POST['ninos']."',
			'".$_POST['ordenini']."',
			'".$_POST['ordenfin']."',
			'".$_POST['comentario_revisado']."',
			'A',
			'".$_SESSION['crmEmpresa']."'
			);";
		}
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}

		// actualizando tabla incripción
		$sql="UPDATE `inscripcion` SET `revisado`='".$_POST['estado']."', `cant_participante`='".$_POST['ciclistas']."', `cant_acom_mayor`='".$_POST['invitados']."', `cant_acomp_menor`='".$_POST['menores']."',estado_inscripcion='".$_POST['saldado']."' WHERE codinscripcion='".$_POST['codigo']."' and inscrito_en='".$_POST['inscrito_en']."'";

		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}
		
		 header("Location: ../inscritos-mant.php".$qstring);

	}
	if ($i=='PRT'){
		if ($_SESSION['crmRanking']<=2){
			$estado = 1;
			$codempresa = $_SESSION['crmEmpresa'];
			$act = $_POST['gact'];
			$lug = $_POST['grev'];
		

			if (isset($_POST['actualizar']))
			{
				if(empty($_POST['cambiar']))
				{
					$qstring = '?status=errslct';
					header("Location: ../reporte-impresion-ticket.php".$qstring);
				}
				else
				{
					//RESETEO LAS IMPRESIONES
					$rsql= "UPDATE `inscripcion`
								SET `impreso` = 2 
								WHERE `codempresa` =  '$codempresa'
							";		
					$rresultado = $mysqli->query($rsql);	

					foreach ($_POST['cambiar'] as $id_inscripcion) 
					{
						$codigo = $id_inscripcion;
						// echo $codigo;
						$sql= "UPDATE `inscripcion`
								SET `impreso` = '$estado'
								WHERE `codinscripcion` = '$codigo'
								AND `codempresa` =  '$codempresa'
							";		
						$resultado = $mysqli->query($sql);		
						// header("Location: ../reporte-ticket.php?status=".$codigo);	
					}
				}

					if($mysqli->query($sql))
					{
						$qstring = '?status=succudt&act='.$act."&rev=".$lug;
						// echo "$qstring";
						header("Location: ../reporte-ticket.php".$qstring);
					}
					else
					{
						$qstring = '?status=errudt';
					 	echo("Error description: " . mysqli_error($mysqli));
					}	
				// esto no aplica ya que controlo el envio de la data en los if anteriores
				// header("Location: ../reporte-impresion-ticket.php".$qstring);	
				// header("Location: ../reporte-ticket.php".$qstring);	
				}
			else
			{
				$qstring = '?status=errudt';
				header("Location: ../reporte-impresion-ticket.php".$qstring);		
			} 			
		}

			
		// }
		else{
			
			header("Location: ../../reporte-impresion-ticket.php".$qstring);
			// header("Location: ../empresa-mant.php".$qstring);
		}
	
}
}
else{
 	header("Location: ../main.php");
}
?>