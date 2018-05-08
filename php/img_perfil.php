<?php 
header("Content-type: image/png"); 
require('conectar.php');
session_start();
if(isset($_SESSION['crmEmpresa'])){ 
    $id = $_SESSION['crmEmpresa'];          
    $q = "SELECT  logo FROM empresa WHERE codempresa = '$id'"; 
    $result=$mysqli->query($q);
    $consulta=$result->fetch_assoc();
    echo $consulta['logo'];
    }
?>