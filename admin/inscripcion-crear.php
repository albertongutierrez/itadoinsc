<?php include'php/cabeza.php';

if ($_SESSION['crmRanking']>2){
	echo"<script language='javascript'>window.location='main.php'</script>;";
}
?>

	
	<div class="content-wrapper" style="overflow:hidden;" >
		<p class="site-title">Mantenimiento Inscripciones</p>
			<ol class="breadcrumb">
			  <li><a href="main.php">Inicio</a></li>
			  <li><a href="inscripcion-mant.php">Inscripciones</a></li>
			  <li class="active">Nuevo Registro</li>			  
			</ol>
		<div class="panel panel-default" style="margin-top: 10px">
			<div class="panel-heading">
				<h3 class="panel-title">Nuevo</h3>
			</div> 
			<div class="p-body">
				<form class="form-horizontal" method="POST" action="php/inscripcion-registros.php?accion=INS"  enctype="multipart/form-data">	
				<legend>Datos Personales y Laborables</legend>

					<div class="form-group ">

						<div class="col-sm-8 col-md-offset-2">
						<div class="img-preview">
							
							<output id="list" ></output>	
							<label for="foto" class="control-label">Fotografía</label>
							<input type="file" accept=".png" class="form-control" id="foto" name="foto" placeholder="Fotografia"  >
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
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" required="">
						</div>
					
						<div class="col-sm-4 ">
							<label for="apellido" class="control-label">Apellidos</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>

							<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos" required="">
						</div>
					</div>
					<div class="form-group ">
						<div class="col-sm-4 col-md-offset-2">
							<label for="identificacion" class="control-label">Identificación No.</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Identificación No." required="">
						</div>
						<div class="col-sm-4">
							<label for="nacionalidad" class="control-label">Nacionalidad</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<select class="form-control" id="nacionalidad" name="nacionalidad" required="">
								<option value="" >Seleccione</option>					
								<?php 
									$query=extraerNacionalidades();
									if($query->num_rows > 0)
									{
										while ($row = $query->fetch_assoc()) {														
											echo "<option value='".$row['codnacionalidad']."'>".strtoupper($row['descripcion'])."</option>	";
										}
									}
								?>						
							</select>
						</div>

					</div>
					<div class="form-group ">
						<div class="col-sm-3 col-md-offset-2">
							<label for="tcelular" class="control-label">Celular</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
							<input type="tel" class="form-control" id="tcelular" name="tcelular" placeholder="Telefono Celular" required="">
						</div>
						<div class="col-sm-3 ">
							<label for="tel" class="control-label">Tel&eacutefono</label>
							<input type="tel" class="form-control" id="tel" name="tel" placeholder="Telefono" >
						</div>
						<div class="col-sm-2 ">
							<label for="fax" class="control-label">Fax</label>

							<input type="fax" class="form-control" id="fax" name="fax" placeholder="Fax" >
						</div>
						
					</div>
					
					<div class="form-group">
						<div class="col-sm-4 col-md-offset-2">
							<label for="sangre" class="control-label">Tipo de Sangre</label>
							<select class="form-control" id="sangre" name="sangre" >
								<option value="">Seleccione</option>
								<option value="A+" >A+</option>	
								<option value="A-" >A-</option>	
								<option value="B+" >B+</option>	
								<option value="B-" >B-</option>	
								<option value="O+" >O+</option>	
								<option value="O-" >O-</option>	
								<option value="AB+" >AB+</option>	
								<option value="AB-" >AB-</option>					
												
							</select>
						</div> 
						<div class="col-sm-4 ">
						<label for="estado-civil" class="control-label">Estado Civil</label>
							<select class="form-control" id="estado-civil" name="estado-civil">
								<option value="">Seleccione</option>					
								<option value="S">Soltero</option>					
								<option value="C">Casado</option>
							</select>

						</div> 
						
					</div>
					<div class="form-group ">
						<div class="col-sm-8 col-md-offset-2">
							<label for="email" class=" control-label">Correo</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" >
						</div>	
						
					</div>

					<div class="form-group ">
						<div class="col-sm-8 col-md-offset-2 ">
						<label for="direccion" class="control-label">Dirección</label>
							<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" >
						</div>
					
					</div>

					<div class="form-group">
						<div class="col-sm-6 col-md-offset-2">
						<label for="organizacion" class="control-label">Empresa u Organizacion</label>
							<input type="text" class="form-control" id="organizacion" name="organizacion" placeholder="Empresa u Organizacion" >
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
											echo "<option value='".$row['codparametro']."'>".strtoupper($row['valor2'])."</option>	";
										}
									}
								?>						
							</select>
						</div>
					
					</div>

					
					<div class="form-group ">
						<div class="col-sm-4 col-md-offset-2">
							<label for="tel_org" class="control-label">Telefono</label>
							<input type="text" class="form-control" id="tel_org" name="tel_org" placeholder="Telefono Organizacion" >
						</div>
						<script type="text/javascript">
							var activo=false;
							function sed() {
						    	var valor2 = document.getElementById("sede");
						    	valor2=(valor2.value);
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
											echo "<option value='".$row['codparametro']."'>".strtoupper($row['valor2'])."</option>	";
										}
									}
								?>	
								<option value="O">DIRECCION REGIONAL</option>					
							</select>
						</div>
					</div>
					<div class="form-group" id="importFrm">
						<div class="col-sm-8 col-md-offset-2">
							<label for="s-otros" class=" control-label">Descripcion</label>
							<textarea class="form-control"  id="s-otros" name="s-otros" placeholder="Descripcion" rows="5"></textarea>

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
											echo "<option value='".$row['codparametro']."'>".strtoupper($row['valor2'])."</option>	";
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
							<input type="text" class="form-control" id="codia" name="codia" placeholder="No. Codia" >
						</div>
					</div>	
					<div class="form-group ">
						<div class="col-sm-6 col-md-offset-2">
							<label for="g-otros" class=" control-label">Otros Gremios</label>
							<textarea class="form-control"  id="g-otros" name="g-otros" placeholder="Otros Gremios" rows="5"></textarea>
							<!-- <input type="text" class="form-control" id="g-otros" name="g-otros" placeholder="Otros Gremios" > -->
						</div>
					</div>

					
				<legend>Curso</legend>
					<div class="form-group ">
						<div class="col-sm-8 col-md-offset-2">	
							<h4>Como usted se enteró del curso? <br></h4>
							<label class="radio-inline"><input type="radio" name="entero" value="web">P&aacute;gina Web ITADO</label>
							<label class="radio-inline"><input type="radio" name="entero" value="correo">E-Mail</label>
							<label class="radio-inline"><input type="radio" name="entero" value="periodico">Peri&oacute;dico</label>
							<label class="radio-inline"><input type="radio" name="entero" value="amigo">Un amigo</label>
							<label class="radio-inline"><input type="radio" name="entero" value="face">Facebook</label>
							<label class="radio-inline"><input type="radio" name="entero" value="otro">Otros</label>
						</div>							
					</div>

					<div class="form-group ">
						<div class="col-sm-6 col-md-offset-2">
							<textarea class="form-control"  id="c-otros" name="c-otros" placeholder="Otro Medio" rows="5"></textarea>
						</div>							
					</div>
					<div class="form-group ">
						<div class="col-sm-8 col-md-offset-2" style="text-align: justify;">
							<h4>Metodologia y Requisitos Fundamentales:</h4><br>
							<p>El curso está dividido en tres (3) módulos, y al final de cada módulo se realizará una evaluación, cuya nota mínima debe ser del 75%. </p>
							
							<p>Al final del curso debe hacerse un trabajo que será presentado a un jurado, cuya nota mínima debe ser del 75%.</p>

							<p>Debe de cumplirse con un mínimo de asistencia del 80%.</p>

							<p>Se emitirá un certificado de aprobación solo a aquellos que cumplan con los requerimientos mínimos antes señalados. A los que no cumplan con superar las evaluaciones, el trabajo final, y sólo cumplan con la asistencia mínima requerida, se le emitirá sólo un certificado de asistencia.</p>

							<p>Aquellos que reciban el certificado de aprobación, podrán iniciar el proceso de admisión al ITADO a partir del primer año de terminar el curso, siempre dentro un periodo no mayor a los tres (3) anos de la fecha del certificado, cumpliendo con los requisitos que establecen los Estatutos y Reglamentos del ITADO. No obstante, dicho certificado de aprobación no lo faculta para ejercer como tasador, hasta no obtener la membresía del ITADO. </p>
						</div>
					</div>
					<div class="form-group ">
						<div class="col-sm-8 col-md-offset-2">	
							<!-- <h4>Como usted se enteró del curso? <br></h4> -->
							<label class="checkbox-inline"><input type="checkbox" name="acuerdo" required="" value="true">Le&iacute;do y Aceptado Conforme</label><span style="font-weight: bold; color: red; font-size: 25px">*</span>
						</div>							
					</div>


				<legend></legend>	
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