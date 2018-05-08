<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){		
		$curso=explode(',', $_POST['curso']);
		$usuario=$_SESSION['crmUsername'];
		if (isset($_POST['horas']) and !empty($_POST['horas'])){
			$horas=$_POST['horas'];
		}
		else{
			$horas=null;
		}
		$sql="INSERT INTO `secciones_enc`(
		`codempresa`, 
		`codcurso`, 
		`codprofesor`, 
		`descripcion`,
		`cupo`, 
		`horas`, 
		`estado`, 
		`usuario`
		) VALUES(
		'".$_SESSION['crmEmpresa']."',
		'$curso[0]',
		'".$_POST['profesor']."',
		'".strtoupper($_POST['descripcion'])."',
		'".$_POST['cupo']."',
		'$horas',
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
		header("Location: ../secciones-enc-mant.php".$qstring);	

	}
	if ($i=='UDT'){	
		$curso=explode(',', $_POST['curso']);
		if (isset($_POST['horas'])){
			$horas=$_POST['horas'];
		}
		else{
			$horas=null;
		}	
		$sql="
		UPDATE `secciones_enc` SET 
		`codcurso`='$curso[0]',
		`codprofesor`='".$_POST['profesor']."',
		`descripcion`='".strtoupper($_POST['descripcion'])."',
		`cupo`='".$_POST['cupo']."',
		`horas`='$horas',
		`estado`='".$_POST['estado']."',
		`usuario`='".$_SESSION['crmUsername']."'
		WHERE
		`codseccion_enc`='".$_POST['codigo']."'
		 ";
		if ($_SESSION['crmRanking']==2){
		 	$sql=$sql." and codempresa ='".$_POST['empresa']."'";
		 }
		
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli)).'<br>';
		}
		header("Location: ../secciones-enc-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$empresa = $_GET['empresa'];
			$sql=" 
				UPDATE 
					`secciones_enc` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				`codseccion_enc` = '$id' 
				 ";
				 if ($_SESSION['crmRanking']==2){
			 	$sql=$sql." and codempresa = '$empresa'";
			}

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				header("Location: ../../secciones-enc-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../secciones-enc-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			
			header("Location: ../../secciones-enc-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>