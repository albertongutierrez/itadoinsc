<?php include'php/cabeza2.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
}
$query=extraerSeccionesDETUDT($_GET['id']);						
$row= $query->fetch_assoc();
$query2=extaerInscritosUDT2($_GET['user'],$_GET['empresa']);
$ro=$query2->fetch_assoc();
?>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Clase </p>
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