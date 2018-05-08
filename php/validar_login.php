<?php
include('conectar.php');
session_start();
//$var='';

if (!empty($_POST['username']) && !empty($_POST['password']) )
{ 
	$user=mysqli_real_escape_string($mysqli,$_POST['username']);
	$pass=mysqli_real_escape_string($mysqli,$_POST['password']);
	// $empresa='ITA';//esta variable es el parametro de la empresa.

	$sql="SELECT u.username,u.codtipo, u.codempresa FROM usuario u, empresa e where u.username='$user' and u.pass= AES_ENCRYPT('$pass','$llave') and  e.estado = 'A' and e.codempresa=u.codempresa and u.estado='A'";
	$result=$mysqli->query($sql);
	$row=$result->num_rows;

	$consulta=$result->fetch_assoc();

	if ($row > 0){
		
		$_SESSION['crmUsername']=$consulta['username'];
		$_SESSION['crmRanking']=$consulta['codtipo'];
		$_SESSION['crmEmpresa']=$consulta['codempresa'];
		$_SESSION['crmTiempo']=time();


		if (isset($_SESSION['crmUsername']) && isset($_SESSION['crmRanking']) && isset($_SESSION['crmEmpresa']))
			
			header('Location: ../main-2.php' );

		}
		else{
			 	header('Location: ../index.php?status=errl');
		}

}
else
{
	echo "Problemas con la base de datos";
}
?>