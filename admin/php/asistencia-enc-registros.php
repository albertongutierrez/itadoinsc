<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){		
		date_default_timezone_set('America/La_Paz');
		$fecha=date("Y-m-d h:i:s",strtotime($_POST['horas']));
		
		$sql="INSERT INTO `asistencia_enc`( 
		`codempresa`, 
		`codseccion_enc`, 
		`fecha`, 
		`estado`, 
		`usuario`
		)VALUES(
		'".$_SESSION['crmEmpresa']."',
		'".$_POST['seccion2']."',
		'$fecha',
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
		$sql='SELECT max(codasistencia_enc) as mayor FROM `asistencia_enc`';
		$query=$mysqli->query($sql);
		$row=$query->fetch_assoc();
		foreach ( $_POST['presente'] as $ro) :
			$ro2=explode(',', $ro);
			$sql  ="INSERT INTO `asistencia_det`(
			`codasistencia_enc`, 
			`codempresa`,
			`condicion`, 
			`codinscripcion`, 
			`usuario`
			)VALUES (
			'".$row['mayor']."',
			'".$_SESSION['crmEmpresa']."',
			'$ro2[0]',
			'$ro2[1]',
			'".$_SESSION['crmUsername']."'
			)";

			if($mysqli->query($sql)){
			$qstring = '?status=succ';
			}
			else{			
				$qstring = '?status=err';		
				echo $sql;
				echo mysqli_error($mysqli);	

			}
		endforeach;

		header("Location: ../asistencia-enc-mant.php".$qstring);	

	}
	if ($i=='UDT'){	
		$fecha=date("Y-m-d h:i:s",strtotime($_POST['horas']));
		$sql="
		UPDATE `asistencia_enc` SET  
		`fecha`='".$fecha."',
		`estado`= '".$_POST['estado']."',
		`usuario`='".$_SESSION['crmUsername']."'
		WHERE
		`codasistencia_enc`='".$_POST['codigo']."'
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
			echo $sql;
		}

		foreach ( $_POST['presente'] as $ro) :
			$ro2=explode(',', $ro);
			$sql  ="
			UPDATE `asistencia_det` SET 
			`codasistencia_enc`='".$_POST['codigo']."',
			`condicion`='$ro2[0]',
			`usuario`='".$_SESSION['crmUsername']."'
			 WHERE `codinscripcion`='$ro2[1]' and
			 `codasistencia_enc`='".$_POST['codigo']."'
			";

			if($mysqli->query($sql)){
			$qstring = '?status=succ';
			}
			else{			
				$qstring = '?status=err';		
				echo $sql;
				echo mysqli_error($mysqli);	

			}
			// echo $sql;
		endforeach;

		header("Location: ../asistencia-enc-mant.php".$qstring);
	}

	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$empresa = $_GET['empresa'];
			$sql=" 
				UPDATE 
					`asistencia_enc` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				`codasistencia_enc` = '$id' 
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

			header("Location: ../../asistencia-enc-mant.php".$qstring);

		}
		else{
			
			header("Location: ../../asistencia-enc-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>