<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){
		$descripcion = strtoupper($_POST['descripcion']);
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
		$sql="INSERT INTO `grupos_pais` ( `codempresa`, `descripcion`, `estado`,`usuario`) 
		VALUES ('$codempresa','$descripcion','$estado', '$usuario')";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succ';
		}
		else{
			$qstring = '?status=err';			
		}
	header("Location: ../grupo-pais-mant.php".$qstring);	

	}
	if ($i=='UDT'){		
			$sql="
			UPDATE `grupos_pais` SET 
			`descripcion`='".$_POST['descripcion']."',
			`estado`='".$_POST['estado']."',
			`usuario`='".$_SESSION['crmUsername']."'
			WHERE codgrupo = '".$_POST['codigo']."'			
			 ";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}
		header("Location: ../grupo-pais-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$codempresa = $_GET['empresa'];
			$sql="
				UPDATE 
					`grupos_pais` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				codgrupo = '$id'
				and codempresa = '$codempresa'
				 ";

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				header("Location: ../../grupo-pais-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../grupo-pais-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			
			header("Location: ../../grupo-pais-mant.php".$qstring);
		}
		
	}

	// header("Location: ../grupo-pais-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>