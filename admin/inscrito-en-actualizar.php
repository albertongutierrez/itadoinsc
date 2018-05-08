<?php include'php/cabeza.php';
	// if (!isset($_GET['id1']) or !isset($_GET['id2'])){
	// 	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
	// }
	if($_SESSION['crmRanking']>2 and $_SESSION['crmEmpresa']) {
	echo"<script language='javascript'>window.location='inscrito-en-mant.php'</script>;";		
}
?>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Lugares Inscripción</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar </h3>
			</div>
			<div class="p-body">
				<?php 					
					$query=extraerInscritoEnUDT($_GET['empresa'], $_GET['id']);
					$row=$query->fetch_assoc();
				?>
				
				<form class="form-horizontal" method="POST" action="php/inscritos-en-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data">				
					<div class="form-group">
						<label for="codigo" class="col-sm-2 control-label">Código Lugar</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codigo" name="codigo" placeholder="Código lugar" required readonly value="<?php echo $row['codinscritoen'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required='Debe llenar este campo' value="<?php echo $row['descripcion'];?>">
						</div>
					</div>

					<?php
					// if(($_SESSION['crmRanking']==1) OR ($_SESSION['crmRanking']==2)){
						echo"<div class='form-group'>
							<label for='mostrar' class='col-sm-2 control-label'>Ver en Reporte</label>
							<div class='col-sm-4'>
								<select class='form-control' id='mostrar' name='mostrar'>";?>				
									<option value='S' <?php if($row['mostrar']=='S'){echo'selected';}?>>SI</option>
									 <option value='N' <?php if($row['mostrar']=='N'){echo'selected';}?>>NO</option>				
								<?php echo"</select>
							</div>
						</div>";
					// }					
					?>

					<?php
					// if(($_SESSION['crmRanking']==1) OR ($_SESSION['crmRanking']==2)){
						echo"<div class='form-group'>
							<label for='tipo' class='col-sm-2 control-label'>Tipo</label>
							<div class='col-sm-4'>
								<select class='form-control' id='tipo' name='tipo'>";?>				
									<option value='D' <?php if($row['tipo']=='D'){echo'selected';}?>>DEBITO</option>
									 <option value='C' <?php if($row['tipo']=='C'){echo'selected';}?>>CREDITO</option>				
								<?php echo"</select>
							</div>
						</div>";
					// }					
					?>

					<?php
					// if(($_SESSION['crmRanking']==1) OR ($_SESSION['crmRanking']==2)){
						echo"<div class='form-group'>
							<label for='kit' class='col-sm-2 control-label'>Lleva Kit</label>
							<div class='col-sm-4'>
								<select class='form-control' id='kit' name='kit'>";?>				
									<option value='S' <?php if($row['kit']=='S'){echo'selected';}?>>SI</option>
									 <option value='N' <?php if($row['kit']=='N'){echo'selected';}?>>NO</option>				
								<?php echo"</select>
							</div>
						</div>";
					// }					
					?>

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
							<a href="inscrito-en-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>