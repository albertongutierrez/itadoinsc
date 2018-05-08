<?php include'php/cabeza.php';
	// if (!isset($_GET['id1']) or !isset($_GET['id2'])){
	// 	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
	// }
	if($_SESSION['crmRanking']>2 and $_SESSION['crmEmpresa']) {
	echo"<script language='javascript'>window.location='control-depositos-mant.php'</script>;";		
}
?>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Depósitos</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar </h3>
			</div>
			<div class="p-body">
				<?php 					
					$query=extraerDepositosLibUDT($_GET['empresa'], $_GET['id']);
					$row=$query->fetch_assoc();
				?>
				
				<form class="form-horizontal" method="POST" action="php/control-depositos-lib-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data">				
					<div class="form-group">
						<label for="coddeposito" class="col-sm-2 control-label">Código </label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codigo" name="codigo" placeholder="Código depósito" required readonly value="<?php echo $row['coddeposito'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="fecha" class="col-sm-2 control-label">Fecha </label>
						<div class="col-sm-4">
							<input type="date" maxlength="3" class="form-control" id="coddeposito" name="coddeposito" placeholder="Código depósito" required readonly value="<?php echo $row['fecha'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required='Debe llenar este campo' required readonly value="<?php echo $row['descripcion'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="monto" class="col-sm-2 control-label">Monto $</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="monto" name="monto" placeholder="Monto" required='Debe llenar este campo' required readonly value="<?php echo $row['monto'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="referencia" class="col-sm-2 control-label">No. Referencia $</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="referencia" name="referencia" placeholder="Monto" required='Debe llenar este campo' required readonly value="<?php echo $row['monto'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="confirmado" class="col-sm-2 control-label">Código Participante</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="confirmado" name="confirmado" placeholder="Código participante" required='Debe llenar este campo' value="<?php echo $row['confirmado'];?>">
						</div>
					</div>

					<!-- Textarea -->
					<div class="form-group">
					<div class="col-sm-8 col-md-offset-2">
					  <label for="comentario" class="control-label" >Comentario</label>
					    <textarea class="form-control" id="comentario" name="comentario" placeholder="Escriba Aquí" required=""><?php echo $row['comentario'];?></textarea>
					  </div>
					</div>

					<div class="form-group">
						<label for="codempresa" class="col-sm-2 control-label">Empresa</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codempresa" name="codempresa" placeholder="Código de empresa" required readonly value="<?php echo $row['codempresa'];?>">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="control-depositos-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>