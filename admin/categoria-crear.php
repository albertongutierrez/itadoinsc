<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
}
?>

	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Categorías</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Nueva</h3>
			</div>
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="php/categoria-registros.php?accion=INS" autocomplete="off" enctype="multipart/form-data">				
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
						<label for="rango1" class="col-sm-2 control-label">Rango inicial</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="rango1" name="rango1" placeholder="Rango inicial" required>
						</div>
					</div>

					<div class="form-group">
						<label for="rango2" class="col-sm-2 control-label">Rango final</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="rango2" name="rango2" placeholder="Rango final" required>
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
							<a href="categoria-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>