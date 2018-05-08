<?php include("php/cabeza.php");?>
 
<div class="content-wrapper" style="overflow:hidden;">
    <div class='newmsj'> 
        <div class='panel panel-default'>

            <div class='panel-body message newmsj-container'>
                <p class='nmsjt'>Nuevo Mensaje</p>
                <?php 
                    if (!isset($_POST['id'])){
                        if ($_SESSION['vRanking']==3){
                            echo '<script>location.href="prev-profesor-newmessage.php";</script>';
                        }
                        else{
                            echo '<script>location.href="prev-newmessage.php";</script>';

                        }
                    }
                    // $arreglo=serialize($_POST['id']);
                    // $arreglo=urlencode($arreglo);

                    

                 ?>
                 <?php //if ($_SESSION['vRanking']==4 or $_SESSION['vRanking']==5): ?>
                     <form class='form-horizontal'  method="post" action="php/enviar-mensaje.php" autocomplete="off">
                     
                  <div class='form-group' style="display: none">
                    <input type="hidden" name="evento" value="<?php echo $_POST['evento']; ?>">
                        <label for='id' class='col-sm-1 control-label'>id:</label>
                        <div class='col-sm-11'>
                                <?php foreach ( $_POST['id'] as $row ) :?>
                              <input type="checkbox" name="id[]" id="id" value="<?php echo $row; ?>" checked>
                          <?php endforeach; ?>
                        </div>
                    </div> 
                    
                  
                
                <div class='col-sm-11 col-sm-offset-1'>
                    <br>    
                    
                    <div class='form-group'>
                        <textarea class='form-control' id='message'  rows='12' placeholder='Haga clic aquí para responder' required="" name="msj"></textarea>
                    </div>
                    
                    <div class='form-group'>  

                            <a href="mensajeria.php" class="btn btn-danger">Atr&aacute;s</a>
                        <!-- <a href="">< type='submit' class='btn btn-default'> </button></a> -->
                        <button type='submit' class='btn btn-success'>Enviar</button>
                        <!-- <button type='submit' class='btn btn-danger'>Discard</button> -->
                    </div>

                </div>  
            </div>  
        </div>  
    </div><!--/.col--> 
</div> <!-- .content-wrapper -->

<?php include("php/pie.php");?>