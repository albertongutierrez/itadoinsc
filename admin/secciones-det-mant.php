<?php include'php/cabeza.php'; 
if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='main.php'</script>;";
}
?>
<?php 
	if(!empty($_GET['status'])){
		    switch($_GET['status']){
		        case 'succ':
		            $statusMsgClass = 'alert-success';
		            $statusMsg = 'Registro almacenado correctamente.';
		            break;
		        case 'err':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Ha ocurrido un error insertendo el registro.';
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
		        case 's':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Error: Ya esta asignadoa aun curso diferente.';
		            break;
		       	case 'sudt':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Error: Ya no pertenece a este curso.';
		            break;
		        default:
		            $statusMsgClass = '';
		            $statusMsg = '';
		    }
		    
		}
		?>

	<div class="content-wrapper" style="overflow:hidden;">
		<h2 style="text-align: center;" class="site-title">Asignar Secciones</h2>

			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li class="active">Asignar Secciones</li>			  
			</ol>
		<?php if(!empty($statusMsg)){
	        //echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	        echo '<div class="alert alert-dismissable '.$statusMsgClass.'"> <button type="button" class="close" data-dismiss="alert" aria-label="close" aria-hidden="true" >&times;</button>'.$statusMsg.'</div>';
	    } 
	    if(($_SESSION['crmRanking']==1) || ($_SESSION['crmRanking']==2)){
	    	echo "<a href='secciones-det-crear.php'>
			<button type='button' class='btn btn-info'>
				Nuevo
			</button>
		</a>";
	    }
	    ?>
			
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Asignar Secciones <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();" style="float: right;">Filtros</a> </h3>

				<?php if (isset($_GET['seccion'])): ?>
		        	<div id="importFrm"> 
		        <?php endif ?>
			    <?php if (!isset($_GET['seccion'])): ?>
		        	<div id=""> 	
				<?php endif ?>	
					<form class="form-inline" role="form" action="secciones-det-mant.php" >
					 <br>
						 <div class="form-group">
						 			
					    	<label>Datos a Motrar</label>
					    	<br>
					    	<div class="form-group">
    							<label class="sr-only" for="actividad">Actividad</label>
    							<select id="codactividad" name="seccion" class="form-control" required=""> 
			            			<!-- <option value="">Seleccione</option>            -->
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
			<?php if (isset($_GET['seccion']) and !empty($_GET['seccion']) ): ?>
				
			<div class="p-body">
				<!-- <div class="row table-responsive"> -->
					<table class="display table table-striped" id="table_id">
						<thead>
							<tr>
								<th>Código</th>
								<th>Nombres	</th>
								<th>Seccion	</th>
								<th></th>
								<th></th>
							</tr>
						</thead>						
						<tbody>
						<?php 
							$query=extraerSeccionesDET2($_GET['seccion']);
				 			if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 
									$query2=extaerInscritosUDT2($row['codinscripcion'],$row['codempresa']);
									$ro=$query2->fetch_assoc();

									echo "
									<tr>
									<td> ".$row['codseccion_det']." </td>";
									echo "
									<td>".$ro['nombre'].' '.$ro['apellido']."</td>
									
									<td> ".$row['estado']."</td>
									";//<td> ".$row['por_defecto']."</td>
									  echo"<td><a data-toggle='tooltip' title='Editar' href='secciones-det-actualizar.php?accion=UDT&empresa=".$row['codempresa']."&id=".$row['codseccion_det']."&user=".$row['codinscripcion']."'><img src='img/lapiz.png' width=15/></a> </td>"; 
									  if (($ro['codinscripcion']==$row['codinscripcion']) and ($row['estado']=='A')){
									  	echo "<td>"?> 
													<img 
													data-toggle='tooltip'
													src='img/basura.png' width='15' title='Anular' onclick="
													$.confirm({
												    title: '¿Estás seguro? ',
												    content: 'Con esta acción el registro seleccionado sera eliminado',
												    buttons: {
												        confirmar: function () {
												 window.location='php/secciones-det-registros.php/?accion=DLT&id=<?php echo $row['codseccion_det']."&empresa=".$row['codempresa']."&user=".$row['codinscripcion'];?>';
												        },
												        cancelar: function () {
												            // $.alert('Cancelado!');
												        }
												    }
												});"/>
											<?php echo"
										 </td>";
										}
										else{
											echo "<td></td>";
										}
									echo "</tr>";
								
								}
								/*<td> <a href='empresa-registros.php?accion=UDT&id=".$row['codempresa']."&nombre=".$row['nombre']."&rsmnombre=".$row['rsm_nombre']."&telefono1=".$row['telefono1']."&telefono2=".$row['telefono2']."&correo=".$row['email']."&web=".$row['pweb']."&estado=".$row['estado']."&rnc=".$row['RNC']."'><img src='img/lapiz.png' width=15/></a> </td>*/
							}
							?>

						</tbody>
					</table>
				<!-- </div> -->
			</div>
			<?php endif ?>
		</div>
	</div>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<?php include'php/pie.php';?>