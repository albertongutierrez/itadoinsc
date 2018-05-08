<?php 
 include 'php/cabeza2.php';
 include 'php/consultas.php';

 // variables
 $id=false;
 $fecha_inscripcion=false;
 $nombre=false;
 $apellido=false;
 $telefono=false;
 $correo=false;
 $cedula_pasaporte=false; 
 $genero=false;
 $pais=false;
 $provincia=false;
 $nombre_grupo=false;
 $otro_grupo=false;
 $cant_p=false;
 $cant_ma=false;
 $cant_me=false;
 $contactoe=false;
 $telefonoe=false;
 $comentario_p=false;
 $acuerdo_t=false;
 $revisado=false;
 $comentario_revisado=false;
 $fecha_deposito=false;
 $monto=false;
 $referencia=false;
 $descripcion_deposito=false;
 $comentario_deposito=false;
 $vtrasaccion='';


if(isset($_GET['codactividad']) && isset($_GET['datos'])){		
		$grev = $_GET['datos'];
		$gact = $_GET['codactividad'];
	}
	else{
		$grev = 'w';
		$gact = '0';
	}
	$actividad='';
 // hasta aquí

 if(!empty($_GET['status'])){
		    switch($_GET['status']){
		        case 'succ':
		            $statusMsgClass = 'alert-success';
		            $statusMsg = 'Kit Entregado Correctamente.';
		            break;
		        case 'err':
		            $statusMsgClass = 'alert-danger';
		            $statusMsg = 'ha Ocurrido un Error Intente Más Tarde.';
		            break;
		        case 'entregado':
		            $statusMsgClass = 'alert-warning';
		            $statusMsg = 'Kit ya Entregado.';
		            break;
		        case 'np':
		            $statusMsgClass = 'alert-info';
		            $statusMsg = 'Pago aun no Realizado.';
		            break;
		        default:
		            $statusMsgClass = '';
		            $statusMsg = '';
		    }
		    
		}
 ?>
<div style="margin-top: 100px" ></div>
	<div class="content-wrapper" style="width: 90%; margin: 0 auto; ">
		<div style="float: left; margin-top: 5px;" >
			<a href="main-2.php" class="btn btn-danger" style="padding: 10px">
			<img src='img/back.svg'/ width="16px">
			<span style="font-size: 13px">Atr&aacute;s</span>
			</a>
		</div>
		<p  class="titulo-sitio"> Consulta Participantes</p>
		<?php if(!empty($statusMsg)){
	        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
	    } 

	    ?>
	   
	    <div class="panel panel-default">

	        <div class="panel-heading">
	            Consulta
	            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Filtros</a><br>
	            
	            <div id="importFrm"> 
					 <form action="php/filtrar-participante.php" method="post">


					  <br>
						<div class="form-group">
					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="id" 
					       <?php 
					       	$query= buscarparametrosdato('id');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='id' && $row['comentario']=='si'){echo "checked";$id=true;}
            	  			?>
					        >ID
					    </label>

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="fecha_inscripcion"
					      <?php 
					      	$query= buscarparametrosdato('fecha_inscripcion');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='fecha_inscripcion' && $row['comentario']=='si'){echo "checked"; $fecha_inscripcion=true;}
            	  			?>
					      > Fecha de Inscripci&oacute;n
					    </label>

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="nombre"
					      <?php 
					      $query= buscarparametrosdato('nombre');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='nombre' && $row['comentario']=='si'){echo "checked"; $nombre=true;}
            	  			?>
            	  			>Nombre
					    </label>

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="apellido"
					      <?php 
					      	$query= buscarparametrosdato('apellido');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='apellido' && $row['comentario']=='si'){echo "checked"; $apellido=true;}
            	  			?>
					      >Apellido
					    </label>

					     <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="telefono"
					      <?php 
					      	$query= buscarparametrosdato('Telefono');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='telefono' && $row['comentario']=='si'){echo "checked"; $telefono=true;}
            	  			?>
					      >Tel&eacute;fono
					    </label>

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="correo"
					      <?php 
					      	$query= buscarparametrosdato('correo');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='correo' && $row['comentario']=='si'){echo "checked"; $correo=true;}
            	  			?>
					      >Correo
					    </label>

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="cedula_pasaporte"
					      <?php 
					      	$query= buscarparametrosdato('cedula_pasaporte');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='cedula_pasaporte' && $row['comentario']=='si'){echo "checked"; $cedula_pasaporte=true;}
            	  			?>	
					      >C&eacute;dula o Pasaporte
					    </label>

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="genero" 
					      <?php 
					      	$query= buscarparametrosdato('genero');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='genero' && $row['comentario']=='si'){echo "checked"; $genero=true;}
            	  			?>
					      >G&eacute;nero
					    </label>

					       <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="pais"
					      <?php 
					      $query= buscarparametrosdato('pais');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='pais' && $row['comentario']=='si'){echo "checked";$pais=true;}
            	  			?>
					      >Pa&iacute;s
					    </label>
					    

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="provincia"
					      <?php 
					      	$query= buscarparametrosdato('provincia');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='provincia' && $row['comentario']=='si'){echo "checked"; $provincia=true;}
            	  			?>
					      >Provincia
					    </label>


					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="nombre_grupo"
					      <?php 
					      	$query= buscarparametrosdato('nombre_grupo');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='nombre_grupo' && $row['comentario']=='si'){echo "checked"; $nombre_grupo=true;}
            	  			?>
					      >Nombre Grupo
					    </label>

					   <!--   <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="otro_grupo"
					      <?php 
					      	// $query= buscarparametrosdato('otro_grupo');
					       // 	$row=$query->fetch_assoc();
            // 	  			if($row['valor2']=='otro_grupo' && $row['comentario']=='si'){echo "checked";$otro_grupo=true;}
            	  			?>
					      >Nombre Otro Grupo 
					    </label> -->

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="cant_p"
					      <?php 
					      	$query= buscarparametrosdato('cant_p');
					       	$row=$query->fetch_assoc();	
            	  			if($row['valor2']=='cant_p' && $row['comentario']=='si'){echo "checked"; $cant_p=true;}
            	  			?>
					      >Cantidad de Participantes
					    </label> 

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="cant_ma"
					      <?php 
					      	$query= buscarparametrosdato('cant_ma');
					       	$row=$query->fetch_assoc();	
            	  			if($row['valor2']=='cant_ma' && $row['comentario']=='si'){echo "checked"; $cant_ma=true;}
            	  			?>
					      >Cantidad de Mayores
					    </label> 

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="cant_me"
					      <?php 
					      	$query= buscarparametrosdato('cant_me');
					       	$row=$query->fetch_assoc();	
            	  			if($row['valor2']=='cant_me' && $row['comentario']=='si'){echo "checked"; $cant_me=true;}
            	  			?>
					      >Cantidad de Menores
					    </label> 

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="contactoe"
					      <?php 
					      	$query= buscarparametrosdato('contactoe');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='contactoe' && $row['comentario']=='si'){echo "checked"; $contactoe=true;}
            	  			?>
					      >Nombre de Contacto de Emergencia 
					    </label>

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="telefonoe"
					      <?php 
					      	$query= buscarparametrosdato('telefonoe');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='telefonoe' && $row['comentario']=='si'){echo "checked"; $telefonoe=true;}
            	  			?>
					      >Tel&eacute;fono Contacto Emergencia
					    </label>

					   <!--  <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="comentario_p"
					      <?php 
					      	// $query= buscarparametrosdato('comentario_p');
					       // 	$row=$query->fetch_assoc();	
            // 	  			if($row['valor2']=='comentario_p' && $row['comentario']=='si'){echo "checked"; $comentario_p=true;}
            	  			?>
					      >Comentario participante
					    </label>  -->

					    <!-- <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="acuerdo_t"
					      <?php 
					      	// $query= buscarparametrosdato('acuerdo_t');
					       // 	$row=$query->fetch_assoc();
            // 	  			if($row['valor2']=='acuerdo_t' && $row['comentario']=='si'){echo "checked";$acuerdo_t=true;}
            	  			?>
					      > Acuerdo de T&eacute;rminos
					    </label> -->

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="revisado"
					      <?php 
					      	$query= buscarparametrosdato('revisado');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='revisado' && $row['comentario']=='si'){echo "checked"; $revisado=true;}
            	  			?>
					      >Revisado
					    </label>

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="c_revisado"
					      <?php 
					      	$query= buscarparametrosdato('c_revisado');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='c_revisado' && $row['comentario']=='si'){echo "checked"; $comentario_revisado=true;}
            	  			?>
					      >Comentario Revisado
					    </label>

					    <!-- <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="fecha_deposito"
					      <?php 
					      	// $query= buscarparametrosdato('fecha_deposito');
					       	// $row=$query->fetch_assoc();
            	  			// if($row['valor2']=='fecha_deposito' && $row['comentario']=='si'){echo "checked"; $fecha_deposito=true;}
            	  			?>
					      >Fecha Deposito
					    </label> -->

					   <!--  <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="monto"
					      <?php 
					      	// $query= buscarparametrosdato('monto');
					       	// $row=$query->fetch_assoc();
            	  			// if($row['valor2']=='monto' && $row['comentario']=='si'){echo "checked"; $monto=true;}
            	  			?>
					      >Monto
					    </label> -->

					    <!-- <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="referencia"
					      <?php 
					      	// $query= buscarparametrosdato('referencia');
					       	// $row=$query->fetch_assoc();
            	  			// if($row['valor2']=='referencia' && $row['comentario']=='si'){echo "checked"; $referencia=true;}
            	  			?>
					      >Orden INI
					    </label>

					    <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="descripcion_deposito"
					      <?php 
					      	// $query= buscarparametrosdato('descripcion_deposito');
					       	// $row=$query->fetch_assoc();
            	  			// if($row['valor2']=='descripcion_deposito' && $row['comentario']=='si'){echo "checked"; $descripcion_deposito=true;}
            	  			?>
					      >Orden FIN
					    </label> -->

					    <!-- <label class="checkbox-inline">
					      <input type="checkbox" value="si" name="comentario_deposito"
					      <?php 
					      	// $query= buscarparametrosdato('comentario_deposito');
					       // 	$row=$query->fetch_assoc();
            // 	  			if($row['valor2']=='comentario_deposito' && $row['comentario']=='si'){echo "checked"; $comentario_deposito=true;}
            	  			?>
					      >Comentario Deposito
					    </label> -->


					    
					    </label>
					    </div>
					    <div class="form-group">
					    	<label>Datos a Motrar</label>
					    	<br>
					    	<label class="radio-inline">
					    	<input type="radio" name="datos" value="all"
					    	<?php 
					      	$query= buscarparametrosdato('datos');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='datos' && $row['comentario']=='all'){echo "checked";$vtrasaccion='all';}
            	  			?>
					    	>
					    	Todos
					    	</label>

							<label class="radio-inline">
							<input type="radio" name="datos" value="con"
							<?php 
					      	$query= buscarparametrosdato('datos');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='datos' && $row['comentario']=='con'){echo "checked";$vtrasaccion='con';}
            	  			?>
							>
							Inscripci&oacute;n Paga
							</label>

							<label class="radio-inline">
							<input type="radio" name="datos" value="sin"
							<?php 
					      	$query= buscarparametrosdato('datos');
					       	$row=$query->fetch_assoc();
            	  			if($row['valor2']=='datos' && $row['comentario']=='sin'){echo "checked";$vtrasaccion='sin';}
            	  			?>
							>
							Inscripci&oacute;n Pendiente
							</label>

							<label class="radio-inline">
							<input type="radio" name="datos" value="kit"
							<?php 
					      	$query= buscarparametrosdato('datos');
					       	$row=$query->fetch_assoc();    
            	  			if($row['valor2']=='datos' && $row['comentario']=='kit'){echo "checked";$vtrasaccion='kit';}
            	  			?>
							>
							Kit Entregados
							</label>

					    </div>
						<div class="form-group">
							<div class="col-sm-2 ">
								<label for="zona" class="col-sm-2 control-label">Evento</label>
								<select class='form-control' id='actividad' name='evento'  >		<?php 
									$query=extraerActividad($_SESSION['crmRanking'],$_SESSION['crmEmpresa']);			
									$query2= buscarparametrosdato('evento');
					       			$ro=$query2->fetch_assoc();
						            if($query->num_rows > 0){
						            while ($row= $query -> fetch_assoc())
						                  { ?>
						              <option value="<?php echo $row['codactividad'];?>" 
						              	<?php if($ro['valor2']=='evento' && $ro['comentario']==$row['codactividad']){echo "selected"; }?>
						              	> <?php echo $row['descripcion'];?></option>
						            <?php }}
						            ?>  		
															
								</select>
							</div>

							<div class="col-sm-3 ">
								<label for="zona" class="col-sm-4 control-label">Inscrito:</label>
								<select id="inscritoen" name="inscritoen" class="form-control">
						            <option value= 'A'>TODAS LAS INSCRIPCIONES</option>           
						            <?php 
						            $query2= buscarparametrosdato('inscritoen');
					       			$ro=$query2->fetch_assoc();
									$query=extraerInscritoEn($_SESSION['crmRanking'],$_SESSION['crmEmpresa']);						
						            if($query->num_rows > 0){
						            while ($row= $query -> fetch_assoc())
						                  { 
						            ?>
						              <option value="<?php echo $row['codinscritoen'];?>"
						              <?php if($ro['valor2']=='inscritoen' && $ro['comentario']==$row['codinscritoen']){echo "selected"; }?>
						              	>
						              <?php echo $row['descripcion'];?></option>
						            <?php }}
						            ?>             
						        </select>
							</div>
						</div>	

							<div class="form-group">
								<div class="col-sm-10">	
						    		<input  type="submit" name="" value="Filtrar">	
						   		 </div>
						    </div>		
					    <br>
					    <br>
					    <br>
					  </form>
					</div>
					<br>
	            <!-- </div> -->
	            
	        </div>
	        
	        <div class="p-body" style="width: 98%; border-style: none; margin-left: 1%;">
	            
                <form id="frm-example" action="php/entregar-kit.php" method="get">
	            <table class="display nowrap" id="example" align="center">
	            <br>
	                <!-- <div style="text-align: right; margin:0 15px 10px 0;">
	                	<b >Descargar Reporte</b>
						<a href="php/report-excel-attendance.php">
							<img src="img/excel.svg" width="32px">
						</a>						
					</div> -->

	                <thead>
	                    <tr>
	                    	<th><input name="select_all" value="1" id="example-select-all" type="checkbox"/> All</th>
	                    	<?php if ($id==true): ?>
	                    		<th>ID</th>  	                    	 	
	                    	<?php endif ?> 

	                    	<?php if ($fecha_inscripcion==true): ?>
	                    		<th>Fecha Inscripci&oacute;n</th>  
	                    	<?php endif ?>

	                    	<?php if ($nombre==true): ?>
	                    		<th>Nombre</th>  	                    	 	
	                    	<?php endif ?>

	                    	<?php if ($apellido==true): ?>
	                    		<th>Apellido</th>  	                    	 	
	                    	<?php endif ?>

	                    	<?php if ($telefono==true): ?>
	                    		<th>Tel&eacute;fono</th>  	                    	 	
	                    	<?php endif ?>

	                    	<?php if ($correo==true): ?>
	                    		<th>Correo</th>  	                    	 	
	                    	<?php endif ?>

	                    	<?php if ($cedula_pasaporte==true): ?>
	                    		<th>C&eacute;dula|Pasaporte</th>
	                    	<?php endif ?>

	                    	<?php if ($genero==true): ?>
	                    		<th>G&eacute;nero</th>  	                    	 
	                    	<?php endif ?>

	                    	<?php if ($pais==true): ?>
	                    		<th>Pa&iacute;s</th>  	                    	 	
	                    	<?php endif ?>

	                    	<?php if ($provincia==true): ?>
	                    		<th>Provincia</th>  	                    	 	
	                    	<?php endif ?>

	             			<?php if ($nombre_grupo==true): ?>
	                    		<th>Grupo</th>  	                    	 	
	                    	<?php endif ?>

	                    	<?php if ($otro_grupo==true): ?>
	                    		<th>Otros Grupos</th>  	                    	 	
	                    	<?php endif ?>

	                    	<?php if ($cant_p==true): ?>
	                    		<th>Cantidad de Participantes</th>
	                    	<?php endif ?>

	                    	<?php if ($cant_ma==true): ?>
	                    		<th>Cantidade de Acompañantes</th>
	                    	<?php endif ?>

	                    	<?php if ($cant_me==true): ?>
	                    		<th>Cantidad de Menores</th>  	
	                    	<?php endif ?>

	                    	<?php if ($contactoe==true): ?>
	                    		<th>Contacto de Emergencia</th>
	                    	<?php endif ?>

	                    	<?php if ($telefonoe==true): ?>
	                    		<th>Tel&eacute;fono Emergencia</th>
	                    	<?php endif ?>

	                    	<?php if ($comentario_p==true): ?>
	                    		<th>Comentario Participante</th>
	                    	<?php endif ?>

	                    	<?php if ($acuerdo_t==true): ?>
	                    		<th>Acuerdo de T&eacute;rminos</th>
	                    	<?php endif ?>

							<?php if ($revisado==true): ?>
	                    		<th>Revisado</th>
	                    	<?php endif ?>

	                    	<?php if ($comentario_revisado==true): ?>
	                    		<th>Comentario Revisado</th>
	                    	<?php endif ?>

	                    	<?php if ($fecha_deposito==true): ?>
	                    		<th>Fecha Depósito</th>
	                    	<?php endif ?>

	                    	<!-- <?php if ($monto==true): ?>
	                    		<th>monto</th>
	                    	<?php endif ?> -->

	                    	<?php if ($referencia==true): ?>
	                    		<th>Orden INI</th>
	                    	<?php endif ?>

	                    	<?php if ($descripcion_deposito==true): ?>
	                    		<th>Orden FIN</th>
	                    	<?php endif ?>

	                    	<!-- <?php //if ($comentario_deposito==true): ?>
	                    		<th>Comentario Deposito</th>
	                    	<?php //endif ?> -->
	                    	
	                    </tr>
	                </thead>
 
	                <tbody>
	                	<?php 
	                	$query2= buscarparametrosdato('inscritoen');
					    $ro=$query2->fetch_assoc();

					    $query2= buscarparametrosdato('evento');
					    $r=$query2->fetch_assoc();

	                	$query=inscritos($ro['comentario'],$r['comentario']);
	       
	                	while ($row=$query->fetch_assoc()) : ?>
	                		
	                		<?php if ($vtrasaccion=='all'and $row['entregado']!='S' ) { ?>
		                		<tr>
		                		<?php $cod= $row['codinscripcion'].'-'.$row['inscrito_en']?>
                                <td><input name="id[]"  id="id" type="checkbox"  value="<?php echo $cod; ?>" />
                                </td>
		                		<?php if ($id==true): ?>
		                    		<td><?php echo $cod; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($fecha_inscripcion==true): ?>
		                    		<td><?php echo $row['fecha_inscripcion']; ?></td>  
		                    	<?php endif ?> 

		                    	<?php if ($nombre==true): ?>
		                    		<td><?php echo $row['nombre']; ?></td>  
		                    	<?php endif ?>

		                    	<?php if ($apellido==true): ?>
		                    		<td><?php echo $row['apellido']; ?></td>  	 	
		                    	<?php endif ?>

		                    	<?php if ($telefono==true): ?>
		                    		<td><?php echo $row['telefono']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($correo==true): ?>
		                    		<td><?php echo $row['email']; ?></td>    	 	
		                    	<?php endif ?>

		                    	<?php if ($cedula_pasaporte==true): ?>
		                    		<td><?php echo $row['cedula']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($genero==true): ?>
		                    		<td><?php echo $row['genero']; ?></td>
		                    	<?php endif ?>

				                <?php if ($pais==true): ?>
		                    		<td><?php echo $row['pais']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($provincia==true): ?>
		                    		<td><?php echo $row['provincia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($nombre_grupo==true): ?>
		                    		<td><?php echo $row['grupo']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($otro_grupo==true): ?>
		                    		<td><?php echo $row['otro_grupo']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_p==true): ?>
		                    		<td><?php if ($row['revisado']=='N'){echo $row['pago_participante'];}else{echo $row['pago_participante']+$row['pend_participante'];} ?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_ma==true): ?>
		                    		<td><?php if ($row['revisado']=='N'){echo $row['pago_acom_mayor'];}else{ echo $row['pago_acom_mayor']+$row['pend_acom_mayor'];}?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_me==true): ?>
		                    		<td><?php if ($row['revisado']=='N'){echo $row['pago_acomp_menor'];}else{echo $row['pago_acomp_menor']+$row['pend_acomp_menor'];} ?></td>
		                    	<?php endif ?>

		                    	<?php if ($contactoe==true): ?>
		                    		<td><?php echo $row['contacto_emergencia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($telefonoe==true): ?>
		                    		<td><?php echo $row['telefono_emergencia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($comentario_p==true): ?>
		                    		<td><?php echo $row['comentario']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($acuerdo_t==true): ?>
		                    		<td><?php echo $row['acuerdo_termino']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($revisado==true): ?>
		                    		<td><?php echo $row['revisado']; ?></td>         	 	
		                    	<?php endif ?>

		                    	<?php if ($comentario_revisado==true): ?>
		                    		<td><?php echo $row['comentario_revisado']; ?></td>
		                    	<?php endif ?>

		                    	 <?php if ($fecha_deposito==true): ?>
		                    		<td><?php echo $row['fecha_saldo']; ?></td>           	 	
		                    	<?php endif ?>
		               
		                    	<?php if ($referencia==true): ?>
		                    		<td><?php echo $row['orden_ini']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($descripcion_deposito==true): ?>
		                    		<td><?php echo $row['orden_fin']; ?></td>
		                    	<?php endif ?>
		                    	
		                    	</tr>
	                    	<?php }
	                    	elseif ($vtrasaccion=='con' and  $row['entregado']!='S') {
	                    		if( $row['revisado']=='S' or ($row['pend_participante']<$row['pago_participante'] or $row['pend_acom_mayor']<$row['pago_acom_mayor'] or $row['pend_acomp_menor']<$row['pend_acomp_menor'])){ ?>
		                    	<tr>
		                    	<?php $cod= $row['codinscripcion'].'-'.$row['inscrito_en']?>
                                <td><input name="id[]"  id="id" type="checkbox"  value="<?php echo $cod; ?>" />
                                </td>
		                    	<?php if ($id==true): ?>
		                    		<td><?php echo $cod; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($fecha_inscripcion==true): ?>
		                    		<td><?php echo $row['fecha_inscripcion']; ?></td>  
		                    	<?php endif ?> 

		                    	<?php if ($nombre==true): ?>
		                    		<td><?php echo $row['nombre']; ?></td>  
		                    	<?php endif ?>

		                    	<?php if ($apellido==true): ?>
		                    		<td><?php echo $row['apellido']; ?></td>  	 	
		                    	<?php endif ?>

		                    	<?php if ($telefono==true): ?>
		                    		<td><?php echo $row['telefono']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($correo==true): ?>
		                    		<td><?php echo $row['email']; ?></td>    	 	
		                    	<?php endif ?>

		                    	<?php if ($cedula_pasaporte==true): ?>
		                    		<td><?php echo $row['cedula']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($genero==true): ?>
		                    		<td><?php echo $row['genero']; ?></td>
		                    	<?php endif ?>

				                <?php if ($pais==true): ?>
		                    		<td><?php echo $row['pais']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($provincia==true): ?>
		                    		<td><?php echo $row['provincia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($nombre_grupo==true): ?>
		                    		<td><?php echo $row['grupo']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($otro_grupo==true): ?>
		                    		<td><?php echo $row['otro_grupo']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_p==true): ?>
		                    		<td><?php echo $row['pago_participante']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_ma==true): ?>
		                    		<td><?php echo $row['pago_acom_mayor']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_me==true): ?>
		                    		<td><?php echo $row['pago_acomp_menor']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($contactoe==true): ?>
		                    		<td><?php echo $row['contacto_emergencia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($telefonoe==true): ?>
		                    		<td><?php echo $row['telefono_emergencia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($comentario_p==true): ?>
		                    		<td><?php echo $row['comentario']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($acuerdo_t==true): ?>
		                    		<td><?php echo $row['acuerdo_termino']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($revisado==true): ?>
		                    		<td><?php echo $row['revisado']; ?></td>         	 	
		                    	<?php endif ?>

		                    	<?php if ($comentario_revisado==true): ?>
		                    		<td><?php echo $row['comentario_revisado']; ?></td>
		                    	<?php endif ?>

		                    	 <?php if ($fecha_deposito==true): ?>
		                    		<td><?php echo $row['fecha_saldo']; ?></td>           	 	
		                    	<?php endif ?>
		               
		                    	<?php if ($referencia==true): ?>
		                    		<td><?php echo $row['orden_ini']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($descripcion_deposito==true): ?>
		                    		<td><?php echo $row['orden_fin']; ?></td>
		                    	<?php endif ?>
		                    	</tr>
	                    	<?php }}
	                    	elseif ($vtrasaccion=='sin' and  $row['entregado']!='S'){
	                    		if($row['pend_participante']>0 or $row['pend_acom_mayor']>0 or $row['pend_acomp_menor']>0){ ?>
		                    	<tr>
		                    	<?php $cod= $row['codinscripcion'].'-'.$row['inscrito_en']?>
                                <td><input name="id[]"  id="id" type="checkbox"  value="<?php echo $cod; ?>" />
                                </td>
		                    	<?php if ($id==true): ?>
		                    		<td><?php echo $cod; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($fecha_inscripcion==true): ?>
		                    		<td><?php echo $row['fecha_inscripcion']; ?></td>  
		                    	<?php endif ?> 

		                    	<?php if ($nombre==true): ?>
		                    		<td><?php echo $row['nombre']; ?></td>  
		                    	<?php endif ?>

		                    	<?php if ($apellido==true): ?>
		                    		<td><?php echo $row['apellido']; ?></td>  	 	
		                    	<?php endif ?>

		                    	<?php if ($telefono==true): ?>
		                    		<td><?php echo $row['telefono']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($correo==true): ?>
		                    		<td><?php echo $row['email']; ?></td>    	 	
		                    	<?php endif ?>

		                    	<?php if ($cedula_pasaporte==true): ?>
		                    		<td><?php echo $row['cedula']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($genero==true): ?>
		                    		<td><?php echo $row['genero']; ?></td>
		                    	<?php endif ?>

				                <?php if ($pais==true): ?>
		                    		<td><?php echo $row['pais']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($provincia==true): ?>
		                    		<td><?php echo $row['provincia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($nombre_grupo==true): ?>
		                    		<td><?php echo $row['grupo']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($otro_grupo==true): ?>
		                    		<td><?php echo $row['otro_grupo']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_p==true): ?>
		                    		<td><?php echo $row['pend_participante']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_ma==true): ?>
		                    		<td><?php echo $row['pend_acom_mayor']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_me==true): ?>
		                    		<td><?php echo $row['pend_acomp_menor']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($contactoe==true): ?>
		                    		<td><?php echo $row['contacto_emergencia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($telefonoe==true): ?>
		                    		<td><?php echo $row['telefono_emergencia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($comentario_p==true): ?>
		                    		<td><?php echo $row['comentario']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($acuerdo_t==true): ?>
		                    		<td><?php echo $row['acuerdo_termino']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($revisado==true): ?>
		                    		<td><?php echo $row['revisado']; ?></td>         	 	
		                    	<?php endif ?>

		                    	<?php if ($comentario_revisado==true): ?>
		                    		<td><?php echo $row['comentario_revisado']; ?></td>
		                    	<?php endif ?>

		                    	 <?php if ($fecha_deposito==true): ?>
		                    		<td><?php echo $row['fecha_saldo']; ?></td>           	 	
		                    	<?php endif ?>
		               
		                    	<?php if ($referencia==true): ?>
		                    		<td><?php echo $row['orden_ini']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($descripcion_deposito==true): ?>
		                    		<td><?php echo $row['orden_fin']; ?></td>
		                    	<?php endif ?>
		                    	</tr>
	                    	<?php } }
	                    	elseif ($vtrasaccion=='kit' and  $row['entregado']=='S'){
	                    		//if($row['estado_inscripcion']=='P'){ ?>
		                    	<tr>
		                    	<?php $cod= $row['codinscripcion'].'-'.$row['inscrito_en']?>
                                <td><input name="id[]"  id="id" type="checkbox"  value="<?php echo $cod; ?>" />
                                </td>
		                    	<?php if ($id==true): ?>
		                    		<td><?php echo $cod; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($fecha_inscripcion==true): ?>
		                    		<td><?php echo $row['fecha_inscripcion']; ?></td>  
		                    	<?php endif ?> 

		                    	<?php if ($nombre==true): ?>
		                    		<td><?php echo $row['nombre']; ?></td>  
		                    	<?php endif ?>

		                    	<?php if ($apellido==true): ?>
		                    		<td><?php echo $row['apellido']; ?></td>  	 	
		                    	<?php endif ?>

		                    	<?php if ($telefono==true): ?>
		                    		<td><?php echo $row['telefono']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($correo==true): ?>
		                    		<td><?php echo $row['email']; ?></td>    	 	
		                    	<?php endif ?>

		                    	<?php if ($cedula_pasaporte==true): ?>
		                    		<td><?php echo $row['cedula']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($genero==true): ?>
		                    		<td><?php echo $row['genero']; ?></td>
		                    	<?php endif ?>

				                <?php if ($pais==true): ?>
		                    		<td><?php echo $row['pais']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($provincia==true): ?>
		                    		<td><?php echo $row['provincia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($nombre_grupo==true): ?>
		                    		<td><?php echo $row['grupo']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($otro_grupo==true): ?>
		                    		<td><?php echo $row['otro_grupo']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_p==true): ?>
		                    		<td><?php echo $row['pago_participante']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_ma==true): ?>
		                    		<td><?php echo $row['pago_acom_mayor']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($cant_me==true): ?>
		                    		<td><?php echo $row['pago_acomp_menor']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($contactoe==true): ?>
		                    		<td><?php echo $row['contacto_emergencia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($telefonoe==true): ?>
		                    		<td><?php echo $row['telefono_emergencia']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($comentario_p==true): ?>
		                    		<td><?php echo $row['comentario']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($acuerdo_t==true): ?>
		                    		<td><?php echo $row['acuerdo_termino']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($revisado==true): ?>
		                    		<td><?php echo $row['revisado']; ?></td>         	 	
		                    	<?php endif ?>

		                    	<?php if ($comentario_revisado==true): ?>
		                    		<td><?php echo $row['comentario_revisado']; ?></td>
		                    	<?php endif ?>

		                    	 <?php if ($fecha_deposito==true): ?>
		                    		<td><?php echo $row['fecha_saldo']; ?></td>           	 	
		                    	<?php endif ?>
		               
		                    	<?php if ($referencia==true): ?>
		                    		<td><?php echo $row['orden_ini']; ?></td>
		                    	<?php endif ?>

		                    	<?php if ($descripcion_deposito==true): ?>
		                    		<td><?php echo $row['orden_fin']; ?></td>
		                    	<?php endif ?>
		                    	</tr>
	                    	<?php } 
		                    	// }
		                    		?>
	            


	                    
	                    <?php endwhile ?>

	                </tbody>
	            </table> 
	          	<!-- <p><a href="main-2.php" class="btn btn-danger">Atrás</a> -->
                <button class='btn btn-success'>Entregar Kit</button></p>
               
                </form>  

	        </div>
    	</div>
		</div><!-- .content-wrapper -->
<?php include 'php/pie.php'; ?>