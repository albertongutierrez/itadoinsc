<?php include'php/cabeza.php';
	if (!isset($_GET['id']) or !isset($_GET['us'])){
		echo"<script language='javascript'>window.location='usuario-mant.php'</script>;";
	}
	if($_SESSION['crmRanking']!=1 and $_SESSION['crmEmpresa']!=$_GET['id']) {
	echo"<script language='javascript'>window.location='usuario-mant.php'</script>;";		
}
?>

	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Usuario</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar </h3>
			</div>
			<div class="p-body">
			<?php 
					$query=extraerUsuarioUDT($_GET['id'],$_GET['us']);
					// echo $query;
					$r=$query->fetch_assoc();
				?>
				<form class="form-horizontal" method="POST" action="php/usuario-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data">				
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label">Usuario</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="username" name="username" placeholder="Nombre De Usuario" readonly value="<?php echo $r['username'];?>">
						</div>
					</div>
					<?php if ($_SESSION['crmRanking'] <=2){?>
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
										if ($row['codtipo']==$r['codtipo'])	{												
											echo "<option value='".$row['codtipo']."' selected>".strtoupper($row['descripcion'])."</option>	";
										}
										else{
											echo "<option value='".$row['codtipo']."' >".strtoupper($row['descripcion'])."</option>	";
										}
										}
									}
								?>						
							</select>
						</div>
					</div>
					<?php }?>

					<div class="form-group">
						<label for="pass" class="col-sm-2 control-label">Contraseña</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" >
						</div>
					</div>


					<div class="form-group">
						<label for="pass-v" class="col-sm-2 control-label">Repita Contraseña</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id"=pass-v" name="pass-v" placeholder="Repita Contraseña" >
							<label style="color: orange">Nota: Si no escribe ninguna contraseña se quedara la misma</label>

						</div>
					</div>

					<?php if ($_SESSION['crmRanking'] <=2){?>
					<div class="form-group">
						<label for="estado" class="col-sm-2 control-label">Estado</label>
						<div class="col-sm-4">
							<select class="form-control" id="estado" name="estado">
								<option>Seleccione</option>
								<option value='I' <?php if($r['estado']=='I'){echo'selected';}?>>INACTIVO</option>					
								<option value='A' <?php if($r['estado']=='A'){echo'selected';}?>>ACTIVO</option>
							</select>
						</div>
					</div>
					<?php }?>

					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Empresa</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" readonly value="<?php echo $_GET['id'] ?>">
						</div>
					</div>

					
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