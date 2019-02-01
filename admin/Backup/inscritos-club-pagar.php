<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='inscritos-club-crear.php'</script>;";
}

if(isset($_GET['accion'])){
	$i=$_GET['accion'];
	if ($i=='INS'){
		///consultar la actividad a buscar para los costos		

		$nombre = strtoupper($_POST['nombre']);
		$rango1 = ($_POST['rango1']);
		$rango2 = ($_POST['rango2']);
		$rango3 = ($_POST['rango3']);

		$codempresa 	= strtoupper($_POST['codempresa']);
		$codactividad 	= ($_POST['codactividad']);
		$codinscritoen 	= ($_POST['codinscritoen']);

		$query=extraerCostosActividad($codactividad,$codempresa);	
		$row=$query->fetch_assoc();
		$costo1 = $row['costo_participante'];
		$costo2 = $row['costo_invitado'];
		$costo3 = $row['costo_ninos'];

		$pagar = ($rango1*$costo1)+($rango2*$costo2)+($rango3*$costo3);

	}


}

if ($pagar <= 0){
	$qstring = '?status=errP2';
	echo"<script language='javascript'>window.location='inscritos-club-crear.php'</script>;";	
}
?>

	<script type="text/javascript">
		function monto(){
	  		var valor = document.getElementById("pagar");
	    	var valor2 = document.getElementById("pagado");
	    	valor=parseInt(valor.value);
	    	valor2=parseInt(valor2.value);
	    	if (valor2<valor){
		  		alert('El Monto a Pagar es Menor a el Total');
	    	} 
	    	else if(valor2>valor) {
		  		alert('el monto a devolver es de:'+' '+(valor2-valor));
	    	}
		} 
	</script>
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Pagar Inscripciones</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Pagar</h3>
			</div>
			<div class="p-body">							
				<form class="form-horizontal" method="POST" action="php/inscritos-registros.php?accion=INS" autocomplete="off" enctype="multipart/form-data">				
					<?php 
						$r=extraerinscritoen3($codinscritoen)->fetch_assoc();
						if ($r['kit']=='S'){
							echo "<input type='hidden' name='ordenini' value='".$_POST['ordenini']."'>";
							echo "<input type='hidden' name='ordenfin' value='".$_POST['ordenfin']."'>";
						}
					?>
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre cliente" required readonly value="<?php echo $nombre?>">
						</div>
					</div>					

					 <div class="form-group">
						<label for="participantes" class="col-sm-2 control-label">Cantidad Ciclistas RD$<?php echo $costo1?></label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="rango1" name="rango1" placeholder="Costo" readonly required value=<?php echo $rango1?>>
						</div>
					</div>

					<div class="form-group">
						<label for="invitados" class="col-sm-2 control-label">Cantidad Invitados RD$<?php echo $costo2?></label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="rango2" name="rango2" placeholder="Costo" readonly required value=<?php echo $rango2?>>
						</div>
					</div>

					<div class="form-group">
						<label for="menores" class="col-sm-2 control-label">Cantidad Menores RD$<?php echo $costo3?></label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="rango3" name="rango3" placeholder="Costo" readonly required value=<?php echo $rango3?>>
						</div>
					</div>

					<div class="form-group">
						<label for="pagar" class="col-sm-2 control-label">Total a Pagar RD$</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="pagar" name="pagar" placeholder="Pagar" readonly required value=<?php echo $pagar?>>
						</div>
					</div>

					<div class="form-group">
						<label for="pagar" class="col-sm-2 control-label">Total Pagado RD$</label>
						<div class="col-sm-4">
							<input type="number" onchange="monto()" class="form-control" id="pagado" name="pagado" placeholder="Pagado" required value=0>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="inscritos-club-crear.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
					
 					<!-- <div class="form-group">
						<label for="codempresa" class="col-sm-2 control-label">Empresa</label>
						<div class="col-sm-4"> -->
							<input type="hidden" class="form-control" id="codinscritoen" name="codinscritoen" placeholder="Nombre empresa" required value=<?php echo $codinscritoen ?>>
							<input type="hidden" class="form-control" id="codactividad" name="codactividad" placeholder="Nombre empresa" required value=<?php echo $codactividad ?>>
							<input type="hidden"class="form-control" id="codempresa" name="codempresa" placeholder="Nombre empresa" required value=<?php echo $codempresa ?>>
					<!-- 	</div>
					</div>	 -->					
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>