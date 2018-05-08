<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){
		$descripcion = strtoupper($_POST['descripcion']);
		$pais = $_POST['pais'];
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
		$sql="INSERT INTO `provincias_pais`(`codpais`, `descripcion`, `estado`,  `usuario`) 
		VALUES ('$pais', '$descripcion','$estado', '$usuario')";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succ';
		}
		else{
			$qstring = '?status=err';			
		}
	header("Location: ../provincias-mant.php".$qstring);	

	}
	if ($i=='UDT'){		
			$sql="
			UPDATE `provincias_pais` SET 
			`descripcion`='".$_POST['descripcion']."',
			`estado`='".$_POST['estado']."',
			`codpais`='".$_POST['pais']."',
			`usuario`='".$_SESSION['crmUsername']."'
			WHERE codprovincia = '".$_POST['codprovincia']."'			
			 ";
			 // AND codempresa = '".$_SESSION['crmEmpresa']."'
		
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}
		header("Location: ../provincias-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$codempresa = $_GET['empresa'];
			$sql="
				UPDATE 
					`provincias_pais` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				codprovincia = '$id'				
				 ";

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				header("Location: ../../provincias-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../provincias-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			
			header("Location: ../../provincias-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>