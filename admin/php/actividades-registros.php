<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){
		$descripcion = strtoupper($_POST['descripcion']);
		$costo1 = $_POST['costo1'];
		$costo2 = $_POST['costo2'];
		$costo3 = $_POST['costo3'];
		$estado = 'A';
		// $codempresa = $_SESSION['crmEmpresa'];
		// --------------------------------
		if ($_SESSION['crmRanking']==1){
			$codempresa = $_POST['codempresa'];
		}
		elseif($_SESSION['crmRanking']==2){
			$codempresa = $_SESSION['crmEmpresa'];
		}
		else {
			$qstring = '?status=err';			
		}
		// ----------------------------------
		$usuario = $_SESSION['crmUsername'];
		$sql="INSERT INTO `actividades`(`codempresa`,`descripcion`,`costo_participante`, `costo_invitado`, `costo_ninos`, `estado`,`condicion`,  `usuario`) 
		VALUES ('$codempresa','$descripcion','$costo1','$costo2','$costo3', '$estado', 'A','$usuario')";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succ';
		}
		else{
			$qstring = '?status=err';			
		}
	header("Location: ../actividades-mant.php".$qstring);	

	}
	if ($i=='UDT'){		
			$sql="
			UPDATE `actividades` SET 
			`descripcion`='".$_POST['descripcion']."',
			`costo_participante`='".$_POST['costo1']."',
			`costo_invitado`='".$_POST['costo2']."',
			`costo_ninos`='".$_POST['costo3']."',
			`estado`='".$_POST['estado']."',
			`condicion`='".$_POST['condicion']."',
			`usuario`='".$_SESSION['crmUsername']."'
			WHERE codactividad = '".$_POST['codigo']."'			
			 ";
			 // AND codempresa = '".$_POST['codempresa']."'
		
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}
		header("Location: ../actividades-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$codempresa = $_GET['empresa'];
			$sql="
				UPDATE 
					`actividades` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				codactividad = '$id'
				and codempresa = '$codempresa'
				 ";

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				header("Location: ../../actividades-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../actividades-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			
			header("Location: ../../actividades-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>