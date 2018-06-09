<?php include'php/cabeza.php'; 
if ($_SESSION['crmRanking']>3){
	echo"<script language='javascript'>window.location='main.php'</script>;";
}
?>
<?php 
	if(!empty($_GET['act'])){
		$gact = $_GET['act'];
		$grev = 'S'; // $_GET['rev']; //SOLO MOSTRAR LOS FORMALIZADOS
	}
	else{
		$gact = '0';
		$grev = 'S'; //SOLO MOSTRAR LOS FORMALIZADOS
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
		<h2 style="text-align: center;" class="site-title">Datos de Emergencia</h2>

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
						 	<input type="hidden" name="pagina" value="reporte-emergencias">			
					    	<label>Datos a Motrar</label>
					    	<br>
					    	<div class="form-group">
    							<label class="sr-only" for="actividad">Actividad</label>
    							<select id="codactividad" name="codactividad" class="form-control" required> 
			            			<!-- <option value= 'A'>Seleccione la actividad</option>            -->
						             <?php 
										$query=extraerSeccionesENC();						
							            if($query->num_rows > 0){
							            while ($row= $query -> fetch_array())
							                  { 
							            ?>
							              <option value="<?php echo $row['codseccion_enc'];?>"><?php echo $row['descripcion'];?></option>
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
								<!-- <th>Actividad</th> -->
								<th>Código</th>
								<?php if($_SESSION['crmRanking']==1){echo "<th>Empresa</th>";}?>
								<th>Participante</th>								
								<th>Cédula</th>
								<th>Nombre Emergencia</th>								
								<th>Teléfono Emergencia</th>
								<?php if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<th></th>";}?>																								
							</tr>
						</thead>						
						<tbody>
						<?php 
							$query=extraerInscritosLinea2($_SESSION['crmRanking'],$_SESSION['crmEmpresa'], $gact, $grev); // solo muestro los formalizados 
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 									
									echo "
									<tr>
									
									<td> ".$row['codinscripcion']."-".$row['inscrito_en']." </td>";
								 	if($_SESSION['crmRanking']==1){echo "<td>".$row['codempresa']."</td>";}
									echo "
									<td> ".$row['nombre']." ".$row['apellido']."</td>									
									<td> ".$row['cedula']."</td>
									<td> ".$row['contacto_emergencia']."</td>
									<td> ".$row['telefono_emergencia']."</td>
									";//<td> ".$row['por_defecto']."</td>
									if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<td><a href='inscritos2-actualizar.php?accion=UDT&pagina=E&empresa=".$row['codempresa']."&id=".$row['codinscripcion']."'><img src='img/lapiz.png' width=15/></a> </td>";}									  
									 																	
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