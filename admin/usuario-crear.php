<?php include'php/cabeza.php';
	if ($_SESSION['crmRanking']>2){
		echo"<script language='javascript'>window.location='usuario-mant.php'</script>;";
	}
?>

	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Usuario</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Nuevo</h3>
			</div>
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="php/usuario-registros.php?accion=INS" autocomplete="off" enctype="multipart/form-data">				
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label">Usuario</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="username" name="username" placeholder="Nombre De Usuario" required>
						</div>
					</div>

					<div class="form-group">
						<label for="tipo-us" class="col-sm-2 control-label">Tipo Usuario</label>
						<div class="col-sm-4">
							<select class="form-control" id="tipo-us" name="tipo-us">
								<option>Seleccione</option>
								
								<?php 
									$query=extraerTipous();
									if($query->num_rows > 0)
									{
										while ($row = $query->fetch_assoc()) {	
											if ($row['codtipo']!=3) {
												echo "<option value='".$row['codtipo']."'>".strtoupper($row['descripcion'])."</option>	";
											}													
										}
									}
								?>						
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="pass" class="col-sm-2 control-label">Contraseña</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
						</div>
					</div>


					<div class="form-group">
						<label for="pass-v" class="col-sm-2 control-label">Repita Contraseña</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id"=pass-v" name="pass-v" placeholder="Repita Contraseña" required>
						</div>
					</div>

					<?php if ($_SESSION['crmRanking'] ==1){?>
					<div class="form-group">
						<label for="empresa" class="col-sm-2 control-label">Empresa</label>
						<div class="col-sm-4">
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
					</div>
					<?php }?>

					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="usuario-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>