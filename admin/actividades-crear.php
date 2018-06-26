<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
}
?>

	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Actividades</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Nuevo</h3>
			</div>
			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li><a href="actividades-mant.php">Actividades</a></li>
			  <li class="active">Nuevo Registro</li>			  
			</ol>
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="php/actividades-registros.php?accion=INS" autocomplete="off" enctype="multipart/form-data">				
					<!--NO APLICA YA QUE ES AUTOINCREMENTABLE-->
					<!-- <div class="form-group">
						<label for="codcategoria" class="col-sm-2 control-label">Código Categoría</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codcategoria" name="codcategoria" placeholder="Código Categoria" required>
						</div>
					</div>
 					-->
					<div class="form-group">
						<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required>
						</div>
					</div>

					<div class="form-group">
						<label for="costo1" class="col-sm-2 control-label">Participantes $</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="costo1" name="costo1" placeholder="Costos $" required>
						</div>
					</div>

					<div class="form-group">
						<label for="costo2" class="col-sm-2 control-label">Invitados $</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="costo2" name="costo2" placeholder="Costos $" required>
						</div>
					</div>

					<div class="form-group">
						<label for="costo3" class="col-sm-2 control-label">Menores $</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="costo3" name="costo3" placeholder="Costos $" required>
						</div>
					</div>

					<?php if ($_SESSION['crmRanking'] ==1){?>
			        <div class="form-group">
			          <label for="zona" class="col-sm-2 control-label">Empresa</label>
			          <div class="col-sm-4">
			            <select id="codempresa" name="codempresa" class="form-control" required> 
			            <option>Seleccione</option>           
			            <?php 
						$query=extraerEmpresa($_SESSION['crmRanking'],$_SESSION['crmEmpresa']);						
			            if($query->num_rows > 0){
			            while ($row= $query -> fetch_array())
			                  { 
			            ?>
			              <option value="<?php echo $row['codempresa'];?>"><?php echo $row['rsm_nombre'];?></option>
			            <?php }}
			            ?>             
			            </select>
			          </div>
			        </div>
			        <?php }?>
											
															
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="actividades-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>