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
		        case 'errslct':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'No se ha seleccionado ningún registro.';
		            break;        
		        default:
		            $statusMsgClass = '';
		            $statusMsg = '';
		    }
		    
		}
		?>

	<script>
		function seleccionar_todo(){
			for (i=0;i<document.CP.elements.length;i++)
				if(document.CP.elements[i].type == "checkbox")	
					document.CP.elements[i].checked=1
		}
		function deseleccionar_todo(){
			for (i=0;i<document.CP.elements.length;i++)
				if(document.CP.elements[i].type == "checkbox")	
					document.CP.elements[i].checked=0
		}
	</script>

<div class="content-wrapper" style="overflow:hidden;">
		<h2 style="text-align: center;" class="site-title">Impresión de Ticket</h2>

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
						 	<input type="hidden" name="pagina" value="reporte-impresion-ticket">			
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
						            <!-- <option value= 'A'>TODAS LAS INSCRIPCIONES</option>            -->
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
			<div class="p-body" style="width: 98%; border-style: none; margin-left: 1%;">
			<form class="form-horizontal" name="CP" method="POST" action="php/inscritos-registros.php?accion=PRT" autocomplete="off" enctype="multipart/form-data">
			<!-- ASIGNACION DE VALOR -->
			<div class="container-fluid">
  				<div class="hide">
					<input type="text" style="visibility:hidden" class="form-control" id="gact" name="gact" required value=<?php echo $gact ?>>
					<input type="text" style="visibility:hidden" class="form-control" id="grev" name="grev" required value=<?php echo $grev ?>>
				</div>	
			</div>		
			<table class="display table table-striped" id="table_id2" align="center">
	            <br>	        	
						<thead>
							<tr>
								<th>Fecha Saldo</th>
								<!-- <th>Actividad</th> -->
								<?php if($_SESSION['crmRanking']==1){echo "<th>Empresa</th>";}?>
								<th>Código</th>
								<th>Nombre</th>
								<th>Grupo</th>								
								<th>Parcipantes</th>										
								<th>Invitados</th>
								<th>Menor</th>
								<th>Sec. Inicial</th>
								<th>Sec. Final</th>
								<?php if($_SESSION['crmRanking']==1 or $_SESSION['crmRanking']==2){echo "<th>Imprimir</th>";}?>
								<!-- <th>Por defecto</th> -->									
							</tr>
						</thead>						
						<tbody>
						<?php 
							$query=extraerImpresionTicket($_SESSION['crmRanking'],$_SESSION['crmEmpresa'], $gact, $grev);
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) {?>  
																		
									<tr>
									<td><?php  echo $row['fecha_saldo']?></td>								
									<?php
										if($_SESSION['crmRanking']==1){echo "<td>".$row['codempresa']."</td>";}
									?>
									<td><?php  echo $row['registro'].'-'.$row['inscrito_en']?></td>									
									<td><?php  echo $row['nombre_representante']?></td>
									<td><?php  echo $row['grupo']?></td>
									<td><?php  echo $row['participantes']?></td>
									<td><?php  echo $row['invitados']?></td>							
									<td><?php  echo $row['invitados_menor']?></td>
									<td><?php  echo $row['orden_ini']?></td>
									<td><?php  echo $row['orden_fin']?></td>
									<td><input type="checkbox" name="cambiar[]" value="<?php echo $row['registro'].'-'.$row['inscrito_en'] ?>"/>
									</td>
									</tr>									
								<?php }
								
							}
							?>

						</tbody>
					</table>
						<div class="form-group">
						<div class="col-sm-offset col-sm-10">
							<a href="main.php" class="btn btn-default">Regresar</a> |
							<a href="javascript:seleccionar_todo()" class="btn btn-success">Marcar todos</a> | 
							<a href="javascript:deseleccionar_todo()" class="btn btn-info">Desmarcar todos</a> | 	
							<button type="submit"  name="actualizar" class="btn btn-danger">Imprimir Ticket</button>
						</div>
					</div>					
				</form>
				<!-- </div> -->
			</div>
		</div>
	</div>

<?php include'php/pie.php';?>