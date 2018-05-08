<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){
		$codigo = strtoupper($_POST['codigo']);
		$descripcion = strtoupper($_POST['descripcion']);
		$mostrar = strtoupper($_POST['mostrar']);
		$tipo = strtoupper($_POST['tipo']);
		$kit = strtoupper($_POST['kit']);
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
		$sql="INSERT INTO `inscrito_en`(`codinscritoen`, `codempresa`,`descripcion`,`mostrar`, `tipo`, `kit`, `estado`,  `usuario`) 
		VALUES ('$codigo','$codempresa','$descripcion', '$mostrar', '$tipo', '$kit', '$estado', '$usuario')";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succ';
		}
		else{
			$qstring = '?status=err';			
		}
	header("Location: ../inscrito-en-mant.php".$qstring);	

	}
	if ($i=='UDT'){		
			$sql="
			UPDATE `inscrito_en` SET 
			`descripcion`='".$_POST['descripcion']."',
			`mostrar`='".$_POST['mostrar']."',
			`tipo`='".$_POST['tipo']."',
			`kit`='".$_POST['kit']."',
			`estado`='".$_POST['estado']."',
			`usuario`='".$_SESSION['crmUsername']."'
			WHERE codinscritoen = '".$_POST['codigo']."'			
			AND codempresa = '".$_POST['codempresa']."'";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}
		header("Location: ../inscrito-en-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$codempresa = $_GET['empresa'];
			$sql="
				UPDATE 
					`inscrito_en` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				codinscritoen = '$id'
				AND codempresa = '$codempresa'
				 ";

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				header("Location: ../../inscrito-en-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../inscrito-en-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			
			header("Location: ../../inscrito-en-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>