<?php 
 
	function nombre_empresa(){
		include('conectar.php');
		$sql="SELECT * FROM empresa where codempresa = '".$_SESSION['crmEmpresa']."'";
		$result=$mysqli->query($sql);
		$consulta=$result->fetch_assoc();
		return $consulta; 
	}

	function buscarparametrosdato($valor2){
		require  'conectar.php';
		$sql="SELECT * FROM parametros where `valor2` = '$valor2' and `descripcion`= 'CP' and codempresa='".$_SESSION['crmEmpresa']."'";
		return $mysqli->query($sql); 
	}  
	function registros($evento){
		require  'conectar.php';
		$sql="SELECT COUNT(*) as total FROM `inscripcion` where codactividad='$evento' and codempresa='".$_SESSION['crmEmpresa']."'";
		return $mysqli->query($sql); 
	}

	function inscritos($v,$v2){
		require  'conectar.php';
		if($v=='A'){
			$sql="SELECT * FROM vparticipantes WHERE estado_inscripcion!='B'and  actividad='$v2'";
		}
		else{
			$sql="SELECT * FROM vparticipantes WHERE estado_inscripcion!='B' and inscrito_en='$v' and actividad='$v2'";
		}
		return $mysqli->query($sql); 
	}


	function graficogenero(){
		require  'conectar.php';
		$sql="(SELECT DISTINCT genero, COUNT(*) AS total FROM `vparticipantes` WHERE genero='F' and `revisado`='S' and codempresa='".$_SESSION['crmEmpresa']."') UNION (SELECT DISTINCT genero, COUNT(*) AS total FROM `vparticipantes` WHERE genero='M' and `revisado`='S' and codempresa='".$_SESSION['crmEmpresa']."') UNION (SELECT DISTINCT genero, COUNT(*) AS total FROM `vparticipantes` WHERE genero='N' and `revisado`='S' and codempresa='".$_SESSION['crmEmpresa']."')";
		return $mysqli->query($sql); 
	}
	function graficoprocedenciaprovincia(){
		require  'conectar.php';
		$sql="SELECT DISTINCT provincia AS provincia, codprovincia as codigo FROM `vparticipantes` WHERE `revisado`='S' and codempresa='".$_SESSION['crmEmpresa']."'";
		return $mysqli->query($sql); 
	}
	function graficoprocedenciacontarprovincia($provincia){
		require  'conectar.php';
		$sql="SELECT (SUM(pago_participante)+SUM(pago_acom_mayor)+SUM(pago_acomp_menor)) as total FROM  `vparticipantes`  WHERE codprovincia='$provincia' and `revisado`='S' and codempresa='".$_SESSION['crmEmpresa']."'";
		return $mysqli->query($sql); 
	}

	function graficoforma(){
		require  'conectar.php';
		$sql="SELECT DISTINCT `inscrito_en` FROM `vparticipantes` where `revisado`='S' and codempresa='".$_SESSION['crmEmpresa']."'";
		return $mysqli->query($sql); 
	}
	function graficocontarforma($forma){
		require  'conectar.php';
		$sql="SELECT (SUM(pago_participante)+SUM(pago_acom_mayor)+SUM(pago_acomp_menor)) as total FROM  `vparticipantes`  WHERE `inscrito_en`='$forma' and `revisado`='S' and codempresa='".$_SESSION['crmEmpresa']."'";
		return $mysqli->query($sql); 
	}

	function graficotipoparticiapante(){
		require  'conectar.php';
		$sql="SELECT sum(pago_participante) as participante, sum(pago_acom_mayor) as mayor, sum(pago_acomp_menor) as menor FROM  `vparticipantes` where `revisado`='S' and codempresa='".$_SESSION['crmEmpresa']."' ";
		return $mysqli->query($sql); 
	}

	function graficogrupo(){
		require  'conectar.php';
		$sql="SELECT DISTINCT `grupo`as grupo, codgrupo as codigo FROM `vparticipantes` where `revisado`='S' and codempresa='".$_SESSION['crmEmpresa']."' order by grupo";
		return $mysqli->query($sql); 
	}
	function graficocontargrupo($grupo){
		require  'conectar.php';
		$sql="SELECT (SUM(pago_participante)+SUM(pago_acom_mayor)+SUM(pago_acomp_menor)) as total  FROM `vparticipantes` WHERE codgrupo='$grupo' and `revisado`='S' and codempresa='".$_SESSION['crmEmpresa']."' ";
		return $mysqli->query($sql); 
	}

	function graficototal(){
		require  'conectar.php';
		$sql="SELECT COUNT(*) as totalg, (SUM(pago_participante)+SUM(pago_acom_mayor)+SUM(pago_acomp_menor)) as total FROM `vparticipantes` where `revisado`='S' and codempresa='".$_SESSION['crmEmpresa']."'";
		return $mysqli->query($sql); 
	}
	function extraerActividad($ranking,$empresa){
		include('conectar.php');
		if ($ranking ==1){
			$sql="SELECT codactividad as codactividad, descripcion, costo_participante, costo_invitado, costo_ninos FROM actividades WHERE estado = 'A'";
		}
		else {
			$sql="SELECT codactividad as codactividad, descripcion, costo_participante, costo_invitado, costo_ninos FROM actividades WHERE estado = 'A' and codempresa='$empresa'";
		
		}
		
		$result=$mysqli->query($sql);
		return $result;
	}
	function extraerInscritoEnUDT($empresa, $id){
		include('conectar.php');
		$sql="SELECT * from inscrito_en where codinscritoen='$id' and codempresa = '$empresa'";
		return $mysqli->query($sql);
	}
	function extraerInscritoEn($ranking, $empresa){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM inscrito_en where mostrar='S'";
		} 		
		else{
			$sql="SELECT * FROM inscrito_en where codempresa = '$empresa'  and mostrar='S'";
		}
		return $mysqli->query($sql);
	}
?>