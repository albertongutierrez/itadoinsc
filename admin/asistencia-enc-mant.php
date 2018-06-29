<?php include'php/cabeza.php'; 

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
		        default:
		            $statusMsgClass = '';
		            $statusMsg = '';
		    }
		    
		}
		?>

	<div class="content-wrapper" style="overflow:hidden;">
		<h2 style="text-align: center;" class="site-title">Mantenimiento Asistencia</h2>
			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li class="active">Asistencia</li>			  
			</ol>

		<?php if(!empty($statusMsg)){
	        //echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	        echo '<div class="alert alert-dismissable '.$statusMsgClass.'"> <button type="button" class="close" data-dismiss="alert" aria-label="close" aria-hidden="true" >&times;</button>'.$statusMsg.'</div>';
	    } 
	    // if(($_SESSION['crmRanking']==1) || ($_SESSION['crmRanking']==2)){
	    	echo "<a href='asistencia-enc-crear.php'>
			<button type='button' class='btn btn-info'>
				Nuevo
			</button>
		</a>";
	    // }
	    ?>
		
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Asistencia</h3>
			</div>
			

			<div class="p-body">
				<!-- <div class="row table-responsive"> -->
					<table class="display table table-striped" id="table_id">
						<thead>
							<tr>
								<th>Código</th>
								<th>Curso</th>
								<th>Presente</th>
								<th>Ausente</th>
								<th>Fecha</th>
								<th>Estado</th>
								<th></th>
								<th></th>
							</tr>
						</thead>						
						<tbody>
						<?php 
							$ausente=0;
							$presente=0;
							$query=extraerAsistenciaENC();
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 
									$ausente=0;
									$presente=0;
									$query2=extraerAsistenciaDETSUM($row['codasistencia_enc']);
									$query3=extraerAsistenciaCURSO($row['codasistencia_enc']);
									$r=$query3->fetch_assoc();
									while ($ro=$query2->fetch_assoc()) {
										if ($ro['condicion']=='A'){
											$ausente=$ro['total'];
										}
										if ($ro['condicion']=='P'){
											$presente=$ro['total'];
										}
									}
									echo "
									<tr>
									<td> ".$row['codasistencia_enc']." </td>
									<td> ".$r['asignatura']." </td>
									<td> ".$presente." </td>
									<td> ".$ausente." </td>
									<td>".$row['fecha']."</td>
									<td> ".$row['estado']."</td>
									";
									echo "<td><a data-toggle='tooltip' title='Editar' href='asistencia-enc-actualizar.php?empresa=".$row['codempresa']."&id=".$row['codasistencia_enc']."'><img src='img/lapiz.png' width=15/></a> </td>";
									// echo "<td> <a data-toggle='tooltip' title='Anular' href='php/asistencia-enc-registros.php/?accion=DLT&id=".$row['codasistencia_enc']."&empresa=".$row['codempresa']."'><img src='img/basura.png' width=15/></a> </td>";
												echo "<td>"?> 
													<img 
													data-toggle='tooltip'
													src='img/basura.png' width='15' title='Anular' onclick="
													$.confirm({
												    title: '¿Estás seguro? ',
												    content: 'Con esta acción el registro seleccionado sera eliminado',
												    buttons: {
												        confirmar: function () {
												 window.location='php/asistencia-enc-registros.php/?accion=DLT&id=<?php echo $row['codasistencia_enc']."&empresa=".$row['codempresa'];?>';
												        },
												        cancelar: function () {
												            // $.alert('Cancelado!');
												        }
												    }
												});"/>
											<?php echo"
										 </td>";					
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

	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();   
		});
	</script>

<?php include'php/pie.php';?>