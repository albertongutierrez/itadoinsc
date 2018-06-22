<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){		

		$sql="SELECT * from usuario where username ='".$_POST['username']."'";

		if(isset($_POST['empresa'])){
			$empresa=$_POST['empresa']; 
			$sql=$sql."and codempresa='".$_POST['empresa']."'";
		}
		else{
			$empresa=$_SESSION['crmEmpresa'];
			$sql=$sql."and codempresa='".$_SESSION['crmEmpresa']."'";
		}
		
		$query=$mysqli->query($sql);

		if ($query->num_rows==0){

			if($_POST['pass']==$_POST['pass-v']){

				$usuario=$_SESSION['crmUsername'];
				$sql="INSERT INTO `profesor`(
				`codempresa`, 
				`nombre`, 
				`apellido`, 
				`cedula`, 
				`email`, 
				`telefono`, 
				`celular`, 
				`estado`,
				`usuario`) 
				VALUES(
				'".$_SESSION['crmEmpresa']."',
				'".strtoupper($_POST['nombre'])."',
				'".strtoupper($_POST['apellido'])."',
				'".$_POST['cedula']."',
				'".$_POST['correo']."',
				'".$_POST['telefono']."',
				'".$_POST['celular']."',
				'A',
				'".$_SESSION['crmUsername']."'
				)";
				
				if($mysqli->query($sql)){
					$qstring = '?status=succ';
					$codprofesor=mysqli_insert_id($mysqli);
					$empresa='';
					
					$sql="INSERT INTO `usuario`
						( 
							`codempresa`, 
							`codtipo`, 
							`codprofesor`, 
							`username`, 
							`pass`, 
							`estado`, 
							`usuario`
						) VALUES (
							'$empresa',
							'".$_POST['tipo-us']."',
							'$codprofesor',
							'".$_POST['username']."',
							AES_ENCRYPT('".$_POST['pass']."','$llave'),
							'A',
							'".$_SESSION['crmUsername']."'
						)";

					if($mysqli->query($sql)){

						$qstring = '?status=succ';
					}
					else{
						$qstring = '?status=errus';
					}	
						
				}
				else{			
					$qstring = '?status=err';			
				}
			}
			else{
				$qstring = '?status=pass';
			}

		}
		else{
				$qstring = '?status=username';
			}
		
		header("Location: ../profesor-mant.php".$qstring);	

	}
	if ($i=='UDT'){	
		
		if( !empty($_POST['pass']) and !empty($_POST['pass-v'])){
			if($_POST['pass']==$_POST['pass-v']){
				$sql="
				UPDATE `profesor` SET 
				`nombre`='".strtoupper($_POST['nombre'])."',			  
				`apellido` = '".strtoupper($_POST['apellido'])."',
				`cedula` = '".$_POST['cedula']."',
				`email` = '".$_POST['correo']."',
				`celular` = '".$_POST['celular']."',
				`telefono` = '".$_POST['telefono']."',
				`estado` = '".$_POST['estado']."',
				`usuario`= '".$_SESSION['crmUsername']."'
				WHERE 
					codprofesor = '".$_POST['codigo']."'
					and codempresa='".$_POST['empresa']."'	
				 ";

			 	if($mysqli->query($sql)){
					$qstring = '?status=succudt';
					$sql="
					UPDATE `usuario` SET
					estado='".$_POST['estado']."',
					pass=AES_ENCRYPT('".$_POST['pass']."','$llave')
					WHERE 
						codusuario='".$_POST['us']."'
					and codprofesor= '".$_POST['codigo']."'
					and codempresa='".$_POST['empresa']."'
					";

					if($mysqli->query($sql)){
						$qstring = '?status=succudt';
					}
					else{
						$qstring = '?status=errudtus';
						 echo("Error description2 : " . mysqli_error($mysqli));
					}
				}
				else{
					$qstring = '?status=errudt';
					 echo("Error description: " . mysqli_error($mysqli));
				}
			}
			else{
				$qstring = '?status=pass';
			}

		}else{
			$sql="
			UPDATE `profesor` SET 
			`nombre`='".strtoupper($_POST['nombre'])."',			  
			`apellido` = '".strtoupper($_POST['apellido'])."',
			`cedula` = '".$_POST['cedula']."',
			`email` = '".$_POST['correo']."',
			`celular` = '".$_POST['celular']."',
			`telefono` = '".$_POST['telefono']."',
			`estado` = '".$_POST['estado']."',
			`usuario`= '".$_SESSION['crmUsername']."'
			WHERE 
					codprofesor = '".$_POST['codigo']."'
				and codempresa='".$_POST['empresa']."'	
			 ";

		 	if($mysqli->query($sql)){
				$qstring = '?status=succudt';
				$sql="
				UPDATE `usuario` SET
				estado='".$_POST['estado']."'
				WHERE
					codusuario='".$_POST['us']."' 
				and codprofesor = '".$_POST['codigo']."'
				and codempresa='".$_POST['empresa']."'
				";

				if($mysqli->query($sql)){
					$qstring = '?status=succudt';
				}
				else{
					$qstring = '?status=errudtus';
					 echo("Error description2 : " . mysqli_error($mysqli));
				}
			}
			else{
				$qstring = '?status=errudt';
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		
		
		
		header("Location: ../profesor-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$id = $_GET['id'];
			$empresa = $_GET['empresa'];
			$sql=" 
				UPDATE 
					`profesor` 
				SET 
				`estado`='I',
				`usuario`='".$_SESSION['crmUsername']."' 
				WHERE
				codprofesor = '$id' 
				 ";
				 if ($_SESSION['crmRanking']==2){
			 	$sql=$sql." and codempresa = '$empresa'";
			}

			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';
				$sql="
				UPDATE `usuario` SET
				estado='I'
				WHERE
					codprofesor = '$id'
				";
				 if ($_SESSION['crmRanking']==2){
			 	$sql=$sql." and codempresa = '$empresa'";
			 	}

				if($mysqli->query($sql)){
					$qstring = '?status=succdlt';
					header("Location: ../../profesor-mant.php".$qstring);
				}
				else{
					$qstring = '?status=errdltus';
					 echo("Error description2 : " . mysqli_error($mysqli));
				}

			}
			else{
				$qstring = '?status=errdlt';
				header("Location: ../../profesor-mant.php".$qstring);
				 echo("Error description: " . mysqli_error($mysqli));
			}
		}
		else{
			
			header("Location: ../../profesor-mant.php".$qstring);
		}
		
	}

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>