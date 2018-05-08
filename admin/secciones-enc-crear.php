<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
}
?>
<script type="text/javascript">
	var acomulativa=false;
	var activo=false;
    var ac='';

	function validar() {
	  	var cam = document.getElementById("curso");
	  	var horas = document.getElementById("horas");
	  	var horad='';
      	horas=horas.value;
      	cam=cam.value;
      	ac=cam.split(',');

		// alert(acomulativa);\

		if (ac[1]=='S'){

			if (activo==false){
				$('#importFrm').slideToggle();
		 		activo=true;
		 	}
		 	$(function(){
		 		$.post( 'php/horas_curso.php',{id:ac[0]} ).done( function(respuesta)
				{
					$( '#hoo' ).html( respuesta);
				});
			});
		  	horad = document.getElementById("horad");
	      	horad=parseInt(horad.value);
		 	$(function(){

	      	$("#horas").attr({
	       "max" : horad,        // substitute your own
	       	"min" : 1          // values (or variables) here
    		});

			});
		}
		else if (ac[1]=='N'){
			if (activo==true){
				$('#importFrm').slideToggle();
		 		activo=false;
		 	}
		}
		// alert(horad);
		// if (horas>horad){
		// 	alert('El numero de horas digitado\ supera el permitido que es: '+horad);
		// }
	}
</script>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Secciones </p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Nueva</h3>
			</div>
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="php/secciones-enc-registros.php?accion=INS" autocomplete="off" enctype="multipart/form-data">	

					<div class="form-group">
			          <div class="col-sm-4 col-sm-offset-4">
			          	<label for="curso" class=" control-label">Curso</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
			            <select id="curso" name="curso" class="form-control" onchange="validar()" required> 
				            <option>Seleccione</option>           
				            <?php 
							$query=extraerCurso();						
				            if($query->num_rows > 0){
				            while ($row= $query -> fetch_array())
				                  { 
				                  	// if ($row['acomulativo']=='S'){
				                  	// 	echo "<script>acomulativa=true;</script>";
				                  	// }
				                  	// else {
				                  	// 	echo "<script>acomulativa=false;</script>";
				                  	// }
				            ?>
				              <option value="<?php echo $row['codcurso'].','.$row['acomulativo'];?>"><?php echo $row['descripcion'];?></option>
				            <?php }}
				            ?>             
			            </select>
			          </div>
			        </div>

			        <div class="form-group">
			          <div class="col-sm-4 col-sm-offset-4">
			          	<label for="profesor" class=" control-label">Profesor</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
			            <select id="profesor" name="profesor" class="form-control" required> 
				            <option>Seleccione</option>           
				            <?php 
							$query=extraerProfesor();						
				            if($query->num_rows > 0){
				            while ($row= $query -> fetch_array())
				                  { 
				            ?>
				              <option value="<?php echo $row['codprofesor'];?>"><?php echo $row['nombre'].' '.$row['apellido'];?></option>
				            <?php }}
				            ?>             
			            </select>
			          </div>
			        </div>

					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-4">
							<label for="descripcion" class="control-label">Descripción</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-4">
							<label for="cupo" class="control-label">Cupo</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="number" class="form-control" id="cupo" name="cupo" placeholder="Cantidad de Cupo" required>

							<div id="hoo"></div>
						</div>
					</div>

					<div class="form-group" id="importFrm">
						<div class="col-sm-4 col-sm-offset-4">
							<label for="horas" class="control-label">Horas</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="number" class="form-control" id="horas" name="horas" placeholder="Cantidad de Horas" onchange="validar()">
						</div>
					</div>
															
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-10">
							<a href="secciones-enc-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>