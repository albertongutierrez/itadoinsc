<?php include'php/cabeza.php'; 
if ($_SESSION['crmRanking']>3){
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
		<h2 style="text-align: center;" class="site-title">Reporte Asistencia</h2>
		<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li class="active">Reporte Asistencia</li>			  
		</ol>

		<?php if(!empty($statusMsg)){
	        //echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	        echo '<div class="alert alert-dismissable '.$statusMsgClass.'"> <button type="button" class="close" data-dismiss="alert" aria-label="close" aria-hidden="true" >&times;</button>'.$statusMsg.'</div>';
	    } 
	 //    if(($_SESSION['crmRanking']==1) || ($_SESSION['crmRanking']==2)){
	 //    	echo "<a href='main.php'>
		// 	<button type='button' class='btn btn-info'>
		// 		Volver Atrás 
		// 	</button>
		// </a>";
	 //    }
	    $fecha=date('Y-m-d');
	    // echo $fecha;
	    if (isset($_GET['curso'])) {
	    	$curso=$_GET['curso'];	 }
	    else{
	    	$curso='';
	    }

	    if (isset($_GET['f1'])) {
	    	$f1=$_GET['f1'];
	    }
	    else{
	    	$f1='';
	    }

	    if (isset($_GET['f2'])) {
	    	$f2=$_GET['f2'];
	    }
	    else{
	    	$f2='';
	    }
	    ?>
		
		 <div class="panel panel-default">
			<div class="panel-heading">
		        <h3 class="panel-title">Consultar <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();" style="float: right;">Filtros</a> </h3>

		        <?php if (isset($_GET['rev'])): ?>
		        	<div id="importFrm"> 
		        <?php endif ?>
			    <?php if (!isset($_GET['rev'])): ?>
		        	<div id=""> 	
				<?php endif ?>
					<form class="form-horizontal" role="form" action="reporte-asistencia.php" method="get">
					 <!-- <br>	 -->
									 
									<!-- <label class="control-label">Datos a Motrar</label> -->
						<div class="form-group">
						 <!-- 	<input type="hidden" name="pagina" value="reporte-grupos-inscritos"> -->
					    	<br>
								<div class="col-sm-3">
									<!-- <br> -->
	    							<label class="control-label" for="curso">Curso</label><span style="font-weight: bold; color: red; font-size: 16px">*</span>
	    							<select id="curso" name="curso" class="form-control" onchange="validar()" required=""> 
				            <option value="">Seleccione</option>           
				            <?php 
							$query=extraerCurso();						
				            if($query->num_rows > 0){
				            while ($row= $query -> fetch_array())
				                  { 
				            ?>
				              <option value="<?php echo $row['codcurso'].','.$row['acomulativo'];?>" <?php if($curso==$row['codcurso'].','.$row['acomulativo']){echo "selected";} ?>><?php echo $row['descripcion'];?></option>
				            <?php }}
				            ?>             
			            </select>
  								</div>  
	  							<div class="col-sm-2">
	  								
	    							<!-- <label class="control-label" for="f1">&#32;&#32;&#32;&#32;</label>
	  								<br> -->
	    							<label class="control-label" for="f1">Desde</label>
	  								<input type="date" name="f1" class="form-control"  value="<?php if($f1==''){echo $fecha;}else{echo $f1;} ?>">
	  							</div>	

	  							<div class="col-sm-2">
	  								
	    							<!-- <label class="control-label" for="f1">&#32;&#32;&#32;&#32;</label>
	  								<br> -->
	    							<label  for="f2">Hasta</label>
	  								<input type="date" name="f2" class="form-control" value="<?php if($f2==''){echo $fecha;}else{echo $f2;} ?>">
	  							</div>							
					    </div>
					    		<button type="submit" class="btn btn-default">Filtrar</button>
					    
						 
					    
					</form>
				</div>	 
			</div>
			<div class="p-body" style="width: 98%; border-style: none; margin-left: 1%;">
			<table class="display table table-striped" id="table_id" align="center">
	            <br>	        	
						<thead>
							<tr>
								<!-- <th>Actividad</th> -->
								<th>Matricula</th>
								<th>Nombres</th>								
								<th>Cant Asistencia</th>							
								<th>Cant Inasistencia</th>							
								<!-- <th>Por defecto</th> -->																								
							</tr>
						</thead>						
						<tbody>
						<?php 
							$query=extraerReEstudiantesPermiso($curso,$f1,$f2);
							// echo $query;
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 	
									$a=0;
									$i=0;
									$q=extraerReEstudiantesPermisocount($row['matricula'],$f1,$f2);				
									while($r=$q->fetch_assoc()){
										if ($r['condicion']=='P'){
											$a++;
										}
										else{
											$i++;
										}
									}

									echo "
									<tr>
									
									<td> ".$row['matricula']." </td>";
								 	
									echo "
									<td> ".$row['nombres']."</td>								
									<td> ".$a."</td>
									<td> ".$i."</td>
									
									";//<td> ".$row['por_defecto']."</td>									  
									 																	
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



<?php include'php/pie.php';?>