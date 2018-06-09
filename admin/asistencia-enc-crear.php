<?php include'php/cabeza3.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
}
		$fecha=date("Y-m-d").'T'.date("h:i");

?>
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Asistencia</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Secciones <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();" style="float: right;">Filtros</a> </h3>

				<?php if (isset($_GET['seccion'])): ?>
		        	<div id="importFrm"> 
		        <?php endif ?>
			    <?php if (!isset($_GET['seccion'])): ?>
		        	<div id=""> 	
				<?php endif ?>	
					<form class="form-inline" role="form" action="asistencia-enc-crear.php" >
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
			<?php //if (isset($GET['seccion'])): ?>
			<div class="p-body">
			        	<form id="frm-example" method="post" action="php/asistencia-enc-registros.php?accion=INS">

						<div class="form-group">
							<div class="col-sm-4">
								<label>Fecha / Hora</label><span style="font-weight: bold; color: red; font-size: 16px">*</span>
			        			<!-- <input type="datetime-local" name="horas" class="form-control" required="" value="<?php echo $fecha ?>"> -->
			        			<div class="input-append date form_datetime">
			                      <input size="24" type="text" value="<?php echo $fecha ?>" id= "horas" name="horas" placeholder="Fecha" required="" readonly>
			                      <span class="add-on"><i class="icon-remove"></i></span>
			                      <span class="add-on"><i class="icon-th"></i></span>
			                    </div>      
			        		</div>
			        	</div>

			        	<div class="form-group">
			        	<div class="col-sm-12 ">
			        	<table id="example" class="display">
			        		<thead>
								<tr>
									<th>C&oacute;digo</th>
									<th>Nombres</th>
									<th><!-- <input type='checkbox'  id="example-select-all1">  -->Situacion</th>
									<!-- <th><input type='checkbox'  id="example-select-all2"> Ausente</th> -->
								</tr>
							</thead>						
							<tbody >
								<?php 
								if (isset($_GET['seccion'])) {
									$seccion=$_GET['seccion'];
								}
								else{
									$seccion='';
								}

								$query=extraerSeccionesDET2($seccion);
								while ($row=$query->fetch_assoc()) {
									$query2=extaerInscritosUDT2($row['codinscripcion'],$row['codempresa']);
									$ro=$query2->fetch_assoc();
									if ($row['estado']=='A'){
										echo "
										<tr>
											<td>
												".$ro['codinscripcion']."
											</td>
											<td>
												".$ro['nombre'].' '.$ro['apellido']."
											</td>
											<td> 
											<select  name='presente[]' class='form-control' required=''> 
									            <option value='A,".$ro['codinscripcion']."'>Ausente</option>
						            			<option value='P,".$ro['codinscripcion']."'>Presente</option>         
									                      
									        </select>
									        </td>
											
										</tr>";
									}
								}
								?>
							</tbody>
						</table>
						</div>
						</div>

								<input type="hidden" name="seccion2" value="<?php echo $seccion ?>">
						<div class="form-group">
							<div class="col-sm-4" >
								<a href="asistencia-enc-mant.php" class="btn btn-default">Regresar</a>
								<button type="submit" class="btn btn-primary">Guardar</button>
							</div>
						</div>
			      
			        	</form>
			        	
			        <!-- </div>	 -->

			</div>
	    	<?php ////endif ?>			
		</div>
	</div>		
	
	<script type="text/javascript">
	    $(".form_datetime").datetimepicker({
	        // format: "dd MM yyyy - HH:ii P",
	        showMeridian: true,
	        autoclose: true,
	        todayBtn: true,
	        pickerPosition: "bottom-left"
	    });
	</script>         

<?php include'php/pie.php';?>