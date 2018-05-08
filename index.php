<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>MS | ManguSoft Login</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style_log.css">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="img/logo.png" />


</head>
<?php 
        session_start();
        if(isset($_SESSION['crmUsername']) && isset($_SESSION['crmEmpresa']) && isset($_SESSION['crmRanking'])){
            header("Location: main-2.php");
        }
        if(isset($_GET['status'])){
            switch($_GET['status']){
                case 'errl':
                    $statusColor = 'red';
                    $statusMsg = 'Usuario o contraseña invalido';
                    break;
                case 'errt':
                    $statusColor = 'orange';
                    $statusMsg = 'Su sesión ha caducado';
                    break;
                case 'errns':
                    $statusColor = 'green';
                    $statusMsg = 'Debe Iniciar session';
                    break;
                default:
                    $statusColor = '';
                    $statusMsg = '';
            }
            
        }
        ?>
<body>
    <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">                                
                        <div class="row-fluid user-row">
                            <img src="img/logo.png" class="img-responsive" alt="" width="200px" />
                        </div>
                    </div>
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form" class="form-signin" method="post" action="php/validar_login.php">
                            <fieldset>
                                <label class="panel-login">
                                    <div class="login_result"></div>
                                </label>
                                <input class="form-control" placeholder="Usuario" id="user" type="text" required name="username">
                                <input class="form-control" placeholder="Contraseña" id="pass" type="password" required name="password">
                                <?php 
                                    if(isset($_GET['status'])){            
                                        echo '<p style="color:'.$statusColor.'; float:right">'.$statusMsg.'</p>';
                                        } 
                                ?>
                                <br>                                        
                                <input class="btn btn-lg btn-success btn-block" type="submit" id="login" value="Iniciar Sesión »">
                            </fieldset>
                        </form>
                         <div style="width:100%;text-align: right; margin-top: 5px;">
                             <a href="mailto:info@mangusoft.com">
                                Contactar Soporte
                             </a>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div  style="margin: 0 auto; text-align:center;  "><p><a href="http://mangusoft.com/" style="text-decoration: none; font-weight: 400; " target="_blanc" >ManguSoft ©</a> <?php echo date('Y');?> •TODOS LOS DERECHOS RESERVADOS. </p></div>
    </div>

    </div>
    <script src="js/jquery-3.1.1.min.js"></script>

    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</body>
</html>
