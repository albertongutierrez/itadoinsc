<?php include'php/cabeza.php';

// if ($_SESSION['crmRanking']>2){
// 	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
// }
		date_default_timezone_set('America/La_Paz');
		$fecha=date("Y-m-d").'T'.date("h:i");
		

?>
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Permisos</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar <!-- <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();" style="float: right;">Filtros</a> --> </h3>

				<?php if (isset($_GET['seccion'])): ?>
		        	<div id="importFrm"> 
		        <?php endif ?>
			    <?php if (!isset($_GET['seccion'])): ?>
		        	<div id=""> 	
				<?php endif ?>	
					<form class="form-inline" role="form" action="permisos-crear.php" >
					 <br>
						 <div class="form-group">
						 			
					    	<label>Datos a Motrar</label>
					    	<br>
					    	<div class="form-group">
    							<label class="sr-only" for="actividad">Actividad</label>
    							<select id="codactividad" name="seccion" class="form-control" required=""> 
			            			<option value="">Seleccione</option>         
						             <?php 
									$query=extraerSeccionesENC();						
						            if($query->num_rows > 0){
						            while ($row= $query -> fetch_array())
						                  { 
						            ?>
						              <option value="<?php echo $row['codseccion_enc'];?>" <?php if(isset($_GET['seccion'])){if($_GET['seccion']==$row['codseccion_enc']){echo "selected";}} ?>><?php echo $row['descripcion'];?></option>
						            <?php }}
						            ?>                
						        </select>
  							</div>  							
  								    
						<button type="submit" class="btn btn-default">Filtrar</button>
					    </div>
					</form>					
				</div>
			</div>
			<?php $query=extraerPermisosUDT($_GET['id']);
		$row=$query->fetch_assoc(); ?>
			<div class="p-body">
			        	<form id="frm-example" method="post" action="php/permisos-registros.php?accion=UDT" class="form-horizontal">

			        	<div class="form-group">
							<div class="col-sm-4 col-md-offset-2">
								<label>Nombres</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
			        			<input type="text" name="nombres" class="form-control" required="" value="<?php echo $row['nombres']; ?>" readonly=''>
			        			<input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
			        		</div>
			        	</div>

			        	<div class="form-group">
							<div class='col-sm-4 col-md-offset-2'>
								<label for='estado_p' class='control-label'>Estado Permiso</label>
								<select class='form-control' id='estado_p' name='estado_p'>
									<option value='A' <?php if($row['estado_permiso']=='A'){echo'selected';}?>>ACTIVO</option>

									 <option value='I' <?php if($row['estado_permiso']=='I'){echo'selected';}?>>FINALIZADO</option>	
								</select>
							</div>
						
						</div>

						<div class="form-group">
							<div class="col-sm-4 col-md-offset-2">
								<label>Hora Inicio</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
			        			<input type="time" name="ini" class="form-control" required="" value="<?php echo date('h:i',strtotime($row['hora_ini'])) ?>">
			        		</div>
			        	</div>
 			        	<div class="form-group">
							<div class="col-sm-4 col-md-offset-2">
								<label>Hora Fin</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
			        			<input type="time" name="fin" class="form-control" required="" value="<?php echo date('h:i',strtotime($row['hora_fin'])) ?>">
			        		</div>
			        	</div>


					<div class="form-group">
						<div class='col-sm-4 col-md-offset-2'>
							<label for='estado' class='control-label'>Estado Registro</label>
							<select class='form-control' id='estado' name='estado'>
								<option value='A' <?php if($row['estado']=='A'){echo'selected';}?>>ACTIVO</option>
								 <option value='I' <?php if($row['estado']=='I'){echo'selected';}?>>INACTIVO</option>	
							</select>
						</div>
					
					</div>

			   						        	

						<input type="hidden" name="seccion2" value="<?php echo $seccion ?>">
						<div class="form-group">
							<div class="col-sm-4 col-md-offset-2">
								<a href="permisos-mant.php" class="btn btn-default">Regresar</a>
								<button type="submit" class="btn btn-primary">Guardar</button>
							</div>
						</div>
			      
			        	</form>
			        	
			        <!-- </div>	 -->

			</div>
	    	<?php ////endif ?>			
		</div>
	</div>		
<?php include'php/pie.php';?>