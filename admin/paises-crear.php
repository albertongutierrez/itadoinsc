<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='main.php'</script>;";
}
?>

	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Países</p>
			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li><a href="paises-mant.php">Países</a></li>
			  <li class="active">Nuevo Registro</li>			  
			</ol>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Nuevo </h3>
			</div>
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="php/paises-registros.php?accion=INS" autocomplete="off" enctype="multipart/form-data">				
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
						<label for="iso" class="col-sm-2 control-label">ISO</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="iso" name="iso" placeholder="ISO" required>
						</div>
					</div>				

				<!-- 	<div class="form-group">
						<label for="zona" class="col-sm-2 control-label">Zona</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="zona" name="zona" placeholder="Zona" required>
						</div>
					</div> -->
					
														
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="paises-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>