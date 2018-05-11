<?php 
	session_start();
	// include("php/tiempo.php");
 	require('php/consultas.php');
 	if(!isset($_SESSION['crmUsername']) && !isset($_SESSION['crmEmpresa']) && !isset($_SESSION['crmRanking'])){
 		header("Location: index.php?status=errns");
 	}
	date_default_timezone_set('America/La_Paz');
 	
 ?>
 
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->

	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">
    <link rel="stylesheet"  href="css/bootstrap.min.css">
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.js"></script>	
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/Chart.js"></script>
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
		
  	
    <title>MS | CONFIGURACION </title>
    <link rel="icon" type="image/png" href="img/logo.png" />

    <script>
 	$(document).ready(function(){
	    $('#table_id').DataTable({ // tabla con botones de impresion
	    	 "iDisplayLength": 15,
	    	 "order": [[ 0, "desc" ]],
	    	 dom: 'Bfrtip',
	        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
	      "language":{
			    "sProcessing":     "Procesando...",
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			    "sZeroRecords":    "No se encontraron resultados",
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			    "sInfoPostFix":    "",
			    "sSearch":         "Buscar:",
			    "sUrl":            "",
			    "sInfoThousands":  ",",
			    "sLoadingRecords": "Cargando...",
			    "oPaginate": {
			        "sFirst":    "Primero",
			        "sLast":     "Último",
			        "sNext":     "Siguiente",
			        "sPrevious": "Anterior"
			    },
			    "oAria": {
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			    }
			}
	    });
	    $('#table_id2').DataTable({ // tablas grandes se pone la barra y con botones
	    	  "scrollX": true,
	    	 "iDisplayLength": 15,
	    	 "order": [[ 0, "desc" ]],
	    	 dom: 'Bfrtip',
	        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
	      "language":{
			    "sProcessing":     "Procesando...",
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			    "sZeroRecords":    "No se encontraron resultados",
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			    "sInfoPostFix":    "",
			    "sSearch":         "Buscar:",
			    "sUrl":            "",
			    "sInfoThousands":  ",",
			    "sLoadingRecords": "Cargando...",
			    "oPaginate": {
			        "sFirst":    "Primero",
			        "sLast":     "Último",
			        "sNext":     "Siguiente",
			        "sPrevious": "Anterior"
			    },
			    "oAria": {
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			    }
			}
	    });

	    

    });
    </script>
</head>
<body  >
	<header class="cd-main-header" >
		<div class="txt_logo">
		<a href="main.php">
			<?php $r= nombre_empresa(); 
			echo "<img src='data:image/png;base64,".base64_encode($r['logo'])."' alt='Logo' class='img_txt'/> 
			<span class='txt_'>".$r['rsm_nombre']."</span>";?>
		 </a>
		 </div>

		<a href="#0" class="cd-nav-trigger"><span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<!-- <li><a href="#0">Tour</a></li> -->				
				<li><a href="mailto:info@mangusoft.com" target="_blank">Soporte</a></li>
				
				<li><a href="http://mangusoft.com/crm_mangusoft2/Manual%20de%20Usuario%201.0.pdf" target="_blank">Manual</a></li>
				
				<li><a href="http://mangusoft.com/" target="_blank">Acerca de</a></li>
				
				<li class="has-children account">
					<a href="#0" class="cuenta">
						<img src="img/cd-avatar.png" alt="avatar">
						<?php echo $_SESSION['crmUsername']; ?>
					</a>

					<ul>

						<!-- <li><a href="#0">My Account</a></li> -->
						<li><a href="usuario-mant.php">Cuenta</a></li>
						<li><a href="php/logout.php">Cerrar Sesión</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header> <!-- .cd-main-header -->

	<main class="cd-main-content">
		<nav class="cd-side-nav">
			<ul>
				<li class="cd-label">Principal</li>
				<li class="has-children overview">
					<a href="main.php">Dashboard</a>
					
					<!-- <ul>
						<li><a href="#0">Miembros Activos y Pasivos</a></li>
						<li><a href="#0">Gestion de Miembros por Zona</a></li>
						<li><a href="#0">Manejo de Cuotas</a></li>
					</ul> -->
				</li>
			<?php if ($_SESSION['crmRanking']<=2): ?>
				
				<li class="has-children gmiembros">
					<a href="#0">Gestión de Cursos</a>
					<ul>
						<li><a href="profesor-mant.php">Mantenimiento Profesor</a></li>
						<hr style=" margin: 0">		
						<li><a href="curso-mant.php">Mantenimiento Cursos</a></li>
						<hr style=" margin: 0">		
						<li><a href="secciones-enc-mant.php">Mantenimiento Secciones</a></li>
					</ul>
				</li>

				<li class="has-children gestudiante">
					<a href="#0">Gestión de Estudiantes</a><!-- <span class="count">3</span> -->
					<ul>
						<li><a href="inscripcion-mant.php">Registro de Estudiantes</a></li>		
						<hr style=" margin: 0">		

						<li><a href="secciones-det-mant.php">Asignar Secciones</a></li>

						
					</ul>
				</li>

				<li class="has-children gcurso">
					<a href="#0">Gestión de Asistencia</a>
					
					<ul>
						<li><a href="asistencia-enc-mant.php">Asistencia</a></li>
						<hr style=" margin: 0">
						<li><a href="permisos-mant.php">Permisos</a></li>
						
						
					</ul>
				</li>
			<?php endif ?>
				<li class="has-children reporte">
					<a href="#0">Reportes</a>
					
					<ul>						
						<li><a href="reporte-asistencia.php">Asistencia</a></li>
						<hr style=" margin: 0">											
						<!-- <li><a href="#">Datos de Emergencia</a></li> -->
						<!-- <hr style=" margin: 0">						 -->
						
						<hr style=" margin: 0">						
						<li><a href="inscripcion-ticket.php">Impresión de Tikect </a></li>
						
						<!-- <hr style=" margin: 0">		 -->
						<!-- <li><a href="#">Inscritos por Curso</a></li>				 -->
						<!-- <hr style=" margin: 0">		 -->
						<!-- <li><a href="#">Resumen de Inscripciones</a></li> -->
						<!-- <hr style=" margin: 0">	 -->
					</ul>
				</li>
			<?php if ($_SESSION['crmRanking']<=2): ?>
				<li class="message">
					<a href="#">Mensajería</a>
				</li>
			<?php endif ?>	

			</ul>
				

			<?php if ($_SESSION['crmRanking']<=2): ?>
			<ul>
				<li class="cd-label">Administración</li>

				<li class="has-children config">
					<a href="#0">Configuración</a>
					
					<ul>
						<li><a href="empresa-mant.php">Gestión de Empresa</a></li>
						<li><a href="actividades-mant.php">Actividades</a></li>
						<li><a href="inscrito-en-mant.php">Lugares Inscripción</a></li>
						<hr style=" margin: 0">
						<li><a href="paises-mant.php">Países</a></li>
						<!-- <li><a href="estudios-mant.php">Tipos de Estudios</a></li> -->
						<li><a href="provincias-mant.php">Provincias</a></li>
						<hr style=" margin: 0">
						<li><a href="nacionalidad-mant.php">Nacionalidad</a></li>
						<hr style=" margin: 0">
						<li><a href="parametros-mant.php">Parámetros Generales</a></li>
						<li><a href="control-mant.php">Control de Cambios</a></li>

					</ul>
				</li>

				<li class="has-children seguridad">
					<a href="#0">Seguridad</a>
					
					<ul>
						<li><a href="usuario-mant.php">Gestión de Usuarios</a></li>
						<li><a href="#0">Importar Datos</a></li>
						<li><a href="#0">Exportar Datos</a></li>
					</ul>
				</li>

				<!-- <li class="has-children bookmarks">
					<a href="#0">Bookmarks</a>
					
					<ul>
						<li><a href="#0">All Bookmarks</a></li>
						<li><a href="#0">Edit Bookmark</a></li>
						<li><a href="#0">Import Bookmark</a></li>
					</ul>
				</li>
				<li class="has-children images">
					<a href="#0">Images</a>
					
					<ul>
						<li><a href="#0">All Images</a></li>
						<li><a href="#0">Edit Image</a></li>
					</ul>
				</li>

				<li class="has-children users">
					<a href="#0">Users</a>
					
					<ul>
						<li><a href="#0">All Users</a></li>
						<li><a href="#0">Edit User</a></li>
						<li><a href="#0">Add User</a></li>
					</ul>
				</li> -->
			</ul>
			<?php endif ?>

			
			<ul>
				<li class="cd-label">Cuenta</li>
				<li class="action-btn" style="margin-bottom: 10px"><a href="main.php"> Inicio</a></li>
				<li class="action-btn" style="margin-bottom: 10px"><a href="../main-2.php"><img src="img/atras.svg" width="16px"> Volver a Consulta</a></li>
				<li class="action-btn"><a href="php/logout.php">Cerrar Sesión</a></li>
			</ul>						
		</nav>