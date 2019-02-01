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

$query=extraerSeccionesENCUDT($_GET['id'],$_GET['empresa']);
$ro=$query->fetch_assoc();

if (empty($ro['codseccion_enc']) && ($Vid != 0)){
        $statusMsgClass = 'alert-danger';
        $statusMsg = 'La consulta no devolvió ningún resultado.';
    }
?>
<script type="text/javascript">
	var acomulativa=false;
	var activo=false;
	$( window ).on( "load", function() {
        validar();
    });
	function validar() {
	  	var cam = document.getElementById("curso");
      	cam=cam.value;
      	var ac=cam.split(',');
		// alert(acomulativa);\

		if (ac[1]=='S'){
			if (activo==false){
				$('#importFrm').slideToggle();
		 		activo=true;
		 	}
		}
		else if (ac[1]=='N'){
			if (activo==true){
				$('#importFrm').slideToggle();
		 		activo=false;
		 	}
		}
	}
</script>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Secciones </p>
			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li><a href="secciones-enc-mant.php">Secciones</a></li>
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
				<form class="form-horizontal" method="POST" action="php/secciones-enc-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data">	

					<div class="form-group">
			          <div class="col-sm-4 col-sm-offset-2">
			          	<label for="curso" class=" control-label">Curso</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
			            <select id="curso" name="curso" class="form-control" onload="validar()" required> 
				            <option>Seleccione</option>           
				            <?php 
							$query=extraerCurso();						
				            if($query->num_rows > 0){
				            while ($row= $query -> fetch_array())
				                  { 				            ?>
				              <option value="<?php echo $row['codcurso'].','.$row['acomulativo'];?>" <?php if ($ro['codcurso']==$row['codcurso']){echo "selected";}?>><?php echo $row['descripcion'];?></option>
				            <?php }}
				            ?>             
			            </select>
			          </div>
			        </div>

			        <div class="form-group">
			          <div class="col-sm-4 col-sm-offset-2">
			          	<label for="profesor" class=" control-label">Profesor</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
			            <select id="profesor" name="profesor" class="form-control" required> 
				            <option>Seleccione</option>           
				            <?php 
							$query=extraerProfesor();						
				            if($query->num_rows > 0){
				            while ($row= $query -> fetch_array())
				                  { 
				            ?>
				              <option value="<?php echo $row['codprofesor'];?>" <?php if ($ro['codprofesor']==$row['codprofesor']){echo "selected";}?>><?php echo $row['nombre'].' '.$row['apellido'];?></option>
				            <?php }}
				            ?>             
			            </select>
			          </div>
			        </div>

					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<label for="descripcion" class="control-label">Descripción</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required="" value="<?php echo $ro['descripcion'] ?>">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<label for="cupo" class="control-label">Cupo</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="number" class="form-control" id="cupo" name="cupo" placeholder="Cantidad de Cupo" required=""  value="<?php echo $ro['cupo'] ?>">
							<input type="hidden" class="form-control" id="codigo" name="codigo" value="<?php echo $ro['codseccion_enc'] ?>">
							<input type="hidden" class="form-control" id="empresa" name="empresa"  value="<?php echo $ro['codempresa']; ?>">
						</div>
					</div>
					<?php //if ($ro['horas']!=0): ?>
						<div class="form-group" id="importFrm" >
							<div class="col-sm-4 col-sm-offset-2">
								<label for="horas" class="control-label">Horas</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
								<input type="number" class="form-control" id="horas" name="horas" placeholder="Cantidad de Horas"  value="<?php echo $ro['horas'] ?>" >
							</div>
						</div>
					<?php //endif ?>

					<div class="form-group">
						<div class='col-sm-4 col-md-offset-2'>
							<label for='estado' class='control-label'>Estado</label>
							<select class='form-control' id='estado' name='estado'>
								<option value='A' <?php if($ro['estado']=='A'){echo'selected';}?>>ACTIVO</option>
								 <option value='I' <?php if($ro['estado']=='I'){echo'selected';}?>>INACTIVO</option>	
							</select>
						</div>
					
					</div>	
															
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="secciones-enc-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>