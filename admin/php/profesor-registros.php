<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){		
		
		$usuario=$_SESSION['crmUsername'];
		$sql="INSERT INTO `profesor`(
		`codempresa`, 
		`nombre`, 
		`apellido`, 
		`cedula`, 
		`email`, 
		`telefono`, 
		`celular`, 
		`estado`,
		`usuario`) 
		VALUES(
		'".$_SESSION['crmEmpresa']."',
		'".strtoupper($_POST['nombre'])."',
		'".strtoupper($_POST['apellido'])."',
		'".$_POST['cedula']."',
		'".$_POST['correo']."',
		'".$_POST['telefono']."',
		'".$_POST['celular']."',
		'A',
		'".$_SESSION['crmUsername']."'
		)";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succ';
		}
		else{			
			$qstring = '?status=err';			
		}
		header("Location: ../profesor-mant.php".$qstring);	

	}
	if ($i=='UDT'){		
		$sql="
		UPDATE `profesor` SET 
		`nombre`='".strtoupper($_POST['nombre'])."',			  
		`apellido` = '".strtoupper($_POST['apellido'])."',
		`cedula` = '".$_POST['cedula']."',
		`email` = '".$_POST['correo']."',
		`celular` = '".$_POST['celular']."',
		`telefono` = '".$_POST['telefono']."',
		`estado` = '".$_POST['estado']."',
		`usuario`= '".$_SESSION['crmUsername']."'
		WHERE codprofesor = '".$_POST['codigo']."'			
		 ";
		if ($_SESSION['crmRanking']==2){
		 	$sql=$sql." and codempresa ='".$_POST['empresa']."'";
		 }
		
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}
		header("Location: ../profesor-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$empresa = $_GET['empresa'];
			$sql=" 
				UPDATE 
					`profesor` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				codprofesor = '$id' 
				 ";
				 if ($_SESSION['crmRanking']==2){
			 	$sql=$sql." and codempresa = '$empresa'";
			}

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				header("Location: ../../profesor-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../profesor-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			
			header("Location: ../../profesor-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>