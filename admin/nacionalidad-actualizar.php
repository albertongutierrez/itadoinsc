<?php include'php/cabeza.php';
	// if (!isset($_GET['id1']) or !isset($_GET['id2'])){
	// 	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
	// }
	if($_SESSION['crmRanking']>2 and $_SESSION['crmEmpresa']) {
	echo"<script language='javascript'>window.location='nacionalidad-mant.php'</script>;";		
}
?>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Nacionalidades</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar </h3>
			</div>
			<div class="p-body">
				<?php 					
					$query=extraerNacionalidadesUDT($_GET['empresa'], $_GET['id']);
					$row=$query->fetch_assoc();
				?>
				
				<form class="form-horizontal" method="POST" action="php/nacionalidades-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data">				
					<div class="form-group">
						<label for="codnacionalidad" class="col-sm-2 control-label">Código</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codnacionalidad" name="codnacionalidad" placeholder="Código nacionalidad" required readonly value="<?php echo $row['codnacionalidad'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required='Debe llenar este campo' value="<?php echo $row['descripcion'];?>">
						</div>
					</div>
					
					<?php
					if(($_SESSION['crmRanking']==1) OR ($_SESSION['crmRanking']==2)){
						echo"<div class='form-group'>
							<label for='estado' class='col-sm-2 control-label'>Estado</label>
							<div class='col-sm-4'>
								<select class='form-control' id='estado' name='estado'>";?>				
									<option value='A' <?php if($row['estado']=='A'){echo'selected';}?>>ACTIVO</option>
									 <option value='I' <?php if($row['estado']=='I'){echo'selected';}?>>INACTIVO</option>				
								<?php echo"</select>
							</div>
						</div>";
					}
					else {
						echo"<div class='form-group'>
							<label for='estado' class='col-sm-2 control-label'>Estado</label>
							<div class='col-sm-4'>
								<select class='form-control' id='estado' name='estado'>";?>				
									<option value='A' <?php if($row['estado']=='A'){echo'selected';}?>>ACTIVO</option>
									 			
								<?php echo"</select>
							</div>
						</div>";	
					}
					?>

					
					<div class="form-group">
						<label for="codempresa" class="col-sm-2 control-label">Empresa</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codempresa" name="codempresa" placeholder="Código de empresa" required readonly value="<?php echo $row['codempresa'];?>">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="nacionalidad-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>