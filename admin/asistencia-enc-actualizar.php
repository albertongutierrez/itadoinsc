<?php include'php/cabeza.php';

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

$id=$_GET['id'];
$empresa=$_GET['empresa'];
$query3=extraerSeccionesENCUDT($id,$empresa);
$r=$query3->fetch_assoc();
$query4=extraerAsistenciaENCUDT($id);
$ru=$query4->fetch_assoc();
$fecha=date("Y-m-d",strtotime($ru['fecha'])).'T'.date("h:i",strtotime($ru['fecha']));

	if ( empty($ru['codasistencia_enc']) && ($Vid != 0)
		){
        $statusMsgClass = 'alert-danger';
        $statusMsg = 'La consulta no devolvió ningún resultado.';
    }



?>
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Asistencia</p>
			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li><a href="asistencia-enc-mant.php">Asistencia</a></li>
			  <li class="active">Editar Registro</li>			  
			</ol>

			 <?php if(!empty($statusMsg)){
                    echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
                    die("<a href='javascript:history.go(-1);' class='btn btn-warning btn-fill'>Datos no encontrados, volver atrás</a>");
                } ?>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Secciones  </h3>

			</div>
			<div class="p-body">
			        	<form id="frm-example2" method="post" action="php/asistencia-enc-registros.php?accion=UDT">

						<div class="row">
					    	<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">					 
				        		<div class="form-group ">
	    							<label class="control-label">Seccion <span style="font-weight: bold; color: red; font-size: 25px"></span></label>	
							         <input type="text" id="seccion" name="seccion" class="form-control" required="" readonly="" value="<?php echo $ru['codseccion_enc'];?>"> 
							         <input type="hidden" name="codigo" value="<?php echo $id ?>"> 			
							    </div>  							
						    </div>

							<div class="col-md-4 col-md-offset-0 col-sm-offset-0 col-sm-4 col-xs-12 col-xs-offset-0 col-lg-4">
								<div class="form-group">
									<label class="control-label">Fecha / Hora <span style="font-weight: bold; color: red; font-size: 25px">*</span></label>
				        			<!-- <input type="datetime-local" name="horas" class="form-control" required="" value="<?php echo $fecha ?>"> -->
				        			<div class="input-append date form_datetime">
										
			                        	<div class="input-group">

					                     	<input size="24" class="form-control" type="text" value="<?php echo $fecha ?>" id= "horas" name="horas" placeholder="Fecha" required="" readonly>
						                  
						                    <span class="add-on input-group-addon"><i class="icon-remove" style="width: 50%"></i></span>
						                    <span class="add-on input-group-addon" ><i class="icon-th" style="width: 50%"></i></span>
						                </div>

				                    </div>   
				        		</div>
				        	</div>
			        	</div>
						<div class="row">
							<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
				        		<div class="form-group">
									<label for='estado' class='control-label'>Estado</label>
									<select class='form-control' id='estado' name='estado'>
										<option value='A' <?php if($ru['estado']=='A'){echo'selected';}?>>ACTIVO</option>
										 <option value='I' <?php if($ru['estado']=='I'){echo'selected';}?>>INACTIVO</option>	
									</select>
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
									<th>Situación</th>
									<!-- <th><input type='checkbox'  id="example-select-all1"> Presente</th>
									<th><input type='checkbox'  id="example-select-all2"> Ausente</th> -->
								</tr>
							</thead>						
							<tbody >
								<?php 
								$seccion=$r['codseccion_enc'];
								$query=extraerAsistenciaDETUDT2($id);
								while ($row=$query->fetch_assoc()) {
									$condi=$row['condicion'];
									$query2=extaerInscritosUDT2($row['codinscripcion'],$row['codempresa']);
									$ro=$query2->fetch_assoc();
									?>
									<tr>
										<td>
											<?php echo $ro['codinscripcion']?> 
										</td>
										<td>
										<?php echo  $ro['nombre'].' '.$ro['apellido']; ?>	
										</td>

										<td> 
											<select  name='presente[]' class='form-control' id="selector" required='' > 
						            			<option value='<?php echo "P,".$ro['codinscripcion'];?>' <?php if ($condi=='P'){echo "selected";} ?>>Presente</option>         
									            <option value='<?php echo "A,".$ro['codinscripcion'];?>' <?php if ($condi=='A'){echo "selected";} ?>>Ausente</option>
									                      
									        </select>
									        </td>
										
									</tr>
								<?php
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