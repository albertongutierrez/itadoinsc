<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='main.php'</script>;";
}
?>
<script type="text/javascript">
	function orden() {
  	var orden = document.getElementById("ordenini2");
  	var participantes = document.getElementById("rango1");

    var orden_fin=parseInt(orden.value);
    var cant_p=parseInt(participantes.value);

    if (cant_p>0){
			document.getElementById("ordenfin").value=((cant_p+orden_fin)-1);
			document.getElementById("ordenini").value=(orden_fin);
		}
		else{	
			document.getElementById("ordenfin").value=(0);
			document.getElementById("ordenini").value=(0);
		}
		// var pa = document.getElementById("ordenfin");
 	// 	pa=pa.value;
  // 		alert(pa);
	// document.getElementById("ordenfin").value=();
  }
</script>
<?php 
	if(!empty($_GET['status'])){
		    switch($_GET['status']){
		        case 'succ':
		            $statusMsgClass = 'alert-success';
		            $statusMsg = 'Registro almacenado correctamente.';
		            break;
		        case 'err':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Ha ocurrido un error insertando el registro.';
		            break;
		        case 'succudt':
		            $statusMsgClass = 'alert-success';
		            $statusMsg = 'Registro actualizado correctamente.';
		            break;
		        case 'errudt':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Ha ocurrido un error actualizando el registro.';
		            break;
		        case 'succdlt':
		            $statusMsgClass = 'alert-success';
		            $statusMsg = 'Registro inhabilitado correctamente.';
		            break;
		        case 'errdlt':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'Ha ocurrido un error inhabilitando el registro.';
		            break;    
		        case 'errP1':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'El monto adeudado es mayor que lo ingresado para pagar.';
		            break;     
		        case 'errP2':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'La cantidad de participantes no puede ser menor o igual que cero';
		            break;            
		        default:
		            $statusMsgClass = '';
		            $statusMsg = '';
		    }
		    
		}
		?>


	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Registro de Inscripciones</p>

		<?php if(!empty($statusMsg)){
	        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	    	}
	    ?>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Nueva</h3>
			</div>
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="inscritos-club-pagar.php?accion=INS" autocomplete="off" enctype="multipart/form-data">				
					<!--NO APLICA YA QUE ES AUTOINCREMENTABLE-->
					<!-- <div class="form-group">
						<label for="codcategoria" class="col-sm-2 control-label">Código Categoría</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codcategoria" name="codcategoria" placeholder="Código Categoria" required>
						</div>
					</div>
 					-->
 				

					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre cliente" required value="Cliente General">
						</div>
					</div>					

					 <div class="form-group">
						<label for="participantes" class="col-sm-2 control-label">Cantidad Ciclistas</label>
						<div class="col-sm-4">
							<input type="number" onchange="orden()" class="form-control" id="rango1" name="rango1" placeholder="Costo" required value=0>
						</div>
					</div>

					<div class="form-group">
						<label for="invitados" class="col-sm-2 control-label">Cantidad Invitados</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="rango2" name="rango2" placeholder="Costo" required value=0>
						</div>
					</div>

					<div class="form-group">
						<label for="menores" class="col-sm-2 control-label">Cantidad Menores</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="rango3" name="rango3" placeholder="Costo" required value=0>
						</div>
					</div>

					<?php 
						$row2=extraerOrdeniscritos()->fetch_assoc();
					 ?>
					<div class="form-group" >
						<!-- <label for="ordenini" class="col-sm-2 control-label">Orden Inicial</label> -->
						<div class="col-sm-4 ">
							<input type="hidden" class="form-control" id="ordenini" name="ordenini" placeholder="Orden" required='Debe llenar este campo' readonly value="0">
							<input type="hidden" class="form-control" id="ordenini2" name="ordenini2" placeholder="Orden"  readonly value="<?php echo $row2['mayor'];?>">
						</div>
											
						<!-- <label for="ordenfin" class="control-label">Orden Final</label> -->
						<div class="col-sm-4 ">
							<input type="hidden" class="form-control" id="ordenfin" name="ordenfin" placeholder="Orden" required='Debe llenar este campo' readonly value="<?php echo $row['orden_fin'];?>">

						</div>
					</div>

					<?php if ($_SESSION['crmRanking'] <= 2){?>
			        <div class="form-group">
			          <label for="inscritoen" class="col-sm-2 control-label">Inscrito en</label>
			          <div class="col-sm-4">
			            <select id="codinscritoen" name="codinscritoen" class="form-control" required> 
			            <!-- <option>Seleccione</option>            -->
			            <?php 
						$query=extraerInscritoEn2($_SESSION['crmRanking'],$_SESSION['crmEmpresa']);						
			            if($query->num_rows > 0){
			            while ($row= $query -> fetch_array())
			                  { 
			            ?>
			              <option value="<?php echo $row['codinscritoen'];?>"><?php echo $row['descripcion'];?></option>
			            <?php }}
			            ?>             
			            </select>
			          </div>
			        </div>
			        <?php }?>

					<?php if ($_SESSION['crmRanking'] <= 2){?>
			        <div class="form-group">
			          <label for="zona" class="col-sm-2 control-label">Actividad</label>
			          <div class="col-sm-4">
			            <select id="codactividad" name="codactividad" class="form-control" required> 
			            <!-- <option>Seleccione</option>            -->
			            <?php 
						$query=extraerActividad($_SESSION['crmRanking'],$_SESSION['crmEmpresa']);						
			            if($query->num_rows > 0){
			            while ($row= $query -> fetch_array())
			                  { 
			            ?>
			              <option value="<?php echo $row['codactividad'];?>"><?php echo $row['descripcion'];?></option>
			            <?php }}
			            ?>             
			            </select>
			          </div>
			        </div>
			        <?php }?>

					<?php if ($_SESSION['crmRanking'] <=2){?>
			        <div class="form-group">
			          <label for="zona" class="col-sm-2 control-label">Empresa</label>
			          <div class="col-sm-4">
			            <select id="codempresa" name="codempresa" class="form-control" required> 
			            <!-- <option>Seleccione</option>            -->
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
							<a href="inscritos-club-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>