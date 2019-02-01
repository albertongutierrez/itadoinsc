<?php include'php/cabeza.php';
	// if (!isset($_GET['id1']) or !isset($_GET['id2'])){
	// 	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
	// }
	if($_SESSION['crmRanking']>2 and $_SESSION['crmEmpresa']) {
	echo"<script language='javascript'>window.location='main.php'</script>;";
}

$Vid =    (int)$_GET['id'];
    if ($Vid == 0){
        // $id = filter_var($Vid, FILTER_SANITIZE_NUMBER_INT);
        // if( !$id ) { 
            // die('Intento de contaminar consulta'); 
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Se ha producido un error al intentar contaminar la consulta.';

        }
        // código para procesar Id numérico
    // }       
?>
	
	<?php 					
		$query=extraerPaisUDT($_GET['id']);
		$row=$query->fetch_assoc();

		if (empty($row['codpais']) && ($Vid != 0)){
        $statusMsgClass = 'alert-danger';
        $statusMsg = 'La consulta no devolvió ningún resultado.';
         }
	?>
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Países</p>
			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li><a href="paises-mant.php">Países</a></li>
			  <li class="active">Editar Registro</li>			  
			</ol>
			<?php if(!empty($statusMsg)){
                echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
                die("<a href='javascript:history.go(-1);' class='btn btn-warning btn-fill'>Datos no encontrados, volver atrás</a>");
            } ?>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar </h3>
			</div>
			<div class="p-body">
				
				<form class="form-horizontal" method="POST" action="php/paises-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data">				
					<div class="form-group">
						<label for="codpais" class="col-sm-2 control-label">Código País</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="codpais" name="codpais" placeholder="Código país" required readonly value="<?php echo $row['codpais'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required='Debe llenar este campo' value="<?php echo $row['descripcion'];?>">
						</div>
					</div>	

					<div class="form-group">
						<label for="iso" class="col-sm-2 control-label">ISO</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="iso" name="iso" placeholder="ISO" required='Debe llenar este campo' value="<?php echo $row['iso'];?>">
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

					<!-- <div class="form-group">
						<label for="codempresa" class="col-sm-2 control-label">Empresa</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codempresa" name="codempresa" placeholder="Código de empresa" required readonly value="<?php //echo $row['codempresa'];?>">
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