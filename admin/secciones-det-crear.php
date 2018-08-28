<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='main.php'</script>;";
}
?>
<script type="text/javascript">
	var acomulativa=false;
	var activo=false;
      

	function validar() {
	  	var cam = document.getElementById("seccion");
      	cam=cam.value;
		// alert(acomulativa);\

		if (cam=='null'){
			if (activo==true){
				$('#importFrm').slideToggle();
		 		activo=false;
		 	}
		}
		else{
			if (activo==false){
				$('#importFrm').slideToggle();
		 		activo=true;
		 	}			
		}
	}
</script>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Asignar Secciones</p>
			<ol class="breadcrumb">
				  <li><a href="main.php">Inicio</a></li>
				  <li><a href="secciones-det-mant.php">Asignar Secciones</a></li>
				  <li class="active">Nuevo Registro</li>			  
			</ol>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Nuevo</h3>
			</div>
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="php/secciones-det-registros.php?accion=INS" autocomplete="off" enctype="multipart/form-data" id="target">	

					<div class="form-group">
			          <div class="col-sm-4 ">
			          	<label for="seccion" class=" control-label">Seccion</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
			            <select id="seccion" name="seccion" class="form-control" onchange="validar()" required> 
				            <option value="null">Seleccione</option>           
				            <?php 
							$query=extraerSeccionesENC();						
				            if($query->num_rows > 0){
				            while ($row= $query -> fetch_array())
				                  { 
				            ?>
				              <option value="<?php echo $row['codseccion_enc'];?>"><?php echo $row['descripcion'];?></option>
				            <?php }}
				            ?>             
			            </select>
			          </div>
			        </div>
			        <div id="importFrm">
			        <table class="display table table-striped" id="example"  cellspacing="0" width="100%">
						<thead>
							<tr>
								<th><input name="select_all" value="1" id="checkall" type="checkbox"/> Todo</th>
								<th>Código</th>
								<th>Nombre</th>							
								<th>Apellido</th>							
							</tr>
						</thead>						
						<tbody>
							<?php 
							$query=extaerInscritos2();
							while($row=$query->fetch_assoc()):?>
							 	<?php if ($row['curso']=='N'): ?>	
									<tr>
										<td><input type="checkbox" name="id[]" id='id' value="<?php echo $row['codinscripcion']; ?>"></td>
										<td><?php echo $row['codinscripcion']; ?></td>
										<td><?php echo $row['nombre']; ?></td>
										<td><?php echo $row['apellido']; ?></td>

									</tr>
							 	<?php endif ?>
							<?php endwhile; ?>
						</tbody>
					</table>
					<div class="form-group">
						<div class="col-sm-10">
							<a href="secciones-det-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
			        
															
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>