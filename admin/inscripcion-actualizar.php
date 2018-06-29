<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
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
    
    if ($_SESSION['crmEmpresa'] != $_GET['empresa']){
        // die('Intento de contaminar consulta'); 
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Se ha producido un error al intentar contaminar la consulta.';      
    }
$query=extaerInscritosUDT2($_GET['id'],$_GET['empresa']);
$r=$query->fetch_assoc();

	if (empty($r['codinscripcion']) && ($Vid != 0)){
        $statusMsgClass = 'alert-danger';
        $statusMsg = 'La consulta no devolvió ningún resultado.';
    }

?>
	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Inscripciones</p>
			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li><a href="inscripcion-mant.php">Inscripciones</a></li>
			  <li class="active">Editar Registro</li>			  
			</ol>
				 <?php if(!empty($statusMsg)){
                    echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
                    die("<a href='javascript:history.go(-1);' class='btn btn-warning btn-fill'>Datos no encontrados, volver atrás</a>");
                } ?>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Editar</h3>
			</div> 
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="php/inscripcion-registros.php?accion=UDT"  enctype="multipart/form-data">	
				<legend>Datos Personales y Laborables</legend>
					<input type="hidden" name="id" value="<?php echo $r['codinscripcion']; ?>">
					<input type="hidden" name="empresa" value="<?php echo $r['codempresa'] ?>">
					<div class="form-group ">

						<div class="col-sm-8 col-md-offset-2">
						<div class="img-preview">
							
							<!-- <output id="list" ></output> -->	
							<div class="form-group" >
								<div class="col-sm-12" >
									<?php if (!empty($r['foto'])): ?>						
										<img src="data:image/png;base64,<?php echo base64_encode($r['foto'])?>" class='imagen-empresa img-responsive'/>
									<?php else: ?>
										<img src="img/miembros.png" class='imagen-empresa img-responsive'/>

									<?php endif ?>						
								</div>
							</div>
							<label for="foto" class="control-label">Fotografía</label>
							<input type="file" accept=".png" class="form-control" id="foto" name="foto" placeholder="Fotografia"  >
							<label style="color: orange">Nota: Si no selecciona una imagen se queda la misma imagen</label>
							</div>
							<script>
							  // ///////////////////////////////////////////////////mostrar preview de la imagen
				              function archivo(evt) {


				                  var files = evt.target.files; // FileList object
				             
				                   document.getElementById("list").innerHTML = ['<img class="thumb" src="img/noimg.png"/>'].join('');
				                  // Obtenemos la imagen del campo "file".
				                  for (var i = 0, f; f = files[i]; i++) {
				                    //Solo admitimos imágenes.
				                    if (!f.type.match('image.*')) {
				                        continue;
				                    }
				             
				                    var reader = new FileReader();
				             
				                    reader.onload = (function(theFile) {
				                        return function(e) {
				                          // Insertamos la imagen

				                         document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
				                         
				                        };
				                    })(f);
				             
				                    reader.readAsDataURL(f);
				                  }
				              }
				             
				              document.getElementById('foto').addEventListener('change', archivo, false);
				     		</script>
						</div>
					</div>

					<div class="form-group ">
						<div class="col-sm-4 col-md-offset-2">
							<label for="nombre" class="control-label">Nombres</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" required="" value="<?php echo $r['nombre']; ?>">
						</div>
					
						<div class="col-sm-4 ">
							<label for="apellido" class="control-label">Apellidos</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>

							<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos" required="" value="<?php echo $r['apellido']; ?>">
						</div>
					</div>
					<div class="form-group ">
						<div class="col-sm-4 col-md-offset-2">
							<label for="identificacion" class="control-label">Identificación No.</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Identificación No." required="" value="<?php echo $r['cedula']; ?>">
						</div>
						<div class="col-sm-4">
							<label for="nacionalidad" class="control-label">Nacionalidad</label>
							<select class="form-control" id="nacionalidad" name="nacionalidad" >
								<option value="" >Seleccione</option>					
								<?php 
									$query=extraerNacionalidades();
									if($query->num_rows > 0)
									{
										while ($row = $query->fetch_assoc()) {		
											if($r['codnacionalidad'] == $row['codnacionalidad']){
												echo "<option value='".$row['codnacionalidad']."' selected>".strtoupper($row['descripcion'])."</option>	";
											} 	
											else{
												echo "<option value='".$row['codnacionalidad']."'>".strtoupper($row['descripcion'])."</option>	";

											}											
										}
									}
								?>						
							</select>
						</div>

					</div>
					<div class="form-group ">
						<div class="col-sm-3 col-md-offset-2">
							<label for="tcelular" class="control-label">Celular</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="tel" class="form-control" id="tcelular" name="tcelular" placeholder="Telefono Celular" required="" value="<?php echo $r['celular']; ?>">
						</div>
						<div class="col-sm-3 ">
							<label for="tel" class="control-label">Tel&eacutefono</label>
							<input type="tel" class="form-control" id="tel" name="tel" placeholder="Telefono" value="<?php echo $r['telefono']; ?>">
						</div>
						<div class="col-sm-2 ">
							<label for="fax" class="control-label">Fax</label>

							<input type="fax" class="form-control" id="fax" name="fax" placeholder="Fax" value="<?php echo $r['fax']; ?>">
						</div>
						
					</div>
					
					<div class="form-group">
						<div class="col-sm-4 col-md-offset-2">
							<label for="sangre" class="control-label">Tipo de Sangre</label>
							<select class="form-control" id="sangre" name="sangre" >
								<option value="">Seleccione</option>
								<option value="A+" <?php if($r['tipo_sangre']=='A+'){echo'selected';}?>>A+</option>	
								<option value="A-" <?php if($r['tipo_sangre']=='A-'){echo'selected';}?>>A-</option>	
								<option value="B+" <?php if($r['tipo_sangre']=='B+'){echo'selected';}?>>B+</option>	
								<option value="B-" <?php if($r['tipo_sangre']=='B-'){echo'selected';}?>>B-</option>	
								<option value="O+" <?php if($r['tipo_sangre']=='O+'){echo'selected';}?>>O+</option>	
								<option value="O-" <?php if($r['tipo_sangre']=='O-'){echo'selected';}?>>O-</option>	
								<option value="AB+" <?php if($r['tipo_sangre']=='AB+'){echo'selected';}?>>AB+</option>	
								<option value="AB-" <?php if($r['tipo_sangre']=='AB-'){echo'selected';}?>>AB-</option>					
												
							</select>
						</div> 
						<div class="col-sm-4 ">
						<label for="estado-civil" class="control-label">Estado Civil</label>
							<select class="form-control" id="estado-civil" name="estado-civil">
								<option value="" >Seleccione</option>					
								<option value="S" <?php if($r['estado_civil']=='S'){echo'selected';}?>>Soltero</option>					
								<option value="C" <?php if($r['estado_civil']=='C'){echo'selected';}?>>Casado</option>
							</select>

						</div> 
						
					</div>
					<div class="form-group ">
						<div class="col-sm-8 col-md-offset-2">
							<label for="email" class=" control-label">Correo</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $r['email']; ?>">
						</div>	
						
					</div>

					<div class="form-group ">
						<div class="col-sm-8 col-md-offset-2 ">
						<label for="direccion" class="control-label">Dirección</label>
							<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?php echo $r['direccion']; ?>">
						</div>
					
					</div>

					<div class="form-group">
						<div class="col-sm-6 col-md-offset-2">
						<label for="organizacion" class="control-label">Empresa u Organizacion</label>
							<input type="text" class="form-control" id="organizacion" name="organizacion" placeholder="Empresa u Organizacion" value="<?php echo $r['lugar_trabajo']; ?>">
						</div>

						<div class="col-sm-2 ">
						<label for="cargo" class="control-label">Cargo</label>
							<select class="form-control" id="cargo" name="cargo" >
								<option value="" >Seleccione</option>					
								<?php 
									$query=extraerCargo();
									if($query->num_rows > 0)
									{
										while ($row = $query->fetch_assoc()) {						
											if($r['cargo']==$row['codparametro']){					
												echo "<option value='".$row['codparametro']."' selected>".strtoupper($row['valor2'])."</option>	";
											}
											else{
												echo "<option value='".$row['codparametro']."'>".strtoupper($row['valor2'])."</option>	";
											}
										}
									}
								?>						
							</select>
						</div>
					
					</div>

					
					<div class="form-group ">
						<div class="col-sm-4 col-md-offset-2">
							<label for="tel_org" class="control-label">Telefono</label>
							<input type="text" class="form-control" id="tel_org" name="tel_org" placeholder="Telefono Organizacion" value="<?php echo $r['telefono_oficina']; ?>">
						</div>
						<script type="text/javascript">
							var activo=false;

							function sed() {
						    	var valor2 = document.getElementById("sede");
						    	valor2=(valor2.value);
						    	// var valor="<?php echo $r['itado_sede']; ?>";
						    	// alert(valor);
						    	if (valor2=='O'){
     							 // document.getElementById("totalabono").value=total;
	     							
								    if (activo==false){
								    	$('#importFrm').slideToggle();
								    	activo=true;
								    }
						    	}
						    	else{
						    		if (activo==true){
								    	$('#importFrm').slideToggle();
								    	activo=false;
								    }
						    	}
								
							}
							function sed2() {
						    	var valor="<?php echo $r['itado_sede']; ?>";
						    	alert(valor);
						    	if (valor=='O'){
     							 // document.getElementById("totalabono").value=total;
	     							
								    if (activo==false){
								    	$('#importFrm').slideToggle();
								    	activo=true;
								    }
						    	}
						    	else{
						    		if (activo==true){
								    	$('#importFrm').slideToggle();
								    	activo=false;
								    }
						    	}
								
							}
						</script>
						<div class="col-sm-4">
						<label for="sede" class="control-label">Sede</label>
							<select  onchange="sed();" class="form-control" id="sede" name="sede">
								<option value="" >Seleccione</option>					
								<?php 
									$query=extraerSede();
									if($query->num_rows > 0)
									{
										while ($row = $query->fetch_assoc()) {						
											if ($r['itado_sede']==$row['codparametro'])
											{								
												echo "<option value='".$row['codparametro']."' selected>".strtoupper($row['valor2'])."</option>	";
											}
											else{
												echo "<option value='".$row['codparametro']."'>".strtoupper($row['valor2'])."</option>	";
											}
										}
									}
									if ($r['itado_sede']=='O'){									
										echo '<option value="O" selected>DIRECCION REGIONAL</option>';
									}
									else{
										echo '<option value="O">DIRECCION REGIONAL</option>';

									}
								?>	
							</select>
						</div>
					</div>
					<div class="form-group" >
						<div class="col-sm-8 col-md-offset-2">
							<label for="s-otros" class=" control-label">Descripcion</label>
							<textarea class="form-control"  id="s-otros" name="s-otros" placeholder="Descripcion" rows="5" ><?php echo $r['otra_sede'] ?></textarea>

						</div>
					</div>
				
				<legend>Formaci&oacute;n Acad&eacute;mica </legend>

					<div class="form-group ">
						<div class="col-sm-4 col-md-offset-2">
							<label for="categoria-e" class="control-label">Experiencia</label>
							<select class="form-control" id="categoria-e" name="categoria-e">
								<option value="">Seleccione</option>					
								<?php 
									$query=extraerExperiencia();
									if($query->num_rows > 0)
									{
										while ($row = $query->fetch_assoc()) {
											if ($r['profesion']==$row['codparametro']){	
												echo "<option value='".$row['codparametro']."' selected>".strtoupper($row['valor2'])."</option>	";
											}
											else{
												echo "<option value='".$row['codparametro']."'>".strtoupper($row['valor2'])."</option>	";
											}
										}
									}
								?>						
							</select>
						</div>
					</div>

					
				<legend>Gremios Afiliados</legend>

					<div class="form-group ">
						<div class="col-sm-4 col-md-offset-2">
						<label for="codia" class=" control-label">No. Codia</label>
							<input type="text" class="form-control" id="codia" name="codia" placeholder="No. Codia" value="<?php echo $r['gremio']; ?>">
						</div>
					</div>	
					<div class="form-group ">
						<div class="col-sm-6 col-md-offset-2">
							<label for="g-otros" class=" control-label">Otros Gremios</label>
							<textarea class="form-control"  id="g-otros" name="g-otros" placeholder="Otros Gremios" rows="5"><?php echo $r['otro_gremio']; ?></textarea>
							<!-- <input type="text" class="form-control" id="g-otros" name="g-otros" placeholder="Otros Gremios" > -->
						</div>
					</div>

					
				<legend>Curso</legend>
					<div class="form-group ">
						<div class="col-sm-8 col-md-offset-2">	
							<h4>Como usted se enteró del curso? <br></h4>

							<?php if ($r['enterar']=='web'): ?>
								<label class="radio-inline"><input type="radio" name="entero" value="web" checked="">P&aacute;gina Web ITADO</label>
							<?php else: ?>
								<label class="radio-inline" ><input type="radio" name="entero" value="web">P&aacute;gina Web ITADO</label>
							<?php endif ?>

							<?php if ($r['enterar']=='correo'): ?>
								<label class="radio-inline"><input type="radio" name="entero" value="correo" checked="">E-Mail</label>
							<?php else: ?>
								<label class="radio-inline"><input type="radio" name="entero" value="correo">E-Mail</label>
							<?php endif ?>

							<?php if ($r['enterar']=='periodico'): ?>
								<label class="radio-inline"><input type="radio" name="entero" value="periodico" checked="">Peri&oacute;dico</label>
							<?php else: ?>
								<label class="radio-inline"><input type="radio" name="entero" value="periodico">Peri&oacute;dico</label>
							<?php endif ?>

							<?php if ($r['enterar']=='amigo'): ?>
								<label class="radio-inline"><input type="radio" name="entero" value="amigo" checked="">Un amigo</label>
							<?php else: ?>
								<label class="radio-inline"><input type="radio" name="entero" value="amigo" >Un amigo</label>
							<?php endif ?>

							<?php if ($r['enterar']=='face'): ?>
								<label class="radio-inline"><input type="radio" name="entero" value="face" checked="">Facebook</label>
							<?php else: ?>
								<label class="radio-inline"><input type="radio" name="entero" value="face">Facebook</label>
							<?php endif ?>

							<?php if ($r['enterar']=='otro'): ?>
								<label class="radio-inline"><input type="radio" name="entero" value="otro" checked="">Otros</label>
							<?php else: ?>
								<label class="radio-inline"><input type="radio" name="entero" value="otro">Otros</label>
							<?php endif ?>
						</div>							
					</div>

					<div class="form-group ">
						<div class="col-sm-6 col-md-offset-2">
							<textarea class="form-control"  id="c-otros" name="c-otros" placeholder="Otro Medio" rows="5"></textarea>
						</div>							
					</div>
					<!-- <div class="form-group ">
						<div class="col-sm-8 col-md-offset-2" style="text-align: justify;">
							<h4>Metodologia y Requisitos Fundamentales:</h4><br>
							<p>El curso está dividido en tres (3) módulos, y al final de cada módulo se realizará una evaluación, cuya nota mínima debe ser del 75%. </p>
							
							<p>Al final del curso debe hacerse un trabajo que será presentado a un jurado, cuya nota mínima debe ser del 75%.</p>

							<p>Debe de cumplirse con un mínimo de asistencia del 80%.</p>

							<p>Se emitirá un certificado de aprobación solo a aquellos que cumplan con los requerimientos mínimos antes señalados. A los que no cumplan con superar las evaluaciones, el trabajo final, y sólo cumplan con la asistencia mínima requerida, se le emitirá sólo un certificado de asistencia.</p>

							<p>Aquellos que reciban el certificado de aprobación, podrán iniciar el proceso de admisión al ITADO a partir del primer año de terminar el curso, siempre dentro un periodo no mayor a los tres (3) anos de la fecha del certificado, cumpliendo con los requisitos que establecen los Estatutos y Reglamentos del ITADO. No obstante, dicho certificado de aprobación no lo faculta para ejercer como tasador, hasta no obtener la membresía del ITADO. </p>
						</div>
					</div> -->
					<!-- <div class="form-group ">
						<div class="col-sm-8 col-md-offset-2">	
							<h4>Como usted se enteró del curso? <br></h4>
							<label class="checkbox-inline"><input type="checkbox" name="acuerdo" required="" value="true">Le&iacute;do y Aceptado Conforme</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
						</div>							
					</div> -->


				<legend></legend>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-2">

						<label for="estado" class="control-label">Estado</label>
							<select class="form-control" id="estado" name="estado" required="">
								<!-- <option value="">Seleccione</option>					 -->
								<option value="A" <?php if($r['estado_inscripcion']=='A'){echo'selected';}?>>Activo</option>					
								<option value="I" <?php if($r['estado_inscripcion']=='I'){echo'selected';}?>>Inactivo</option>							
							</select>
						</div>
				</div>
				
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-8">
							<a href="inscripcion-mant.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>		
<?php include'php/pie.php';?>