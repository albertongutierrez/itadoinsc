<?php include'php/cabeza.php'; 
if ($_SESSION['crmRanking']>3){
	echo"<script language='javascript'>window.location='main.php'</script>;";
}
?>
<?php 
	if(!empty($_GET['rev'])){
		$grev = $_GET['rev'];
		$gact = $_GET['act'];
	}
	else{
		$grev = 'A';
		$gact = '0';
	}

	if(!empty($_GET['status'])){
		    switch($_GET['status']){
		        case 'succ':
		            $statusMsgClass = 'alert-success';
		            $statusMsg = 'Registro almacenado correctamente.';
		            break;
		        case 'err':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Ha ocurrido un error insertando el registro.';
		            break;
		        case 'succudt':
		            $statusMsgClass = 'alert-success';
		            $statusMsg = 'Registro actualizado correctamente.';
		            break;
		        case 'errudt':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Ha ocurrido un error actualizando el registro.';
		            break;
		        case 'succdlt':
		            $statusMsgClass = 'alert-success';
		            $statusMsg = 'Registro inhabilitado correctamente.';
		            break;
		        case 'errdlt':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Ha ocurrido un error inhabilitando el registro.';
		            break;    
		        default:
		            $statusMsgClass = '';
		            $statusMsg = '';
		    }
		    
		}
		?>
<div class="content-wrapper" style="overflow:hidden;">
		<h2 style="text-align: center;" class="site-title">Resumen de Inscripciones</h2>

		<?php if(!empty($statusMsg)){
	        //echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	        echo '<div class="alert alert-dismissable '.$statusMsgClass.'"> <button type="button" class="close" data-dismiss="alert" aria-label="close" aria-hidden="true" >&times;</button>'.$statusMsg.'</div>';
	    } 
	    if(($_SESSION['crmRanking']==1) || ($_SESSION['crmRanking']==2)){
	    	echo "<a href='main.php'>
			<button type='button' class='btn btn-info'>
				<- Volver Atrás 
			</button>
		</a>";
	    }
	    ?>
		
		 <div class="panel panel-default">
			<div class="panel-heading">
		       Consultar 
		        <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();" style="float: right;">Filtros</a>
		        <br>

		        <?php if (isset($_GET['rev'])): ?>
		        	<div id="importFrm"> 
		        <?php endif ?>
			    <?php if (!isset($_GET['rev'])): ?>
		        	<div id=""> 	
				<?php endif ?>
					<form class="form-inline" role="form" action="php/filtrar-inscritos.php" method="post">
					 <br>
						 <div class="form-group">
						 	<input type="hidden" name="pagina" value="reporte-resumen-inscritos">
						 	
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
						            ?>
						              <option value="<?php echo $row['codactividad'];?>"><?php echo $row['descripcion'];?></option>
						            <?php }}
						            ?>             
						        </select>
  							</div>

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
								Inscritos Pagos
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
								Inscritos No Pagos 
							</label>
					    </div>
					    <br>
					    <button type="submit" class="btn btn-default">Filtrar</button>
					</form>
				</div>	 
			</div>
			<div class="p-body" style="width: 98%; border-style: none; margin-left: 1%;">
			<table class="display table table-striped" id="table_id" align="center">
	            <br>	        	
						<thead>
							<tr>
								<th>Actividad</th>
								<?php if($_SESSION['crmRanking']==1){echo "<th>Empresa</th>";}?>
								<th>Total</th>
								<th>Ciclistas</th>
								<th>Acompañantes</th>								
								<th>Niños</th>										
								<!-- <th>Por defecto</th> -->									
							</tr>
						</thead>						
						<tbody>
						<?php 
							$query=extraerResumenInscritos($_SESSION['crmRanking'],$_SESSION['crmEmpresa'], $gact, $grev);
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 
									
									echo "
									<tr>
									<td>".$row['actividad']."</td>";
								 	if($_SESSION['crmRanking']==1){echo "<td>".$row['codempresa']."</td>";}
									echo "
									<td>".$row['total']."</td>
									<td>".$row['ciclistas']."</td>
									<td>".$row['acompanantes']."</td>
									<td>".$row['acompanantes_menor']."</td>											
									</tr>";
								}
								
							}
							?>

						</tbody>
					</table>
				<!-- </div> -->
			</div>
		</div>
	</div>

<?php include'php/pie.php';?>