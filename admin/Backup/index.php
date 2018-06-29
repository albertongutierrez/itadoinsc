<?php
session_start();
if(!isset($_SESSION['vUsername']) && !isset($_SESSION['vEmpresa']) && !isset($_SESSION['vRanking'])){
 		header("Location: ../index.php");
 	}?>