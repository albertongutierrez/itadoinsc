<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){		
		date_default_timezone_set('America/La_Paz');
		$fecha=date("Y-m-d h:i:s",strtotime($_POST['horas']));
		$hora=date("h:i:s",strtotime($_POST['horas']));
		$sql="INSERT INTO `permisos`(
		`codseccion`, 
		`codempresa`, 
		`codinscripcion`, 
		`fecha`, 
		`hora_ini`, 
		`estado_permiso`, 
		`estado`, 
		`usuario`
		) VALUES(
		'".$_POST['seccion2']."',
		'".$_SESSION['crmEmpresa']."',
		".$_POST['permiso'].",
		'$fecha',
		'$hora',
		'A',
		'A',
		'".$_SESSION['crmUsername']."'
		)";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succ';
		}
		else{			
			$qstring = '?status=err';		
			echo mysqli_error($mysqli);	

		}

		header("Location: ../permisos-mant.php".$qstring);	

	}
	if ($i=='CUT'){	
		$id = $_GET['id'];
		$empresa = $_GET['empresa'];	
		date_default_timezone_set('America/La_Paz');
		// $fecha=date("Y-m-d h:i:s",strtotime($_POST['horas']));
		$hora=date("h:i:s");
		$sql="UPDATE 
					`permisos` 
				SET 

				`estado_permiso`='I',
				`hora_fin`='$hora',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				`codpermiso` = '$id' 
				 ";
				 if ($_SESSION['crmRanking']==2){
			 	$sql=$sql." and codempresa = '$empresa'";
			}
		if($mysqli->query($sql)){
			$qstring = '?status=succ';
		}
		else{			
			$qstring = '?status=err';		
			echo mysqli_error($mysqli);	

		}

		header("Location: ../permisos-mant.php".$qstring);	

	}
	if ($i=='UDT'){	
		$fecha=date("Y-m-d h:i:s",strtotime($_POST['horas']));
		$sql="
		UPDATE `permisos` SET 
		`estado_permiso`='".$_POST['estado_p']."', 
		`hora_ini`='".$_POST['ini']."',
		`hora_fin`='".$_POST['fin']."',
		`estado`= '".$_POST['estado']."',
		`usuario`='".$_SESSION['crmUsername']."'
		WHERE
		`codpermiso`='".$_POST['codigo']."'
		 ";
		if ($_SESSION['crmRanking']==2){
		 	$sql=$sql." and `codempresa` ='".$_POST['empresa']."'";
		}
		
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli)).'<br>';
			echo $sql;
		}

		header("Location: ../permisos-mant.php".$qstring);
	}

	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$empresa = $_GET['empresa'];
			$sql=" 
				UPDATE 
					`permisos` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				`codpermiso` = '$id' 
				 ";
				 if ($_SESSION['crmRanking']==2){
			 	$sql=$sql." and codempresa = '$empresa'";
			}

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				// header("Location: ../../secciones-det-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				// header("Location: ../../secciones-det-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}

			header("Location: ../../permisos-mant.php".$qstring);

		}
		else{
			
			header("Location: ../../permisos-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>