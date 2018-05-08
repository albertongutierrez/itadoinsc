<?php 
include 'consultas.php';
session_start();
$query=extraerCupoCursos($_POST['id']); 
$row=$query->fetch_assoc();
echo '<input type="hidden" class="form-control" id="horad" name="horad" value="'.$row['horas_res'].'">';
 ?>