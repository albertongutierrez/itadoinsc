<?php include'php/cabeza.php'; 
// if ($_SESSION['crmRanking']>2){
// 	echo"<script language='javascript'>window.location='main.php'</script>;";
// }
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
		<h2 style="text-align: center;" class="site-title">Mantenimiento Permisos</h2>

			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li class="active">Permisos</li>			  
			</ol>
		<?php if(!empty($statusMsg)){
	        //echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	        echo '<div class="alert alert-dismissable '.$statusMsgClass.'"> <button type="button" class="close" data-dismiss="alert" aria-label="close" aria-hidden="true" >&times;</button>'.$statusMsg.'</div>';
	    } 
	    // if(($_SESSION['crmRanking']==1) || ($_SESSION['crmRanking']==2)){
	    	echo "<a href='permisos-crear.php'>
			<button type='button' class='btn btn-info'>
				Nuevo
			</button>
		</a>";
	    // }
	    ?>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Permisos</h3>
			</div>
			<div class="p-body">
				<!-- <div class="row table-responsive"> -->
					<table class="display table table-striped" id="table_id3">
						<thead>
							<tr>

								<!-- <th>ID</th> -->
								<th>Matricula</th>
								<th>Nombres</th>
								<th>Asignatura</th>
								<th>Sección</th>
								<th>Estado Permiso</th>
								<th>H. Inicio</th>
								<th>H. Fin</th>
								<th>Estado</th>
								<th>Fecha</th>
								<!-- <?php 
								//if ($row['estado_permiso']=='A'){
									//echo "<th></th>";
								//}
								?> -->

								<th></th>
								<th></th>
							</tr>
						</thead>						
						<tbody>
						<?php 
							$ausente=0;
							$presente=0;
							$estado_p='Finalizado';
							$query=extraerPermisos();
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 

									if($row['estado_permiso']=='A' ){
										$estado_p='Activo';
									}
									if($row['estado_permiso']=='I'){
										$estado_p='Finalizado';
									}
									echo "
									<tr>
									<td> ".$row['id']." </td>
									<td> ".$row['nombres']." </td>
									<td> ".$row['curso']." </td>
									<td> ".$row['seccion']." </td>
									<td>".$estado_p."</td>
									<td> ".$row['ini']."</td>
									<td> ".$row['fin']."</td>
									<td> ".$row['estado']."</td>
									<td>".$row['fecha']."</td>
									";
									echo "<td><a data-toggle='tooltip' title='Editar' href='permisos-actualizar.php?accion=UDT&empresa=".$row['codempresa']."&id=".$row['codigo']."&seccion=".$row['seccion']."'><img src='img/lapiz.png' width=15/></a> </td>";
									if ($row['estado_permiso']=='A'){
										echo "<td><a data-toggle='tooltip' title='Finalizar' href='php/permisos-registros.php?accion=CUT&empresa=".$row['codempresa']."&id=".$row['codigo']."'><img src='img/tj.png' width=15/></a> </td>";
									}
									else{
											echo "<td>"?> 
													<img 
													data-toggle='tooltip'
													src='img/basura.png' width='15' title='Anular' onclick="
													$.confirm({
												    title: '¿Estás seguro? ',
												    content: 'Con esta acción el registro seleccionado sera eliminado',
												    buttons: {
												        confirmar: function () {
												 window.location='php/permisos-registros.php/?accion=DLT&id=<?php echo $row['codigo']."&empresa=".$row['codempresa'];?>';
												        },
												        cancelar: function () {
												            // $.alert('Cancelado!');
												        }
												    }
												});"/>
											<?php echo"
										 </td>";
									}
																		
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