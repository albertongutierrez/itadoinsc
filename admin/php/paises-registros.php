<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){
		$descripcion = strtoupper($_POST['descripcion']);
		$iso = strtoupper($_POST['iso']);				
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
		$sql="INSERT INTO `pais`(`iso`,`descripcion`, `estado`, `usuario`) 
		VALUES ('$iso', '$descripcion','$estado',  '$usuario')";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succ';
		}
		else{
			$qstring = '?status=err';			
		}
	header("Location: ../paises-mant.php".$qstring);	

	}
	if ($i=='UDT'){		
			$sql="
			UPDATE `pais` SET 
			`iso`='".$_POST['iso']."',
			`descripcion`='".$_POST['descripcion']."',
			`estado`='".$_POST['estado']."',			
			`usuario`='".$_SESSION['crmUsername']."'
			WHERE codpais = '".$_POST['codpais']."'			
			 ";
			 // AND codempresa = '".$_SESSION['crmEmpresa']."'
		
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}
		header("Location: ../paises-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$codempresa = $_GET['empresa'];
			$sql="
				UPDATE 
					`pais` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				codpais = '$id'				
				 ";

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				header("Location: ../../paises-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../paises-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			
			header("Location: ../../paises-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>