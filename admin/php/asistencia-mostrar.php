<?php 
	include 'conectar.php';
	include 'consultas.php';
	session_start();
	$id=$_POST['id'];
	if ($_SESSION['crmRanking']==1){
		$sql="SELECT * FROM `secciones_det` where `codseccion_enc`='$id' and estado='A'";
	}
	else{
		$sql="SELECT * FROM `secciones_det` WHERE  `codempresa`='".$_SESSION['codempresa']."' and `codseccion_enc`='$id' and estado='A'";
	}
	$query=$mysqli->query($sql); 
			        	
	//echo "
			//";
	$var=null;
	$i=0;
	while ($row=$query->fetch_assoc()) {
		$query2=extaerInscritosUDT2($row['codinscripcion'],$row['codempresa']);
		$ro=$query2->fetch_assoc();
		if (($query->num_rows)-1==$i){
			$var.='['.json_encode($ro['nombre'].' '.$ro['apellido']).','.json_encode("<input type='checkbox' name='presente[]'>").','.json_encode("<input type='checkbox' name='ausente[]'>").']';
		
		}
		else{
			$var.='['.json_encode($ro['nombre'].' '.$ro['apellido']).','.json_encode("<input type='checkbox' name='presente[]'>").','.json_encode("<input type='checkbox' name='ausente[]'>").'],';
		}
		$i++;
		

		// echo "

		// <tr>
		// 	<td>
		// 		".$ro['nombre'].' '.$ro['apellido']."
		// 	</td>
		// 	<td> 
		// 		<input type='checkbox' name='presente[]' >
		// 	</td>
		// 	<td> 
		// 		<input type='checkbox' name='ausente[]'>
		// 	</td>
		// </tr>";
	}
	// echo $var;
	echo '<script type="text/javascript">
		var dataset=['.$var.'];
		// alert(dataset);
		</script>';
	// echo "</tbody></table>";

 ?>
