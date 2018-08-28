<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){		
		foreach ( $_POST['id'] as $row ) :
			$sql="INSERT INTO `secciones_det`(
			`codempresa`, 
			`codseccion_enc`, 
			`codinscripcion`, 
			`estado`, 
			`usuario`
			)VALUES(
			'".$_SESSION['crmEmpresa']."',
			'".$_POST['seccion']."',
			'$row',
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
			$sql="
			UPDATE `inscripcion` SET 
			`curso`='S',
			`usuario`='".$_SESSION['crmUsername']."'
			WHERE 
			`codinscripcion`='$row'";
		if($mysqli->query($sql)){
				$qstring = '?status=succ';
			}
			else{			
				$qstring = '?status=err';		
				echo mysqli_error($mysqli);	

			}
		endforeach;
		header("Location: ../secciones-det-mant.php".$qstring);	

	}
	if ($i=='UDT'){	
		if($_POST['curso']=='N'){
			$curso='';	
			$sql="
			UPDATE `secciones_det` SET 
			`estado`= '".$_POST['estado']."',
			`usuario`='".$_SESSION['crmUsername']."'
			WHERE
			`codseccion_det`='".$_POST['codigo']."'
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
			}


			if($_POST['estado']=='A'){
				$curso='S';
			}
			else{
				$curso='N';
			}
			$sql="
			UPDATE `inscripcion` SET 
			`curso`='$curso',
			`usuario`='".$_SESSION['crmUsername']."'
			WHERE 
			`codinscripcion`='".$_POST['inscripcion']."'";
			if($mysqli->query($sql)){
				$qstring = '?status=succ';
			}
			else{			
				$qstring = '?status=err';		
				echo mysqli_error($mysqli);	
			}

			header("Location: ../secciones-det-mant.php".$qstring);
		}
		else{	
			header("Location: ../secciones-det-mant.php?status=s");
		}


	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$us = $_GET['user'];
			$empresa = $_GET['empresa'];
			$sql=" 
				UPDATE 
					`inscripcion` 
				SET 
				`curso`='N',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				`codinscripcion` = '$us' 
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

			$sql=" 
				UPDATE 
					`secciones_det` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."'
				WHERE
				`codseccion_det` = '$id' 
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

				header("Location: ../../secciones-det-mant.php".$qstring);

		}
		else{
			
			header("Location: ../../secciones-det-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>