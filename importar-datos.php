<?php


		include("php/cabeza.php");
		include("php/consultas.php");
		if($_SESSION['crmRanking']==3){
        header('Location: index.php' );
    	}
		if(!empty($_GET['status'])){
		    switch($_GET['status']){
		        case 'succ':
		            $statusMsgClass = 'alert-success';
		            $statusMsg = 'Los miembros han sido insertados con éxito.';
		            break;
		        case 'err':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Se ha producido algún problema. Vuelve a intentarlo.';
		            break;
		        case 'invalid_file':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Cargue un archivo CSV válido.';
		            break;
		        default:
		            $statusMsgClass = '';
		            $statusMsg = '';
		    }
		    
		}
	?>
	<div style="margin-top: 100px" ></div>
	<div class="content-wrapper" style="width: 90%; margin: 0 auto; ">
		<div style="float: left; margin-top: 5px;" >
			<a href="main-2.php" class="btn btn-danger" style="padding: 10px">
			<img src='img/back.svg'/ width="16px">
			<span style="font-size: 13px">Atr&aacute;s</span>
			</a>
		</div>
		<p  class="titulo-sitio"> Importar Datos</p>
	    <?php if(!empty($statusMsg)){
	        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	    } 

	    ?>
	    <div class="panel panel-default">

	        <div class=" panel-heading" >
	        	<!-- <div style="display: flex;"> -->
				<?php if (!isset($_GET['evento'])): ?>
		            <form class="form-inline" role="form" action="importar-datos.php" method="get">
					 <br>
						 <div class="form-group">
						 	<!-- <input type="hidden" name="pagina" value="rep-inscritos-total">			 -->
					    	<label>Datos a Importar</label>
					    	<br>
					    	<div class="form-group">
    							<label class="sr-only" for="actividad">Actividad</label>
    							<select id="codactividad" name="evento" class="form-control" required> 
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
  							
					    
						<button type="submit" class="btn btn-default">Filtrar</button>
					    </div>	
					</form>

				<?php endif ?>

	            <?php if (isset($_GET['evento'])): ?>
	           		<p>Datos
		            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();" style="float:right; ">Importar</a>
	           			</p>
	           		
		            <form action="php/importData.php?action=<?php echo $_SESSION['crmEmpresa'];?>&actividad=<?php echo $_GET['evento'];?>" method="post" enctype="multipart/form-data" id="importFrm">
		                <input type="file" name="file" accept=".csv" required/>
		                <input type="submit" class="btn btn-primary" name="importSubmit" value="Importar" >	<br>
		                <label style="color:orange;">Nota: *Sólo se pueden importar archivos .csv</label>  <br>  
		                <label style="color:orange;">*Los registros actuales ser&aacute;n sustituidos por los del archivo importados</label>   
		                          
		            </form>
				 <?php endif ?>
				 <!-- </div> -->
	            </div>


	        <!-- </div>   -->
			<?php if (isset($_GET['evento'])): ?>
	        
	        <div class="p-body" style="width: 98%; border-style: none; margin-left: 1%;">
	            
	            <table class="display " id="table_id2" align="center">
	            <br>
	                <thead>
	                    <tr>
	                      	<th>Total de Datos</th>
	                      		                      

	                    </tr>
	                </thead>

	                <tbody>
	                	<tr>
	                	<?php 
	                	$query=registros($_GET["evento"]);
	                	$row=$query->fetch_assoc();
	                	 ?>
	                		<td>
	                			 <?php echo $row['total'];?> 
	                		</td> 
	                	</tr>
	                </tbody>
	            </table> 
	            

	        </div>
    	</div>
		<?php endif ?>
		</div><!-- .content-wrapper -->
		
<?php include("php/pie.php");?>