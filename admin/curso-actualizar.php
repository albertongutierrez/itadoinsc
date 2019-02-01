<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	// echo"<script language='javascript'>window.location='nacionalidad-mant.php'</script>;";
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

$query=extraerCursoUDT($_GET['id'],$_GET['empresa']);
$row=$query->fetch_assoc();

if (empty($row['codcurso']) && ($Vid != 0)){
        $statusMsgClass = 'alert-danger';
        $statusMsg = 'La consulta no devolvió ningún resultado.';
    }
?>
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Curso</p>
			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li><a href="curso-mant.php">Cursos</a></li>
			  <li class="active">Editar Registro</li>			  
			</ol>

			<?php if(!empty($statusMsg)){
                    echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
                    die("<a href='javascript:history.go(-1);' class='btn btn-warning btn-fill'>Datos no encontrados, volver atrás</a>");
                } ?>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Actualizar</h3>
			</div>
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="php/curso-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data">				
					
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<label for="descripcion" class="control-label">Descripción</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required value="<?php echo $row['descripcion'] ?>">

							<input type="hidden" class="form-control" id="codigo" name="codigo" required value="<?php echo $row['codcurso'] ?>">
							<input type="hidden" class="form-control" id="empresa" name="empresa"  required value="<?php echo $row['codempresa'] ?>">
						</div>
					</div>	

					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<label for="hora" class="control-label">Horas</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="number" class="form-control" id="hora" name="hora" placeholder="Numero de horas" required value="<?php echo $row['horas'] ?>">
						</div>
					</div>
					<div class='form-group'>
							<div class='col-sm-4 col-sm-offset-2'>
								<label for='acomulativo' class='control-label'>acomulativo</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
								<select class='form-control' id='acomulativo' name='acomulativo'>			
									<option value='N' <?php if ($row['acomulativo']=='N'){echo "selected";} ?>>NO</option>
									<option value='S' <?php if ($row['acomulativo']=='S'){echo "selected";}?>>SI</option>
									}
									 			
								</select>
							</div>
						</div>

						<div class="form-group">
						<div class='col-sm-4 col-md-offset-2'>
							<label for='estado' class='control-label'>Estado</label>
							<select class='form-control' id='estado' name='estado'>
								<option value='A' <?php if($row['estado']=='A'){echo'selected';}?>>ACTIVO</option>
								 <option value='I' <?php if($row['estado']=='I'){echo'selected';}?>>INACTIVO</option>	
							</select>
						</div>
					
					</div>	

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="curso-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>