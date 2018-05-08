<?php include'php/cabeza.php'; 
if ($_SESSION['crmRanking']>3){
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
		        default:
		            $statusMsgClass = '';
		            $statusMsg = '';
		    }
		    
		}
		?>
<div class="content-wrapper" style="overflow:hidden;">
		<h2 style="text-align: center;" class="site-title">Efectivo a Percibir Inscripciones</h2>

		<?php if(!empty($statusMsg)){
	        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
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
						 	<input type="hidden" name="pagina" value="reporte-efectivo-percibir">			
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
						            <option value= 'A'>TODAS LAS INSCRIPCIONES</option>           
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
			<table class="display table table-striped" id="table_id" align="center">
	            <br>	        	
						<thead>
							<tr>
								<th>Actividad</th>
								<?php if($_SESSION['crmRanking']==1){echo "<th>Empresa</th>";}?>
								<th>A Pagar</th>
								<th>Depósitos</th>								
								<th>Donaciones</th>	
								<th>Por Pagar</th>										
								<!-- <th>Por defecto</th> -->									
							</tr>
						</thead>						
						<tbody>
						<?php 
							$query=extraerFlujoEfectivo($_SESSION['crmRanking'],$_SESSION['crmEmpresa'], $gact, $grev);
							if($query->num_rows > 0){
								while ( $row= $query->fetch_assoc()) { 
									
									echo "
									<tr>
									<td>".$row['actividad']."</td>";
								 	if($_SESSION['crmRanking']==1){echo "<td>".$row['codempresa']."</td>";}
									echo "
									<td>".number_format($row['a_pagar'],2)."</td>
									<td>".number_format($row['debito'],2)."</td>
									<td>".number_format($row['credito'],2)."</td>
									<td>".number_format($row['por_pagar'],2)."</td>											
									</tr>";
								}
								
							}
							?>

						</tbody>
					</table>
				<!-- </div> -->
			</div>
		</div>
	</div>

<?php include'php/pie.php';?>