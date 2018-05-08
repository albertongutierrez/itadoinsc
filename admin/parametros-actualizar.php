<?php include'php/cabeza.php';
	// if (!isset($_GET['id1']) or !isset($_GET['id2'])){
	// 	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
	// }
	if($_SESSION['crmRanking']>2 and $_SESSION['crmEmpresa']) {
	echo"<script language='javascript'>window.location='parametros-mant.php'</script>;";		
}
?>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Parámetros Generales</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar </h3>
			</div>
			<div class="p-body">
				<?php 					
					$query=extraerParametrosUDT($_GET['empresa'], $_GET['id']);
					$row=$query->fetch_assoc();
				?>
				
				<form class="form-horizontal" method="POST" action="php/parametros-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data">				
					<div class="form-group">
						<label for="codparametro" class="col-sm-2 control-label">Código Parámetro</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="codparametro" name="codparametro" placeholder="Código parámetro" required readonly value="<?php echo $row['codparametro'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="abreviatura" class="col-sm-2 control-label">Abreviatura</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="abreviatura" name="abreviatura" placeholder="Abreviatura" required readonly value="<?php echo $row['descripcion'];?>">
							<span class="help-block">Abreviatura que identifica al parámetro internamente en el sistema. Máximo tres carácteres</span>
						</div>
					</div>

					<div class="form-group">
						<label for="valor1" class="col-sm-2 control-label">Secuencia #</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="valor1" name="valor1" placeholder="Secuencia #" required value="<?php echo $row['valor1'];?>">
							<span class="help-block">Secuencia que identifica el orden del parámetro internamente en el sistema.</span>
						</div>
					</div>

					<div class="form-group">
						<label for="valor2" class="col-sm-2 control-label">Valor Texto</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="valor2" name="valor2" placeholder="Valor alfanumérico" required value="<?php echo $row['valor2'];?>">
							<span class="help-block">Descripción visual que se mostrara al usuario en el sistema.</span>
						</div>
					</div>

					<!-- Textarea -->
					<div class="form-group">
					  <label for="area" class="col-md-2 control-label" >Descripción</label>
					  <div class="col-md-8">                     
					    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Escriba aquí"><?php echo $row['comentario'];?></textarea>
					    <span class="help-block">Descripción o comentario del parámetro..</span>
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
							<a href="parametros-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>