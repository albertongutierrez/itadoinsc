<?php include'php/cabeza.php';

		$fecha=date("Y-m-d").'T'.date("h:i");
		$creada=false;
		$ids='';
		$empresa='';
		$seccion=''

?>
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Asistencia</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Sección: <span class="seccion"></span> <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();" style="float: right;">Filtros</a> </h3>

				<?php 
					if (isset($_GET['seccion'])): 
						$consulta=extraerAsistenciaCreada($_GET['seccion']);
						// echo $consulta;
						if($consulta->num_rows>0){
							$creada=true;

							$var=$consulta->fetch_assoc();
							$ids=$var['codasistencia_enc'];
							$empresa=$var['codempresa'];
						}
					?>
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
    							<select id="seccion" name="seccion" class="form-control" required=""> 
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
			        	<form id="frm-example2" method="post" action="php/asistencia-enc-registros.php?accion=INS">

						<div class="col-sm-4">
							<div class="form-group">
			        			<div class="input-append date form_datetime">
								
								<label class="control-label">Fecha / Hora</label><span style="font-weight: bold; color: red; font-size: 16px">*</span>
		                        <div class="input-group">
			                    	<input size="24" type="text" class="form-control" value="<?php echo $fecha ?>" id= "horas" name="horas" placeholder="Fecha" required="" readonly>
			                    	<span class="add-on input-group-addon"><i class="icon-remove"></i></span>
			                    	<span class="add-on input-group-addon"><i class="icon-th"></i></span>
			                    </div> 
			                    </div> 

			        		</div>
			        	</div>

			        	<div class="form-group">
			        	<div class="col-sm-12 ">
			        	<table id="example2" class="display">
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
							if ($creada!=true){
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
											<select  name='presente[]' class='form-control' required='' id='selector'> 
									            <option value='A,".$ro['codinscripcion']."'>Ausente</option>
						            			<option value='P,".$ro['codinscripcion']."'>Presente</option>         
									                      
									        </select>
									        </td>
											
										</tr>";
									}
								}
							}
							else{
								echo "
								<script>
									$.confirm({
									    title: 'Ya se ha pasado asistencia!',
									    content: 'Desea Editarla?',
									    buttons: {
									        Si: function () {
												window.location='asistencia-enc-actualizar.php?id=".$ids."&empresa=".$empresa."';
									 		},
									        cancelar: function () {
									            // $.alert('Cancelado!');
									        }
									    }
									});
								</script>";
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
	    $('.seccion').text($('#seccion option:selected').text());
	</script>         

<?php include'php/pie.php';?>