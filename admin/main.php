<?php include'php/cabeza.php';?>
<!-- <div class="content-wrapper"> -->
<div class="content-wrapper" style="overflow:hidden;" >
<!--  -->
    <?php 
       // $q=extraerActividad2();
       //    $r=$q->fetch_assoc();
       //    $total=0;
       //     $numero=$q->num_rows;
       //    for ($i=0; $i <$numero ; $i++) { 
       //      $query=inscritosProvincias($r["codactividad"]);
       //      // $query=inscritosGrupos
       //      $row=$query->fetch_assoc();  
       //      $total+=$row['total'];
       //    }         

          
      // $q=extraerActividad2();
      // $r=$q->fetch_assoc();
      // $numero=$q->num_rows;
      // if ($numero>0) {

      //   $label='';
      //   $data='';
      //   $query=inscritosDias();
      //   $i=0;
      //   while($row=$query->fetch_assoc()){

      //     $label .="'".date('d',strtotime($row['fecha'])).' '.date('M',strtotime($row['fecha']))."'".',';
      //     $query2=inscritosNXD($row['fecha']);

      //     $row2=$query2->fetch_assoc();
      //     if($i==29)
      //     {
      //       $data.=$row2['total'];
      //     }
      //     else{
      //       $data.=$row2['total'].",";
      //     }
      //     $i++;

      //   }
      // }

    ?>
    <!-- <div style="width: 100%; background-color: white; padding: 25px"> -->
    <!-- <canvas id="line-chart" width="100%" height="40%  "></canvas> -->
    <!-- </div>    -->
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
      <br>
     <!--  <div class="col-md-8 col-md-offset-2 justify-content: center">
				 <div  style="margin: 0 auto; text-align:center;  "><p>
				 Sistema de Consultas ManguSoft |
				 <a href="http://mangusoft.com/" style="text-decoration: none; font-weight: 400; " target="_blank" >ManguSoft ©</a> <?php echo date('Y');?> •TODOS LOS DERECHOS RESERVADOS. </p>
				 </div>    			
		</div>	 -->
</div>
						
		 
			 
		
<!-- </div> --> <!-- .content-wrapper -->
<?php include'php/pie.php';?>
