<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){		
		$usuario=$_SESSION['crmUsername'];
		$sql="INSERT INTO `cursos`(
		`codempresa`, 
		`descripcion`, 
		`horas`, 
		`acomulativo`, 
		`estado`, 
		`usuario`
		) VALUES(
		'".$_SESSION['crmEmpresa']."',
		'".strtoupper($_POST['descripcion'])."',
		'".$_POST['hora']."',
		'".$_POST['acomulativo']."',
		'A',
		'".$_SESSION['crmUsername']."'
		)";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succ';
		}
		else{			
			$qstring = '?status=err';			
		}
		header("Location: ../curso-mant.php".$qstring);	

	}
	if ($i=='UDT'){		
		$sql="
		UPDATE `cursos` SET 
		`descripcion`='".strtoupper($_POST['descripcion'])."',
		`horas`='".$_POST['hora']."',
		`acomulativo`='".$_POST['acomulativo']."',
		`estado`='".$_POST['estado']."',
		`usuario`='".$_SESSION['crmUsername']."'
		WHERE codcurso = '".$_POST['codigo']."'			
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
		header("Location: ../curso-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$empresa = $_GET['empresa'];
			$sql=" 
				UPDATE 
					`cursos` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				codcurso = '$id' 
				 ";
				 if ($_SESSION['crmRanking']==2){
			 	$sql=$sql." and codempresa = '$empresa'";
			}

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				header("Location: ../../curso-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../curso-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			
			header("Location: ../../curso-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>