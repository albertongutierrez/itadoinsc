<?php include'php/cabeza.php';
	// if (!isset($_GET['id1']) or !isset($_GET['id2'])){
	// 	echo"<script language='javascript'>window.location='categoria-mant.php'</script>;";
	// }
	if($_SESSION['crmRanking']>2 and $_SESSION['crmEmpresa']) {
	echo"<script language='javascript'>window.location='inscritos-mant.php'</script>;";		
}
?>
<script language="javascript">
  function sumar()
  {
      var total = 0;
      var valor1 = document.getElementById("ciclistas");
      var valor2 = document.getElementById("invitados");
      var valor3 = document.getElementById("menores");
      // ----COTOS
      var costo1 = document.getElementById("costo1");
      var costo2 = document.getElementById("costo2");
      var costo3 = document.getElementById("costo3");
      // total.value = (parseInt(val1.value)*600)+(parseInt(val2.value)*400)+(parseInt(val3.value)*300);
       // total.value = parseInt(ciclistas.value) + parseInt(invitados.value);
       total =(parseInt(valor1.value)*costo1.value)+(parseInt(valor2.value)*costo2.value)+(parseInt(valor3.value)*costo3.value);
      // var Display = document.getElementById("Display");
      // Display.innerHTML = total;
      document.getElementById("totalpagar").value=total;
  }
  </script>

<?php 
	$hoy = date("Y/m/d"); //asigno la fecha actual del sistema para el control de registro
?>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Inscripciones</p>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar</h3>
			</div>
			<div class="p-body">
				<?php 					
					if(isset($_GET['pagina'])){
						$pagina=$_GET['pagina']; 
						// E -> Reporte Emergencia
						// I -> Inscritos Actualizar (Pagar)
					}
					else{
						$pagina='C'; //C-> Solo consulta	
					}	
					// echo $pagina;

					$query=extraerInscritosUDT($_GET['empresa'], $_GET['id']);
					$row=$query->fetch_assoc();

					$cquery=extraerCostosActividad($row['codactividad'],$_GET['empresa']);	
					$crow=$cquery->fetch_assoc();
					$costo1 = $crow['costo_participante'];
					$costo2 = $crow['costo_invitado'];
					$costo3 = $crow['costo_ninos'];

					$totalpagar = ($row['cant_participante'] * $costo1) + ($row['cant_acom_mayor'] * $costo2) + ($row['cant_acomp_menor'] * $costo3);
					// echo "$totalpagar";
					// echo $row['codactividad'];
					// echo $_GET['empresa'];
					// echo $costo1;
					// echo $costo2;
					// echo $costo3;
				?>
				
				<form class="form-horizontal" method="POST" action="php/inscritos2-registros.php?accion=UDT" autocomplete="off" enctype="multipart/form-data">				
					
					<div class="page-header">
					<h2>Datos personales:</h2>
					</div>

					
					<div class="form-group">
						<div class="col-sm-4 col-md-offset-2">
						<label for="codinscripcion" class="col-sm-2 control-label">Código</label>
						<!-- <div class="col-sm-4"> -->
							<input type="text" maxlength="3" class="form-control" id="codigo" name="codigo" placeholder="Código inscripción" required readonly value="<?php echo $row['codinscripcion'];?>">
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-4">
						<label for="estado_inscripcion" class="col-sm-2 control-label">Estado</label>
							<input type="text" class="form-control" id="estado_inscripcion" name="estado_inscripcion" placeholder="Estado inscripción" required='Debe llenar este campo' readonly value="<?php if ($row['estado_inscripcion']== 'P') {echo "PAGADA";} elseif ($row['estado_inscripcion']== 'A') {echo "PENDIENTE";} elseif ($row['estado_inscripcion']== 'I') {echo "INCOMPLETA";} elseif ($row['estado_inscripcion']== 'B') {echo "BORRADA";};?>">
						</div>
					</div>

					<div class="form-group">
					 	<div class="col-sm-4 col-md-offset-2">												
						<label for="nombre" class="col-sm-2 control-label">Nombre</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required='Debe llenar este campo' value="<?php echo $row['nombre'];?>">
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-4">
						<label for="apellido" class="col-sm-2 control-label">Apellido</label>
							<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required='Debe llenar este campo' value="<?php echo $row['apellido'];?>">
						</div>
					</div>

					<div class="form-group">
					 	<div class="col-sm-4 col-md-offset-2">												
						<label for="telefono" class="col-sm-2 control-label">Teléfono</label>
							<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" required='Debe llenar este campo' value="<?php echo $row['telefono'];?>">
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-4">
						<label for="email" class="col-sm-2 control-label">Email</label>
							<input type="text" class="form-control" id="email" name="email" placeholder="E-mail" required='Debe llenar este campo' value="<?php echo $row['email'];?>">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-4 col-md-offset-2">
						<label for="codinscripcion" class="col-sm-2 control-label">Cédula</label>
						<!-- <div class="col-sm-4"> -->
							<input type="text" maxlength="3" class="form-control" id="cedula" name="cedula" placeholder="Cédula" required value="<?php echo $row['cedula'];?>">
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-4">
						<label for="fecha_inscripcion" class="col-sm-2 control-label">Inscrito </label>
							<input type="date" class="form-control" id="fecha_inscripcion" name="fecha_inscripcion" placeholder="Fecha inscripción" required='Debe llenar este campo' value="<?php echo $row['fecha_inscripcion'];?>">
						</div>
					</div>

					<div class="form-group">
					 	<div class="col-sm-4 col-md-offset-2">											
						<label for="pais" class="col-sm-2 control-label">País</label>
						<select id="pais" name="pais" class="form-control" required>            
			            <!-- <option>Seleccione</option> -->
			            <option value="<?php echo $row['codpais'];?>"><?php echo $row['pais'];?></option>
			            <?php 
						$queryZ=extraerPaises($_SESSION['crmRanking']);						
			            if($queryZ->num_rows > 0){
			            while ($rowZ= $queryZ -> fetch_array())
			                  { 
			            ?>
			              <option value="<?php echo $rowZ['codpais'];?>"><?php echo $rowZ['descripcion'];?></option>
			            <?php }}
			            ?>             
			            </select>
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-4">
						<label for="provincia" class="col-sm-2 control-label">Provincia</label>
						<select id="provincia" name="provincia" class="form-control" required>
				            <!-- <option>Seleccione</option> -->
				            <option value="<?php echo $row['codprovincia'];?>"><?php echo $row['provincia'];?></option>
				            <?php 
							$queryZA=extraerProvincias($_SESSION['crmRanking']);						
				            if($queryZA->num_rows > 0){
				            while ($rowZA= $queryZA -> fetch_array())
				                  { 
				            ?>
				              <option value="<?php echo $rowZA['codprovincia'];?>"><?php echo $rowZA['descripcion'];?></option>
				            <?php }}
				            ?>             
			            </select>
						</div>
					</div>

					<div class="form-group">
					 	<div class="col-sm-4 col-md-offset-2">												
						<label for="grupo" class="col-sm-2 control-label">Grupo</label>
						<select id="grupo" name="grupo" class="form-control" required>
				            <!-- <option>Seleccione</option> -->
				            <option value="<?php echo $row['codgrupo'];?>"><?php echo $row['grupos'];?></option>
				            <?php 
							$queryZG=extraerGrupoPais($_SESSION['crmRanking']);						
				            if($queryZG->num_rows > 0){
				            while ($rowZG= $queryZG -> fetch_array())
				                  { 
				            ?>
				              <option value="<?php echo $rowZG['codgrupo'];?>"><?php echo $rowZG['descripcion'];?></option>
				            <?php }}
				            ?>             
			            </select>
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-4">
						<label for="otrogrupo" class="col-sm-2 control-label">Otros</label>
							<input type="text" class="form-control" id="otrogrupo" name="otrogrupo" placeholder="Otro Grupo" value="<?php echo $row['otro_grupo'];?>">
						</div>
					</div>

					<div class="form-group">
					 	<div class="col-sm-4 col-md-offset-2">												
						<label for="contactoe" class="col-sm-2 control-label">Contacto</label>
							<input type="text" class="form-control" id="contactoe" name="contactoe" placeholder="Contacto emergencia" value="<?php echo $row['contacto_emergencia'];?>">
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-4">
						<label for="emergenciat" class="col-sm-2 control-label">Teléfono</label>
							<input type="text" class="form-control" id="emergenciat" name="emergenciat" placeholder="Telefono emergencia" required='Debe llenar este campo' value="<?php echo $row['telefono_emergencia'];?>">
						</div>
					</div>

					<div class="form-group">
					<label for="comentario" class="col-sm-2 control-label" >Comentario</label>
					<div class="col-sm-8">					  
					    <textarea class="form-control" id="comentario" name="comentario" placeholder="Escriba Aquí"><?php echo $row['comentario'];?></textarea>
					  </div>
					</div>

					<div class="page-header">
						<h2>Datos inscripción: <small>Gestionar cantidad de inscritos</small></h2>
					</div>

					<div class="form-group">						
						<div class="col-sm-3 col-md-offset-2">												
						<label for="ciclistas" class="col-sm-2 control-label">Participantes</label>
							<input type="number" class="form-control" id="ciclistas" onchange="sumar()" name="ciclistas" placeholder="Rango ciclistas" required value="<?php echo $row['cant_participante'];?>">
							<input type="number" class="form-control" id="costo1" name="costo1" value="<?php echo $costo1 ?>"" style="visibility:hidden">
						</div>
					<!-- </div> -->
					
					<!-- <div class="form-group"> -->						
						<div class="col-sm-3">
						<label for="invitados" class="col-sm-2 control-label">Invitados</label>
							<input type="number" class="form-control" id="invitados" onchange="sumar()" name="invitados" placeholder="Rango invitados" required value="<?php echo $row['cant_acom_mayor'];?>">
							<input type="number" class="form-control" id="costo2" name="costo2" value="<?php echo $costo2 ?>"" style="visibility:hidden">
						</div>
					<!-- </div> -->

					<!-- <div class="form-group">						 -->
						<div class="col-sm-3">
						<label for="menores" class="col-sm-2 control-label">Menores</label>
							<input type="number" class="form-control" id="menores" onchange="sumar()" name="menores" placeholder="Rango invitados menores" required value="<?php echo $row['cant_acomp_menor'];?>">
							<input type="number" class="form-control" id="costo3" name="costo3" value="<?php echo $costo3 ?>"" style="visibility:hidden">
						</div>
					</div>

					<div class="page-header">
						<h2>Datos costos:<small>Gestionar datos de pagos</small></h2>
					</div>

					<div class="form-group">
					<div class="col-sm-3 col-md-offset-2">
					  <label for="fecha_saldo" class="control-label" >Fecha saldo</label>
					    <input type="date" class="form-control" id="fecha_saldo" name="fecha_saldo" placeholder="Fecha saldo" value="<?php echo $row['fecha_saldo'];?>">
					  </div>
					</div>

					<div class="form-group">
						<div class="col-sm-2 col-md-offset-2">												
						<label for="totapagar" class="col-sm-2 control-label">Monto</label>
							<input type="number" class="form-control" id="totalpagar" name="totalpagar" placeholder="totalpagar" required='Debe llenar este campo' value="<?php echo $totalpagar;?>">
							<span id="Display"></span>
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->
						<div class="col-sm-2">
							<label for="pagado" class="col-sm-2 control-label">Pagado</label>
							<input type="number" class="form-control" id="totalpagado" name="totalpagado" placeholder="totalpagado" required='Debe llenar este campo' value="<?php echo $row['recibido'];?>">
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-2">
							<label for="pendiente" class="col-sm-2 control-label">Pendiente</label>
							<input type="number" class="form-control" id="totalpendiente" name="totalpendiente" placeholder="totalpendiente" required='Debe llenar este campo' value="<?php echo $row['pendiente'];?>">
						</div>

						<div class="col-sm-2">
							<label for="monto_devuelto" class="col-sm-2 control-label">Devuelto</label>
							<input type="number" class="form-control" id="monto_devuelto" name="monto_devuelto" placeholder="monto_devuelto" required='Debe llenar este campo' value="<?php echo $row['monto_devuelto'];?>">
						</div>
					</div>

					<div class="page-header">
						<h2>Secuencia registros: <small>La secuencia toma en cuenta la cantidad de participantes inscritos</small></h2>
					</div>

					<div class="form-group">
					 	<div class="col-sm-4 col-md-offset-2">												
						<label for="ordenini" class="col-sm-2 control-label">Orden Inicial</label>
							<input type="number" class="form-control" id="ordenini" name="ordenini" placeholder="Orden" required='Debe llenar este campo' value="<?php echo $row['orden_ini'];?>">
						</div>
					<!-- </div> -->

					<!-- <div class="form-group"> -->						
						<div class="col-sm-4">
						<label for="ordenfin" class="col-sm-2 control-label">Orden Final</label>
							<input type="number" class="form-control" id="ordenfin" name="ordenfin" placeholder="Orden" required='Debe llenar este campo' value="<?php echo $row['orden_fin'];?>">
						</div>
					</div>

					<div class="page-header">
						<h2>Datos de control: </h2>
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
					    <textarea class="form-control" id="comentario_revisado" name="comentario_revisado" placeholder="Escriba Aquí"><?php echo $row['comentario_revisado'];?></textarea>
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
					<label for="imagen" class="col-sm-2 control-label">Clic para ampliar, doble clic para tamaño normal</label>
					<div class="col-sm-8" >
						 <img onclick="javascript:this.width=500;this.height=400" ondblclick="javascript:this.width=200;this.height=80" src="data:image/jpg;base64,<?php echo base64_encode($row['foto_deposito'])?>" width="200" class='img-responsive'/> 
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
							<?php
							  if ($pagina == 'E'){ ?>	
							   <a href="reporte-emergencias.php" class="btn btn-default">Regresar</a>
							<?php
								}
							  elseif ($pagina == 'I'){ 								   
								echo "<a href='inscritos-actualizar.php?accion=UDT&pagina=I&empresa=".$row['codempresa']."&id=".$row['codinscripcion']."' class='btn btn-default'>Regresar</a>";
							  }	
							  else { ?>
							    <a href="inscritos2-mant.php" class="btn btn-default">Regresar</a>
							<?php
								}
							?>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>