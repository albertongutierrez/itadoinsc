<?php
include'conectar.php';
session_start();

if(isset($_GET['accion'])){
	$i=$_GET['accion'];	
	 
	if ($i=='INS'){
		$sql="SELECT * from usuario where username ='".$_POST['username']."'";
		if(isset($_POST['empresa'])){ $sql=$sql."and codempresa='".$_POST['empresa']."'";}else{$sql=$sql."and codempresa='".$_SESSION['crmEmpresa']."'";}
		$query=$mysqli->query($sql);
		echo $query->num_rows;
		if ($query->num_rows==0){
			if($_POST['pass']==$_POST['pass-v']){
				if(isset($_POST['empresa'])){
					$sql="INSERT INTO `usuario`( `codempresa`, `codtipo`, `username`, `pass`, `estado`, `usuario`) VALUES ('".$_POST['empresa']."','".$_POST['tipo-us']."','".$_POST['username']."',AES_ENCRYPT('".$_POST['pass']."','$llave'),'A','".$_SESSION['crmUsername']."')";
					
					if($mysqli->query($sql)){
						$qstring = '?status=succ';
					}
					else{
						$qstring = '?status=err';
					}				
				}
				else{
					$sql="INSERT INTO `usuario`( `codempresa`, `codtipo`, `username`, `pass`, `estado`, `usuario`) VALUES ('".$_SESSION['crmEmpresa']."','".$_POST['tipo-us']."','".$_POST['username']."',AES_ENCRYPT('".$_POST['pass']."','$llave'),'A','".$_SESSION['crmUsername']."')";

					if($mysqli->query($sql)){
						$qstring = '?status=succ';
					}
					else{
						$qstring = '?status=err';
					}	
				}
				
			}
			else{
					$qstring = '?status=pass';
				}
		}
		else{
			$qstring = '?status=username';
		}
		header("Location: ../usuario-mant.php".$qstring);
	}
	
	if ($i=='UDT'){
		if ($_SESSION['crmRanking']<=2){
			if (isset($_POST['pass']) and !empty($_POST['pass']) ){	
				if( $_POST['pass']== $_POST['pass-v']){		
					$sql="UPDATE `usuario` SET `codtipo`='".$_POST['tipo-us']."',`pass`=AES_ENCRYPT('".$_POST['pass']."','$llave'),`estado`='".$_POST['estado']."' ,`usuario`='".$_SESSION['crmUsername']."' WHERE username='".$_POST['username']."' ";
					if($mysqli->query($sql)){
						$qstring = '?status=succudt';
					}
					else{
						$qstring = '?status=errudt';
					}
				}
				else{
					$qstring = '?status=pass';
				}
			}
			else{
				$sql="UPDATE `usuario` SET `codtipo`='".$_POST['tipo-us']."',`estado`='".$_POST['estado']."' ,`usuario`='".$_SESSION['crmUsername']."' WHERE username='".$_POST['username']."'
				 ";
				 if($mysqli->query($sql)){
						$qstring = '?status=succudt';
				}
				else{
					$qstring = '?status=errudt';
				}
			}
		}
		else{
			if (isset($_POST['pass'])){	
				if( $_POST['pass']== $_POST['pass-v']){		
					$sql="UPDATE `usuario` SET `pass`=".$_POST['pass']." ,`usuario`='".$_SESSION['crmUsername']."' WHERE username='".$_POST['username']."' and empresa='".$_SESSION['crmEmpresa']."'";
				
					if($mysqli->query($sql)){
						$qstring = '?status=succ';
					}
					else{
						$qstring = '?status=err';
					}
				}
				else{
					$qstring = '?status=pass';
				}
			}
		}

		header("Location: ../usuario-mant.php".$qstring);

	}
	if ($i=='DLT'){
		if ($_SESSION['crmRanking']<=2){
			$sql="
				UPDATE `usuario` SET 
				`estado`='I' ,`usuario`='".$_SESSION['crmUsername']."' WHERE
				codempresa= '".$_GET['id']."' and username='".$_GET['username']."' 
				 ";
			if($mysqli->query($sql)){
				$qstring = '?status=succdlt';

			}
			else{
				$qstring = '?status=errdlt';
			}
		}
		else{
			header("Location: ../usuario-mant.php".$qstring);
		}
		// $qstring = '?status=errdlt';
			header("Location: ../usuario-mant.php".$qstring);

	}
	
	

	// header("Location: ../empresa-mant.php".$qstring);
}
else{
 	header("Location: ../main.php");
}
?>