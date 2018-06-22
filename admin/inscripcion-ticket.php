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
		<h2 style="text-align: center;" class="site-title">Impresion de Ticket</h2>

		<?php if(!empty($statusMsg)){
	        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	    } 
	 //    if(($_SESSION['crmRanking']==1) || ($_SESSION['crmRanking']==2)){
	 //    	echo "<a href='inscripcion-crear.php'>
		// 	<button type='button' class='btn btn-info'>
		// 		Nueva
		// 	</button>
		// </a>";
	 //    }
	    ?>
		
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Inscripciones</h3>
			</div>
			<div class="p-body">
				<!-- <div class="row table-responsive"> -->
					<table class="display table table-striped" id="table_id">
						<thead>
							<tr>
								<th>Código</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Estado</th>
								<th></th>
							</tr>
						</thead>						
						<tbody>
						<?php 
							$query=extaerInscritos2();
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 
									
									echo "
									<tr>
									<td> ".$row['codinscripcion']." </td>
									<td>".$row['nombre']."</td>
									<td>".$row['apellido']."</td>
									<td> ".$row['estado_inscripcion']."</td>
									<td><a data-toggle='tooltip' title='Imprimir' target='_blank' href='inscripcion-ticket-generar.php?accion=UDT&empresa=".$row['codempresa']."&id=".$row['codinscripcion']."'><img src='img/printer.png' width=15/></a> </td>";
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