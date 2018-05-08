<?php include'php/cabeza.php';
      // include'php/consul.php';
 ?>
<div class="content-wrapper" style="overflow:hidden;" >
<div class="container-fluid">
    <div class="row">
    
          
    <h1 class="site-title" style="margin:0 auto; padding: 15px" >Dashboard</h1>
      <?php 
      $query=inscritos();
      $row=$query->fetch_assoc();
       ?>
    	<div class="col-md-3" >
    	    <a class="info-tiles tiles-inverse has-footer" href="#">
    		    <div class="tiles-heading">
			        <div class="pull-left">Inscripciones</div>
               <br>
			        <div class="pull-right">
			        	<div id="tileorders" class="sparkline-block"><canvas width="39" height="13" style="display: inline-block; width: 39px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"><?php echo $row['total'] ?></div>
			    </div>
			    <div class="tiles-footer">
			    	<!-- <div class="pull-left">manage orders</div> -->
			    	<!-- <div class="pull-right percent-change">+20.7%</div> -->
          
			    </div>
			</a>
    	</div>
        
        <div class="col-md-3">
        	<a class="info-tiles tiles-green has-footer" href="#">
			    <div class="tiles-heading">
          <?php 
          $query=inscritosGrupos();
          $row=$query->fetch_assoc();
           ?>
			        <div class="pull-left" >Grupos Inscritos</div>
              <br>
			        <div class="pull-right">
			        	<div id="tilerevenues" class="sparkline-block"><canvas width="40" height="13" style="display: inline-block; width: 40px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"><?php echo $row['total'] ?></div>
			    </div>
			    <div class="tiles-footer">
			    	<!-- <div class="pull-left">go to accounts</div> -->
			    	<!-- <div class="pull-right percent-change">+17.2%</div> -->
        
			    </div>
			</a>
    	</div>    
        <?php 
          $query=inscritosProvincias();
          $row=$query->fetch_assoc();
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
			        <div class="text-center"><?php echo $row['total'] ?></div>
			    </div>
			    <div class="tiles-footer">
			    	<!-- <div class="pull-left">see all tickets</div> -->
			    	<!-- <div class="pull-right percent-change">+10.3%</div> -->
       
			    </div>
			</a>
    	</div>
        <?php 
        $query=extraerFlujoEfectivo($_SESSION['crmRanking'],$_SESSION['crmEmpresa'], '1','A' );
        $row=$query->fetch_assoc();
         ?>
        <div class="col-md-3">
        	<a class="info-tiles tiles-midnightblue has-footer" href="#">
			    <div class="tiles-heading">
			        <div class="pull-left">Efectivo A Persivir</div>
               <br>
			        <div class="pull-right">
			        	<div id="tilemembers" class="sparkline-block"><canvas width="39" height="13" style="display: inline-block; width: 39px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"><?php echo number_format($row['por_pagar'],2) ?></div>
			    </div>
			    <div class="tiles-footer">
			    	<!-- <div class="pull-left">manage members</div> -->
			    	<!-- <div class="pull-right percent-change">-11.1%</div> -->
       
			    </div>
			</a>
    	</div>
	</div>
        
    </div> 
    <?php 
      $label='';
      $data='';
      $query=inscritosDias();
      $i=0;
      while($row=$query->fetch_assoc()){

        $label .="'".date('d',strtotime($row['fecha'])).' '.date('M',strtotime($row['fecha']))."'".',';
        $query2=inscritosNXD($row['fecha']);

        $row2=$query2->fetch_assoc();
        if($i==29)
        {
          $data.=$row2['total'];
        }
        else{
          $data.=$row2['total'].",";
        }
        $i++;

      }
      // echo $data.' <br>  '.$label;

    ?>
    <div style="width: 100%; background-color: white; padding: 25px">
    <canvas id="line-chart" width="100%" height="40%  "></canvas>
    </div>   
      <script type="text/javascript">
        new Chart(document.getElementById("line-chart"), {
    type: 'bar',
    data: {
      labels: [<?php echo $label ?>],
      datasets: [
        {
          label: "",
          backgroundColor: "#3e95cd",
          data: [<?php echo $data ?>]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Inscripciones Diarias'
      }
    }
});
      </script>
</div>
<?php include'php/pie.php'; ?>