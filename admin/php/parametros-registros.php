<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){		
		$abreviatura = strtoupper($_POST['abreviatura']);
		$valor1 = $_POST['valor1'];
		$valor2 = $_POST['valor2'];
		$comentario = $_POST['descripcion'];
		
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

		$usuario=$_SESSION['crmUsername'];
		$sql="INSERT INTO `parametros`(`descripcion`, `valor1`, `valor2`, `estado`, `codempresa`, `usuario`, `comentario`) VALUES ('$abreviatura','$valor1','$valor2','$estado','$codempresa','$usuario', '$comentario')";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succ';
		}
		else{			
			$qstring = '?status=err';			
		}
	header("Location: ../parametros-mant.php".$qstring);	

	}
	if ($i=='UDT'){		
			$sql="
			UPDATE `parametros` SET 
			`descripcion`='".strtoupper($_POST['abreviatura'])."',			  
  			`valor1` = '".$_POST['valor1']."',
  			`valor2` = '".$_POST['valor2']."',
  			`estado` = '".$_POST['estado']."',
  			`usuario`= '".$_SESSION['crmUsername']."',
  			`comentario` = '".$_POST['descripcion']."'
			WHERE codparametro = '".$_POST['codparametro']."'			
			 ";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';
		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}
		header("Location: ../parametros-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$codempresa = $_GET['empresa'];
			$sql="
				UPDATE 
					`parametros` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				codparametro = '$id'
				 ";
				 if ($_SESSION['crmRanking']==2){
			 	$sql=$sql." AND codempresa = '".$_SESSION['crmEmpresa']."'";
			}

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				header("Location: ../../parametros-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../parametros-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			
			header("Location: ../../parametros-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>