<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>MS | Consultas</title>
		<meta name="description" content="Sistema de consulta MS" />
		<meta name="author" content="Codrops" />
		<!-- <link rel="shortcut icon" href="../favicon.ico">  -->
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/style-2.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script> 
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
		<link rel="stylesheet" href="css/jquery.dataTables.min.css">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
  		<script src="js/Chart.js"></script>
		<script src="js/bootstrap.js"></script>
		
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

    	<link rel="icon" type="image/png" href="img/logo.png" />

    <script>
 	$(document).ready(function(){
    var table = $('#example').DataTable({   
     	"scrollX": true,
       "iDisplayLength": 10,
       "order": [[ 2, "desc" ]],
       dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
      
    
   });

   // Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = table.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#example tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control 
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });
    
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all checkboxes in the table
      table.$('input[type="checkbox"]').each(function(){
         // If checkbox doesn't exist in DOM
         if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
               // Create a hidden element 
               $(form).append(
                  $('<input>')
                     .attr('type', 'hidden')
                     .attr('name', this.name)
                     .val(this.value)
               );
            }
         } 
      });

      // FOR TESTING ONLY
      
      // Output form data to a console
      $('#example-console').text($(form).serialize()); 
      console.log("Form submission", $(form).serialize()); 
       
      // Prevent actual form submission
      // e.preventDefault();
   });

    
    
    });

		
</script>
	</head>
	<body>

	<?php 
	session_start();
	// include("php/tiempo.php") ;
    if(!isset($_SESSION['crmUsername']) && !isset($_SESSION['crmRanking']) && !isset($_SESSION['crmEmpresa'])){
        header('Location: index.php?status=errs' );
    }
	 ?>
