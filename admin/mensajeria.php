<?php include'php/cabeza2.php'; 
if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='main.php'</script>;"; 
}
if(isset($_GET['codactividad']) && isset($_GET['datos'])){		
		$grev = $_GET['datos'];
		$gact = $_GET['codactividad'];
	}
	else{
		$grev = 'w';
		$gact = '0';
	}
	$actividad='';
?>


	<div class="content-wrapper" style="overflow:hidden;">
		<h2 style="text-align: center;" class="site-title">Mensajer&iacute;a</h2>
		
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
			Mensajer&iacute;a
			<a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();" style="float: right; text-decoration:none;">Filtros</a><br>
			
			
			<?php if (isset($_GET['codactividad']) && isset($_GET['datos'])) : ?>
		        <div id="importFrm"> 
		    <?php endif;?>

		    <?php if (!isset($_GET['codactividad']) && !isset($_GET['datos'])) : ?>
		        <div id=""> 
		    <?php endif;?>
					<form class="form-inline" role="form" action="mensajeria.php" method="get">
					 <br>						 
						  <div class="form-group">
						 <!-- 	<input type="hidden" name="pagina" value="reporte-grupos-inscritos"> -->
					    	<label>Datos a Motrar</label>
					    	<br>
					    	<div class="form-group">
    							<label class="sr-only" for="actividad">Actividad</label>
    							<select id="codactividad" name="codactividad" class="form-control" required> 
			            			<!-- <option value= 'A'>Seleccione la actividad</option>            -->
						            <?php 
									$query=extraerActividad($_SESSION['crmRanking'],$_SESSION['crmEmpresa']);						
						            if($query->num_rows > 0){
						            while ($row= $query -> fetch_array())
						                  { 
						                  	if($row['codactividad']==$_GET['codactividad']){
						                  		$actividad=$row['descripcion'];
						                  	}
						            ?>
						              <option value="<?php echo $row['codactividad'];?>"><?php echo $row['descripcion'];?></option>
						            <?php }}
						            ?>             
						        </select>
  							</div>  							
  								    
						<!-- <button type="submit" class="btn btn-default">Filtrar</button> -->
					    </div>

						 <div class="form-group">
						 							 	
					    	<!-- <label>Datos a Motrar</label> -->
					    	<br>
					    	<label class="radio-inline">
					    	<input type="radio" name="datos" value="A"
							<?php
							 if ($grev == 'A'){
							 	?>
							 	checked="checked"
							 	<?php
							 } 
							?>
					    	>					 
					    	Todos
					    	</label>

							<label class="radio-inline">
								<input type="radio" name="datos" value="S"
								<?php
								 if ($grev == 'S'){
								 	?>
								 	checked="checked"
								 	<?php
								 } 
								?>
							>
								Inscripci&oacute;n Confirmada (S)
							</label>

							<label class="radio-inline">
								<input type="radio" name="datos" value="N"
								<?php
								 if ($grev == 'N'){
								 	?>
								 	checked="checked"
								 	<?php
								 } 
								?>
							>
								Inscripci&oacute;n Sin Confirmar (N) 
							</label>
					    </div>
					    <br>
					    <br>
					  	<div class="form-group">
					    	<button type="submit" class="btn btn-default">Filtrar</button>
					    </div>
					</form>
				</div>	 
			</div>
			<?php if (isset($_GET['codactividad']) && isset($_GET['datos'])) : ?>
			<div class="p-body">
				<!-- <div class="row table-responsive"> -->
				<form method="POST" action="nuevo-mensaje.php" id="frm-example">
				<input type="hidden" name="evento" value="<?php echo $actividad ?>">
					<table class="display" id="example" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th><input name="select_all" value="1" id="example-select-all" type="checkbox"/> All</th>
								<th>Código</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Email</th>
							</tr>
						</thead>						
						<tbody>
						
						<?php 
							$query=extraerCorreos();
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 
									if ($grev=='A'){
										echo "
										<tr>
										 	<td><input name='id[]'  id='id' type='checkbox'  value='".$row['email']."' />
                                			</td>
											<td> ".$row['codigo']." </td>
											<td>".$row['nombre']."</td>
											<td> ".$row['apellido']."</td>
											<td> ".$row['email']."</td>
										</tr>";
									}
									elseif ($grev=='S'){
										if($row['revisado']=='S'){
											echo "
										<tr>
										 	<td><input name='id[]'  id='id' type='checkbox'  value='".$row['email']."' />
                                			</td>
											<td> ".$row['codigo']." </td>
											<td>".$row['nombre']."</td>
											<td> ".$row['apellido']."</td>
											<td> ".$row['email']."</td>
										</tr>";
										}
									}
									elseif ($grev=='N'){
										if($row['revisado']=='N'){
											echo "
										<tr>
										 	<td><input name='id[]'  id='id' type='checkbox'  value='".$row['email']."' />
                                			</td>
											<td> ".$row['codigo']." </td>
											<td>".$row['nombre']."</td>
											<td> ".$row['apellido']."</td>
											<td> ".$row['email']."</td>
										</tr>";
										}
									}
								}
						
							}
							?>

						</tbody>
					</table>
					 <button class='btn btn-success'>Enviar Mensaje</button></p>
							
				</form>
				<!-- </div> -->
			</div>
			<?php endif ?>
		</div>
	</div>

<?php include'php/pie.php';?>