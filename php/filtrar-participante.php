<?php 

	session_start();
    if(!isset($_SESSION['crmUsername']) && !isset($_SESSION['crmRanking']) && !isset($_SESSION['crmEmpresa'])){
        header('Location: ../index.php?status=errs' );
    }

	include 'conectar.php';
	include 'consultas.php';

	$query= buscarparametrosdato('id');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['id'])) {
			$sql="UPDATE `parametros` SET `comentario`='si', usuario='".$_SESSION['crmUsername']."' where `descripcion`='CP' and `valor1`= 1 ";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no', usuario='".$_SESSION['crmUsername']."' where `descripcion`='CP' and `valor1`= 1";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['id'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '1', 'id', '".$_POST['id']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '1', 'id', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('fecha_inscripcion');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['id'])) {
			$sql="UPDATE `parametros` SET `comentario`='si', usuario='".$_SESSION['crmUsername']."' where `descripcion`='CP' and `valor1`= 2";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no', usuario='".$_SESSION['crmUsername']."' where `descripcion`='CP' and `valor1`= 2";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['id'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '2', 'fecha_inscripcion', '".$_POST['id']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '2', 'fecha_inscripcion', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('nombre');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['nombre'])) {
			$sql="UPDATE `parametros` SET `comentario`='si', usuario='".$_SESSION['crmUsername']."' where `descripcion`='CP' and `valor1`= 3";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no', usuario='".$_SESSION['crmUsername']."' where `descripcion`='CP' and `valor1`= 3";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['nombre'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`.`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '3', 'nombre', '".$_POST['nombre']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '3', 'nombre', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}
	$query= buscarparametrosdato('apellido');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['apellido'])) {
			$sql="UPDATE `parametros` SET `comentario`='si', usuario='".$_SESSION['crmUsername']."' where `descripcion`='CP' and `valor1`= 4";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no', usuario='".$_SESSION['crmUsername']."' where `descripcion`='CP' and `valor1`= 4";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['apellido'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '4', 'apellido', '".$_POST['apellido']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '4', 'apellido', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('telefono');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['telefono'])) {
			$sql="UPDATE `parametros` SET `comentario`='si', usuario='".$_SESSION['crmUsername']."' where `descripcion`='CP' and `valor1`= 5";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no', usuario='".$_SESSION['crmUsername']."' where `descripcion`='CP' and `valor1`= 5";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['telefono'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '5', 'telefono', '".$_POST['telefono']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '5', 'telefono', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('correo');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['correo'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 6";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 6";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['correo'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '6', 'correo', '".$_POST['correo']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '6', 'correo', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('cedula_pasaporte');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['cedula_pasaporte'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 7";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 7";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['cedula_pasaporte'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '7', 'cedula_pasaporte', '".$_POST['cedula_pasaporte']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '7', 'cedula_pasaporte', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('genero');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['genero'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 8";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 8";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['genero'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '8', 'genero', '".$_POST['genero']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '8', 'genero', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('pais');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['pais'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 9";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 9";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['pais'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '9', 'pais', '".$_POST['pais']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '9', 'pais', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}


	$query= buscarparametrosdato('provincia');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['provincia'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 10";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 10";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['provincia'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '10', 'provincia', '".$_POST['provincia']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '10', 'provincia', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('nombre_grupo');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['nombre_grupo'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 11";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 11";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['nombre_grupo'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '11', 'nombre_grupo', '".$_POST['nombre_grupo']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '11', 'nombre_grupo', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('otro_grupo');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['otro_grupo'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 12";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 12";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['otro_grupo'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '12', 'otro_grupo', '".$_POST['otro_grupo']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '12', 'otro_grupo', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('cant_p');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['cant_p'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 13";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 13";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['cant_p'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '13', 'cant_p', '".$_POST['cant_p']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '13', 'cant_p', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('cant_ma');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['cant_ma'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 14";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 14";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['cant_ma'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '14', 'cant_ma', '".$_POST['cant_ma']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '14', 'cant_ma', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('cant_me');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['cant_me'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 15";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 15";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['cant_me'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '15', 'cant_me', '".$_POST['cant_me']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '15', 'cant_me', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('contactoe');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['contactoe'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 16";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 16";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['contactoe'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '16', 'contactoe', '".$_POST['contactoe']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '16', 'contactoe', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('telefonoe');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['telefonoe'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 17";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 17";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['telefonoe'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '17', 'telefonoe', '".$_POST['telefonoe']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '17', 'telefonoe', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('comentario_p');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['comentario_p'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 18";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 18";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['comentario_p'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '18', 'comentario_p', '".$_POST['comentario_p']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '18', 'comentario_p', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('acuerdo_t');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['acuerdo_t'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 19";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 19";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['acuerdo_t'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '19', 'acuerdo_t', '".$_POST['acuerdo_t']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '19', 'acuerdo_t', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('revisado');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['revisado'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 20";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 20";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['revisado'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '20', 'revisado', '".$_POST['revisado']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '20', 'revisado', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('c_revisado');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['c_revisado'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 21";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 21";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['c_revisado'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '21', 'c_revisado', '".$_POST['c_revisado']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '21', 'c_revisado', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('fecha_deposito');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['fecha_deposito'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 22";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 22";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['fecha_deposito'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '22', 'fecha_deposito', '".$_POST['fecha_deposito']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '22', 'fecha_deposito', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('monto');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['monto'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 23";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 23";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['monto'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '23', 'monto', '".$_POST['monto']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '23', 'monto', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('referencia');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['referencia'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 24";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 24";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['referencia'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '24', 'referencia', '".$_POST['referencia']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '24', 'referencia', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('descripcion_deposito');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['descripcion_deposito'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 25";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 25";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['descripcion_deposito'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '25', 'descripcion_deposito', '".$_POST['descripcion_deposito']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '25', 'descripcion_deposito', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('comentario_deposito');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['comentario_deposito'])) {
			$sql="UPDATE `parametros` SET `comentario`='si' where `descripcion`='CP' and `valor1`= 26";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='no' where `descripcion`='CP' and `valor1`= 26";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['comentario_deposito'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '26', 'comentario_deposito', '".$_POST['comentario_deposito']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '26', 'comentario_deposito', 'no','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('datos');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['datos'])) {
			$sql="UPDATE `parametros` SET `comentario`='".$_POST['datos']."' where `descripcion`='CP' and `valor1`= 27";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='".$_POST['datos']."' where `descripcion`='CP' and `valor1`= 27";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['datos'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '27', 'datos', '".$_POST['datos']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '27', 'datos', 'all','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('evento');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['evento'])) {
			$sql="UPDATE `parametros` SET `comentario`='".$_POST['evento']."' where `descripcion`='CP' and `valor1`= 28";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='".$_POST['evento']."' where `descripcion`='CP' and `valor1`= 28";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['evento'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '28', 'evento', '".$_POST['evento']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '28', 'evento', 'all','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}

	$query= buscarparametrosdato('inscritoen');
	$num=$query->num_rows; 
	if($num>0)
	{
		if (isset($_POST['inscritoen'])) {
			$sql="UPDATE `parametros` SET `comentario`='".$_POST['inscritoen']."' where `descripcion`='CP' and `valor1`= 29";
			$mysqli->query($sql);
			
		}
		else{
			$sql="UPDATE `parametros` SET `comentario`='".$_POST['inscritoen']."' where `descripcion`='CP' and `valor1`= 29";
			$mysqli->query($sql);
		}
	}
	else{
		if (isset($_POST['inscritoen'])) {
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '29', 'inscritoen', '".$_POST['inscritoen']."','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO `parametros` (`codparametro`,`codempresa`, `descripcion`, `valor1`, `valor2`, `comentario`,`estado`,`usuario`) VALUES (NULL,'".$_SESSION['crmEmpresa']."', 'CP', '29', 'inscritoen', 'all','A','".$_SESSION['crmUsername']."')";
			$mysqli->query($sql);
		}
	}


echo mysqli_error($mysqli);
header("Location: ../consulta-participante.php");
	

 ?>