<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='parametros-mant.php'</script>;";
}
?>

	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Parámetros Generales</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Nuevo </h3>
			</div>
			<div class="p-body"> 
				<form class="form-horizontal" method="POST" action="php/parametros-registros.php?accion=INS" autocomplete="off" enctype="multipart/form-data">								
					<!--NO APLICA YA QUE ES AUTOINCREMENTABLE-->					
					<!-- <div class="form-group">
						<label for="codcategoria" class="col-sm-2 control-label">Código Categoría</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codcategoria" name="codcategoria" placeholder="Código Categoria" required>
						</div>
					</div>
 					-->
								        
					<div class="form-group">
						<label for="abreviatura" class="col-sm-2 control-label">Abreviatura</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="abreviatura" name="abreviatura" placeholder="Abreviatura" required>
							<span class="help-block">Ingresar la abreviatura que identificara al parámetro internamente en el sistema. Máximo tres carácteres</span>
							<p>
								<span style="font-weight: bold"> Para Registrar Tener en cuenta la abreviatura: </span><br> 
							    <span style="color:red">SD:</span> Sede<br>
							    <span style="color:red">EXL:</span> Experiencia Laboral<br>
							    <span style="color:red">CAR:</span> Cargo
							</p>
						</div>
					</div>

					<div class="form-group">
						<label for="valor1" class="col-sm-2 control-label">Secuencia #</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="valor1" name="valor1" placeholder="Secuencia #" required>
							<span class="help-block">Ingresar la secuencia que identificara el orden del parámetro internamente en el sistema.</span>
						</div>
					</div>

					<div class="form-group">
						<label for="valor2" class="col-sm-2 control-label">Valor Texto</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="valor2" name="valor2" placeholder="Valor alfanumérico" required>
							<span class="help-block">Ingresar la descripción visual que se mostrara al usuario en el sistema.</span>
						</div>
					</div>

					<!-- Textarea -->
					<div class="form-group">
					  <label for="descripcion" class="col-md-2 control-label" >Descripción</label>
					  <div class="col-md-8">                     
					    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Escriba aquí"></textarea>
					    <span class="help-block">Describir brevemente la utilidad del presente parámetro..</span>
					  </div>
					</div>
					

					<!-- Select Basic -->
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
							<a href="parametros-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>