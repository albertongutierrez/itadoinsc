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
		<h2 style="text-align: center;" class="site-title">Mantenimiento Países</h2>
		<ol class="breadcrumb">
		  <li><a href="main.php">Inicio</a></li>
		  <li class="active">Países</li>			  
		</ol>
		<?php if(!empty($statusMsg)){
	        //echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	        echo '<div class="alert alert-dismissable '.$statusMsgClass.'"> <button type="button" class="close" data-dismiss="alert" aria-label="close" aria-hidden="true" >&times;</button>'.$statusMsg.'</div>';
	    } 
	    if(($_SESSION['crmRanking']==1) || ($_SESSION['crmRanking']==2)){
	    	echo "<a href='paises-crear.php'>
			<button type='button' class='btn btn-info'>
				Nuevo 
			</button>
		</a>";
	    }
	    ?>
		
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Países</h3>
			</div>
			<div class="p-body">
				<!-- <div class="row table-responsive"> -->
					<table class="display table table-striped" id="table_id">
						<thead>
							<tr>
								<th>Código</th>								
								<th>Descripción</th>
								<th>ISO</th>
								<th>Estado</th>
								<!-- <th>Por defecto</th> -->								
								<?php if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<th></th>";}?>
								<?php if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<th></th>";}?>
							</tr>
						</thead>						
						<tbody>
						<?php 
							$query=extraerPaises($_SESSION['crmRanking'],$_SESSION['crmEmpresa']);
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 
									
									echo "
									<tr>
									<td> ".$row['codpais']." </td>
									<td>".$row['descripcion']."</td>
									<td>".$row['iso']."</td>
									<td> ".$row['estado']."</td>
									";//<td> ".$row['por_defecto']."</td>
								
									if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<td><a data-toggle='tooltip' title='Editar' href='paises-actualizar.php?accion=UDT&id=".$row['codpais']."'><img src='img/lapiz.png' width=15/></a> </td>";}
									if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<td>"?> 
													<img 
													data-toggle='tooltip'
													src='img/basura.png' width='15' title='Anular' onclick="
													$.confirm({
												    title: '¿Estás seguro? ',
												    content: 'Con esta acción el registro seleccionado sera eliminado',
												    buttons: {
												        confirmar: function () {
												 window.location='php/paises-registros.php/?accion=DLT&id=<?php echo $row['codpais'];?>';
												        },
												        cancelar: function () {
												            // $.alert('Cancelado!');
												        }
												    }
												});"/>
											<?php echo"
										 </td>";}																		
									echo"</tr>";
									
								}								
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