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
				<form  method="POST" action="php/profesor-registros.php?accion=INS" autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 ">
							<legend> Datos Personales</legend>
						</div>		
					</div>		
					<div class="row">

						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group">
								<label for="nombre" class="control-label">Nombre</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
								<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="">
							</div>
						</div>

						<div class="col-md-4 col-md-offset-0 col-sm-offset-0 col-sm-4 col-xs-12 col-xs-offset-0 col-lg-4">
							<div class="form-group">
								<label for="apellido" class="control-label">Apellido</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
								<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required="">
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group">
								<label for="cedula" class=" control-label">Cedula</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
								<input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula" required="">
							</div>
						</div>
						<div class="col-md-4 col-md-offset-0 col-sm-offset-0 col-sm-4 col-xs-12 col-xs-offset-0 col-lg-4">
							<div class="form-group">
							
								<label for="correo" class=" control-label">Correo</label><span style="font-weight: bold; color: red; font-size: 25px"></span>
								<input type="email" class="form-control" id="correo" name="correo" placeholder="Correo">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group">
								<label for="celular" class=" control-label">Celular</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
								<input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" required>
							</div>
						</div>
							
						<div class="col-md-4 col-md-offset-0 col-sm-offset-0 col-sm-4 col-xs-12 col-xs-offset-0 col-lg-4">
							<div class="form-group">
								<label for="telefono" class=" control-label">Tel&eacute;fono</label><span style="font-weight: bold; color: red; font-size: 25px"></span>
								<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tel&eacute;fono">
							</div>
						</div>	
					</div>

					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
							<legend>Credenciales de Acceso</legend>
						</div>
					</div>							
						
					<div class="row">
						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group ">
								<label for="username" class="control-label">Usuario <span style="font-weight: bold; color: red; font-size: 25px">*</span></label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Nombre De Usuario" required="">
								<input type="hidden" class="form-control" name="tipo-us" value="3">
							</div>
						</div>

						<div class="col-md-4 col-md-offset-0 col-sm-offset-0 col-sm-4 col-xs-12 col-xs-offset-0 col-lg-4">
							<div class="form-group">	
								<label for="pass" class="control-label">Contraseña <span style="font-weight: bold; color: red; font-size: 25px">*</span></label>
								<input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-2">
							<div class="form-group">
								<label for="pass-v" class="control-label">Repita Contraseña <span style="font-weight: bold; color: red; font-size: 25px">*</span></label>
								<input type="password" class="form-control" id"=pass-v" name="pass-v" placeholder="Repita Contraseña" required="">
							</div>
						</div>
							<?php if ($_SESSION['crmRanking'] ==1){?>
					
							<div class="col-md-4 col-md-offset-0 col-sm-offset-0 col-sm-4 col-xs-12 col-xs-offset-0 col-lg-4">
								<div class="form-group ">

									<label for="empresa" class="control-label">Empresa <span style="font-weight: bold; color: red; font-size: 25px">*</span></label>
									<select class="form-control" id="empresa" name="empresa" required="">
										<option>Seleccione</option>
										<?php 
											$query=extraerEmpresa($_SESSION['crmRanking']);
											if($query->num_rows > 0)
											{
												while ($row = $query->fetch_assoc()) {

													echo "<option value='".$row['codempresa']."'>".strtoupper($row['rsm_nombre'])."</option>	";
												}
											}
										?>						
									</select>
								</div>

							<?php }?>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-offset-2 col-sm-10 col-xs-10 col-xs-offset-1">
							<div class="form-group">
								<a href="profesor-mant.php" class="btn btn-default">Regresar</a>
								<button type="submit" class="btn btn-primary">Guardar</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>