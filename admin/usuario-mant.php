<?php include'php/cabeza.php'; 
// if ($_SESSION['crmRanking']>2){
// 	echo"<script language='javascript'>window.location='empresa-mant.php'</script>;";
// }
?>
<?php 
	if(!empty($_GET['status'])){
		    switch($_GET['status']){
		    	case 'username':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Usuario registrado, pruebe con otro.';
		            break;
				case 'pass':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Las contraseñas no coinciden.';
		            break;
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
		<h2 style="text-align: center;" class="site-title">Mantenimiento Usuarios</h2>

		<?php if(!empty($statusMsg)){
	        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	    } 
	    if($_SESSION['crmRanking']<=2  ){
	    	echo "<a href='usuario-crear.php'>
			<button type='button' class='btn btn-info'>
				Nuevo 
			</button>
		</a>";
	    }
	    ?>
		
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Usuarios</h3>
			</div>
			<div class="p-body">
				<!-- <div class="row table-responsive"> -->
					<table class="display table table-striped" id="table_id">
						<thead>
							<tr>
								<th>Código</th>
								<th>Usuario</th>
								<th>Estado</th>
								<!-- <th>Por defecto</th> -->
								<th></th>
								<?php if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<th></th>";}?>
							</tr>
						</thead>						
						<tbody>
						<?php
							$query=extraerUsuarios();

							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 
									
									echo "
									<tr>
									<td> ".$row['codusuario']." </td>
									<td>".$row['username']."</td>
									<td> ".$row['estado']."</td>
									";//<td> ".$row['por_defecto']."</td>
									echo "<td> <a href='usuario-actualizar.php?accion=UDT&id=".$row['codempresa']."&us=".$row['username']."'><img src='img/lapiz.png' width=15/></a> </td>";
									 if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2 ){echo "<td> <a href='php/usuario-registros.php?accion=DLT&id=".$row['codempresa']."&username=".$row['username']."'><img src='img/basura.png' width=15/></a> </td>";}									
									
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