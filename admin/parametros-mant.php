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
		<h2 style="text-align: center;" class="site-title">Mantenimiento Parámetros Generales</h2>

		<?php if(!empty($statusMsg)){
	        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	    } 
	    if(($_SESSION['crmRanking']==1) || ($_SESSION['crmRanking']==2)){
	    	echo "<a href='parametros-crear.php'>
			<button type='button' class='btn btn-info'>
				Nuevo 
			</button>
		</a>";
	    }
	    ?>
		
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Parámetros</h3>
			</div>
			<div class="p-body">
				<!-- <div class="row table-responsive"> -->
					<table class="display table table-striped" id="table_id">
						<thead>
							<tr>
								<th>Código</th>
								<th>Abreviatura</th>
								<th>Secuencia #</th>
								<th>Valor Texto</th>
								<th>Descripción</th>
								<th>Empresa</th>
								<th>Estado</th>
								<!-- <th>Estado</th> -->
								<!-- <th>Por defecto</th> -->								
								<?php if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<th></th>";}?>
								<?php if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<th></th>";}?>
							</tr>
						</thead>						
						<tbody>
						<?php 
							$query=extraerParametros($_SESSION['crmRanking'],$_SESSION['crmEmpresa']);
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 
									
									echo "
									<tr>
									<td> ".$row['codparametro']." </td>
									<td>".$row['descripcion']."</td>
									<td>".$row['valor1']."</td>									
									<td>".$row['valor2']."</td>									
									<td>".$row['comentario']."</td>									
									<td>".$row['codempresa']."</td>									
									<td>".$row['estado']."</td>									
									";
									// <td> ".$row['estado']."</td>
									//<td> ".$row['por_defecto']."</td>
									 if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<td><a href='parametros-actualizar.php?accion=UDT&empresa=".$row['codempresa']."&id=".$row['codparametro']."'><img src='img/lapiz.png' width=15/></a> </td>";}
									 if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<td> <a href='php/parametros-registros.php/?accion=DLT&id=".$row['codparametro']."&empresa=".$row['codempresa']."'><img src='img/basura.png' width=15/></a> </td>";}

									
									
									echo"</tr>";
								}
								/*<td> <a href='empresa-registros.php?accion=UDT&id=".$row['codempresa']."&nombre=".$row['nombre']."&rsmnombre=".$row['rsm_nombre']."&telefono1=".$row['telefono1']."&telefono2=".$row['telefono2']."&correo=".$row['email']."&web=".$row['pweb']."&estado=".$row['estado']."&rnc=".$row['RNC']."'><img src='img/lapiz.png' width=15/></a> </td>*/
							}
							?>

						</tbody>
					</table>
					<p><span style="font-weight: bold"> Para Registrar Tener en cuenta la abreviatura: </span><br> 
					   <span style="color:red">SD:</span> Sede<br>
					   <span style="color:red">EXL:</span> Experiencia Laboral<br>
					   <span style="color:red">CAR:</span> Cargo
					</p>
				<!-- </div> -->
			</div>
		</div>
	</div>

<?php include'php/pie.php';?>