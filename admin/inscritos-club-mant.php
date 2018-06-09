<?php include'php/cabeza.php'; 
if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='main.php'</script>;";
}
?>
<?php 
	if(!empty($_GET['rev'])){
		$gact = $_GET['act'];
		$grev = $_GET['rev'];
	}
	else{
		$gact = '0';
		$grev = 'A';
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
		        case 'errP1':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'El monto adeudado es mayor que lo ingresado para pagar.';
		            break;     
		        case 'errP2':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'La cantidad de participantes no puede ser menor o igual que cero';
		            break;          
		        default:
		            $statusMsgClass = '';
		            $statusMsg = '';
		    }
		    
		}
		?>

	<div class="content-wrapper" style="overflow:hidden;">
		<h2 style="text-align: center;" class="site-title">Mantenimiento Inscripción Directa</h2>

		<?php if(!empty($statusMsg)){
	        //echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	        echo '<div class="alert alert-dismissable '.$statusMsgClass.'"> <button type="button" class="close" data-dismiss="alert" aria-label="close" aria-hidden="true" >&times;</button>'.$statusMsg.'</div>';
	    } 
	    if(($_SESSION['crmRanking']==1) || ($_SESSION['crmRanking']==2)){
	    	echo "<a href='inscritos-club-crear.php'>
			<button type='button' class='btn btn-info'>
				Nueva 
			</button>
		</a>";
	    }
	    ?>
		
		<div class="panel panel-default" style="margin-top: 10px">
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
						 	<input type="hidden" name="pagina" value="inscritos-club-mant">			
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
  							<div class="form-group">
    							<label class="sr-only" for="inscritoen">Inscrito en:</label>
    							<select id="codinscritoen" name="codinscritoen" class="form-control">
						            <option value= 'A'>TODAS LAS INSCRIPCIONES</option>           
						            <?php 
									$query=extraerInscritoEn($_SESSION['crmRanking'],$_SESSION['crmEmpresa']);						
						            if($query->num_rows > 0){
						            while ($row= $query -> fetch_array())
						                  { 
						            ?>
						              <option value="<?php echo $row['codinscritoen'];?>"><?php echo $row['descripcion'];?></option>
						            <?php }}
						            ?>             
						        </select>
  							</div>
					    
						<button type="submit" class="btn btn-default">Filtrar</button>
					    </div>
					</form>
				</div>	
			</div>
			<div class="p-body">
				<!-- <div class="row table-responsive"> -->
					<table class="display table table-striped" id="table_id">
						<thead>
							<tr>
								<th>Código</th>
								<?php if($_SESSION['crmRanking']==1){echo "<th>Empresa</th>";}?>
								<th>Cliente</th>
								<th>Participantes</th>								
								<th>Acompañantes</th>
								<th>Menores</th>
								<th>Pagado</th>								
								<th>Recibido</th>
								<th>Devuelto</th>
								<!-- <th>Por defecto</th> -->																								
							</tr>
						</thead>						
						<tbody>
						<?php 
							$query=extraerInscritosClub($_SESSION['crmRanking'],$_SESSION['crmEmpresa'], $gact, $grev);
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 
									
									echo "
									<tr>
									<td> ".$row['codinscripcion']."-".$row['inscrito_en']." </td>";
								 	if($_SESSION['crmRanking']==1){echo "<td>".$row['codempresa']."</td>";}
									echo "									
									<td> ".$row['nombre']."</td>	
									<td> ".$row['cant_participante']."</td>	
									<td> ".$row['cant_acom_mayor']."</td>
									<td> ".$row['cant_acomp_menor']."</td>									
									<td> ".$row['pagado']."</td>	
									<td> ".$row['recibido']."</td>	
									<td> ".$row['monto_devuelto']."</td>	
									";//<td> ".$row['por_defecto']."</td>
									  																	
									echo"</tr>";
								}
								/*<td> <a href='empresa-registros.php?accion=UDT&id=".$row['codempresa']."&nombre=".$row['nombre']."&rsmnombre=".$row['rsm_nombre']."&telefono1=".$row['telefono1']."&telefono2=".$row['telefono2']."&correo=".$row['email']."&web=".$row['pweb']."&estado=".$row['estado']."&rnc=".$row['RNC']."'><img src='img/lapiz.png' width=15/></a> </td>*/
							}
							?>

						</tbody>
					</table>
				<!-- </div> -->
			</div>
		</div>
	</div>

<?php include'php/pie.php';?>