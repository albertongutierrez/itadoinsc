<?php include'php/cabeza.php'; 
if ($_SESSION['crmRanking']>2){
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
		<h2 style="text-align: center;" class="site-title">Mantenimiento Inscritos en Línea</h2>

		<?php if(!empty($statusMsg)){
	        //echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	        echo '<div class="alert alert-dismissable '.$statusMsgClass.'"> <button type="button" class="close" data-dismiss="alert" aria-label="close" aria-hidden="true" >&times;</button>'.$statusMsg.'</div>';
	    } 
	    if(($_SESSION['crmRanking']==1) || ($_SESSION['crmRanking']==2)){
		echo "<a href='main.php'>
			<button type='button' class='btn btn-info' >
				Volver Atrás 
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
						 	<input type="hidden" name="pagina" value="inscritos-mant">
						 	
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
			<table class="display table table-striped" id="table_id2" align="center">
	            <br>
	        	<thead>
					<tr>
						<th>Código</th>
						<?php if($_SESSION['crmRanking']==1){echo "<th>Empresa</th>";}?>
						<th>Fecha</th>
						<th>Nombre</th>								
						<th>Cédula</th>
						<th>Teléfono</th>
						<!-- <th>Correo</th>								 -->
						<th>Fecha Saldo</th>
						<th>Revisado</th>
						<th>Comentario</th>
						<!-- <th>Por defecto</th> -->								
						<?php if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<th></th>";}?>
								
					</tr>
				</thead>
				<tbody>
						<?php 
							$query=extraerInscritosLinea($_SESSION['crmRanking'],$_SESSION['crmEmpresa'],$gact, $grev);
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) {
									$q=extraerComentarioCk($row['codinscripcion'],$row['inscrito_en']);
									$r=$q->fetch_assoc();	
									echo "
									<tr>
									<td> ".$row['codinscripcion']." </td>";
								 	if($_SESSION['crmRanking']==1){echo "<td>".$row['codempresa']."</td>";}
									echo "
									<td>".$row['fecha_inscripcion']."</td>
									<td> ".$row['nombre']." ".$row['apellido']."</td>									
									<td> ".$row['cedula']."</td>
									<td> ".$row['telefono']."</td>
									
									<td> ".$row['fecha_saldo']."</td>	
									<td> ".$row['revisado']."</td>	
									<td> ".$r['comentario']."</td>
									";//<td> ".$row['por_defecto']."</td>
									  if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<td><a data-toggle='tooltip' title='Editar' href='inscritos-actualizar.php?accion=UDT&empresa=".$row['codempresa']."&id=".$row['codinscripcion']."'><img src='img/lapiz.png' width=15/></a> </td>";}
									 
									
									
									echo"</tr>";
								}
								/*<td> <a href='empresa-registros.php?accion=UDT&id=".$row['codempresa']."&nombre=".$row['nombre']."&rsmnombre=".$row['rsm_nombre']."&telefono1=".$row['telefono1']."&telefono2=".$row['telefono2']."&correo=".$row['email']."&web=".$row['pweb']."&estado=".$row['estado']."&rnc=".$row['RNC']."'><img src='img/lapiz.png' width=15/></a> </td>*/
							}
							?>

						</tbody>	
	        </table>

			</div>	
		 </div>

	</div>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<?php include'php/pie.php';?>