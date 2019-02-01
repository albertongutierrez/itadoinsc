<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){
		$tamanio = $_FILES["logo"]["size"];
		$archivo = $_FILES["logo"]["tmp_name"]; 
		$fp = fopen($archivo, "rb");
		$contenido = fread($fp, $tamanio);
		$contenido = addslashes($contenido);
		fclose($fp); 
		if (isset($_POST['telefono2'])){
			$telefono2=$_POST['telefono2'];
		}
		else{ $telefono2="";}

		if (isset($_POST['web'])){
			$web="".$_POST['web']."";
		}
		else{ $web="";}
		echo $_POST['email'];
		$sql="INSERT INTO `empresa`(`codempresa`, `nombre`, `rsm_nombre`, `logo`, `telefono1`, `telefono2`, `email`, `pweb`, `estado`, `RNC`, `por_defecto`,`usuario`) 
		VALUES ('".strtoupper($_POST['codempresa'])."','".$_POST['nombre']."','".strtoupper($_POST['rsmnombre'])."','$contenido','".$_POST['telefono']."','".$telefono2."','".$_POST['email']."','".$web."','A','".$_POST['rnc']."','N','".$_SESSION['crmUsername']."')";
		
		if($mysqli->query($sql)){
			$qstring = '?status=succ';
		}
		else{
			$qstring = '?status=err';
		}
	header("Location: ../empresa-mant.php".$qstring);	

	}
	if ($i=='UDT'){

		if (!empty($_POST['telefono2'])){
			$telefono2=$_POST['telefono2'];
		}
		else{ 
			$telefono2='';
		}
		if (!empty($_POST['web'])){
			$web=$_POST['web'];
		}
		else{ $web='';}	

		if (isset($_POST['estado'])){
			$estado=$_POST['estado'];
		}	
		else{ $estado='A';}	
		if (!empty($_FILES["logo"]) and ($_FILES["logo"]["size"]>0)){
			echo "string";
			$tamanio = $_FILES["logo"]["size"];
			$archivo = $_FILES["logo"]["tmp_name"]; 
			$fp = fopen($archivo, "rb");
			$contenido = fread($fp, $tamanio);
			$contenido = addslashes($contenido);
			fclose($fp); 

			$sql="
			UPDATE `empresa` SET 
			`nombre`='".$_POST['nombre']."',
			`rsm_nombre`='".$_POST['rsmnombre']."',
			`logo`='$contenido',
			`telefono1`='".$_POST['telefono']."',
			`telefono2`='$telefono2',
			`email`='".$_POST['email']."',
			`pweb`='$web',
			`estado`='$estado',
			`RNC`='".$_POST['rnc']."',
			`por_defecto`='".$_POST['por-defecto']."',
			`usuario`='".$_SESSION['crmUsername']."'
 
			WHERE 
			codempresa= '".$_POST['codempresa']."'
			 ";
		}
		else{
			$sql="
			UPDATE `empresa` SET 
			`nombre`='".$_POST['nombre']."',
			`rsm_nombre`='".$_POST['rsmnombre']."',
			`telefono1`='".$_POST['telefono']."',
			`telefono2`='$telefono2',
			`email`='".$_POST['email']."',
			`pweb`='$web',
			`estado`='$estado',
			`RNC`='".$_POST['rnc']."',
			`por_defecto`='".$_POST['por-defecto']."' ,
			`usuario`='".$_SESSION['crmUsername']."'

			WHERE 
			codempresa= '".$_POST['codempresa']."'
			 ";
		}
		if($mysqli->query($sql)){
			$qstring = '?status=succudt';

		}
		else{
			$qstring = '?status=errudt';
			 echo("Error description: " . mysqli_error($mysqli));
		}
		header("Location: ../empresa-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']==1){
			$sql="
				UPDATE `empresa` SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."'
 				WHERE
				codempresa= '".$_GET['id']."'
				 ";
			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				header("Location: ../../empresa-mant.php".$qstring);

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../empresa-mant.php".$qstring);
				 // echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			header("Location: ../empresa-mant.php".$qstring);
		}
	}

	header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>