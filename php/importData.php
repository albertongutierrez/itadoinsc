<?php
//load the database configuration file
include 'conectar.php';
session_start();
    // include("php/tiempo.php") ;
    if(!isset($_SESSION['crmUsername']) && !isset($_SESSION['crmRanking']) && !isset($_SESSION['crmEmpresa'])){
        header('Location: ../index.php?status=errs' );
    }
// session_start();
 
if(isset($_POST['importSubmit'])){
    
    //validate whether uploaded file is a csv file
    $csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    if(!empty($_FILES['file']['name']) ){//&& in_array($_FILES['file']['type'],$csvMimes)
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            $error='';
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
           

            //skip first line
            fgetcsv($csvFile);
            
            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile,100000,",")) !== FALSE){
                //check whether member already exists in database with same email

                //extraer la ultima actividad
                // $sql2="SELECT MAX(codactividad) as total FROM actividades WHERE estado='A' ";
                // $s=$mysqli->query($sql2);
                // $row=$s->fetch_assoc();

                $sql="SELECT codinscripcion as codigo, inscrito_en inscrito from `inscripcion` where codinscripcion='".str_replace('"',"",$line[0])."' and inscrito_en='L' and codactividad='".$_GET['actividad']."'";
                $query=$mysqli->query($sql);
                $ins=$query->num_rows;

                // $reciver=str_replace('"',"",$line[6]);                     

                // $newDate = "".substr($reciver,6,10).'-'.substr($reciver,3,2).'-'.substr($reciver,0,2)."";
                
                $reciver=str_replace('"',"",$line[1]);

                $newDate2 = "".substr($reciver,6,10).'-'.substr($reciver,0,2).'-'.substr($reciver,3,2).""; 
                // echo $newDate2.'<br>';
                $line[11]=str_replace("'","",$line[11]);
                $line[17]=str_replace("'","",$line[17]);
                if ($ins<1){
                    $sql="INSERT INTO `inscripcion`(
                    `codinscripcion`,
                    `inscrito_en`,
                    `fecha_inscripcion`,
                    `nombre`, 
                    `apellido`, 
                    `telefono`,
                    `email`, 
                    `cedula`, 
                    `genero`, 
                    `codpais`, 
                    `codprovincia`, 
                    `codgrupo`, 
                    `otro_grupo`, 
                    `cant_participante`, 
                    `cant_acom_mayor`, 
                    `cant_acomp_menor`, 
                    `contacto_emergencia`, 
                    `telefono_emergencia`, 
                    `comentario`, 
                    `acuerdo_termino`, 
                    `codempresa`, 
                    `codactividad`, 
                    `codnacionalidad`,
                    `estado_inscripcion`,
                    `revisado`,
                    `impreso`,
                    `entregado`
                    ) VALUES    (
                    '".str_replace('"',"",$line[0])."',
                    'L',
                    '".$newDate2."',
                    '".str_replace('"',"",$line[2])."',
                    '".str_replace('"',"",$line[3])."',
                    '".str_replace('"',"",$line[4])."',
                    '".str_replace('"',"",$line[5])."',
                    '".str_replace('"',"",$line[6])."',
                    '".str_replace('"',"",$line[7])."',
                    '".str_replace('"',"",$line[8])."',
                    '".str_replace('"',"",$line[9])."',
                    '".str_replace('"',"",$line[10])."',
                    '".str_replace('"',"",$line[11])."',
                    '".str_replace('"',"",$line[12])."',
                    '".str_replace('"',"",$line[13])."',
                    '".str_replace('"',"",$line[14])."',
                    '".str_replace('"',"",$line[15])."',
                    '".str_replace('"',"",$line[16])."',
                    '".str_replace('"',"",$line[17])."',
                    '".str_replace('"',"",$line[18])."',
                    '".$_SESSION['crmEmpresa']."',
                    '".$_GET['actividad']."',
                    '1',
                    'I',
                    'N',
                    '2',
                    'N'
                    )";
                    
                    if($mysqli->query($sql)){
                        $qstring = '?status=succ';
                       
                    }
                    else{
                        $error .= $line[0].',';
                        echo '<script>alert("'.$line[13].'");</script>';
                        echo "error: ".mysqli_error($mysqli).'<br>';
                        echo $sql.'<br>';

                        // break;
                    }      
                }     
                $qstring = '?status=';                                     
                        
            }
          
            //close opened csv file
            fclose($csvFile);

            
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
header("Location: ../importar-datos.php".$qstring."&id=".$error);
?>