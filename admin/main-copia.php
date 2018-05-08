<div class="container-fluid">
    <div class="row">
    
          
    <h1 class="site-title" style="margin:0 auto; padding: 15px" >Dashboard</h1>
      <?php 
        $q=extraerActividad2();
        $r=$q->fetch_assoc();
        $total=0;
        $numero=$q->num_rows;
        for ($i=0; $i <$numero ; $i++) { 
        $query=inscritos($r["codactividad"]);
          $row=$query->fetch_assoc();  
          $total+= $row['total'];
        }
      ?>
    	<div class="col-md-3" >
    	    <a class="info-tiles tiles-inverse has-footer" href="reporte-resumen-inscritos.php">
    		    <div class="tiles-heading">
			        <div class="pull-left">Inscripciones</div>
               <br>
			        <div class="pull-right">
			        	<div id="tileorders" class="sparkline-block"><canvas width="39" height="13" style="display: inline-block; width: 39px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"><?php echo $total ?></div>
			    </div>
			    <div class="tiles-footer">
			    	<!-- <div class="pull-left">manage orders</div> -->
			    	<!-- <div class="pull-right percent-change">+20.7%</div> -->
          
			    </div>
			</a>
    	</div>
        
        <div class="col-md-3">
        	<a class="info-tiles tiles-green has-footer" href="reporte-grupos-inscritos.php">
			    <div class="tiles-heading">
          <?php
          $q=extraerActividad2();
          $r=$q->fetch_assoc();
          $total=0;
          $numero=$q->num_rows;
          for ($i=0; $i <$numero ; $i++) { 
            $query=inscritosGrupos($r["codactividad"]);
            $row=$query->fetch_assoc();  
            $total+=$row['total'];
          }




            // $q=extraerActividad2();

            // $r=$q->fetch_assoc();

            // $numero=$q->num_rows;
            // if ($numero>0) {
            //   # code...
              
            //   $row=$query->fetch_assoc();
            //   $total=$row['total'];
            // }
            // else{
            //   $total=0;
            // }
      
           ?>
			        <div class="pull-left" >Grupos Inscritos</div>
              <br>
			        <div class="pull-right">
			        	<div id="tilerevenues" class="sparkline-block"><canvas width="40" height="13" style="display: inline-block; width: 40px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"><?php echo $total ?></div>
			    </div>
			    <div class="tiles-footer">
			    	<!-- <div class="pull-left">go to accounts</div> -->
			    	<!-- <div class="pull-right percent-change">+17.2%</div> -->
        
			    </div>
			</a>
    	</div>    
        <?php 
          $q=extraerActividad2();
          $r=$q->fetch_assoc();
          $total=0;
          $numero=$q->num_rows;
          for ($i=0; $i <$numero ; $i++) { 
            $query=inscritosProvincias($r["codactividad"]);
            // $query=inscritosGrupos
            $row=$query->fetch_assoc();  
            $total+=$row['total'];
          }          
           ?>
        <div class="col-md-3">
        	<a class="info-tiles tiles-blue has-footer" href="#">
			    <div class="tiles-heading">
			        <div class="pull-left">Provincias</div>
               <br>
			        <div class="pull-right">
			        	<div id="tiletickets" class="sparkline-block"><canvas width="13" height="13" style="display: inline-block; width: 13px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"><?php echo $total ?></div>
			    </div>
			    <div class="tiles-footer">
			    	<!-- <div class="pull-left">see all tickets</div> -->
			    	<!-- <div class="pull-right percent-change">+10.3%</div> -->
       
			    </div>
			</a>
    	</div>
        <?php 
        $q=extraerActividad2();
        $r=$q->fetch_assoc();
        $valor=0;
        $numero=$q->num_rows;
        for ($i=0; $i <$numero ; $i++) { 
          $query=extraerFlujoEfectivo($_SESSION['crmRanking'],$_SESSION['crmEmpresa'], $r["codactividad"],'A' );
          $row=$query->fetch_assoc();  
          $valor= $row['debito']+$valor;
        }
        $valor=number_format($valor,2);

         ?>
        <div class="col-md-3">
        	<a class="info-tiles tiles-midnightblue has-footer" href="reporte-efectivo-percibir.php">
			    <div class="tiles-heading">
			        <div class="pull-left">Efectivo A Percibir</div>
               <br>
			        <div class="pull-right">
			        	<div id="tilemembers" class="sparkline-block"><canvas width="39" height="13" style="display: inline-block; width: 39px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"><?php echo $valor;?></div>
			    </div>
			    <div class="tiles-footer">
			    	<!-- <div class="pull-left">manage members</div> -->
			    	<!-- <div class="pull-right percent-change">-11.1%</div> -->
       
			    </div>
			</a>
    	</div>
	</div>
        
    </div> 