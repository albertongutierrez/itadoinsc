<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='main.php'</script>;";
}

	$Vid =    (int)$_GET['id'];
    if ($Vid == 0){
        // $id = filter_var($Vid, FILTER_SANITIZE_NUMBER_INT);
        // if( !$id ) { 
            // die('Intento de contaminar consulta'); 
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Se ha producido un error al intentar contaminar la consulta.';

        }
        // código para procesar Id numérico
    // }
    
    if ($_SESSION['crmEmpresa'] != $_GET['empresa']){
        // die('Intento de contaminar consulta'); 
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Se ha producido un error al intentar contaminar la consulta.';      
    } 

$query=extraerProfesorUDT($_GET['id'],$_GET['empresa']);
$row=$query->fetch_assoc();

if (empty($row['codprofesor']) && ($Vid != 0)){
        $statusMsgClass = 'alert-danger';
        $statusMsg = 'La consulta no devolvió ningún resultado.';
    }

?>
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Profesor</p>
			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li><a href="profesor-mant.php">Profesores</a></li>
			  <li class="active">Editar Registro</li>			  
			</ol>

				 <?php if(!empty($statusMsg)){
                    echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
                    die("<a href='javascript:history.go(-1);' class='btn btn-warning btn-fill'>Datos no encontrados, volver atrás</a>");
                } ?>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar</h3>
			</div>
			<div class="p-body">
				<form  method="POST" action="php/profesor-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data"> 
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 ">
							<legend> Datos Personales</legend>
						</div>		
					</div>		

					<div class="row">
						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group">
								<label for="nombre" class="control-label">Codigo</label><span style="font-weight: bold; color: red; font-size: 25px"></span>
								<input type="text" class="form-control" readonly="" value="<?php echo $row['codprofesor'] ?>">
								<input type="hidden"  value="<?php echo $row['codprofesor'] ?>" name="codigo">
								<input type="hidden"  value="<?php echo $row['codempresa'] ?>" name="empresa">
							</div>
						</div>

						<div class="col-md-4 col-md-offset-0 col-sm-offset-0 col-sm-4 col-xs-12 col-xs-offset-0 col-lg-4">
							<div class="form-group ">
								<label for='estado' class='control-label'>Estado <span style="font-weight: bold; color: red; font-size: 25px"> </span></label>

								<select class='form-control' id='estado' name='estado'>

									<option value='A' <?php if($row['estado']=='A'){echo'selected';}?>>ACTIVO</option>
									 <option value='I' <?php if($row['estado']=='I'){echo'selected';}?>>INACTIVO</option>	
								</select>

							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group">
								<label for="nombre" class="control-label">Nombre</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
								<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="" value="<?php echo $row['nombre'] ?>">
							</div>
						</div>

						<div class="col-md-4 col-md-offset-0 col-sm-offset-0 col-sm-4 col-xs-12 col-xs-offset-0 col-lg-4">
							<div class="form-group">
								<label for="apellido" class="control-label">Apellido</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
								<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required="" value="<?php echo $row['apellido'] ?>">
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group">
								<label for="cedula" class=" control-label">Cedula</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
								<input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula" required="" value="<?php echo $row['cedula'] ?>">
							</div>
						</div>
						<div class="col-md-4 col-md-offset-0 col-sm-offset-0 col-sm-4 col-xs-12 col-xs-offset-0 col-lg-4">
							<div class="form-group">
							
								<label for="correo" class=" control-label">Correo</label><span style="font-weight: bold; color: red; font-size: 25px"></span>
								<input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" value="<?php echo $row['email'] ?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group">
								<label for="celular" class=" control-label">Celular</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
								<input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" required="" value="<?php echo $row['celular'] ?>">
							</div>
						</div>
							
						<div class="col-md-4 col-md-offset-0 col-sm-offset-0 col-sm-4 col-xs-12 col-xs-offset-0 col-lg-4">
							<div class="form-group">
								<label for="telefono" class=" control-label">Tel&eacute;fono</label><span style="font-weight: bold; color: red; font-size: 25px"></span>
								<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tel&eacute;fono" value="<?php echo $row['telefono'] ?>">
							</div>
						</div>	
					</div>

					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
							<legend>Credenciales de Acceso</legend>
						</div>
					</div>							
						
					<div class="row">

						

						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group ">
								<label for="username" class="control-label">Usuario <span style="font-weight: bold; color: red; font-size: 25px">*</span></label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Nombre De Usuario" required="" value="<?php echo $row['username'] ?>" readonly>
								<input type="hidden" class="form-control" name="us" value="<?php echo $row['codusuario'] ?>">
							</div>
						</div>

					</div>

					<div class="row">

						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group">
								<label for="pass" class="control-label">Contraseña <span style="font-weight: bold; color: red; font-size: 25px">*</span></label>
								<input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" >

							</div>
						</div>
						<div class="col-md-4 col-md-offset-0 col-sm-offset-0 col-sm-4 col-xs-12 col-xs-offset-0 col-lg-4">
							<div class="form-group">	
								<label for="pass-v" class="control-label">Repita Contraseña <span style="font-weight: bold; color: red; font-size: 25px">*</span></label>
								<input type="password" class="form-control" id"=pass-v" name="pass-v" placeholder="Repita Contraseña">
							</div>
						</div>

						<div class="col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
							<span class="help-block" style="color: orange">Nota: Si no escribe ninguna contraseña se quedara la misma</span >
						</div>

					</div>

					<div class="row">
						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group">
								<a href="profesor-mant.php" class="btn btn-default">Regresar</a>
								<button type="submit" class="btn btn-primary">Actualizar</button>
							</div>
						</div>
					</div>
												
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>