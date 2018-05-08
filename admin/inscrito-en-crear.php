<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='inscrito-en-mant.php'</script>;";
}
?>

	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Lugares Inscripción</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Nueva</h3>
			</div>
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="php/inscritos-en-registros.php?accion=INS" autocomplete="off" enctype="multipart/form-data">				
					<!--NO APLICA YA QUE ES AUTOINCREMENTABLE-->
					 <div class="form-group">
						<label for="codigo" class="col-sm-2 control-label">Código Lugar</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codigo" name="codigo" placeholder="Código Lugar" required>
						</div>
					</div>
 					
					<div class="form-group">
						<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required>
						</div>
					</div>

			        <div class="form-group">
			          <label for="mostrar" class="col-sm-2 control-label">Ver en Reporte</label>
			          <div class="col-sm-4">
			            <select id="mostrar" name="mostrar" class="form-control" required> 
			            <option>Seleccione</option>           			            
			              <option value="S">SI</option>
			              <option value="N">NO</option>
			            </select>
			          </div>
			        </div>

			        <div class="form-group">
			          <label for="tipo" class="col-sm-2 control-label">Tipo</label>
			          <div class="col-sm-4">
			            <select id="tipo" name="tipo" class="form-control" required> 
			            <option>Seleccione</option>           			            
			              <option value="D">DEBITO</option>
			              <option value="C">CREDITO</option>
			            </select>
			          </div>
			        </div>

			        <div class="form-group">
			          <label for="kit" class="col-sm-2 control-label">Lleva Kit</label>
			          <div class="col-sm-4">
			            <select id="kit" name="kit" class="form-control" required> 
			            <option>Seleccione</option>           			            
			              <option value="S">SI</option>
			              <option value="N">NO</option>
			            </select>
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
							<a href="inscrito-en-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>