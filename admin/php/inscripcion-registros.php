<?php
include'conectar.php';
session_start();

	

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	date_default_timezone_set('America/La_Paz');
	$fecha=date('Y-m-d h:i:s');
	if (isset($_POST['s_otros'])){
		$sede_o=$_POST['s_otros'];
	}
	else{
		$sede_o='';
	}

	// if (isset($_POST['nacionalidad'])){
	// 	$nacionalidad=$_POST['nacionalidad'];
	// }
	// else{
	// 	$nacionalidad='';
	// }

	if (isset($_POST['entero'])){
		$entero=$_POST['entero'];
	}
	else{
		$entero='';
	}



	if ($i=='INS'){
		if (isset($_POST['s_otros'])){
			$sede_o=$_POST['s_otros'];
		}
		else{
			$sede_o='';
		}
		if (!empty($_FILES["foto"]) and ($_FILES["foto"]["size"]>0)){
			// con foto de deposito
			$tamanio = $_FILES["foto"]["size"];
			$archivo = $_FILES["foto"]["tmp_name"]; 
			$fp = fopen($archivo, "rb");
			$contenido = fread($fp, $tamanio);
			$contenido = addslashes($contenido);
			fclose($fp); 
			$sql="INSERT INTO 
			`inscripcion`
			(
			`codinscritoen`, 
			`codempresa`, 
			`fecha_inscripcion`, 
			`nombre`, 
			`apellido`, 
			`cedula`,  
			`telefono`, 
			`celular`, 
			`fax`, 
			`email`, 
			`tipo_sangre`, 
			`estado_civil`,  
			`direccion`, 
			`codpais`, 
			`codprovincia`,
			`codgrupo`, 
			`codactividad`,
			`codnacionalidad`,
			`estado_inscripcion`, 
			`lugar_trabajo`, 
			`cargo`, 
			`telefono_oficina`, 
			`itado_sede`, 
			`otra_sede`, 
			`profesion`,
			`gremio`,
			`otro_gremio`,
			`enterar`, 
			`comentario`, 
			`acuerdo_termino`, 
			`usuario`,
			`foto`,
			`curso`
			) VALUES (
			'L',
			'".$_SESSION['crmEmpresa']."',
			'$fecha',
			'".strtoupper($_POST['nombre'])."',
			'".strtoupper($_POST['apellido'])."',
			'".$_POST['identificacion']."',
			'".$_POST['tel']."',
			'".$_POST['tcelular']."',
			'".$_POST['fax']."',
			'".$_POST['email']."',
			'".$_POST['sangre']."',
			'".$_POST['estado-civil']."',
			'".$_POST['direccion']."',
			'1',
			'1',
			'1',
			'1',
			'".$_POST['nacionalidad']."',
			'A',
			'".$_POST['organizacion']."',
			'".$_POST['cargo']."',
			'".$_POST['tel_org']."',
			'".$_POST['sede']."',
			'$sede_o',
			'".$_POST['categoria-e']."',
			'".$_POST['codia']."',
			'".$_POST['g-otros']."',
			'$entero',
			'".$_POST['c-otros']."',
			'".$_POST['acuerdo']."',
			'".$_SESSION['crmUsername']."',
			'$contenido',
			'N'
			)";

			if($mysqli->query($sql)){
				$qstring = '?status=succudt';
			}
			else{
				$qstring = '?status=errudt';
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			$sql="INSERT INTO 
			`inscripcion`
			(
			`codinscritoen`, 
			`codempresa`, 
			`fecha_inscripcion`, 
			`nombre`, 
			`apellido`, 
			`cedula`,  
			`telefono`, 
			`celular`, 
			`fax`, 
			`email`, 
			`tipo_sangre`, 
			`estado_civil`,  
			`direccion`, 
			`codpais`, 
			`codprovincia`,
			`codgrupo`, 
			`codactividad`,
			`codnacionalidad`,
			`estado_inscripcion`, 
			`lugar_trabajo`, 
			`cargo`, 
			`telefono_oficina`, 
			`itado_sede`, 
			`otra_sede`, 
			`profesion`,
			`gremio`,
			`otro_gremio`,
			`enterar`, 
			`comentario`, 
			`acuerdo_termino`, 
			`usuario`,
			`curso`
			) VALUES (
			'L',
			'".$_SESSION['crmEmpresa']."',
			'$fecha',
			'".strtoupper($_POST['nombre'])."',
			'".strtoupper($_POST['apellido'])."',
			'".$_POST['identificacion']."',
			'".$_POST['tel']."',
			'".$_POST['tcelular']."',
			'".$_POST['fax']."',
			'".$_POST['email']."',
			'".$_POST['sangre']."',
			'".$_POST['estado-civil']."',
			'".$_POST['direccion']."',
			'1',
			'1',
			'1',
			'1',
			'".$_POST['nacionalidad']."',
			'A',
			'".$_POST['organizacion']."',
			'".$_POST['cargo']."',
			'".$_POST['tel_org']."',
			'".$_POST['sede']."',
			'$sede_o',
			'".$_POST['categoria-e']."',
			'".$_POST['codia']."',
			'".$_POST['g-otros']."',
			'$entero',
			'".$_POST['c-otros']."',
			'".$_POST['acuerdo']."',
			'".$_SESSION['crmUsername']."',
			'N'
			)";

			if($mysqli->query($sql)){
				$qstring = '?status=succudt';
			}
			else{
				$qstring = '?status=errudt';
				 echo("Error description: " . mysqli_error($mysqli)).'<br>';
				 // echo $sql;
			}
		}	

	 header("Location: ../inscripcion-mant.php".$qstring);	

	}
	

	if ($i=='UDT'){
		if (isset($_POST['s_otros'])){
			$sede_o=$_POST['s_otros'];
		}
		else{
			$sede_o='';
		}
		if (!empty($_FILES["foto"]) and ($_FILES["foto"]["size"]>0)){
			// con foto de deposito
			$tamanio = $_FILES["foto"]["size"];
			$archivo = $_FILES["foto"]["tmp_name"]; 
			$fp = fopen($archivo, "rb");
			$contenido = fread($fp, $tamanio);
			$contenido = addslashes($contenido);
			fclose($fp); 

			$sql="UPDATE `inscripcion` SET 
			`nombre`='".strtoupper($_POST['nombre'])."',
			`apellido`='".strtoupper($_POST['apellido'])."',
			`cedula`='".$_POST['identificacion']."',
			`foto`='$contenido',
			`telefono`='".$_POST['tel']."',
			`celular`='".$_POST['tcelular']."',
			`fax`='".$_POST['fax']."',
			`email`='".$_POST['email']."',
			`tipo_sangre`='".$_POST['sangre']."',
			`estado_civil`='".$_POST['estado-civil']."',
			`direccion`='".$_POST['direccion']."',
			`estado_inscripcion`='".$_POST['estado']."',
			`lugar_trabajo`='".$_POST['organizacion']."',
			`cargo`='".$_POST['cargo']."',
			`telefono_oficina`='".$_POST['tel_org']."',
			`itado_sede`='".$_POST['sede']."',
			`otra_sede`='$sede_o',
			`profesion`='".$_POST['categoria-e']."',
			`gremio`='".$_POST['codia']."',
			`otro_gremio`='".$_POST['g-otros']."',
			`enterar`='".$_POST['entero']."',
			`comentario`='".$_POST['c-otros']."',	
			`usuario`='".$_SESSION['crmUsername']."'
			WHERE `codempresa`='".$_POST['empresa']."' and `codinscripcion`='".$_POST['id']."'";
			 }
		else {
			// sin foto de desposito
			$sql="UPDATE `inscripcion` SET 
			`nombre`='".strtoupper($_POST['nombre'])."',
			`apellido`='".strtoupper($_POST['apellido'])."',
			`cedula`='".$_POST['identificacion']."',
			`telefono`='".$_POST['tel']."',
			`celular`='".$_POST['tcelular']."',
			`fax`='".$_POST['fax']."',
			`email`='".$_POST['email']."',
			`tipo_sangre`='".$_POST['sangre']."',
			`estado_civil`='".$_POST['estado-civil']."',
			`direccion`='".$_POST['direccion']."',
			`estado_inscripcion`='".$_POST['estado']."',
			`lugar_trabajo`='".$_POST['organizacion']."',
			`cargo`='".$_POST['cargo']."',
			`telefono_oficina`='".$_POST['tel_org']."',
			`itado_sede`='".$_POST['sede']."',
			`otra_sede`='$sede_o',
			`profesion`='".$_POST['categoria-e']."',
			`gremio`='".$_POST['codia']."',
			`otro_gremio`='".$_POST['g-otros']."',
			`enterar`='".$_POST['entero']."',
			`comentario`='".$_POST['c-otros']."',	
			`usuario`='".$_SESSION['crmUsername']."'
			WHERE `codempresa`='".$_POST['empresa']."' and `codinscripcion`='".$_POST['id']."'";
		}
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}

		// actualizando tabla incripción
		// $sql="UPDATE `inscripcion` SET `revisado`='".$_POST['estado']."', `cant_participante`='".$_POST['ciclistas']."', `cant_acom_mayor`='".$_POST['invitados']."', `cant_acomp_menor`='".$_POST['menores']."',estado_inscripcion='".$_POST['saldado']."' WHERE codinscripcion='".$_POST['codigo']."' and inscrito_en='".$_POST['inscrito_en']."'";

		// if($mysqli->query($sql)){
		// 	$qstring = '?status=succudt';
		// }
		// else{
		// 	$qstring = '?status=errudt';
		// 	 echo("Error description: " . mysqli_error($mysqli));
		// }
		
		 header("Location: ../inscripcion-mant.php".$qstring);

	}
	if ($i=='DLT'){
		$sql="UPDATE `inscripcion` SET `estado_inscripcion`='I' WHERE codinscripcion='".$_GET['id']."' and `codinscritoen`='L' and `codempresa`='".$_GET['empresa']."'";
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}
		 header("Location: ../../inscripcion-mant.php".$qstring);
	
	}

}
else{
 	header("Location: ../main.php");
}
?>