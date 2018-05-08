<?php 
session_start();
    if(!isset($_SESSION['crmUsername']) && !isset($_SESSION['crmRanking']) && !isset($_SESSION['crmEmpresa'])){
        header('Location: ../index.php?status=errs' );
    }
    include'conectar.php';
	

    foreach ( $_GET['id']as $row ) {
    	$v1=explode('-',$row );
		// echo $v1[0];
		// echo $v1[1];
    	$sql="SELECT * from  `inscripcion`  where `codinscripcion`='".$v1[0]."' and `inscrito_en`='".$v1[1]."' and `codempresa`='".$_SESSION['crmEmpresa']."' and `entregado`='N'";
    	$query=$mysqli->query($sql);
    	$r=$query->fetch_assoc();
    	// echo $sql;
    	if ($r["revisado"] == 'S'){

			if ($query->num_rows>0){
			
				$sql="UPDATE `inscripcion` SET `entregado`='S' where `codinscripcion`='".$v1[0]."' and `inscrito_en`='".$v1[1]."' and `codempresa`='".$_SESSION['crmEmpresa']."' ";

				if ($mysqli->query($sql)){
					$qstring = '?status=succ';
					
				}
				else{
		            $qstring = '?status=err';
					// echo mysqli_error($mysqli)."<br>";
				}
			}
			else{
				$cod .=$v1[0].',';
				$ie .=$v1[1].',';
				$qstring = '?status=entregado';

			}
		}
		else{
				$qstring = '?status=np';
		}

    	// $i++;
     } 
	header("Location: ../consulta-participante.php".$qstring);
 ?>