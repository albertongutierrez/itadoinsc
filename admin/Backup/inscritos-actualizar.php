<?php include'php/cabeza.php';
	// if (!isset($_GET['id1']) or !isset($_GET['id2'])){
	// 	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
	// }
	if($_SESSION['crmRanking']>2 and $_SESSION['crmEmpresa']) {
	echo"<script language='javascript'>window.location='inscritos-mant.php'</script>;";		
}
?>
<script language="javascript">
  var activo= false;

  function sumar()
  {
      var total = 0;
      var valor1 = document.getElementById("ciclistas");
      var valor2 = document.getElementById("invitados");
      var valor3 = document.getElementById("menores");
      var t = document.getElementById("t");
      // ----COTOS
      var costo1 = document.getElementById("costo1");
      var costo2 = document.getElementById("costo2");
      var costo3 = document.getElementById("costo3");
      t=parseInt(t.value);
       total =(parseInt(valor1.value)*costo1.value)+(parseInt(valor2.value)*costo2.value)+(parseInt(valor3.value)*costo3.value);

      document.getElementById("totalpagar").value=(total-t);
  }

  function sumar2()
  {
      var total = 0;
      var valor1 = document.getElementById("participantes");
      var valor2 = document.getElementById("acompanantes");
      var valor3 = document.getElementById("ninos");
      // ----COTOS
      var costo1 = document.getElementById("costo1");
      var costo2 = document.getElementById("costo2");
      var costo3 = document.getElementById("costo3");
      
    

       total =(parseInt(valor1.value)*costo1.value)+(parseInt(valor2.value)*costo2.value)+(parseInt(valor3.value)*costo3.value);

      document.getElementById("totalabono").value=total;
  }

  function pendiente(){
  	  // pendiente

      var costo2 = document.getElementById("totalpagar");
      var costo = document.getElementById("totalpagado");
      var orden = document.getElementById("ordenini");
  	  var participantes = document.getElementById("ciclistas");
  	  var valor2 = document.getElementById("invitados");
      var valor3 = document.getElementById("menores");
      var cp = document.getElementById("cp");
      var cac = document.getElementById("cac");
      var cam = document.getElementById("cam");
      // var saldado = document.getElementById("saldado");

      // covertido a int
      var totalpagar=parseInt(costo2.value);
      var totalpendiente = parseInt(costo.value);
      var orden_fin=parseInt(orden.value);
      var cant_p=parseInt(participantes.value);
      var cant_a=parseInt(valor2.value);
      var cant_m=parseInt(valor3.value);
      cp =parseInt(cp.value);
      cac =parseInt(cac.value);
      cam =parseInt(cam.value);
      // saldado = saldado.value;

      if (totalpagar<totalpendiente){
	      total =(totalpendiente-totalpagar);
      	// total2=totalpagar-totalpendiente;
      	


      	document.getElementById("monto_devuelto").value=total;
      	document.getElementById("totalpendiente").value=0;
      	


		// asignar cantidad de participantes|acompanantes|ninos
		document.getElementById("participantes").value=(cant_p-cp);
		document.getElementById("acompanantes").value=(cant_a-cac);
		document.getElementById("ninos").value=(cant_m-cam);
		document.getElementById("saldado").value=('P');

		var p = document.getElementById("participantes");
      	var orden2 = document.getElementById("ordenini2");
      	p =parseInt(p.value);
      	orden2 =parseInt(orden2.value);

		if (p>0){
			document.getElementById("ordenfin").value=((p+orden2)-1);
			document.getElementById("ordenini").value=(orden2);
		}
		else{	
			document.getElementById("ordenfin").value=(0);
			document.getElementById("ordenini").value=(0);
		}
		// var pa = document.getElementById("ordenfin");
 	// 	pa=pa.value;
  // 		alert(pa);

      	if (activo==true){
	    	$('#importFrm').slideToggle();
	    	activo=false;
	    }

      }
      else if (totalpagar==totalpendiente){
      	document.getElementById("monto_devuelto").value=0;
      	document.getElementById("totalpendiente").value=0;
		// document.getElementById("ordenfin").value=(cant_p+orden_fin);

		
  		// asignar cantidad de participantes|acompanantes|ninos		
		document.getElementById("participantes").value=(cant_p-cp);
		document.getElementById("acompanantes").value=(cant_a-cac);
		document.getElementById("ninos").value=(cant_m-cam);
		document.getElementById("saldado").value=('P');

		var p = document.getElementById("participantes");
      	var orden2 = document.getElementById("ordenini2");
      	p =parseInt(p.value);
      	orden2 =parseInt(orden2.value);

		if (p>0){
			document.getElementById("ordenfin").value=((p+orden2)-1);
			document.getElementById("ordenini").value=(orden2);
		}
		else{	
			document.getElementById("ordenfin").value=(0);
			document.getElementById("ordenini").value=(0);
		}

		// var pa = document.getElementById("ordenfin");
 	// 	pa=pa.value;
  // 		alert(pa);
      	if (activo==true){
	    	$('#importFrm').slideToggle();
	    	activo=false;
	    }
      }
      else{
		document.getElementById("ordenfin").value=(0);
		total =(totalpagar-totalpendiente);		
      	document.getElementById("monto_devuelto").value=0;
      	document.getElementById("totalpendiente").value=total;

      	// asignar cantidad de participantes|acompanantes|ninos
		document.getElementById("participantes").value=(0);
		document.getElementById("acompanantes").value=(0);
		document.getElementById("ninos").value=(0);
		document.getElementById("saldado").value=('I');


		// var pa = document.getElementById("saldado");
 	// 	pa=parseInt(pa.value);
  // 		alert(pa);

	    if (activo==false){
	    	$('#importFrm').slideToggle();
	    	activo=true;
	    }
      }


  }

  function orden() {
  	var orden = document.getElementById("ordenini2");
  	var participantes = document.getElementById("participantes");

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
	// document.getElementById("ordenfin").value=();
    

  }
  </script>

<?php 
	$hoy = date("d/m/Y"); //asigno la fecha actual del sistema para el control de registro
?>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Inscripciones</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar </h3>
			</div>
			<div class="p-body">
				<?php 					
					$query=extraerInscritosUDT($_GET['empresa'], $_GET['id']);
					$row=$query->fetch_assoc();

					$cquery=extraerCostosActividad($row['codactividad'],$_GET['empresa']);	
					$crow=$cquery->fetch_assoc();
					$costo1 = $crow['costo_participante'];
					$costo2 = $crow['costo_invitado'];
					$costo3 = $crow['costo_ninos'];
					$totalpagar = ($row['cant_participante'] * $costo1) + ($row['cant_acom_mayor'] * $costo2) + ($row['cant_acomp_menor'] * $costo3);


					$q=extraerPagos($costo1,$costo2,$costo3,$row['inscrito_en'],$row['codinscripcion']);
					$r=$q->fetch_assoc();
				?>
				
				<form class="form-horizontal" method="POST" action="php/inscritos-registros.php?accion=UDT2" autocomplete="off" enctype="multipart/form-data">				
					
					<div class="page-header">
					<h2>Datos personales:</h2>
					</div>

					<div class="form-group">
						<div class="col-sm-4 col-md-offset-2">
						<label for="codinscripcion" class="control-label">Código</label>
						<!-- <div class="col-sm-4"> -->
							<input type="text" maxlength="3" class="form-control" id="codigo" name="codigo" placeholder="Código inscripción" required readonly value="<?php echo $row['codinscripcion'].' '.$row['inscrito_en'];?>">
							<input type="hidden" name="inscrito_en" value="<?php echo $row['inscrito_en']; ?>">
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-4">
						<label for="fecha_inscripcion" class="control-label">Inscrito </label>
							<input type="date" class="form-control" id="fecha_inscripcion" name="fecha inscripcion" placeholder="Fecha inscripción" required='Debe llenar este campo' readonly value="<?php echo $row['fecha_inscripcion'];?>">
						</div>
					</div>

					<div class="form-group">
					 	<div class="col-sm-4 col-md-offset-2">												
						<label for="nombre" class=" control-label">Nombre</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required='Debe llenar este campo' readonly value="<?php echo $row['nombre'];?>">
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-4">
						<label for="apellido" class=" control-label">Apellido</label>
							<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required='Debe llenar este campo' readonly value="<?php echo $row['apellido'];?>">
						</div>
					</div>
					<!-- MOSTRAR DETALLES DE INSCRIPCION -->
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">							
							<?php						
								echo "<a href='inscritos2-actualizar.php?accion=UDT&pagina=I&empresa=".$row['codempresa']."&id=".$row['codinscripcion']."' class='btn btn-info'>Más información...</a>";							
							?>
						</div>
					</div>
					<!-- FIN DE DETALLE -->
					<div class="page-header">
						<h2>Datos inscripción: <small>Gestionar cantidad de inscritos</small></h2>
					</div>

					<div class="form-group">						
						<div class="col-sm-3 col-md-offset-2">												
						<label for="ciclistas" class="control-label">Participantes</label>
							<input type="number" class="form-control" id="ciclistas" onchange="sumar()" name="ciclistas" placeholder="Rango ciclistas" required value="<?php echo $row['cant_participante'];?>">
							<input type="number" class="form-control" id="costo1" name="costo1" value="<?php echo $costo1 ?>"" style="visibility:hidden">
						</div>
					<!-- </div> -->
					
					<!-- <div class="form-group"> -->						
						<div class="col-sm-3">
						<label for="invitados" class="control-label">Invitados</label>
							<input type="number" class="form-control" id="invitados" onchange="sumar()" name="invitados" placeholder="Rango invitados" required value="<?php echo $row['cant_acom_mayor'];?>">
							<input type="number" class="form-control" id="costo2" name="costo2" value="<?php echo $costo2 ?>"" style="visibility:hidden">
						</div>
					<!-- </div> -->

					<!-- <div class="form-group">						 -->
						<div class="col-sm-3">
						<label for="menores" class="control-label">Menores</label>
							<input type="number" class="form-control" id="menores" onchange="sumar()" name="menores" placeholder="Rango invitados menores" required value="<?php echo $row['cant_acomp_menor'];?>">
							<input type="number" class="form-control" id="costo3" name="costo3" value="<?php echo $costo3 ?>"" style="visibility:hidden">
						</div>
					</div>
					<?php if (isset($r['ini']) and isset($r['fin'])): ?>
						<h3 style="padding:5px; text-align: center;">Orden Asignado a la Inscripción</h3>
						<div class="form-group" >
						<div class="col-sm-4 col-md-offset-2">												
						<label for="ini" class="control-label">Orden Inicial</label>
							
						</div>
											
						<div class="col-sm-4 ">
						<label for="fin" class="control-label">Orden Final</label>
							

						</div>
					</div>
					<?php 
						$qu=extraerOrdenpagada($row['inscrito_en'],$row['codinscripcion']);
						while($ru=$qu->fetch_assoc()):
					 ?>
					
						
					<div class="form-group" >
						<div class="col-sm-4 col-md-offset-2">												
						<!-- <label for="ini" class="control-label">Orden Inicial</label> -->
							<input type="number" class="form-control" id="ini"   readonly value="<?php echo $ru['ini'] ?>">
						</div>
											
						<div class="col-sm-4 ">
						<!-- <label for="fin" class="control-label">Orden Final</label> -->
							<input type="number" class="form-control" id="fin"  readonly value="<?php echo $ru['fin'];?>">

						</div>
					</div>
					<?php endwhile ?>
					<?php endif ?>


					<div class="page-header">
						<h2>Datos costos:<small> Gestionar datos de pagos</small></h2>
					</div>
					<?php 
												
						if (!empty($r['participantes']) or !empty($r['acompanantes']) or !empty($r['ninos'])){
							$t=$r['participantes']+$r['acompanantes']+$r['ninos'];
						}
						else{
							$t=0;
						}

						if (!empty($r['cp'])){
							$cp=$r['cp'];
						}
						else{
							$cp=0;
						}

						if (!empty($r['cac'])){
							$cac=$r['cac'];
						}
						else{
							$cac=0;
						}

						if (!empty($r['cam'])){
							$cam=$r['cam'];
						}
						else{
							$cam=0;
						}

						// imprimen cantidad de participante|acompanantes|ninos 
						echo "<input type='hidden' id='cp' value='$cp'>";
						echo "<input type='hidden' id='cac' value='$cac'>";
						echo "<input type='hidden' id='cam' value='$cam'>";
						echo "<input type='hidden' id='t' value='$t'>";
						// if ( (($row['cant_participante']*$costo1) + ($row['cant_acom_mayor']*$costo2)+($row['cant_acomp_menor']*$costo3))==$t){
							echo "<input type='hidden' id='saldado' name='saldado' value>";

						// }
					 ?>
					<div class="form-group">
						<div class="col-sm-4 col-md-offset-2">
						 	 <label for="fecha_saldo" class="control-label" >Fecha saldo</label>
						    <input type="date" class="form-control" id="fecha_saldo" name="fecha_saldo" placeholder="Fecha saldo" required='Debe llenar este campo' value="<?php if (isset($r['fecha'])){echo $r['fecha'];}else{echo $row['fecha_saldo'];}?>">
					  </div>

					  <div class="col-sm-4">
						 	 <label for="monto_t_pagado" class="control-label" >Monto Pagado </label>
						    <input type="text" class="form-control" id="monto_t_pagado" name="monto_t_pagado" placeholder="Monto Total Pagado" readonly="" value="<?php echo $t;?>">
					  </div>
					</div>

					<div class="form-group">
						<div class="col-sm-2 col-md-offset-2">												
						<label for="totapagar" class="control-label">Monto Pendiente</label>
							<input type="number" class="form-control" id="totalpagar" name="totalpagar" placeholder="totalpagar" required='Debe llenar este campo' value="<?php echo $totalpagar-$t;?>" readonly>
							<span id="Display"></span>
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->
						<div class="col-sm-2">
							<label for="pagado" class="control-label">Monto a Pagar</label>
							<input type="number" onchange="pendiente()" class="form-control" id="totalpagado" name="totalpagado" placeholder="totalpagado" required='Debe llenar este campo' value="0" >
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-2">
							<label for="totalpendiente" class="control-label" style="font-size: 13px">F. Monto Pendiente</label>
							<input type="number" class="form-control" id="totalpendiente" name="totalpendiente" placeholder="totalpendiente" required='Debe llenar este campo' value="0" readonly="">
						</div>

						<div class="col-sm-2">
							<label for="monto_devuelto" class="control-label">Monto a Devolver</label>
							<input type="number" class="form-control" id="monto_devuelto" name="monto_devuelto" placeholder="monto_devuelto" required='Debe llenar este campo' value="<?php echo $row['monto_devuelto'];?>" readonly>
						</div>
					</div>

					<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
					<div id="importFrm">
						
						<div class="form-group" >
							<h1 style="margin: 0px; padding: 15px;">Detalles del Abono</h1>												
						<div class="col-sm-2 col-md-offset-2">												
						<label for="participantes" class="col-sm-2 control-label">Participantes</label>
							<input type="number" onchange="orden(); sumar2();" class="form-control" id="participantes" name="participantes" placeholder="Cant. ciclistas a pagar" required value="">
							
						</div>
									
						<div class="col-sm-3">
						<label for="acompanantes" class="col-sm-2 control-label">Invitados</label>
							<input type="number" onchange="orden(); sumar2();" class="form-control" id="acompanantes" name="acompanantes" placeholder="Cant. invitados a pagar" required value="">
							
						</div>
										
						<div class="col-sm-3">
						<label for="ninos" class="col-sm-2 control-label">Menores</label>
							<input type="number" onchange="orden(); sumar2();" class="form-control" id="ninos"  name="ninos" placeholder="Cant. menores a pagar" required value="">
							
						</div>
					</div>
					<?php 
						$row2=extraerOrdeniscritos()->fetch_assoc();
					 ?>
					<div class="form-group" >
						<div class="col-sm-4 col-md-offset-2">												
						<label for="ordenini" class="col-sm-2 control-label">Orden Inicial</label>
							<input type="number" class="form-control" id="ordenini" name="ordenini" placeholder="Orden" required='Debe llenar este campo' readonly value="0">
							<input type="hidden" class="form-control" id="ordenini2" name="ordenini2" placeholder="Orden"  readonly value="<?php echo $row2['mayor'];?>">
						</div>
											
						<div class="col-sm-4 ">
						<label for="ordenfin" class="col-sm-2 control-label">Orden Final</label>
							<input type="number" class="form-control" id="ordenfin" name="ordenfin" placeholder="Orden" required='Debe llenar este campo' readonly value="<?php echo $row['orden_fin'];?>">

						</div>
					</div>

					<div class="form-group" >
						<div class="col-sm-4 col-md-offset-4">
							<label for="totalabono" class="col-sm-8 control-label">Total de Efectivo Abonado</label>
							<input type="number" class="form-control" id="totalabono" name="totalabono"  readonly value="<?php echo $row['orden_fin'];?>">
						</div>
					</div>
					</div>

					<!--////////////////////////////////////  -->


					<!-- <div class="page-header">
						<h2>Secuencia registros: <small>La secuencia toma en cuenta la cantidad de participantes inscritos</small></h2>
					</div>

					<div class="form-group">
					 	
					</div> -->

					<div class="page-header">
						<h2>Datos de control </h2>
					</div>

					<?php
					if(($_SESSION['crmRanking']==1) OR ($_SESSION['crmRanking']==2)){
						echo"<div class='form-group'>
							<label for='estado' class='col-sm-2 control-label'>Confirmados</label>
							<div class='col-sm-4'>
								<select class='form-control' id='estado' name='estado'>";?>				
									<option value='N' <?php if($row['revisado']=='N'){echo'selected';}?>>NO</option>
									<option value='S' <?php if($row['revisado']=='S'){echo'selected';}?>>SI</option>												
								<?php echo"</select>
							</div>
						</div>";
					}					
					?>

					<!-- Textarea -->
					<div class="form-group">
					<label for="comentario_revisado" class="col-sm-2 control-label" >Comentario</label>
					<div class="col-sm-8">					  
					    <textarea class="form-control" id="comentario_revisado" name="comentario_revisado" placeholder="Escriba Aquí" required=""><?php echo $r['comentario'];?></textarea>
					  </div>
					</div>

					<div class="form-group">
						<label for="imagen" class="col-sm-2 control-label">Comprobante Depósito</label>
						<div class="col-sm-4">
							<input type="file" accept=".jpg" class="form-control" id="imagen" name="imagen" placeholder="Foto deposito">
						</div>
					</div>	

					<!-- <div class="form-group" >
					<div class="col-sm-8" >
						<img src="data:image/jpg;base64,<?php //echo base64_encode($row['foto_deposito'])?>" class='imagen-deposito img-responsive'/>
					</div>
					</div> -->	
					
					<div class="form-group" >
					<label for="imagen" class="col-sm-2 control-label">Doble Clic Para Ampliar, Un Clic Para Tamaño Normal</label>
					<div class="col-sm-8" >
						<?php 
							$q2=extraerFotoDeposito($row['inscrito_en'],$row['codinscripcion']);
							while($ro=$q2->fetch_assoc()): ?>

						 		<img style="float: left; border:2px black solid; margin: 15px" onclick="javascript:this.width=200;this.height=80" ondblclick="javascript:this.width=500;this.height=400" src="data:image/jpg;base64,<?php echo base64_encode($ro['foto_deposito'])?>" width="200" class='img-responsive'/> 
							<?php endwhile; ?>
					</div>
					</div>	

					<div class="form-group">
						<label for="codempresa" class="col-sm-2 control-label">Empresa</label>
						<div class="col-sm-4">
							<input type="text" maxlength="3" class="form-control" id="codempresa" name="codempresa" placeholder="Código de empresa" required readonly value="<?php echo $row['codempresa'];?>">
						</div>
					</div>

					<hr>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="inscritos-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>