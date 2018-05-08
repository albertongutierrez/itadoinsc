<?php 

	session_start();
    if(!isset($_SESSION['crmUsername']) && !isset($_SESSION['crmRanking']) && !isset($_SESSION['crmEmpresa'])){
        header('Location: ../main.php' );
    }

	include 'conectar.php';
	include 'consultas.php';

	$vpagina = $_POST['pagina'];

	$vrevisado = $_POST['datos'];
	if ($vrevisado == 'A') {
		$rev = '?rev=A&act='.$_POST['codactividad'];
	}
	elseif ($vrevisado == 'S') {
		$rev = '?rev=S&act='.$_POST['codactividad'];
	}
	elseif ($vrevisado == 'N') {
		$rev = '?rev=N&act='.$_POST['codactividad'];
	}
	else{
		$rev = '?rev=A&act=0'; //ERROR DEVUELVO TODOS LOS DATOS DE LA CONSULTA
	}

	// echo $vrevisado;
	// $query= extraerInscritosLinea2($_SESSION['crmRanking'],$_SESSION['crmEmpresa'], $vrevisado);
	// $num=$query->num_rows; 
	
	if ($vpagina == 'inscritos-mant'){
		echo mysqli_error($mysqli);
		header("Location: ../inscritos-mant.php".$rev);
	}
	elseif ($vpagina == 'inscritos2-mant'){
		echo mysqli_error($mysqli);
		header("Location: ../inscritos2-mant.php".$rev);
	}
	elseif ($vpagina == 'reporte-grupos-inscritos'){
		echo mysqli_error($mysqli);
		header("Location: ../reporte-grupos-inscritos.php".$rev);
	}
	elseif ($vpagina == 'reporte-resumen-inscritos'){
		echo mysqli_error($mysqli);
		header("Location: ../reporte-resumen-inscritos.php".$rev);
	}	
	// // IMPRESION DE TICKET 1 ES IMPRESO Y 2 NO IMPRESO
	// elseif ($vpagina == 'reporte-impresion-ticket') {
	// 	echo mysqli_error($mysqli);
	// 	if ($vrevisado == 'A') {
	// 		$rev = '?rev=A';
	// 	}
	// 	elseif ($vrevisado == '1') {
	// 		$rev = '?rev=1';
	// 	}
	// 	elseif ($vrevisado == '2') {
	// 		$rev = '?rev=2';
	// 	}
	// 	else{
	// 		$rev = '?rev=A'; //ERROR DEVUELVO TODOS LOS DATOS DE LA CONSULTA
	// 	}
	// 	header("Location: ../reporte-impresion-ticket.php".$rev);
	// }
	// NUEVA METODOLOGIA DE FILTROS
	elseif ($vpagina == 'rep-inscritos-total') {
		$act = $_POST['codactividad'];
		$lug = $_POST['codinscritoen'];
				
		echo mysqli_error($mysqli);
		header("Location: ../rep-inscritos-total.php?act=".$act."&rev=".$lug);
	}
	elseif ($vpagina == 'inscritos-club-mant'){
		$act = $_POST['codactividad'];
		$lug = $_POST['codinscritoen'];
				
		echo mysqli_error($mysqli);
		header("Location: ../inscritos-club-mant.php?act=".$act."&rev=".$lug);
	}
	elseif ($vpagina == 'reporte-emergencias') {
		$act = $_POST['codactividad'];
		// $lug = $_POST['codinscritoen'];
				
		echo mysqli_error($mysqli);
		header("Location: ../reporte-emergencias.php?act=".$act); //."&rev=".$lug
	}
	elseif ($vpagina == 'reporte-orden-inscritos') {
		$act = $_POST['codactividad'];
		// $lug = $_POST['codinscritoen'];
				
		echo mysqli_error($mysqli);
		header("Location: ../reporte-orden-inscritos.php?act=".$act); //."&rev=".$lug
	}
	elseif ($vpagina == 'reporte-impresion-ticket') {
		$act = $_POST['codactividad'];
		$lug = $_POST['codinscritoen'];
				
		echo mysqli_error($mysqli);
		header("Location: ../reporte-impresion-ticket.php?act=".$act."&rev=".$lug);
	}
	elseif ($vpagina == 'reporte-efectivo-percibir') {
		$act = $_POST['codactividad'];
		$lug = $_POST['codinscritoen'];
				
		echo mysqli_error($mysqli);
		header("Location: ../reporte-efectivo-percibir.php?act=".$act."&rev=".$lug); //
	}
	elseif ($vpagina == 'rep-relacion-inscritos') {
		$act = $_POST['codactividad'];
		$lug = $_POST['codinscritoen'];
				
		echo mysqli_error($mysqli);
		header("Location: ../rep-relacion-inscritos.php?act=".$act."&rev=".$lug); //
	}	
	// HASTA QUI NUEVA METODOLOGIA 
	// elseif ($vpagina == 'reporte-efectivo-percibir') {

	// 	if ($vrevisado == 'A') {
	// 	$rev = '?rev=A&act='.$_POST['codactividad'];
	// 	}
	// 	elseif ($vrevisado == 'L') {
	// 		$rev = '?rev=L&act='.$_POST['codactividad'];
	// 	}
	// 	elseif ($vrevisado == 'C') {
	// 		$rev = '?rev=C&act='.$_POST['codactividad'];
	// 	}
	// 	else{
	// 		$rev = '?rev=A&act=0'; //ERROR DEVUELVO TODOS LOS DATOS DE LA CONSULTA
	// 	}
	// 	echo mysqli_error($mysqli);
	// 	header("Location: ../reporte-efectivo-percibir.php".$rev);
	// }
	else{
		header("Location: ../main.php");	
	}
		

 ?>	}
