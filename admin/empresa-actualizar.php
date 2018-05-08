<?php include'php/cabeza.php';?>
<?php if($_SESSION['crmRanking']!=1 and $_SESSION['crmEmpresa']!=$_GET['id']) {
	echo"<script language='javascript'>window.location='empresa-mant.php'</script>;";		
}

?>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Empresa</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar Empresa</h3>
			</div>
			<div class="p-body">
				<?php 
					$query=extraerEmpresaUDT($_GET['id']);
					$row=$query->fetch_assoc();
				?>
				
				<form class="form-horizontal" method="POST" action="php/empresa-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data">				
					<div class="form-group" >
					<div class="col-sm-8" >
						<img src="data:image/png;base64,<?php echo base64_encode($row['logo'])?>" class='imagen-empresa img-responsive'/>
					</div>
					</div>
					<div class="form-group">
						<label for="codempresa" class="col-sm-2 control-label">Codigo Empresa</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codempresa" name="codempresa" placeholder="Codgo Empresa" required readonly value="<?php echo $row['codempresa'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required='Debe llenar este campo' value="<?php echo $row['nombre'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="rsmnombre" class="col-sm-2 control-label">Acr&oacutenimo Nombre</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="rsmnombre" name="rsmnombre" placeholder="Acronimo Nombre" required value="<?php echo $row['rsm_nombre'];?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="logo" class="col-sm-2 control-label">Logo</label>
						<div class="col-sm-4">
							<input type="file" accept=".png" class="form-control" id="logo" name="logo" placeholder="Logo">
							<label style="color: orange">Nota: Si no selecciona una imagen se queda la misma imagen</label>
						</div>
					</div>			
					
					<div class="form-group">
						<label for="telefono" class="col-sm-2 control-label">Tel&eacutefono 1</label>
						<div class="col-sm-4">
							<input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono 1" required value="<?php echo $row['telefono1'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="telefono2" class="col-sm-2 control-label">Tel&eacutefono 2</label>
						<div class="col-sm-4">
							<input type="tel" class="form-control" id="telefono2" name="telefono2" placeholder="Telefono 2" value="<?php echo $row['telefono2'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-4">
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="<?php echo $row['email'];?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="web" class="col-sm-2 control-label">P&aacutegina Web</label>
						<div class="col-sm-4">
							<input type="url" class="form-control" id="web" name="web" placeholder="Pagina Web" value="<?php echo $row['pweb'];?>">
						</div>
					</div>

					
					<div class="form-group">
						<label for="rnc" class="col-sm-2 control-label">RNC</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="rnc" name="rnc" placeholder="RNC" required value="<?php echo $row['rnc'];?>">
						</div>
					</div>
					<?php
					if($_SESSION['crmRanking']==1 ){
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
					?>

					<!-- <div class="form-group">
						<label for="por-defecto" class="col-sm-2 control-label">Por defecto</label>
						<div class="col-sm-4">
							<select class="form-control" id="por-defecto" name="por-defecto">						
								<option value="N" <?php// if($row['por_defecto']=='N') echo 'selected'; ?>>NO</option>
								<option value="S" <?php //if($row['por_defecto']=='S') echo 'selected'; ?>>SI</option>							
							</select>
						</div>
					</div> -->

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="empresa-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>