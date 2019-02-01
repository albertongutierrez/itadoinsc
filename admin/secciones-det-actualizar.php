<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='main.php'</script>;";
}

 	$Vid 	=    (int)$_GET['id'];
 	$Vuser 	=    (int)$_GET['user'];

    if (($Vid == 0) or ($Vuser == 0)){
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

$query=extraerSeccionesDETUDT($_GET['id']);						
$row= $query->fetch_assoc();
$query2=extaerInscritosUDT2($_GET['user'],$_GET['empresa']);
$ro=$query2->fetch_assoc();

	if (empty($row['codseccion_det'])){
        $statusMsgClass = 'alert-danger';
        $statusMsg = 'La consulta no devolvió ningún resultado.';
    }

    
    if (empty($ro['codinscripcion'])){
        $statusMsgClass = 'alert-danger';
        $statusMsg = 'La consulta no devolvió ningún resultado.';
    }
?>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Asignar Secciones</p>
			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li><a href="secciones-det-mant.php">Asignar Secciones</a></li>
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
				<form class="form-horizontal" method="POST" action="php/secciones-det-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data">	

					<div class="form-group">
			          <div class="col-sm-4 col-md-offset-2">
			          	<label for="codigo" class=" control-label">Codigo</label><span style="font-weight: bold; color: red; font-size: 25px" class="">*</span>       
				        <input type="text" class="form-control" name="codigo" readonly="" value="<?php echo $row['codseccion_det'] ?>">             
				        <input type="hidden" class="form-control" name="empresa" value="<?php echo $row['codempresa'] ?>"  > 

				        <input type="hidden" class="form-control" name="inscripcion" value="<?php echo $row['codinscripcion'] ?>"  >             
				        <input type="hidden" class="form-control" name="curso" value="<?php echo $ro['curso'] ?>"  >   
				        <?php //echo  '<script type="text/javascript">alert( "'.$ro["curso"].'")</script> ';    ?>    
			          </div>
			        </div>

			        <div class="form-group">
			          <div class="col-sm-4 col-md-offset-2">
			          	<label for="nombres" class=" control-label">Nombres</label><span style="font-weight: bold; color: red; font-size: 25px" class="">*</span>       
				        <input type="text" class="form-control" name="nombres" value="<?php echo $ro['nombre'].' '.$ro['apellido'] ?>" disabled="" >
			          </div>
			        </div>

			        <div class='form-group'>
							<div class='col-sm-4 col-md-offset-2'>
							<label for='estado' class='control-label'>Estado</label>
								<select class='form-control' id='estado' name='estado'>			
									<option value='A' <?php if($row['estado']=='A'){echo'selected';}?>>ACTIVO</option>
									 <option value='I' <?php if($row['estado']=='I'){echo'selected';}?>>INACTIVO</option>				
								</select>
							</div>
						</div>
			        
					<div class="form-group">
						<div class="col-sm-10 col-md-offset-2">
							<a href="secciones-det-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
			        
															
					<!-- </div> -->
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>