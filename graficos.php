<?php require 'php/cabeza.php';
	require 'php/consultas.php'; 
	$query=graficototal();
	$row=$query->fetch_assoc();
	$total=$row['total'];
	$totalg=$row['totalg'];
?>
	<div style="margin-top: 100px" ></div>
	<p  class="titulo-sitio">Estad&iacute;sticas</p>
	<div class="btn-atras" >
			<a href="main-2.php" class="btn btn-danger" style="padding: 10px">
			<img src='img/back.svg'/ width="16px">
			<span style="font-size: 13px">Atr&aacute;s</span>
			</a>
	</div>
<div style="width: 100%; margin:0 auto; background-color: red; display: flex: ">
	<div class="content-wrapper panel-1" >

	    <div class="panel panel-default">

	    	<div class="panel-heading">G&eacute;nero (Total:<?php echo $totalg ?>)</div>
	        
	        <div class="p-body" >
	        <?php 
	        $query=graficogenero();
	        $valor='';
	        $i=1;
	        while ($row=$query->fetch_assoc()) {
	        	if ($query->num_rows==$i){
	        		$valor .=$row['total'];
	        	}
	        	else{
	        		$valor .=$row['total'].',';
	        	}
	        	$i++;
	        }
	         ?>
	        <div class="p-2db" >
	        <canvas id='chart1' style="padding-bottom: 10px; "></canvas>
	        <script type='text/javascript'>
				var ctx = document.getElementById('chart1');
				var myChart2 = new Chart(ctx, {
					    type: 'pie',
					    data: {
					        labels: [
					        'Femenino',
					        'Masculino',							        
					        'No definido',							        
					    ],
					        datasets: [
					        {
					            data: [<?php echo $valor ?>],
					            backgroundColor: [
					                '#F24472',
					                '#36A2EB',

					            ],
					            hoverBackgroundColor: [
					                'pink',	
					                '#4E7AC9',	
					                'grey',

					            ]
					        }]
					    },
					    options: {
					        animation:{
					            animateScale:true
					        }
					    }
					});
			</script>	            
	            
			</div>
	        </div>
    	</div>
	</div><!-- .content-wrapper -->


	<div class="content-wrapper panel-2" >	
	
	    <div class="panel panel-default">

	    	<div class="panel-heading">Forma de Inscripci&oacute;n (Total:<?php echo $total ?>)</div>

	        
	        <div class="p-body" style="width: 98%; border-style: none; margin-left: 1%;">
	        <?php 
	        $query=graficoforma();
	        $label='';
	        $valor='';
	        $color='';
	        // $='';
	        $i=0;
	        $i=0;
	         function colores()
	        	{
	        		return sprintf( "#%06X", mt_rand( 0, 0xFFFFFF ));
	        	}
	        while ($row=$query->fetch_assoc()) {
	        	$i++;
	        
	        	$label .="'".$row['inscrito_en']."',";
	        	$query2=graficocontarforma($row['inscrito_en']);
	        	$row2=$query2->fetch_assoc();
	        	if ($query->num_rows==$i){
	        		$valor .=$row2['total'];
	        	}
	        	else{
	        		$valor .=$row2['total'].',';
	        	}
	        	
	        	$color="'#FFFF63','#D04D63','#36A2EB'";
	        	
	        	

	        }

	        // echo $label.'<br>'.$valor.'<br>'.$color;
	         ?>

	        <div class="p-2db" >
	        <canvas id='chart2' style="padding-bottom: 10px; "></canvas>
	        <script type='text/javascript'>
				var ctx = document.getElementById('chart2');
				var myChart2 = new Chart(ctx, {
					    type: 'pie',
					    data: {
					        labels: [
					       <?php echo $label ?>			             
					    						        
					    ],
					        datasets: [
					        {
					            data: [<?php echo $valor ?>],
					            backgroundColor: [
					               <?php echo $color ?>			             
					      
					            ],
					            hoverBackgroundColor: [
					               <?php echo $color ?>			             
					            ]
					        }]
					    },
					    options: {
					        animation:{
					            animateScale:true
					        }
					    }
					});
			</script>	            
	            
			</div>
	            
	            

	        </div>
    	</div>
	</div><!-- .content-wrapper -->


	<div class="content-wrapper panel-3" >	
	
	    <div class="panel panel-default">

	    	<div class="panel-heading">Tipos Participantes (Total:<?php echo $total ?>) </div>



	        
	        <div class="p-body" style="width: 98%; border-style: none; margin-left: 1%;">
	           <?php 
	        $query=graficotipoparticiapante();
	        $label="'Participantes','Invitados','Niños'";
	        $color='';
	       	$row=$query->fetch_assoc();
			$r1="'".$row['participante']."','".$row['mayor']."','".$row['menor']."'";
	        $color="'#B1D5F0','#373A50','#C6C5C2'";
	         ?>
	         <div class="p-2db" >
	        <canvas id='chart3' style="padding-bottom: 10px; "></canvas>
	        <script type='text/javascript'>
				var ctx = document.getElementById('chart3');
				var myChart2 = new Chart(ctx, {
					    type: 'pie',
					    data: {
					        labels: [
					       <?php echo $label ?>			             
					    						        
					    ],
					        datasets: [
					        {
					            data: [<?php echo $r1;?>],
					            backgroundColor: [
	        	
					               <?php echo $color; ?>			             
					      
					            ],
					            hoverBackgroundColor: [
					               <?php echo $color; ?>			             
					            ]
					        }]
					    },
					    options: {
					        animation:{
					            animateScale:true
					        }
					    }
					});
			</script>	            
	            
			</div>
	            
	            

	        </div>
	            
	            

	        <!-- </div> -->
    	</div>
	</div><!-- .content-wrapper -->

	<div class="content-wrapper panel-4" >	
	
	    <div class="panel panel-default">

	    	<div class="panel-heading">Procedencia (Total:<?php echo $total ?>)</div>



	        
	        <div class="p-body" style="width: 98%; border-style: none; margin-left: 1%;">
	            <?php 
	        $query=graficoprocedenciaprovincia();
	        $label='';
	        $valor='';
	        $color='';
	        $i=0;
	  
	        while ($row=$query->fetch_assoc()) {
	        	$i++;
	        	if ($query->num_rows==$i){
	        		$label .="'".strtoupper($row['provincia'])."',";
	        	}
	        	else{
	        		$label .="'".strtoupper($row['provincia'])."',";
	        	}
	        	$query2=graficoprocedenciacontarprovincia($row['codigo']);
	        	$row2=$query2->fetch_assoc();
	        	if ($query->num_rows==$i){
	        		$valor .=$row2['total'];
	        	}
	        	else{
	        		$valor .=$row2['total'].',';
	        	}
	        	
	        	$colors=colores();
	        	
	        	if ($query->num_rows==$i){
	        		if ($i%2==0){
	        			$color .="'#0FA62C'";
	        		}
	        		else{
	        			$color .="'#0FA62C'";
	        		}
	        	}
	        	else{
	        		if ($i%2==0){
	        			$color .="'#0FA62C',";
	        		}
	        		else{
	        			$color .="'#0FA62C',";
	        		}
	        	}

	        }
	         ?>

	        <div class="p-1db" >
	        <canvas id='chart4' style="padding-bottom: 10px; "></canvas>
	        <script type="text/javascript">
			var ctx = document.getElementById("chart4");
			var myChar2 = new Chart(ctx, {
			    type: 'bar',
			    data: {
			    labels: [<?php echo $label;?>],
			    datasets: [
			        {
			            label: "Procedencia",
			            backgroundColor: [<?php echo $color;?>]
			            ,
			            borderColor: [<?php echo $color;?>]
			            ,
			            borderWidth: 1,
			            data: [<?php echo $valor;?>],
			        }
			    ]
			}
			    
			,
			    options:{               //estas opciones ponen una sola linea de bars
			        scales: {
			            xAxes: [{
			                stacked: true
			            }],
			            yAxes: [{
			                stacked: true
			            }]
			        }
			    }
			});

			// var ctx = document.getElementById($data)
		</script>

	        	            
	            
			</div>
	            
	            

	        </div>
    	</div>
	</div><!-- .content-wrapper -->

	<div class="content-wrapper panel-4" >	
	
	    <div class="panel panel-default">

	    	<div class="panel-heading">Grupo Deportivo (Total:<?php echo $total ?>)</div>



	        
	        <div class="p-body" style="width: 98%; border-style: none; margin-left: 1%;">
	            <?php 
	        $query=graficogrupo();
	        $label='';
	        $valor='';
	        $color='';
	        $colors='';
	        $i=0;
	     
	        while ($row=$query->fetch_assoc()) {
	        	$i++;
	        	if ($query->num_rows==$i){
	        		$label .="'".strtoupper($row['grupo'])."',";
	        	}
	        	else{
	        		$label .="'".strtoupper($row['grupo'])."',";
	        	}
	        	$query2=graficocontargrupo($row['codigo']);
	        	$row2=$query2->fetch_assoc();
	        	if ($query->num_rows==$i){
	        		$valor .=$row2['total'];
	        	}
	        	else{
	        		$valor .=$row2['total'].',';
	        	}
	        	
	        	$colors=colores();
	        	
	        	if ($query->num_rows==$i){
	        		if ($i%2==0){
	        			$color .="'#0FA62C'";
	        		}
	        		else{
	        			$color .="'#0FA62C'";
	        		}
	        	}
	        	else{
	        		if ($i%2==0){
	        			$color .="'#0FA62C',";
	        		}
	        		else{
	        			$color .="'#0FA62C',";
	        		}
	        	}

	        }
	         ?>

	        <div class="p-1db" >
	        <canvas id='chart5' style="padding-bottom: 10px; "></canvas>
	        <script type="text/javascript">
			var ctx = document.getElementById("chart5");
			var myChar2 = new Chart(ctx, {
			    type: 'bar',
			    data: {
			    labels: [<?php echo $label;?>],
			    datasets: [
			        {
			            label: "Grupos",
			            backgroundColor: [<?php echo $color;?>]
			            ,
			            borderColor: [<?php echo $color;?>]
			            ,
			            borderWidth: 1,
			            data: [<?php echo $valor;?>],
			        }
			    ]
			}
			    
			,
			    options:{               //estas opciones ponen una sola linea de bars
			        scales: {
			            xAxes: [{
			                stacked: true
			            }],
			            yAxes: [{
			                stacked: true
			            }]
			        }
			    }
			});

			// var ctx = document.getElementById($data)
		</script>

	        	            
	            
			</div>
	            
	            

	        </div>
    	</div>
	</div><!-- .content-wrapper -->
</div>
<?php require 'php/pie.php'; ?>
