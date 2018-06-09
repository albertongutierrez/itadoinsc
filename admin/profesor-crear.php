<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='provincias-mant.php'</script>;";
}
?>
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Profesor</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Nuevo</h3>
			</div>
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="php/profesor-registros.php?accion=INS" autocomplete="off" enctype="multipart/form-data">

					<div class="form-group">
						<div class="col-sm-4 col-md-offset-2">
							<label for="nombre" class=" control-label">Nombre</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="">
						</div>
						<div class="col-sm-4 ">
							<label for="apellido" class=" control-label">Apellido</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required="">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-4 col-md-offset-2">
							<label for="cedula" class=" control-label">Cedula</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula" required="">
						</div>
						<div class="col-sm-4 ">
							<label for="correo" class=" control-label">Correo</label><span style="font-weight: bold; color: red; font-size: 25px"></span>
							<input type="email" class="form-control" id="correo" name="correo" placeholder="Correo">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-4 col-md-offset-2">
							<label for="celular" class=" control-label">Celular</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" required>
						</div>
						
						<div class="col-sm-4 ">
							<label for="telefono" class=" control-label">Tel&eacute;fono</label><span style="font-weight: bold; color: red; font-size: 25px"></span>
							<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tel&eacute;fono">
						</div>
					</div>								
														
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="profesor-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>