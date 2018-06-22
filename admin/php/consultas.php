<?php  
	// session_start(); 

	function nombre_empresa(){
		include('conectar.php');
		$sql="SELECT * FROM empresa where codempresa = '".$_SESSION['crmEmpresa']."'";
		$result=$mysqli->query($sql);
		$consulta=$result->fetch_assoc();
		return $consulta;  
	}

	function extraerAsistenciaCreada($id){
		include('conectar.php');
		date_default_timezone_set('America/La_Paz');
		
		$empresa=$_SESSION['crmEmpresa'];
		$fecha=date('Y-m-d');

		$sql="
		SELECT 
			* 
		FROM 
			asistencia_enc 
		where 
				codempresa = '$empresa'
			and DATE(fecha)='$fecha'
			and codseccion_enc='$id'
			and estado='A'
			
		";
		// return ($sql);
		return $mysqli->query($sql);

	}

	function extraerEmpresa($ranking,$empresa){
		include('conectar.php');
		if ($ranking ==1){
			$sql="SELECT * FROM empresa ";
		}
		else {
			$sql="SELECT * FROM empresa where codempresa = '".$_SESSION['crmEmpresa']."' and codempresa='$empresa'";
		
		}
		
		$result=$mysqli->query($sql);
		return $result;
	}
	function extraerEmpresaUDT($empresa){
		include('conectar.php');
		$sql="SELECT * FROM empresa where codempresa='$empresa' ";
		$result=$mysqli->query($sql);
		return $result;
	}
	function extraerUsuarios(){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM usuario";
		}
		elseif ($_SESSION['crmRanking']==2){
			$sql="SELECT * FROM usuario where codempresa = '".$_SESSION['crmEmpresa']."' and codtipo!=1";			
		}
		else{
			$sql="SELECT * FROM usuario where codempresa = '".$_SESSION['crmEmpresa']."' and username='".$_SESSION['crmUsername']."'";
		
		}
		return $mysqli->query($sql);
	}

	function extraerTipous(){
		include('conectar.php');
		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM tipo_usuario";
		}
		else{
			$sql="SELECT * FROM tipo_usuario where codtipo >= 2";
		}
		return $mysqli->query($sql);
	}

	function extraerUsuarioUDT($empresa,$id){
		include('conectar.php');
		$sql="SELECT * from usuario where username='$id' and codempresa='$empresa'";
		return $mysqli->query($sql);
	}

	function extraerZonas(){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM zonas where estado='A'";
		}
		else{
			$sql="SELECT * FROM zonas where codempresa = '".$_SESSION['crmEmpresa']."' and estado='A'";
		}
		return $mysqli->query($sql);
	}
	function extraerZonaUDT($empresa,$id){
		include('conectar.php');
		$sql="SELECT * from zonas where codzona='$id' and codempresa='$empresa'";
		return $mysqli->query($sql);
	}
	


	// NUEVO ALBERTO
	function extraerMiembros(){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM miembros";
		}
		else{
			$sql="SELECT * FROM miembros where codempresa = '".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);
	}

	function extraerMiembrosUDT($empresa,$id){
		include('conectar.php');	
		$sql="SELECT * from miembros where codmiembro='$id' and codempresa='$empresa'";
		return $mysqli->query($sql);
	}

	function extraerZonasMiembros($miembro){
		include('conectar.php'); 

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM miembros_por_zona where codmiembro='$miembro' and estado='A'";
		}
		else{
			$sql="SELECT * FROM miembros_por_zona where codempresa = '".$_SESSION['crmEmpresa']."' and codmiembro='$miembro' and estado='A'";
		}
		return $mysqli->query($sql);
	}
	//este es dependiente de el de arriva
	function extraerZonaMiembro($miembro,$mz,$zona,$categoria){
		include('conectar.php');
		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT m.nombre,m.apellido,z.descripcion, mz.categoria, m.codempresa, mz.codmiembro, p.valor2 as miembrocat, mz.codmiembro_zona as miembro_zona, mz.codmiembro as codmiembro, mz.categoria as idcat, mz.codzona, mz.categoria as codcategoria FROM miembros_por_zona mz, zonas z, miembros m,  parametros p where m.codmiembro='$miembro' and mz.codmiembro='$miembro' and mz.codmiembro_zona='$mz' and mz.codzona='$zona' and z.codzona='$zona' and p.codparametro='$categoria' and p.descripcion='EZ' and m.estado='A'";
			}
		
		else{
			$sql="SELECT m.nombre,m.apellido,z.descripcion, mz.categoria, m.codempresa, mz.codmiembro, p.valor2 as miembrocat, mz.codmiembro_zona as miembro_zona, mz.codmiembro as codmiembro, mz.categoria as idcat, mz.codzona , mz.categoria as codcategoria FROM miembros_por_zona mz, zonas z, miembros m,  parametros p where m.codmiembro='$miembro' and mz.codmiembro='$miembro' and mz.codmiembro_zona='$mz' and mz.codzona='$zona' and z.codzona='$zona' and p.codparametro='$categoria' and p.descripcion='EZ' and m.codempresa='".$_SESSION['crmEmpresa']."' and z.codempresa='".$_SESSION['crmEmpresa']."' and p.codempresa='".$_SESSION['crmEmpresa']."' and m.estado='A'";
		}
		return $mysqli->query($sql);
	}

	function extraerNacionalidad(){
		include('conectar.php');
		$sql="SELECT * FROM parametros where";
			if ($_SESSION['crmRanking'] ==1){
			 $sql=$sql." descripcion='NAC'  and estado='A'";
		}
		else{
			 $sql=$sql." descripcion='NAC' and estado='A' and codempresa='".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);

	}

	function extraerZonaParametros(){
		include('conectar.php');
		$sql="SELECT * FROM parametros where";
		if ($_SESSION['crmRanking'] ==1){
			 $sql=$sql." descripcion='EZ'  and estado='A'";
		}
		else{
			 $sql=$sql." descripcion='EZ' and estado='A' and codempresa='".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);

	}

	function extraerCategoriaCarreraParametros(){
		include('conectar.php');
		if ($_SESSION['crmRanking'] ==1){
			$sql  = "SELECT codparametro as codigo, concat(valor2,' ',comentario) as descripcion FROM `parametros` WHERE descripcion='MIT' AND estado='A'";
		}
		else{
			$sql  = "SELECT codparametro as codigo, concat(valor2,' ',comentario) as descripcion FROM `parametros` WHERE descripcion='MIT' and codempresa='".$_SESSION['crmEmpresa']."' AND estado='A'";

		}
		return $mysqli->query($sql);

	}

	function extraerCategoriaExperienciaParametros(){
		include('conectar.php');
		if ($_SESSION['crmRanking'] ==1){
			$sql  = "SELECT codparametro as codigo, concat(valor2,' ',comentario) as descripcion FROM `parametros` WHERE descripcion='TM' AND estado='A'";
		}
		else{
			$sql  = "SELECT codparametro as codigo, concat(valor2,' ',comentario) as descripcion FROM `parametros` WHERE descripcion='TM' and codempresa='".$_SESSION['crmEmpresa']."' AND estado='A'";

		}
		return $mysqli->query($sql);

	}

	function extraerdateraportehabilesactivos($tipo){
		include('conectar.php');
		if ($tipo=='ah') {
			$sql="select a.codmiembro as membresia, CONCAT(a.nombre,' ', a.apellido) as nombres, a.telcasa as telefono, a.telcelular as celular, a.email,
			c.descripcion as ciudad, d.descripcion as regional 
			from miembros a, vmiembros_ccuota b, provincias_pais c, zonas d, miembros_por_zona e
			where a.codmiembro = b.codmiembro
			and a.codempresa = b.codempresa
			and b.cuotas_pendientes BETWEEN (select min(a.rango1) from categorias a
                            where a.codcategoria <> 3) and (select max(a.rango2) from categorias a
                            where a.codcategoria <> 3)
			and c.codempresa = a.codempresa
			and c.codprovincia = a.codprovincia
			and d.codzona = e.codzona
			and d.codempresa = e.codempresa
			and e.codmiembro = a.codmiembro
			and e.codempresa = a.codempresa
			";
		}
		elseif($tipo=='i'){
			$sql="select a.codmiembro as membresia, CONCAT(a.nombre,' ', a.apellido) as nombres, a.telcasa as telefono, a.telcelular as celular, a.email,
			c.descripcion as ciudad, d.descripcion as regional 
			from miembros a, vmiembros_ccuota b, provincias_pais c, zonas d, miembros_por_zona e
			where a.codmiembro = b.codmiembro
			and a.codempresa = b.codempresa
			and b.cuotas_pendientes BETWEEN (select max(a.rango1) from categorias a
                            where a.codcategoria = 3) and (select max(a.rango2) from categorias a
                            where a.codcategoria = 3)
			and c.codempresa = a.codempresa
			and c.codprovincia = a.codprovincia
			and d.codzona = e.codzona
			and d.codempresa = e.codempresa
			and e.codmiembro = a.codmiembro
			and e.codempresa = a.codempresa
			";
		}
		
		return $mysqli->query($sql);
	}
	function extraerCurriculum(){
		include('conectar.php');	
		$sql="SELECT * FROM `miembros` where estado='A'";	
		return $mysqli->query($sql);
	}
	function extraerCurriculumuser($id){
		include('conectar.php');	
		$sql="SELECT  
				m.nombre,
				m.apellido,
				m.direccion, 
				m.telcasa as telefono, 
				m.telcelular as celular, 
				m.email as correo, 
				p.valor2 as nacionalidad,
				m.lugar_nacimiento, 
				m.fecha_nacimiento,
				m.estado_civil,
				m.noidentificacion as cedula,
				m.fotografia as foto
				FROM
				miembros m , parametros p
				where
				m.codmiembro='$id' and m.estado='A' and m.nacionalidad=p.codparametro"
			;	
		return $mysqli->query($sql);
	}

	function extraerCurriculumestudios($id){
		include('conectar.php');	
		$sql="SELECT b.descripcion as estudio, a.descripcion as titulo FROM miembo_estudios a, estudios_enc b where a.codmiembro='$id' and a.codestudios= b.codestudios and a.estado='A'";	
		return $mysqli->query($sql);
	}

	function extraerCurriculumexperiencia($id){
		include('conectar.php');	
		$sql="SELECT a.nombre_empresa as empresa, a.descripcion as experiencia, b.valor2 as titulo, a.asignatura, a.actividad FROM miembro_experiencia a, parametros b where a.codmiembro='$id' and a.codparametro=b.codparametro and a.estado='A'";	
		return $mysqli->query($sql);
	}

	function extraerControl(){
		include('conectar.php');	
		$sql="SELECT c.fecha, c.objeto, c.tabla, c.operacion, c.username FROM control c";
		if ($_SESSION['crmRanking']==2){
			$sql = $sql." where  c.codempresa='".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);
	}

	function extraerGrupopais(){
		include('conectar.php');	
		$sql="SELECT `codgrupo`, `codempresa`, `descripcion`, `estado`, `usuario` FROM `grupos_pais`";
		if ($_SESSION['crmRanking']==2){
			$sql .=" where  codempresa='".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);
	}
	function extraerGrupopaisUDT($empresa,$id){
		include('conectar.php');	
		$sql="SELECT `codgrupo`, `codempresa`, `descripcion`, `estado`, `usuario` FROM `grupos_pais` where codgrupo='$id' and codempresa='$empresa'";
		if ($_SESSION['crmRanking']==2){
			$sql .=" and   codempresa='".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);
	}

	function extraerActividades(){
		include('conectar.php');	
		$sql="SELECT * FROM `actividades`";
		if ($_SESSION['crmRanking']==2){
			$sql .=" where codempresa='".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);
	}

	function extraerActividadesUDT($empresa,$id){
		include('conectar.php');	
		$sql="SELECT * FROM `actividades` where codactividad='$id' and codempresa='$empresa'";
		if ($_SESSION['crmRanking']==2){
			$sql .=" and codempresa='".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);
	}

	function extraerParametros(){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM parametros";
		}
		else{
			$sql="SELECT * FROM parametros where codempresa = '".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);
	}
	function extraerParametrosUDT($empresa,$id){
		include('conectar.php');
		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * from parametros where codparametro='$id' ";

		}
		else{
			$sql="SELECT * from parametros where codparametro='$id' and codempresa='$empresa'";
		}
		
		return $mysqli->query($sql);
	}
	function extraerCorreos(){
		include('conectar.php');

		$sql="SELECT codinscripcion as codigo, revisado,email,nombre,apellido from inscripcion where codempresa='".$_SESSION['crmEmpresa']."' and estado_inscripcion != 'B' and inscrito_en ='L' ";

		return $mysqli->query($sql);
	}

	function extraerCorreoEmpresa(){
		include('conectar.php');
		session_start();

		$sql="SELECT email,rsm_nombre as nombre from empresa where codempresa='".$_SESSION['crmEmpresa']."' and estado= 'A'";

		return $mysqli->query($sql);
	}

	function inscritos($actividad){
		require  'conectar.php';
		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT sum(cant_participante+cant_acom_mayor+cant_acomp_menor)as total FROM inscripcion WHERE estado_inscripcion!='B' and codactividad='$actividad' ";
		}
		else{
			$sql="SELECT sum(cant_participante+cant_acom_mayor+cant_acomp_menor)as total FROM inscripcion WHERE estado_inscripcion!='B' and codempresa='".$_SESSION['crmEmpresa']."' and codactividad='$actividad' ";
		}
		return $mysqli->query($sql); 
	}
	function inscritosGrupos($actividad){
		require  'conectar.php';
		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT DISTINCT a.codactividad ,count(DISTINCT b.descripcion) as total FROM inscripcion a, grupos_pais b WHERE a.estado_inscripcion!='B' and a.codgrupo=b.codgrupo and a.codactividad='$actividad'";
		}
		else{
			$sql="SELECT DISTINCT a.codactividad ,count(DISTINCT b.descripcion) as total FROM inscripcion a, grupos_pais b WHERE a.estado_inscripcion!='B' and a.codgrupo=b.codgrupo and a.codempresa='".$_SESSION['crmEmpresa']."' and b.codempresa='".$_SESSION['crmEmpresa']."' and a.codactividad='$actividad'";
		}

		return $mysqli->query($sql); 
	}

	function inscritosProvincias($actividad){
		require  'conectar.php';
		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT COUNT(DISTINCT b.descripcion) AS total FROM inscripcion a, provincias_pais b WHERE estado_inscripcion!='B' and a.codprovincia=b.codprovincia and a.codactividad='$actividad'";
		}
		else{
			$sql="SELECT COUNT(DISTINCT b.descripcion) AS total FROM inscripcion a, provincias_pais b WHERE estado_inscripcion!='B' and a.codempresa='".$_SESSION['crmEmpresa']."' and a.codprovincia=b.codprovincia and a.codactividad='$actividad'";
		}
		return $mysqli->query($sql); 
	}

	function inscritosDias(){
		require  'conectar.php';
		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT DISTINCT a.fecha_inscripcion as fecha FROM vparticipantes a, actividades b WHERE a.fecha_inscripcion<=now() and  a.estado_inscripcion!='B' and b. order by fecha_inscripcion DESC LIMIT 10";
		}
		else{
			$sql="SELECT DISTINCT fecha_inscripcion as fecha FROM `vparticipantes` WHERE fecha_inscripcion<=now() and  estado_inscripcion!='B' and codempresa='".$_SESSION['crmEmpresa']."' order by fecha_inscripcion DESC LIMIT 10";
		}
		return $mysqli->query($sql); 
	}

	function inscritosNXD($fecha){
		require  'conectar.php';
		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT sum(cant_participante+cant_acom_mayor+cant_acomp_menor) as total FROM `inscripcion` WHERE fecha_inscripcion='$fecha'";
		}
		else{
			$sql="SELECT sum(cant_participante+cant_acom_mayor+cant_acomp_menor) as total FROM `inscripcion` WHERE fecha_inscripcion='$fecha' AND codempresa='".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql); 
	}

	function extraerOrdeniscritos(){
		require  'conectar.php';
		$sql="SELECT ifnull(max(orden_fin+1), 1) as mayor FROM `control_kit` WHERE codempresa='".$_SESSION['crmEmpresa']."' and estado='A'";
		return $mysqli->query($sql); 
	}

	function extraerPagos($c1,$c2,$c3,$ie,$cod){
		require  'conectar.php';
		$sql="SELECT sum(cant_participante*$c1) as participantes, sum(cant_acom_mayor*$c2) as acompanantes, sum(cant_acomp_menor*$c3) as ninos, fecha_deposito as fecha, sum(cant_participante) as cp, sum(cant_acom_mayor) as cac, sum(cant_acomp_menor) as cam, deposito as foto_deposito, comentario, orden_ini as ini, orden_fin as fin FROM `control_kit` WHERE inscrito_en='$ie' and codinscripcion='$cod'";
		return $mysqli->query($sql); 
	}
	function extraerFotoDeposito($ie,$cod){
		require  'conectar.php';
		$sql="SELECT deposito as foto_deposito FROM `control_kit` WHERE inscrito_en='$ie' and codinscripcion='$cod'";
		return $mysqli->query($sql); 
	}
	function extraerOrdenpagada($ie,$cod){
		require  'conectar.php';
		$sql="SELECT orden_ini as ini, orden_fin as fin FROM `control_kit` WHERE inscrito_en='$ie' and codinscripcion='$cod'";
		return $mysqli->query($sql); 
	}

	function extraerComentarioCk($cod,$ie)
	{
		require  'conectar.php';
		$sql="SELECT comentario FROM `control_kit` WHERE inscrito_en='$ie' and codinscripcion='$cod'";
		return $mysqli->query($sql); 
	}

	function extraerinscritoen3($ie)
	{
		require  'conectar.php';
		$sql="SELECT * FROM `inscrito_en` WHERE codinscritoen='$ie'";
		return $mysqli->query($sql); 
	}

	function extraerActividad2(){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `actividades` WHERE  condicion!='C'";
		}
		else{
			$sql="SELECT * FROM `actividades` WHERE codempresa='".$_SESSION['crmEmpresa']."' and condicion!='C'";
		}
		return $mysqli->query($sql); 
	}
	function extraerCargo(){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `parametros` WHERE  estado='A' and descripcion='CAR'";
		}
		else{
			$sql="SELECT * FROM `parametros` WHERE codempresa='".$_SESSION['crmEmpresa']."' and estado='A' and descripcion='CAR'";
		}
		return $mysqli->query($sql); 
	}

	function extraerSede(){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `parametros` WHERE  estado='A' and descripcion='SD'";
		}
		else{
			$sql="SELECT * FROM `parametros` WHERE codempresa='".$_SESSION['crmEmpresa']."' and estado='A' and descripcion='SD'";
		}
		return $mysqli->query($sql); 
	}

	function extraerExperiencia(){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `parametros` WHERE  estado='A' and descripcion='EXL'";
		}
		else{
			$sql="SELECT * FROM `parametros` WHERE codempresa='".$_SESSION['crmEmpresa']."' and estado='A' and descripcion='EXL'";
		}
		return $mysqli->query($sql); 
	}
 	function extaerInscritos2(){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `inscripcion` ";
		}
		elseif($_SESSION['crmRanking']==2){
			$sql="SELECT * FROM `inscripcion` WHERE codempresa='".$_SESSION['crmEmpresa']."' ";
		}
		else{
			$sql="
			SELECT 
				a.* 
			FROM 
				`inscripcion` a,
				`profesor` b,
				`secciones_enc` c,
				`secciones_det` d
			WHERE 
					a.codempresa='".$_SESSION['crmEmpresa']."' 
				and a.codinscripcion=d.codinscripcion
				and b.codprofesor='".$_SESSION['crmProfesor']."'
				and b.codempresa=a.codempresa
				and b.codprofesor=c.codprofesor
				
				and c.codempresa=a.codempresa
				and c.codseccion_enc=d.codseccion_enc

				and d.codempresa=c.codempresa
			";
		}
		return $mysqli->query($sql); 
	}

	function extaerInscritosUDT2($id,$empresa){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `inscripcion` WHERE `codinscripcion`='$id' and `codempresa`='$empresa'";
		}
		else{
			$sql="SELECT * FROM `inscripcion` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."' AND `codinscripcion`='$id'";
		}
		return $mysqli->query($sql); 
	}

	function extraerProfesor(){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `profesor`  ";
		}
		else{
			$sql="SELECT * FROM `profesor` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql); 
	}
	function extraerProfesorUDT($id,$empresa){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="
			SELECT 
				a.*,
				b.username,
				b.codusuario
			FROM 
				`profesor` a, 
				`usuario` b 
			WHERE 
					a.codprofesor='$id' 
				and a.codempresa='$empresa'
				and a.codprofesor=b.codprofesor
				and a.codempresa=b.codempresa
			";
		}
		else{
			$sql="
			SELECT 
				a.*,
				b.username,
				b.codusuario
			FROM 
				`profesor` a, 
				`usuario` b 
			WHERE 
					a.codprofesor='$id' 
				and a.codempresa='$empresa'
				and a.codprofesor=b.codprofesor
				and a.codempresa='".$_SESSION['crmEmpresa']."'
				and b.codempresa=a.codempresa
			";
		}
		return $mysqli->query($sql); 
	}

	function extraerCurso(){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `cursos`  ";
		}
		elseif ($_SESSION['crmRanking']==2){
			$sql="SELECT * FROM `cursos` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."'";
		}
		else{
			$sql="
				SELECT 
					a.* 
				FROM 
					`cursos` a,
					`secciones_enc` b
				WHERE  
						a.codempresa='".$_SESSION['crmEmpresa']."'
					and a.codcurso=b.codcurso
					and b.codprofesor='".$_SESSION['crmProfesor']."'
				";
		}
		return $mysqli->query($sql); 
	}

	function extraerCursoUDT($id,$empresa){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `cursos` WHERE `codcurso`='$id' and `codempresa`='$empresa'";
		}
		else{
			$sql="SELECT * FROM `cursos` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."' and `codcurso`='$id'";
		}
		return $mysqli->query($sql); 
	}

	
	function extraerSeccionesENC(){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `secciones_enc` where `estado`='A'";
		}
		elseif ($_SESSION['crmRanking']==2){
			$sql="SELECT * FROM `secciones_enc` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."' and `estado`='A'";
		}
		else{
			$sql="
			SELECT 
				* 
			FROM 
				`secciones_enc` 
			WHERE  
					`codempresa`='".$_SESSION['crmEmpresa']."' 
				and `estado`='A' 
				and codprofesor='".$_SESSION['crmProfesor']."'
			";
		}
		return $mysqli->query($sql); 
	}

	function extraerSeccionesENCUDT($id,$empresa){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `secciones_enc` WHERE `codseccion_enc`='$id' and `codempresa`='$empresa'";
		}
		else{
			$sql="SELECT * FROM `secciones_enc` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."' and `codseccion_enc`='$id'";
		}
		return $mysqli->query($sql); 
	}

	function extraerSeccionesDET(){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `secciones_det`  ";
		}
		else{
			$sql="SELECT * FROM `secciones_det` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql); 
	}

	function extraerSeccionesDET2($id){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `secciones_det` where `codseccion_enc`='$id' ";
		}
		else{
			$sql="SELECT * FROM `secciones_det` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."' and `codseccion_enc`='$id'";
		}
		return $mysqli->query($sql); 
	}

	function extraerSeccionesDETUDT($id){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `secciones_det` where `codseccion_det`='$id' ";
		}
		else{
			$sql="SELECT * FROM `secciones_det` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."' and `codseccion_det`='$id'";
		}
		return $mysqli->query($sql); 
	}

	function extraerAsistenciaENC(){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `asistencia_enc`  ";
		}
		elseif ($_SESSION['crmRanking']==2){
			$sql="SELECT * FROM `asistencia_enc` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."'";
		}
		else{
			$sql="
			SELECT 
				* 
			FROM 
				asistencia_enc a,  
				secciones_enc b
			WHERE  
					a.codempresa='".$_SESSION['crmEmpresa']."'
				and a.codseccion_enc=b.codseccion_enc
				and b.codprofesor='".$_SESSION['crmProfesor']."'
			";
		}
		return $mysqli->query($sql); 
	}

	function extraerAsistenciaENCUDT($id){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `asistencia_enc` where `codasistencia_enc`='$id'";
		}
		else{
			$sql="SELECT * FROM `asistencia_enc` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."' and `codasistencia_enc`='$id'";
		}
		return $mysqli->query($sql); 
	}

	function extraerAsistenciaDETUDT2($id){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT * FROM `asistencia_det` where `codasistencia_enc`='$id'";
		}
		
		else{
			$sql="SELECT * FROM `asistencia_det` WHERE  `codempresa`='".$_SESSION['crmEmpresa']."' and `codasistencia_enc`='$id'";
		}
		return $mysqli->query($sql); 
	}

	function extraerAsistenciaDETSUM($id){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="
				(
					SELECT 
						DISTINCT 
						condicion,
						COUNT(*) as total 
					FROM 
						`asistencia_det`
					where 
							`codasistencia_enc`='$id' 
						and condicion='A'
				)
				UNION
				(
					SELECT 
						DISTINCT 
						condicion,
						COUNT(*) as total 
					FROM 
						`asistencia_det`
					where 
							`codasistencia_enc`='$id' 
						and condicion='P'
				)";
		}
		else{
			$sql="(SELECT DISTINCT condicion ,COUNT(*) as total FROM `asistencia_det` where `codasistencia_enc`='$id' and condicion='A' and `codempresa`='".$_SESSION['crmEmpresa']."')UNION(SELECT DISTINCT condicion ,COUNT(*) as total FROM `asistencia_det` where `codasistencia_enc`='$id' and condicion='P' and `codempresa`='".$_SESSION['crmEmpresa']."')";
		}
		return $mysqli->query($sql); 
	}

	function extraerAsistenciaCURSO($id){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT b.descripcion as asignatura FROM asistencia_enc a, cursos b, secciones_enc c WHERE a.codseccion_enc= c.codseccion_enc and b.codcurso=c.codcurso and a.codasistencia_enc='$id'";
		}
		else{
			$sql="
			SELECT 
				b.descripcion as asignatura 
			FROM 
				asistencia_enc a, 
				cursos b, 
				secciones_enc c 
			WHERE 
					a.codseccion_enc= c.codseccion_enc 
				and b.codcurso=c.codcurso 
				and a.codasistencia_enc='$id' 
				and a.codempresa='".$_SESSION['crmEmpresa']."' 
				and a.codempresa=b.codempresa
				and a.codempresa=c.codempresa
			";
		}
		return $mysqli->query($sql); 
	}
	function extraerCupoCursos($id){
		require  'conectar.php';
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT b.descripcion as curso, b.horas as horas_curso,SUM(a.horas)as horas_acum, b.horas-SUM(a.horas) horas_res FROM secciones_enc a, cursos b WHERE a.codcurso=b.codcurso and a.codempresa=b.codempresa and b.acomulativo='S' and b.codcurso='$id'";
		}
		
		else{
			$sql="SELECT b.descripcion as curso, b.horas as horas_curso,SUM(a.horas)as horas_acum, b.horas-SUM(a.horas) horas_res FROM secciones_enc a, cursos b WHERE a.codcurso=b.codcurso and a.codempresa=b.codempresa and b.acomulativo='S' and a.codempresa='".$_SESSION['crmEmpresa']."' and b.codempresa='".$_SESSION['crmEmpresa']."' and b.codcurso='$id'";
		}
		return $mysqli->query($sql); 
	}

	function extraerEstudiantesPermiso($id){
		require  'conectar.php';
		$fecha=date('Y-m-d');
		$empresa=$_SESSION['crmEmpresa'];
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT c.codinscripcion as id,concat(c.nombre,' ',c.apellido) as nombre FROM 
				asistencia_det a,
				asistencia_enc b,
				inscripcion c, 
				secciones_enc d, 
				secciones_det e 
				WHERE 
					a.condicion='P'
				and a.codasistencia_enc=b.codasistencia_enc
				and d.codseccion_enc = e.codseccion_enc 
				and b.codseccion_enc=d.codseccion_enc 
				and c.codinscripcion=e.codinscripcion 
				and c.codinscripcion=a.codinscripcion
				and date(b.fecha)='$fecha'
				and b.codseccion_enc='$id'
				and e.estado='A'
				and a.codinscripcion NOT IN (
										SELECT 
											codinscripcion 
										FROM 
											permisos
										WHERE 
												date(b.fecha)='$fecha' 
											and estado='A'
											and estado_permiso='A'
										)
				";
		}
		
		

		else{
			$sql="
			SELECT 
				c.codinscripcion as id,
				concat(c.nombre,' ',c.apellido) as nombre 
			FROM 
				asistencia_det a,
				asistencia_enc b,
				inscripcion c, 
				secciones_enc d, 
				secciones_det e 
			WHERE 
					b.codempresa='$empresa' 
				and date(b.fecha)='$fecha'
				and b.codseccion_enc=d.codseccion_enc 
				
				and a.condicion='P'
				and a.codempresa=b.codempresa 
				and a.codasistencia_enc=b.codasistencia_enc
				and a.codinscripcion=c.codinscripcion
				and a.codinscripcion NOT IN (
										SELECT 
											codinscripcion 
										FROM 
											permisos
										WHERE 
												date(b.fecha)='$fecha' 
											and estado='A'
											and estado_permiso='A'
										)
				
				and c.codempresa=b.codempresa 
				
				and d.codseccion_enc='$id'
				and d.codempresa=c.codempresa 
				and d.codseccion_enc = e.codseccion_enc 

				and e.codempresa=d.codempresa 
				and e.codinscripcion=c.codinscripcion
				and e.estado='A' 
				";
		}
		return $mysqli->query($sql); 
	}

	function extraerPermisos(){
		require  'conectar.php';
		$fecha=date('Y-m-d');
		if ($_SESSION['crmRanking']==1){
			$sql="SELECT 
				d.codinscripcion as id, 
				a.codpermiso as codigo, 
				CONCAT(d.nombre,' ',d.apellido) as nombres, 
				a.estado_permiso, 
				a.estado, 
				b.descripcion as seccion,
				-- COUNT(*)as total_p,
				a.fecha,
				e.codempresa, 
				a.hora_fin as fin,
				a.hora_ini as ini,
				b.descripcion as seccion,
				c.descripcion as curso
				FROM 
				`permisos` a, 
				`secciones_enc` b,
				`cursos` c, 
				`inscripcion` d, 
				`empresa` e 
				WHERE 
				a.codseccion=b.codseccion_enc 
				and a.codempresa=e.codempresa 
				and a.codinscripcion=d.codinscripcion
				and a.codempresa = c.codempresa 
				and b.codcurso=c.codcurso
				";
		}
		
		elseif ($_SESSION['crmRanking']==2){
			$sql="SELECT 
				d.codinscripcion as id, 
				a.codpermiso as codigo, 
				CONCAT(d.nombre,' ',d.apellido) as nombres, 
				a.estado_permiso, 
				a.estado, 
				b.descripcion as seccion,
				-- COUNT(*)as total_p,
				a.fecha,
				e.codempresa, 
				a.hora_fin as fin,
				a.hora_ini as ini,
				b.descripcion as seccion,
				c.descripcion as curso
				FROM 
				`permisos` a, 
				`secciones_enc` b, 
				`cursos` c, 
				`inscripcion` d, 
				`empresa` e 
				WHERE 
				a.codseccion=b.codseccion_enc 
				and a.codinscripcion=d.codinscripcion
				and a.codempresa ='".$_SESSION['crmEmpresa']."' 
				and a.codempresa = b.codempresa 
				and a.codempresa = c.codempresa 
				and b.codcurso=c.codcurso
				and a.codempresa = d.codempresa  
				and a.codempresa = e.codempresa 
				";
		}

		else{
			$sql="SELECT 
				d.codinscripcion as id, 
				a.codpermiso as codigo, 
				CONCAT(d.nombre,' ',d.apellido) as nombres, 
				a.estado_permiso, 
				a.estado, 
				b.descripcion as seccion,
				a.fecha,
				e.codempresa, 
				a.hora_fin as fin,
				a.hora_ini as ini,
				b.descripcion as seccion,
				c.descripcion as curso
				FROM 
				`permisos` a, 
				`secciones_enc` b,
				`cursos` c, 
				`inscripcion` d, 
				`empresa` e 
				WHERE 
				a.codseccion=b.codseccion_enc 
				and a.codinscripcion=d.codinscripcion
				and a.codempresa ='".$_SESSION['crmEmpresa']."' 
				and a.codempresa = b.codempresa 
				and a.codempresa = d.codempresa  
				and a.codempresa = e.codempresa 
				and a.codempresa = c.codempresa 
				and b.codcurso=c.codcurso
				and b.codprofesor = '".$_SESSION['crmProfesor']."' 
				";
		}
		return $mysqli->query($sql); 
	}

	function extraerPermisosUDT($id){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT a.estado_permiso, a.hora_ini, a.hora_fin, a.estado, concat(b.nombre,' ', b.apellido) as nombres, a.codpermiso as codigo FROM permisos a, inscripcion b where a.codpermiso='$id' and a.codinscripcion=b.codinscripcion ";
		} 		
		else{
			$sql="SELECT a.estado_permiso, a.hora_ini, a.hora_fin, a.estado, concat(b.nombre,' ', b.apellido) as nombres, a.codpermiso as codigo FROM permisos a, inscripcion b where a.codpermiso='$id' and a.codinscripcion=b.codinscripcion and  a.estado = 'A'";
		}
		return $mysqli->query($sql);
	}

	function extraerTiketdataUDT($id){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT 
				a.nombre,
				a.apellido,
				a.codinscripcion,
				a.cedula,
				b.descripcion as curso
				FROM 
				inscripcion a, 
				cursos b, 
				secciones_enc c, 
				secciones_det d 
				WHERE
				c.codseccion_enc= d.codseccion_enc AND
				a.codinscripcion=d.codinscripcion AND
				b.codcurso= c.codcurso AND 
				a.codempresa=b.codempresa AND
				a.codempresa=c.codempresa AND
				a.codempresa=d.codempresa AND
				c.estado='A' AND
				d.estado='A' AND
				b.estado='A' AND 
				a.codinscripcion='$id'";
		} 		
		else{
			$sql="SELECT 
				a.nombre,
				a.apellido,
				a.codinscripcion,
				a.cedula,
				b.descripcion as curso
				FROM 
				inscripcion a, 
				cursos b, 
				secciones_enc c, 
				secciones_det d 
				WHERE
				c.codseccion_enc= d.codseccion_enc AND
				a.codinscripcion=d.codinscripcion AND
				b.codcurso= c.codcurso AND 
				a.codempresa=b.codempresa AND
				a.codempresa=c.codempresa AND
				a.codempresa=d.codempresa AND
				c.estado='A' AND
				d.estado='A' AND
				b.estado='A' AND 
				a.codinscripcion='$id' 
				and a.codempresa='".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);
	}

	function extraerReEstudiantesPermiso($curso,$f1,$f2){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT DISTINCT 
			CONCAT(c.nombre,' ',c.apellido) as nombres, 
			c.codinscripcion as matricula 
			FROM 
			asistencia_enc a,
			asistencia_det b, 
			inscripcion c,
			secciones_enc d
			WHERE 
			b.codinscripcion=c.codinscripcion and 
			a.codasistencia_enc=b.codasistencia_enc and 
			d.codcurso='$curso'and 
			a.codseccion_enc=d.codseccion_enc and 
			date(a.fecha) between '$f1' and '$f2'";
		} 		
		else{
			$sql=" SELECT DISTINCT 
			CONCAT(c.nombre,' ',c.apellido) as nombres, 
			c.codinscripcion as matricula 
			FROM 
			asistencia_enc a,
			asistencia_det b, 
			inscripcion c,
			secciones_enc d
			WHERE 
			b.codinscripcion=c.codinscripcion and 
			a.codasistencia_enc=b.codasistencia_enc and 
			d.codcurso='$curso'and 
			a.codseccion_enc=d.codseccion_enc and 
			a.codempresa='".$_SESSION['crmEmpresa']."' and b.codempresa='".$_SESSION['crmEmpresa']."' and
			date(a.fecha) between '$f1' and '$f2' ";
		}
		return $mysqli->query($sql);
		// return $sql;
	}

	function extraerReEstudiantesPermisocount($id,$f1,$f2){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT a.condicion from asistencia_det a, asistencia_enc b  WHERE a.codinscripcion='$id' and b.estado='A' and a.codasistencia_enc=b.codasistencia_enc and date(b.fecha) between '$f1' and '$f2'";
		} 		
		else{
			$sql="SELECT a.condicion from asistencia_det a, asistencia_enc b  WHERE a.codinscripcion='$id' and b.estado='A' and a.codasistencia_enc=b.codasistencia_enc and a.codempresa='".$_SESSION['crmEmpresa']."' and b.codempresa='".$_SESSION['crmEmpresa']."' and date(b.fecha) between '$f1' and '$f2'";
		}
		return $mysqli->query($sql);
	}

	//*********************************************************** 
	//** DESDE AQUI TRABAJO DE HAROLD TEJADA 					*
	//** ULTIMA MODIFICACION FUNCION DE PROVINCIAS 				*
	//** 21 de SEPTIEMBRE DEL 2017								*
	//***********************************************************
	function extraerPaises(){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM pais";
		} 		
		else{
			$sql="SELECT * FROM pais where estado = 'A'";
		}
		return $mysqli->query($sql);
	}

	function extraerPaisUDT($id){
		include('conectar.php');
		$sql="SELECT * from pais where codpais='$id'";
		return $mysqli->query($sql);
	}

	
	function extraerProvincias(){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT provincias_pais.codprovincia, provincias_pais.descripcion, provincias_pais.estado, provincias_pais.codpais, pais.descripcion as pais, provincias_pais.usuario, provincias_pais.estado FROM provincias_pais, pais where pais.codpais = provincias_pais.codpais";
		}
		else{
			$sql="SELECT provincias_pais.codprovincia, provincias_pais.descripcion, provincias_pais.estado, provincias_pais.codpais, pais.descripcion as pais, provincias_pais.usuario, provincias_pais.estado FROM provincias_pais, pais where pais.codpais = provincias_pais.codpais and provincias_pais.estado = 'A'";
		}
		return $mysqli->query($sql);
	}

	function extraerProvinciasUDT($id){
		include('conectar.php');
		$sql="SELECT provincias_pais.codprovincia, provincias_pais.descripcion, provincias_pais.estado, provincias_pais.codpais, pais.descripcion as pais, provincias_pais.usuario, provincias_pais.estado FROM provincias_pais, pais where pais.codpais = provincias_pais.codpais 
			and provincias_pais.codprovincia='$id'";
		return $mysqli->query($sql);
	}	

	function extraerDepositosLib($ranking,$empresa){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM control_depositos_libreta";
		}
		else{
			$sql="SELECT * FROM control_depositos_libreta where codempresa = '".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);
	}

	function extraerDepositosLibUDT($empresa, $id){
		include('conectar.php');
		if ($_SESSION['crmRanking'] ==1){
		$sql="SELECT * FROM control_depositos_libreta where coddeposito ='$id'";
		}
		else{
			$sql="SELECT * FROM control_depositos_libreta where coddeposito ='$id' and codempresa ='$empresa'";
		}
		return $mysqli->query($sql);
	}	

	function extraerNacionalidades(){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM nacionalidad";
		}
		else{
			$sql="SELECT * FROM nacionalidad where codempresa = '".$_SESSION['crmEmpresa']."'";
		}
		return $mysqli->query($sql);
	}

	function extraerNacionalidadesUDT($empresa,$id){
		include('conectar.php');	
		$sql="SELECT * from nacionalidad where codnacionalidad='$id' and codempresa='$empresa'";
		return $mysqli->query($sql);
	}

	function extraerInscritos($ranking, $empresa){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM inscripcion";
		} 		
		else{
			$sql="SELECT * FROM inscripcion where codempresa = '$empresa' ";
		}
		return $mysqli->query($sql);
	}

	function extraerInscritosUDT($empresa, $id){
		include('conectar.php');
		$sql="SELECT * from vinscritos where codinscripcion='$id' and inscrito_en = 'L' and codempresa = '$empresa'";
		return $mysqli->query($sql);
	}

	function extraerInscritoEn($ranking, $empresa){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM inscrito_en";
		} 		
		else{
			$sql="SELECT * FROM inscrito_en where codempresa = '$empresa' ";
		}
		return $mysqli->query($sql);
	}

	function extraerInscritoEn2($ranking, $empresa){
		include('conectar.php');

		if ($_SESSION['crmRanking'] ==1){
			$sql="SELECT * FROM inscrito_en where codinscritoen <> 'L' order by 1 desc";
		} 		
		else{
			$sql="SELECT * FROM inscrito_en where codempresa = '$empresa' and codinscritoen <> 'L' order by 1 desc";
		}
		return $mysqli->query($sql);
	}

	function extraerInscritoEnUDT($empresa, $id){
		include('conectar.php');
		$sql="SELECT * from inscrito_en where codinscritoen='$id' and codempresa = '$empresa'";
		return $mysqli->query($sql);
	}

	function extraerRepInscritosTotal($ranking, $empresa, $actividad, $lugar){
		include('conectar.php');		
		if ($ranking ==1){
			$sql="SELECT a.actividad as actividad, a.lugar, a.descripcion, a.cantidad_paga as cantidad, a.costo, a.total, a.codempresa FROM vtotal_inscritos a where a.inscrito_en = '$lugar' and a.codactividad = '$actividad'";
		} 		
		else{
			$sql="SELECT a.actividad as actividad, a.lugar, a.descripcion, a.cantidad_paga as cantidad, a.costo, a.total, a.codempresa FROM vtotal_inscritos a where a.inscrito_en = '$lugar' and a.codactividad = '$actividad' and a.codempresa = '$empresa'";
		}

		/*
		if ($revisado == 'A'){ // el caso de otro valor L o C
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT b.descripcion as actividad, a.descripcion, a.cantidad, a.costo, a.total, a.codempresa FROM vtotal_inscritos a, actividades b where a.inscrito_en = '$revisado' and a.codempresa = b.codempresa and a.codactividad =  b.codactividad";
			} 		
			else{
				$sql="SELECT b.descripcion as actividad, a.descripcion, a.cantidad, a.costo, a.total, a.codempresa FROM vtotal_inscritos a, actividades b where a.inscrito_en = '$revisado' and a.codempresa = '$empresa' and a.codempresa = b.codempresa and a.codactividad =  b.codactividad";
			}
		}
		elseif ($revisado == 'L'){ // el caso de otro valor L o C
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT b.descripcion as actividad, a.descripcion, a.cantidad, a.costo, a.total, a.codempresa FROM vtotal_inscritos a, actividades b where a.inscrito_en = '$revisado' and a.codempresa = b.codempresa and a.codactividad =  b.codactividad";
			} 		
			else{
				$sql="SELECT b.descripcion as actividad, a.descripcion, a.cantidad, a.costo, a.total, a.codempresa FROM vtotal_inscritos a, actividades b where a.inscrito_en = '$revisado' and a.codempresa = '$empresa' and a.codempresa = b.codempresa and a.codactividad =  b.codactividad";
			}
		}
		elseif ($revisado == 'C'){ // el caso de otro valor L o C
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT b.descripcion as actividad, a.descripcion, a.cantidad, a.costo, a.total, a.codempresa FROM vtotal_inscritos a, actividades b where a.inscrito_en = '$revisado' and a.codempresa = b.codempresa and a.codactividad =  b.codactividad";
			} 		
			else{
				$sql="SELECT b.descripcion as actividad, a.descripcion, a.cantidad, a.costo, a.total, a.codempresa FROM vtotal_inscritos a, actividades b where a.inscrito_en = '$revisado' and a.codempresa = '$empresa' and a.codempresa = b.codempresa and a.codactividad =  b.codactividad";
			}
		}
		else {
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT b.descripcion as actividad, a.descripcion, sum(a.cantidad) as cantidad, sum(a.costo) as costo,  CASE 
									  WHEN a.inscrito_en = 'A' THEN (a.total)
									  ELSE SUM(A.TOTAL)
									  END AS total, a.codempresa FROM vtotal_inscritos a, actividades b 
									  where a.codempresa = b.codempresa and a.codactividad =  b.codactividad
									  and a.inscrito_en = 'A'
						group by a.descripcion";
			} 		
			else{
				$sql="SELECT b.descripcion as actividad, a.descripcion, sum(a.cantidad) as cantidad, sum(a.costo) as costo, CASE 
									  WHEN a.inscrito_en = 'A' THEN (a.total)
									  ELSE SUM(A.TOTAL)
									  END AS total, a.codempresa FROM vtotal_inscritos a, actividades b where a.codempresa = '$empresa' and a.codempresa = b.codempresa and a.codactividad =  b.codactividad
									  and a.inscrito_en = 'A'
					group by a.descripcion";
			}*/
			
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

	function extraerCostosActividad($id,$empresa){
		include('conectar.php');
		$sql="SELECT codactividad, descripcion, costo_participante, costo_invitado, costo_ninos FROM actividades WHERE estado = 'A' 
			and codactividad = '$id'
			and codempresa='$empresa'";
		
		$result=$mysqli->query($sql);
		return $result;
	}

	function extraerInscritosClub($ranking, $empresa, $actividad, $lugar){
		include('conectar.php');
		
		if ($lugar == 'A'){	//TODOS LOS LUGARES DE INSCRIPCION EXCEPTO EN LINEA
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT a.codinscripcion, a.inscrito_en, a.nombre, a.cant_participante, a.cant_acom_mayor, a.cant_acomp_menor, a.pagado, a.pendiente, a.recibido, a.monto_devuelto, b.descripcion, c.descripcion as lugar, a.codempresa FROM inscripcion a, actividades b, inscrito_en c where a.inscrito_en <> 'L' and a.codactividad = '$actividad' and a.codactividad = b.codactividad and a.codempresa = b.codempresa and a.codempresa = c.codempresa and a.inscrito_en = c.codinscritoen";
			} 		
			else{
				$sql="SELECT a.codinscripcion, a.inscrito_en, a.nombre, a.cant_participante, a.cant_acom_mayor, a.cant_acomp_menor, a.pagado, a.pendiente, a.recibido, a.monto_devuelto, b.descripcion, c.descripcion as lugar, a.codempresa FROM inscripcion a, actividades b, inscrito_en c where a.inscrito_en <> 'L' and a.codactividad = '$actividad' and a.codactividad = b.codactividad and a.codempresa = b.codempresa and a.codempresa = '$empresa' and a.codempresa = c.codempresa and a.inscrito_en = c.codinscritoen";
			}	
		}
		else {
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT a.codinscripcion, a.inscrito_en, a.nombre, a.cant_participante, a.cant_acom_mayor, a.cant_acomp_menor, a.pagado, a.pendiente, a.recibido, a.monto_devuelto, b.descripcion, c.descripcion as lugar, a.codempresa FROM inscripcion a, actividades b, inscrito_en c where a.inscrito_en <> 'L' and a.inscrito_en = '$lugar' and a.codactividad = '$actividad' and a.codactividad = b.codactividad and a.codempresa = b.codempresa and a.codempresa = c.codempresa and a.inscrito_en = c.codinscritoen";
			} 		
			else{
				$sql="SELECT a.codinscripcion, a.inscrito_en, a.nombre, a.cant_participante, a.cant_acom_mayor, a.cant_acomp_menor, a.pagado, a.pendiente, a.recibido, a.monto_devuelto, b.descripcion, c.descripcion as lugar, a.codempresa FROM inscripcion a, actividades b, inscrito_en c where a.inscrito_en <> 'L' and a.inscrito_en = '$lugar' and a.codactividad = '$actividad' and a.codactividad = b.codactividad and a.codempresa = b.codempresa and a.codempresa = '$empresa' and a.codempresa = c.codempresa and a.inscrito_en = c.codinscritoen";
			}		
		}

		return $mysqli->query($sql);
		
	}

	function extraerInscritosLinea($ranking, $empresa, $actividad, $revisado){ //para trabajar con los filtros
		include('conectar.php');

		if ($revisado != 'A') {
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT * FROM inscripcion where inscrito_en = 'L' and estado_inscripcion <> 'B' and revisado = '$revisado' and codactividad = '$actividad'";
			} 		
			else{
				$sql="SELECT * FROM inscripcion where codempresa = '$empresa' and inscrito_en = 'L' and estado_inscripcion <> 'B' and revisado = '$revisado' and codactividad = '$actividad'";
			}
		}
		else {
				if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT * FROM inscripcion where inscrito_en = 'L' and estado_inscripcion <> 'B' and codactividad = '$actividad'";
			} 		
			else{
				$sql="SELECT * FROM inscripcion where codempresa = '$empresa' and inscrito_en = 'L' and estado_inscripcion <> 'B' and codactividad = '$actividad'";
			}
		}	
		return $mysqli->query($sql);
	}


	function extraerInscritosLinea2($ranking, $empresa, $actividad, $revisado){ //para trabajar con los filtros
		include('conectar.php');
		// revisado = T, S, N
				
		if ($ranking ==1){
			$sql="SELECT a.codempresa, a.codinscripcion, a.inscrito_en, a.nombre, a.apellido, a.cedula, a.contacto_emergencia, a.telefono_emergencia, b.descripcion as actividad FROM inscripcion a, actividades b where a.inscrito_en = 'L' and a.revisado = '$revisado' and a.codactividad = '$actividad' and a.codempresa = b.codempresa and a.codactividad = b.codactividad";
			} 		
		else{
			$sql="SELECT a.codempresa, a.codinscripcion, a.inscrito_en, a.nombre, a.apellido, a.cedula, a.contacto_emergencia, a.telefono_emergencia, b.descripcion as actividad FROM inscripcion a, actividades b where a.codempresa = '$empresa' and a.inscrito_en = 'L' and a.revisado = '$revisado' and a.codactividad = '$actividad' and a.codempresa = b.codempresa and a.codactividad = b.codactividad";
			}		
		return $mysqli->query($sql);
	}

	function extraerInscritosGrupos($ranking, $empresa, $actividad, $revisado){
		include('conectar.php');

		if ($revisado=='S'){
			if ($ranking ==1){
				$sql="SELECT a.codempresa, a.codgrupo, b.descripcion as grupo, SUM(d.cant_participante) as inscritos, SUM(d.cant_acom_mayor) as inscritos_may, sum(d.cant_acomp_menor) as inscritos_men,
					(SUM(d.cant_participante)+ SUM(d.cant_acom_mayor)+ sum(d.cant_acomp_menor)) as total,
					c.descripcion as actividad 
					FROM inscripcion a, grupos_pais b, actividades c, control_kit d 
					WHERE a.revisado = '$revisado' 
					and a.codactividad = '$actividad'
					and a.estado_inscripcion <> 'B'
					and b.codempresa = a.codempresa
					and b.codgrupo = a.codgrupo
					and c.codempresa = a.codempresa
					and c.codactividad = a.codactividad
					and a.codempresa = d.codempresa
	                and a.codinscripcion = d.codinscripcion
	                and a.inscrito_en = d.inscrito_en
					group by a.codgrupo, b.descripcion, c.descripcion
					UNION
					SELECT a.codempresa,'0000', 'TOTAL GRUPOS' AS grupo, SUM(d.cant_participante) AS inscritos, SUM(d.cant_acom_mayor) AS inscritos_may, SUM(d.cant_acomp_menor) AS inscritos_men, (SUM(d.cant_participante) + SUM(d.cant_acom_mayor) + SUM(d.cant_acomp_menor)) AS total, c.descripcion as actividad
					FROM inscripcion a, actividades c, control_kit d
					WHERE a.revisado = '$revisado' 
					and a.codactividad = '$actividad'
					and a.estado_inscripcion <> 'B'
					and c.codempresa = a.codempresa
					and c.codactividad = a.codactividad
					and a.codempresa = d.codempresa
	                and a.codinscripcion = d.codinscripcion
	                and a.inscrito_en = d.inscrito_en
					group by c.descripcion
					";
			} 		
			else
			{
				$sql="SELECT a.codempresa, a.codgrupo, b.descripcion as grupo, SUM(d.cant_participante) as inscritos, SUM(d.cant_acom_mayor) as inscritos_may, sum(d.cant_acomp_menor) as inscritos_men,
					(SUM(d.cant_participante)+ SUM(d.cant_acom_mayor)+ sum(d.cant_acomp_menor)) as total,
					c.descripcion as actividad 
					FROM inscripcion a, grupos_pais b, actividades c, control_kit d 
					WHERE a.revisado = '$revisado' 
					and a.codactividad = '$actividad'
					and a.codempresa = '$empresa'
					and a.estado_inscripcion <> 'B'
					and b.codempresa = a.codempresa
					and b.codgrupo = a.codgrupo
					and c.codempresa = a.codempresa
					and c.codactividad = a.codactividad
					and a.codempresa = d.codempresa
	                and a.codinscripcion = d.codinscripcion
	                and a.inscrito_en = d.inscrito_en
					group by a.codgrupo, b.descripcion, c.descripcion
					UNION
					SELECT a.codempresa,'0000', 'TOTAL GRUPOS' AS grupo, SUM(d.cant_participante) AS inscritos, SUM(d.cant_acom_mayor) AS inscritos_may, SUM(d.cant_acomp_menor) AS inscritos_men, (SUM(d.cant_participante) + SUM(d.cant_acom_mayor) + SUM(d.cant_acomp_menor)) AS total, c.descripcion as actividad
					FROM inscripcion a, actividades c, control_kit d
					WHERE a.revisado = '$revisado' 
					and a.codactividad = '$actividad'
					and a.estado_inscripcion <> 'B'
					and a.codempresa = '$empresa'
					and c.codempresa = a.codempresa
					and c.codactividad = a.codactividad
					and a.codempresa = d.codempresa
	                and a.codinscripcion = d.codinscripcion
	                and a.inscrito_en = d.inscrito_en
					group by c.descripcion";
			}
		}	
		elseif ($revisado=='N'){
			if ($ranking ==1){
				$sql="SELECT a.codempresa, 
						a.codgrupo, 
						a.grupo, 
						sum(a.inscritos) as inscritos, 
						sum(a.inscritos_may) as inscritos_may,   
						sum(a.inscritos_men) as inscritos_men,
						(sum(a.inscritos)+
						 sum(a.inscritos_may)+
						 sum(a.inscritos_men)
						) as total,
						c.descripcion as actividad
						FROM vgrupos a, actividades c
						WHERE a.actividad = '$actividad'
						and a.codempresa = c.codempresa
						and a.actividad = c.codactividad
						group by a.codempresa, a.codgrupo, a.grupo, c.descripcion
					UNION
					SELECT a.codempresa, '0000' as codgrupo, 'TOTAL GRUPOS' as grupo, 
						sum(a.inscritos) as inscritos, 
						sum(a.inscritos_may) as inscritos_may,   
						sum(a.inscritos_men) as inscritos_men,
						(sum(a.inscritos)+
						 sum(a.inscritos_may)+
						 sum(a.inscritos_men)
						) as total,
						c.descripcion as actividad
						from vgrupos a, actividades c
						where a.actividad = '$actividad'
						and a.codempresa = c.codempresa
						and a.actividad = c.codactividad
						group by a.codempresa, c.descripcion
					";
			} 		
			else
			{
				$sql="SELECT a.codempresa, 
						a.codgrupo, 
						a.grupo, 
						sum(a.inscritos) as inscritos, 
						sum(a.inscritos_may) as inscritos_may,   
						sum(a.inscritos_men) as inscritos_men,
						(sum(a.inscritos)+
						 sum(a.inscritos_may)+
						 sum(a.inscritos_men)
						) as total,
						c.descripcion as actividad
						FROM vgrupos a, actividades c
						WHERE a.actividad = '$actividad'
						and a.codempresa = '$empresa'
						and a.codempresa = c.codempresa
						and a.actividad = c.codactividad
						group by a.codempresa, a.codgrupo, a.grupo, c.descripcion
					UNION
					SELECT a.codempresa, '0000' as codgrupo, 'TOTAL GRUPOS' as grupo, 
						sum(a.inscritos) as inscritos, 
						sum(a.inscritos_may) as inscritos_may,   
						sum(a.inscritos_men) as inscritos_men,
						(sum(a.inscritos)+
						 sum(a.inscritos_may)+
						 sum(a.inscritos_men)
						) as total,
						c.descripcion as actividad
						from vgrupos a, actividades c
						where a.actividad = '$actividad'
						and a.codempresa = '$empresa'
						and a.codempresa = c.codempresa
						and a.actividad = c.codactividad
						group by a.codempresa, c.descripcion";
			}	
		}
		else{ // en caso de ser A u otro valor los muestra todos
			if ($ranking ==1){
				$sql="SELECT a.codempresa, a.codgrupo, b.descripcion as grupo, SUM(a.cant_participante) as inscritos, SUM(a.cant_acom_mayor) as inscritos_may, sum(a.cant_acomp_menor) as inscritos_men,
					(SUM(a.cant_participante)+ SUM(a.cant_acom_mayor)+ sum(a.cant_acomp_menor)) as total,
					c.descripcion as actividad  
					FROM inscripcion a, grupos_pais b, actividades c
					WHERE a.codactividad = '$actividad'
					and a.estado_inscripcion <> 'B'
					and b.codempresa = a.codempresa
					and b.codgrupo = a.codgrupo
					and c.codempresa = a.codempresa
					and c.codactividad = a.codactividad
					group by a.codgrupo, b.descripcion, c.descripcion
					UNION
					SELECT a.codempresa,'0000', 'TOTAL GRUPOS' AS grupo, SUM(a.cant_participante) AS inscritos, SUM(a.cant_acom_mayor) AS inscritos_may, SUM(a.cant_acomp_menor) AS inscritos_men, (SUM(a.cant_participante) + SUM(a.cant_acom_mayor) + SUM(d.cant_acomp_menor)) AS total, c.descripcion as actividad
					FROM inscripcion a, actividades c
					WHERE a.codactividad = '$actividad'
					and a.estado_inscripcion <> 'B'					
					and c.codempresa = a.codempresa
					and c.codactividad = a.codactividad
					group by c.descripcion
					";
			} 		
			else{
				$sql="SELECT a.codempresa, a.codgrupo, b.descripcion as grupo, SUM(a.cant_participante) as inscritos, SUM(a.cant_acom_mayor) as inscritos_may, sum(a.cant_acomp_menor) as inscritos_men,
					(SUM(a.cant_participante)+ SUM(a.cant_acom_mayor)+ sum(a.cant_acomp_menor)) as total,
					c.descripcion as actividad  
					FROM inscripcion a, grupos_pais b, actividades c
					WHERE a.codactividad = '$actividad'
					and a.codempresa = '$empresa'
					and a.estado_inscripcion <> 'B'
					and b.codempresa = a.codempresa
					and b.codgrupo = a.codgrupo
					and c.codempresa = a.codempresa
					and c.codactividad = a.codactividad
					group by a.codgrupo, b.descripcion, c.descripcion
					UNION
					SELECT a.codempresa,'0000', 'TOTAL GRUPOS' AS grupo, SUM(a.cant_participante) AS inscritos, SUM(a.cant_acom_mayor) AS inscritos_may, SUM(a.cant_acomp_menor) AS inscritos_men, (SUM(a.cant_participante) + SUM(a.cant_acom_mayor) + SUM(a.cant_acomp_menor)) AS total, c.descripcion as actividad
					FROM inscripcion a, actividades c
					WHERE a.codactividad = '$actividad'
					and a.codempresa = '$empresa'
					and a.estado_inscripcion <> 'B'
					and c.codempresa = a.codempresa
					and c.codactividad = a.codactividad
					group by c.descripcion
					 ";
			}

		}
		
		return $mysqli->query($sql);
	}
	function extraerInscritosOrden($ranking, $empresa, $actividad){
		include('conectar.php');

		if ($ranking ==1){
			$sql="SELECT a.codempresa, a.codinscripcion, a.inscrito_en, a.nombre, a.apellido, a.codgrupo, b.descripcion as grupo, (d.cant_participante) as inscritos, d.orden_ini, d.orden_fin, d.fecha_deposito as fecha_saldo, c.descripcion as actividad, a.entregado 
				FROM inscripcion a, grupos_pais b, actividades c, control_kit d  
				WHERE b.codempresa = a.codempresa
				and b.codgrupo = a.codgrupo
				and a.revisado = 'S'
				-- and a.estado_inscripcion = 'P'
				-- and a.inscrito_en = 'L'
				and a.codactividad = '$actividad'
				and c.codempresa = a.codempresa
				and c.codactividad = a.codactividad
				and a.codempresa = d.codempresa
                and a.codinscripcion = d.codinscripcion
                and a.inscrito_en = d.inscrito_en
                and d.orden_ini <> 0
				";
		} 		
		else{
			$sql="SELECT a.codempresa, a.codinscripcion, a.inscrito_en, a.nombre, a.apellido, a.codgrupo, b.descripcion as grupo, (d.cant_participante) as inscritos, d.orden_ini, d.orden_fin, d.fecha_deposito as fecha_saldo, c.descripcion as actividad, a.entregado 
				FROM inscripcion a, grupos_pais b, actividades c, control_kit d 
				WHERE a.codempresa = '$empresa'
				and b.codempresa = a.codempresa
				and b.codgrupo = a.codgrupo
				and a.revisado = 'S'
				-- and a.estado_inscripcion = 'P'
				-- and a.inscrito_en = 'L'
				and a.codactividad = '$actividad'
				and c.codempresa = a.codempresa
				and c.codactividad = a.codactividad
				and a.codempresa = d.codempresa
                and a.codinscripcion = d.codinscripcion
                and a.inscrito_en = d.inscrito_en
                and d.orden_ini <> 0
				";
		}
		return $mysqli->query($sql);
	}

	function extraerResumenInscritos($ranking, $empresa, $actividad, $revisado){
		include('conectar.php');

		if ($revisado=='S'){ ///PAGOS
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT a.codempresa, a.codactividad, b.descripcion as actividad, 
					(sum(d.cant_participante)+sum(d.cant_acom_mayor)+sum(d.cant_acomp_menor)) as total,
					sum(d.cant_participante) as ciclistas, 
					sum(d.cant_acom_mayor) as acompanantes, 
					sum(d.cant_acomp_menor) as acompanantes_menor 
					FROM inscripcion a, actividades b, control_kit d
					WHERE a.codempresa = b.codempresa
					and a.codactividad = b.codactividad
					and a.codactividad = '$actividad'
					and a.revisado = '$revisado' 
					and a.estado_inscripcion <> 'B'
					and a.codempresa = d.codempresa
	                and a.codinscripcion = d.codinscripcion
	                and a.inscrito_en = d.inscrito_en
					GROUP by a.codempresa, a.codactividad, b.descripcion 
					";
			} 		
			else
			{
				$sql="SELECT a.codempresa, a.codactividad, b.descripcion as actividad, (sum(d.cant_participante)+sum(d.cant_acom_mayor)+sum(d.cant_acomp_menor)) as total,
					sum(d.cant_participante) as ciclistas, 
					sum(d.cant_acom_mayor) as acompanantes, 
					sum(d.cant_acomp_menor) as acompanantes_menor
					FROM inscripcion a, actividades b, control_kit d
					WHERE a.codempresa = b.codempresa
					and a.codactividad = b.codactividad
					and a.revisado = '$revisado' 
					and a.codempresa = '$empresa'
					and a.codactividad = '$actividad'
					and a.estado_inscripcion <> 'B'
					and a.codempresa = d.codempresa
	                and a.codinscripcion = d.codinscripcion
	                and a.inscrito_en = d.inscrito_en
					GROUP by a.codempresa, a.codactividad, b.descripcion";
			}
		}
		elseif ($revisado=='N'){ ///PAGOS
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT a.codempresa, a.actividad as codactividad, b.descripcion as actividad, 
					(sum(a.inscritos)+sum(a.inscritos_may)+sum(a.inscritos_men)) as total,
					sum(a.inscritos) as ciclistas, 
					sum(a.inscritos_may) as acompanantes, 
					sum(a.inscritos_men) as acompanantes_menor 
					FROM vgrupos a, actividades b
					WHERE a.codempresa = b.codempresa
					and a.actividad = b.codactividad
					and a.actividad = '$actividad'
					GROUP by a.codempresa, a.actividad, b.descripcion 
					";
			} 		
			else
			{
				$sql="SELECT a.codempresa, a.actividad as codactividad, b.descripcion as actividad, 
					(sum(a.inscritos)+sum(a.inscritos_may)+sum(a.inscritos_men)) as total,
					sum(a.inscritos) as ciclistas, 
					sum(a.inscritos_may) as acompanantes, 
					sum(a.inscritos_men) as acompanantes_menor 
					FROM vgrupos a, actividades b
					WHERE a.codempresa = b.codempresa
					and a.actividad = b.codactividad
					and a.codempresa = '$empresa'
					and a.actividad = '$actividad'
					GROUP by a.codempresa, a.actividad, b.descripcion";
			}
		}
		else{ // en caso de ser A u otro valor los muestra todos
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT a.codempresa, a.codactividad, b.descripcion as actividad, (sum(a.cant_participante)+sum(a.cant_acom_mayor)+sum(a.cant_acomp_menor)) as total,
			        sum(a.cant_participante) as ciclistas, 
			        sum(a.cant_acom_mayor) as acompanantes, 
					sum(a.cant_acomp_menor) as acompanantes_menor 
					FROM inscripcion a, actividades b
					WHERE a.codempresa = b.codempresa
					and a.codactividad = b.codactividad
					and a.codactividad = '$actividad'
					and a.estado_inscripcion <> 'B'
					GROUP by a.codempresa, a.codactividad, b.descripcion
					";
			} 		
			else{
				$sql="SELECT a.codempresa, a.codactividad, b.descripcion as actividad, (sum(a.cant_participante)+sum(a.cant_acom_mayor)+sum(a.cant_acomp_menor)) as total,
			        sum(a.cant_participante) as ciclistas, 
			        sum(a.cant_acom_mayor) as acompanantes, 
					sum(a.cant_acomp_menor) as acompanantes_menor
					FROM inscripcion a, actividades b
					WHERE a.codempresa = b.codempresa
					and a.codactividad = b.codactividad
					and a.codempresa = '$empresa' 
					and a.codactividad = '$actividad'
					and a.estado_inscripcion <> 'B'
					GROUP by a.codempresa, a.codactividad, b.descripcion
					 ";
			}

		}
		
		return $mysqli->query($sql);
	}	

	function extraerFlujoEfectivo($ranking, $empresa, $actividad, $revisado){
		include('conectar.php');

		if ($revisado!='A'){
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT a.codempresa, a.codactividad, b.descripcion as actividad, 
						(sum(a.cant_participante * b.costo_participante)+
						 sum(a.cant_acom_mayor * b.costo_invitado)+
						 sum(a.cant_acomp_menor * b.costo_ninos)) as a_pagar,
						 IF(c.tipo = 'D', sum(d.pagado),0) as debito, 
                         IF(c.tipo = 'C', (sum(d.pagado)*-1),0) as credito,
						 ((sum(a.cant_participante * b.costo_participante)+
						  sum(a.cant_acom_mayor * b.costo_invitado)+
						  sum(a.cant_acomp_menor * b.costo_ninos))-
						  sum(d.pagado)
						 ) as por_pagar
						FROM inscripcion a, actividades b, inscrito_en c, vcontrol_pagos d
						WHERE a.codempresa = b.codempresa
						and a.codactividad = b.codactividad	
						and a.estado_inscripcion <> 'B'										
						and a.inscrito_en = '$revisado'
						and a.codactividad = '$actividad'
						and a.codempresa = c.codempresa
                        and a.inscrito_en = c.codinscritoen
                        and a.codinscripcion = d.codinscripcion
                        and a.inscrito_en = d.inscrito_en
                        and a.codempresa = d.codempresa                        
						GROUP by a.codempresa, a.codactividad, b.descripcion, c.tipo 
					";
			} 		
			else
			{
				$sql="SELECT a.codempresa, a.codactividad, b.descripcion as actividad, 
						(sum(a.cant_participante * b.costo_participante)+
						 sum(a.cant_acom_mayor * b.costo_invitado)+
						 sum(a.cant_acomp_menor * b.costo_ninos)) as a_pagar,
						 IF(c.tipo = 'D', sum(d.pagado),0) as debito, 
                         IF(c.tipo = 'C', (sum(d.pagado)*-1),0) as credito,
						 ((sum(a.cant_participante * b.costo_participante)+
						  sum(a.cant_acom_mayor * b.costo_invitado)+
						  sum(a.cant_acomp_menor * b.costo_ninos))-
						  sum(d.pagado)
						 ) as por_pagar
						FROM inscripcion a, actividades b, inscrito_en c, vcontrol_pagos d
						WHERE a.codempresa = b.codempresa
						and a.codactividad = b.codactividad	
						and a.estado_inscripcion <> 'B'										
						and a.inscrito_en = '$revisado'
						and a.codactividad = '$actividad'
						and a.codempresa = '$empresa'
						and a.codempresa = c.codempresa
                        and a.inscrito_en = c.codinscritoen
                        and a.codinscripcion = d.codinscripcion
                        and a.inscrito_en = d.inscrito_en
                        and a.codempresa = d.codempresa                        
						GROUP by a.codempresa, a.codactividad, b.descripcion, c.tipo";
			}
		}else{ // en caso de ser A u otro valor los muestra todos
			if ($_SESSION['crmRanking'] ==1){
				$sql="SELECT a.codempresa, a.codactividad, a.actividad, sum(a_pagar) a_pagar, sum(debito) as debito, sum(a.credito) as credito, sum(a.por_pagar) as por_pagar 
					FROM (
							SELECT a.codempresa, a.codactividad, b.descripcion as actividad, 
						(sum(a.cant_participante * b.costo_participante)+
						 sum(a.cant_acom_mayor * b.costo_invitado)+
						 sum(a.cant_acomp_menor * b.costo_ninos)) as a_pagar,
						 IF(c.tipo = 'D', sum(d.pagado),0) as debito, 
                         IF(c.tipo = 'C', (sum(d.pagado)*-1),0) as credito,
						 ((sum(a.cant_participante * b.costo_participante)+
						  sum(a.cant_acom_mayor * b.costo_invitado)+
						  sum(a.cant_acomp_menor * b.costo_ninos))-
						  sum(d.pagado)
						 ) as por_pagar
						FROM inscripcion a, actividades b, inscrito_en c, vcontrol_pagos d
						WHERE a.codempresa = b.codempresa
						and a.codactividad = b.codactividad	
						and a.estado_inscripcion <> 'B'										
						and a.codactividad = '$actividad'
						and a.codempresa = c.codempresa
                        and a.inscrito_en = c.codinscritoen
                        and a.codinscripcion = d.codinscripcion
                        and a.inscrito_en = d.inscrito_en
                        and a.codempresa = d.codempresa                        
						GROUP by a.codempresa, a.codactividad, b.descripcion, c.tipo) AS a
		                        group by a.codempresa, a.codactividad, a.actividad
					";
			} 		
			else{
				$sql="SELECT a.codempresa, a.codactividad, a.actividad, sum(a_pagar) a_pagar, sum(debito) as debito, sum(a.credito) as credito, sum(a.por_pagar) as por_pagar 
					FROM (
							SELECT a.codempresa, a.codactividad, b.descripcion as actividad, 
						(sum(a.cant_participante * b.costo_participante)+
						 sum(a.cant_acom_mayor * b.costo_invitado)+
						 sum(a.cant_acomp_menor * b.costo_ninos)) as a_pagar,
						 IF(c.tipo = 'D', sum(d.pagado),0) as debito, 
                         IF(c.tipo = 'C', (sum(d.pagado)*-1),0) as credito,
						 ((sum(a.cant_participante * b.costo_participante)+
						  sum(a.cant_acom_mayor * b.costo_invitado)+
						  sum(a.cant_acomp_menor * b.costo_ninos))-
						  sum(d.pagado)
						 ) as por_pagar
						FROM inscripcion a, actividades b, inscrito_en c, vcontrol_pagos d
						WHERE a.codempresa = b.codempresa
						and a.codactividad = b.codactividad	
						and a.estado_inscripcion <> 'B'										
						and a.codactividad = '$actividad'
						and a.codempresa = '$empresa'
						and a.codempresa = c.codempresa
                        and a.inscrito_en = c.codinscritoen
                        and a.codinscripcion = d.codinscripcion
                        and a.inscrito_en = d.inscrito_en
                        and a.codempresa = d.codempresa                        
						GROUP by a.codempresa, a.codactividad, b.descripcion, c.tipo) AS a
					            group by a.codempresa, a.codactividad, a.actividad
					 ";
			}

		}
		
		return $mysqli->query($sql);
	}		
function extraerImpresionTicket($ranking, $empresa, $actividad, $lugar){
		include('conectar.php');
		if ($lugar != 'A') {	
			if ($ranking ==1){
					$sql="SELECT a.codempresa, c.descripcion as actividad, a.codinscripcion as registro, e.fecha_deposito as fecha_saldo, CONCAT(a.nombre,' ', a.apellido) as nombre_representante, b.descripcion as grupo, e.cant_participante as participantes, e.cant_acom_mayor as invitados, e.cant_acomp_menor as invitados_menor, 
						e.orden_ini, e.orden_fin, a.impreso, a.inscrito_en
						FROM inscripcion a, grupos_pais b, actividades c, inscrito_en d, control_kit e  
						WHERE a.revisado = 'S'
						-- and a.inscrito_en = 'L'
						and a.estado_inscripcion <> 'B'
						and a.codactividad = '$actividad'
						and a.inscrito_en = '$lugar'
						and b.codgrupo = a.codgrupo
						and b.codempresa = b.codempresa
						and c.codactividad = a.codactividad
						and c.codempresa = a.codempresa
						and d.codinscritoen = a.inscrito_en
	                    and d.codempresa = a.codempresa
	                    and d.mostrar = 'S'
	                    and a.codempresa = e.codempresa
                		and a.codinscripcion = e.codinscripcion
                		and a.inscrito_en = e.inscrito_en
                		-- and e.orden_ini <> 0
						";
				} 		
			else
				{
					$sql="SELECT a.codempresa, c.descripcion as actividad, a.codinscripcion as registro, e.fecha_deposito as fecha_saldo, CONCAT(a.nombre,' ', a.apellido) as nombre_representante, b.descripcion as grupo, e.cant_participante as participantes, e.cant_acom_mayor as invitados, e.cant_acomp_menor as invitados_menor, 
						e.orden_ini, e.orden_fin, a.impreso, a.inscrito_en
						FROM inscripcion a, grupos_pais b, actividades c, inscrito_en d, control_kit e  
						WHERE a.revisado = 'S'
						-- and a.inscrito_en = 'L'
						and a.estado_inscripcion <> 'B'
						and a.codactividad = '$actividad'
						and a.codempresa = '$empresa'					
						and a.inscrito_en = '$lugar'
						and b.codgrupo = a.codgrupo
						and b.codempresa = b.codempresa
						and c.codactividad = a.codactividad
						and c.codempresa = a.codempresa
						and d.codinscritoen = a.inscrito_en
	                    and d.codempresa = a.codempresa
	                    and d.mostrar = 'S'
	                    and a.codempresa = e.codempresa
                		and a.codinscripcion = e.codinscripcion
                		and a.inscrito_en = e.inscrito_en
                		-- and e.orden_ini <> 0
						";
				}
			}
			else
			{
				if ($ranking ==1){
				$sql="SELECT a.codempresa, c.descripcion as actividad, a.codinscripcion as registro, e.fecha_deposito as fecha_saldo, CONCAT(a.nombre,' ', a.apellido) as nombre_representante, b.descripcion as grupo, e.cant_participante as participantes, e.cant_acom_mayor as invitados, e.cant_acomp_menor as invitados_menor, 
						e.orden_ini, e.orden_fin, a.impreso, a.inscrito_en
					FROM inscripcion a, grupos_pais b, actividades c, inscrito_en d, control_kit e    
					WHERE a.revisado = 'S'
					-- and a.inscrito_en = 'L'
					and a.estado_inscripcion <> 'B'
					and a.codactividad = '$actividad'
					and b.codgrupo = a.codgrupo
					and b.codempresa = b.codempresa
					and c.codactividad = a.codactividad
					and c.codempresa = a.codempresa
					and d.codinscritoen = a.inscrito_en
                    and d.codempresa = a.codempresa
                    and d.mostrar = 'S'
                    and a.codempresa = e.codempresa
                		and a.codinscripcion = e.codinscripcion
                		and a.inscrito_en = e.inscrito_en
					";
			} 		
		else
			{
				$sql="SELECT a.codempresa, c.descripcion as actividad, a.codinscripcion as registro, e.fecha_deposito as fecha_saldo, CONCAT(a.nombre,' ', a.apellido) as nombre_representante, b.descripcion as grupo, e.cant_participante as participantes, e.cant_acom_mayor as invitados, e.cant_acomp_menor as invitados_menor, 
						e.orden_ini, e.orden_fin, a.impreso, a.inscrito_en
					FROM inscripcion a, grupos_pais b, actividades c, inscrito_en d, control_kit e    
					WHERE a.revisado = 'S'
					-- and a.inscrito_en = 'L'
					and a.estado_inscripcion <> 'B'
					and a.codactividad = '$actividad'
					and a.codempresa = '$empresa'					
					and b.codgrupo = a.codgrupo
					and b.codempresa = b.codempresa
					and c.codactividad = a.codactividad
					and c.codempresa = a.codempresa
					and d.codinscritoen = a.inscrito_en
                    and d.codempresa = a.codempresa
                    and d.mostrar = 'S'
                    and a.codempresa = e.codempresa
                		and a.codinscripcion = e.codinscripcion
                		and a.inscrito_en = e.inscrito_en
					";
			}
			}
		return $mysqli->query($sql);
	}

	function extraerImpresionTicket2($ranking, $empresa, $actividad, $lugar){
		include('conectar.php');
		//el valor imrpeso = 1 es para las inscripciones seleccionadas
		if ($lugar != 'A') {	
			if ($ranking ==1){
					$sql="SELECT a.codempresa, c.descripcion as actividad, a.codinscripcion as registro, e.fecha_deposito as fecha_saldo, CONCAT(a.nombre,' ', a.apellido) as nombre_representante, b.descripcion as grupo, e.cant_participante as participantes, e.cant_acom_mayor as invitados, e.cant_acomp_menor as invitados_menor, 
						CONCAT(e.orden_ini,'-',e.orden_fin) as secuencia_kit, a.impreso, a.inscrito_en
						FROM inscripcion a, grupos_pais b, actividades c, inscrito_en d, control_kit e      
						WHERE a.revisado = 'S'
						-- and a.inscrito_en = 'L'
						and a.impreso = '1' 
						and a.estado_inscripcion <> 'B'
						and a.codactividad = '$actividad'
						and a.inscrito_en = '$lugar'
						and b.codgrupo = a.codgrupo
						and b.codempresa = b.codempresa
						and c.codactividad = a.codactividad
						and c.codempresa = a.codempresa
						and d.codinscritoen = a.inscrito_en
	                    and d.codempresa = a.codempresa
	                    and d.mostrar = 'S'
	                    and a.codempresa = e.codempresa
                		and a.codinscripcion = e.codinscripcion
                		and a.inscrito_en = e.inscrito_en
						";
				} 		
			else
				{
					$sql="SELECT a.codempresa, c.descripcion as actividad, a.codinscripcion as registro, e.fecha_deposito as fecha_saldo, CONCAT(a.nombre,' ', a.apellido) as nombre_representante, b.descripcion as grupo, e.cant_participante as participantes, e.cant_acom_mayor as invitados, e.cant_acomp_menor as invitados_menor, 
						CONCAT(e.orden_ini,'-',e.orden_fin) as secuencia_kit, a.impreso, a.inscrito_en
						FROM inscripcion a, grupos_pais b, actividades c, inscrito_en d, control_kit e      
						WHERE a.revisado = 'S'
						-- and a.inscrito_en = 'L'
						and a.impreso = '1'						
						and a.estado_inscripcion <> 'B'
						and a.codactividad = '$actividad'
						and a.codempresa = '$empresa'					
						and a.inscrito_en = '$lugar'
						and b.codgrupo = a.codgrupo
						and b.codempresa = b.codempresa
						and c.codactividad = a.codactividad
						and c.codempresa = a.codempresa
						and d.codinscritoen = a.inscrito_en
	                    and d.codempresa = a.codempresa
	                    and d.mostrar = 'S'
	                    and a.codempresa = e.codempresa
                		and a.codinscripcion = e.codinscripcion
                		and a.inscrito_en = e.inscrito_en
						";
				}
			}
			else
			{
				if ($ranking ==1){
				$sql="SELECT a.codempresa, c.descripcion as actividad, a.codinscripcion as registro, e.fecha_deposito as fecha_saldo, CONCAT(a.nombre,' ', a.apellido) as nombre_representante, b.descripcion as grupo, e.cant_participante as participantes, e.cant_acom_mayor as invitados, e.cant_acomp_menor as invitados_menor, 
					CONCAT(e.orden_ini,'-',e.orden_fin) as secuencia_kit, a.impreso, a.inscrito_en
					FROM inscripcion a, grupos_pais b, actividades c, inscrito_en d, control_kit e      
					WHERE a.revisado = 'S'
					-- and a.inscrito_en = 'L'
					and a.impreso = '1'
					and a.estado_inscripcion <> 'B'
					and a.codactividad = '$actividad'
					and b.codgrupo = a.codgrupo
					and b.codempresa = b.codempresa
					and c.codactividad = a.codactividad
					and c.codempresa = a.codempresa
					and d.codinscritoen = a.inscrito_en
                    and d.codempresa = a.codempresa
                    and d.mostrar = 'S'
                    and a.codempresa = e.codempresa
                		and a.codinscripcion = e.codinscripcion
                		and a.inscrito_en = e.inscrito_en
					";
			} 		
		else
			{
				$sql="SELECT a.codempresa, c.descripcion as actividad, a.codinscripcion as registro, e.fecha_deposito as fecha_saldo, CONCAT(a.nombre,' ', a.apellido) as nombre_representante, b.descripcion as grupo, e.cant_participante as participantes, e.cant_acom_mayor as invitados, e.cant_acomp_menor as invitados_menor, 
					CONCAT(e.orden_ini,'-',e.orden_fin) as secuencia_kit, a.impreso, a.inscrito_en
					FROM inscripcion a, grupos_pais b, actividades c, inscrito_en d, control_kit e      
					WHERE a.revisado = 'S'
					-- and a.inscrito_en = 'L'
					and a.impreso = '1'
					and a.estado_inscripcion <> 'B'
					and a.codactividad = '$actividad'
					and a.codempresa = '$empresa'		
					and b.codgrupo = a.codgrupo
					and b.codempresa = b.codempresa
					and c.codactividad = a.codactividad
					and c.codempresa = a.codempresa
					and d.codinscritoen = a.inscrito_en
                    and d.codempresa = a.codempresa
                    and d.mostrar = 'S'
                    and a.codempresa = e.codempresa
                		and a.codinscripcion = e.codinscripcion
                		and a.inscrito_en = e.inscrito_en
					";
			}
			}
		return $mysqli->query($sql);
	}

	function extraerRepRelacionInscritos($ranking, $empresa, $actividad, $lugar){
		include('conectar.php');						
		if ($lugar != 'A') {
				if ($ranking ==1){
					$sql="SELECT
							  '03-Inscritos pagos' AS descripcion,
								SUM(d.pago_participante) AS participantes,							  
								SUM(d.pago_acom_mayor) AS acompanantes,							  
								SUM(d.pago_acomp_menor) AS ninos,						  
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad' 
							  		AND p.inscrito_en = '$lugar'	
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c,						
        					  vcontrol_pagos d
							WHERE
							  a.revisado = 'S' AND a.estado_inscripcion <> 'B' AND a.codempresa = b.codempresa AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen
							  	  AND a.codactividad = '$actividad' AND a.inscrito_en = '$lugar'
							  	  AND d.codempresa = a.codempresa
							      AND d.codinscripcion = a.codinscripcion
							      AND d.inscrito_en = a.inscrito_en
							      AND d.revisado = a.revisado	
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa
							UNION
							SELECT
							  '02-Pre-Inscritos no pagos' AS descripcion,
							  SUM(d.pend_participante) AS participantes,				
							  SUM(d.pend_acom_mayor) AS acompanantes,					
							  SUM(d.pend_acomp_menor) AS ninos,						
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad' AND p.inscrito_en = '$lugar'	
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c,
							  vcontrol_pagos d
							WHERE
							  a.estado_inscripcion <> 'B' AND a.codempresa = b.codempresa AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen AND a.codactividad = '$actividad' AND a.inscrito_en = '$lugar'
							  	  AND d.codempresa = a.codempresa
							      AND d.codinscripcion = a.codinscripcion
							      AND d.inscrito_en = a.inscrito_en
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa
							UNION
							SELECT
							  '01-Totales' AS descripcion,
							  SUM(a.cant_participante) AS participantes,							  
							  SUM(a.cant_acom_mayor) AS acompanantes,							  
							  SUM(a.cant_acomp_menor) AS ninos,							  
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad' AND p.inscrito_en = '$lugar'	
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c
							WHERE
							  a.codempresa = b.codempresa AND a.estado_inscripcion <> 'B' AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen AND a.codactividad = '$actividad' AND a.inscrito_en = '$lugar'
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa";
				} 		
				else{
					$sql="SELECT
							  '03-Inscritos pagos' AS descripcion,
								SUM(d.pago_participante) AS participantes,							  
								SUM(d.pago_acom_mayor) AS acompanantes,							  
								SUM(d.pago_acomp_menor) AS ninos,						  
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad' AND p.codempresa = '$empresa' AND p.inscrito_en = '$lugar'	
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c,						
        					  vcontrol_pagos d
							WHERE
							  a.revisado = 'S' AND a.estado_inscripcion <> 'B' AND a.codempresa = b.codempresa AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen
							  	  AND a.codactividad = '$actividad' AND a.inscrito_en = '$lugar'
							  	  AND a.codempresa = '$empresa'
							  	  AND d.codempresa = a.codempresa
							      AND d.codinscripcion = a.codinscripcion
							      AND d.inscrito_en = a.inscrito_en
							      AND d.revisado = a.revisado	
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa
							UNION
							SELECT
							  '02-Pre-Inscritos no pagos' AS descripcion,
							  SUM(d.pend_participante) AS participantes,				
							  SUM(d.pend_acom_mayor) AS acompanantes,					
							  SUM(d.pend_acomp_menor) AS ninos,						
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad' AND p.codempresa = '$empresa' AND p.inscrito_en = '$lugar'	
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c,
							  vcontrol_pagos d
							WHERE
							  a.estado_inscripcion <> 'B' AND a.codempresa = b.codempresa AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen AND a.codactividad = '$actividad' AND a.inscrito_en = '$lugar' AND a.codempresa = '$empresa'
							  	  AND d.codempresa = a.codempresa
							      AND d.codinscripcion = a.codinscripcion
							      AND d.inscrito_en = a.inscrito_en
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa
							UNION
							SELECT
							  '01-Totales' AS descripcion,
							  SUM(a.cant_participante) AS participantes,							  
							  SUM(a.cant_acom_mayor) AS acompanantes,							  
							  SUM(a.cant_acomp_menor) AS ninos,							  
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad' AND p.codempresa = '$empresa' AND p.inscrito_en = '$lugar'	
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c
							WHERE
							  a.codempresa = b.codempresa AND a.estado_inscripcion <> 'B' AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen AND a.codactividad = '$actividad' AND a.inscrito_en = '$lugar' AND a.codempresa = '$empresa'
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa";
				}	
			}
		else{ //TODAS LAS ACTIVIDADES E INSCRIPCIONES
			if ($ranking ==1){
					$sql="SELECT
							  '03-Inscritos pagos' AS descripcion,
								SUM(d.pago_participante) AS participantes,							  
								SUM(d.pago_acom_mayor) AS acompanantes,							  
								SUM(d.pago_acomp_menor) AS ninos,						  
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad'	
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c,						
        					  vcontrol_pagos d
							WHERE
							  a.revisado = 'S' AND a.estado_inscripcion <> 'B' AND a.codempresa = b.codempresa AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen
							  	  AND a.codactividad = '$actividad' 
							  	  AND d.codempresa = a.codempresa
							      AND d.codinscripcion = a.codinscripcion
							      AND d.inscrito_en = a.inscrito_en
							      AND d.revisado = a.revisado	
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa
							UNION
							SELECT
							  '02-Pre-Inscritos no pagos' AS descripcion,
							  SUM(d.pend_participante) AS participantes,				
							  SUM(d.pend_acom_mayor) AS acompanantes,					
							  SUM(d.pend_acomp_menor) AS ninos,						
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad'	
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c,
							  vcontrol_pagos d
							WHERE
							    a.estado_inscripcion <> 'B' AND a.codempresa = b.codempresa AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen AND a.codactividad = '$actividad' 
							  	  AND d.codempresa = a.codempresa
							      AND d.codinscripcion = a.codinscripcion
							      AND d.inscrito_en = a.inscrito_en
							      AND d.revisado = a.revisado
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa
							UNION
							SELECT
							  '01-Totales' AS descripcion,
							  SUM(a.cant_participante) AS participantes,							  
							  SUM(a.cant_acom_mayor) AS acompanantes,							  
							  SUM(a.cant_acomp_menor) AS ninos,							  
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad' 
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c
							WHERE
							  a.codempresa = b.codempresa AND a.estado_inscripcion <> 'B' AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen AND a.codactividad = '$actividad' 
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa";
				} 		
			else{
				$sql="SELECT
							  '03-Inscritos pagos' AS descripcion,
								SUM(d.pago_participante) AS participantes,							  
								SUM(d.pago_acom_mayor) AS acompanantes,							  
								SUM(d.pago_acomp_menor) AS ninos,						  
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad' AND p.codempresa = '$empresa' 
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c,						
        					  vcontrol_pagos d
							WHERE
							  a.revisado = 'S' AND a.estado_inscripcion <> 'B' AND a.codempresa = b.codempresa AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen
							  	  AND a.codactividad = '$actividad' 
							  	  AND a.codempresa = '$empresa'
							  	  AND d.codempresa = a.codempresa
							      AND d.codinscripcion = a.codinscripcion
							      AND d.inscrito_en = a.inscrito_en
							      AND d.revisado = a.revisado	
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa
							UNION
							SELECT
							  '02-Pre-Inscritos no pagos' AS descripcion,
							  SUM(d.pend_participante) AS participantes,				
							  SUM(d.pend_acom_mayor) AS acompanantes,					
							  SUM(d.pend_acomp_menor) AS ninos,						
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad' AND p.codempresa = '$empresa' 
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c,
							  vcontrol_pagos d
							WHERE a.estado_inscripcion <> 'B' AND a.codempresa = b.codempresa AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen AND a.codactividad = '$actividad' AND a.codempresa = '$empresa'
							  	  AND d.codempresa = a.codempresa
							      AND d.codinscripcion = a.codinscripcion
							      AND d.inscrito_en = a.inscrito_en
							      AND d.revisado = a.revisado
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa
							UNION
							SELECT
							  '01-Totales' AS descripcion,
							  SUM(a.cant_participante) AS participantes,							  
							  SUM(a.cant_acom_mayor) AS acompanantes,							  
							  SUM(a.cant_acomp_menor) AS ninos,							  
							  (select (SUM(p.cant_participante) + SUM(p.cant_acom_mayor) + SUM(p.cant_acomp_menor))
							  	from inscripcion p
							  	where p.estado_inscripcion <> 'B' AND p.codactividad = '$actividad' AND p.codempresa = '$empresa' 
							  ) as total,
							  a.codactividad AS codactividad,
							  b.descripcion AS actividad,
							  a.codempresa AS codempresa
							FROM
							  inscripcion a,
							  actividades b,
							  inscrito_en c
							WHERE
							  a.codempresa = b.codempresa AND a.estado_inscripcion <> 'B' AND a.codactividad = b.codactividad AND a.codempresa = c.codempresa AND a.inscrito_en = c.codinscritoen AND a.codactividad = '$actividad'  AND a.codempresa = '$empresa'
							GROUP BY
							  a.codactividad,
							  b.descripcion,
							  a.codempresa";
				}
			}			
		return $mysqli->query($sql);	
	}
	function extraerPerfilUsuario(){
		
	}
		
		
?>
