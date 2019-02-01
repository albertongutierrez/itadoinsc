<?php 
	$t='Perfil de Usuario ';
	$menu='admin';
	$pagina=$t;
	include("php/cabeza.php");


	if(!empty($_GET['status'])){
	    switch($_GET['status']){
	        case 'succ':
                $statusMsgClass = 'alert-success';
                $statusMsg = 'Registro almacenado correctamente.';
                break;
            case 'err':
                $statusMsgClass = 'alert-danger';
                $statusMsg = 'Ha ocurrido un error insertendo el registro.';
                break;
            case 'succudt':
                $statusMsgClass = 'alert-success';
                $statusMsg = 'Registro actualizado correctamente.';
                break;
            case 'errudt':
                $statusMsgClass = 'alert-danger';
                $statusMsg = 'Ha ocurrido un error actualizando el registro.';
                break;
            case 'succdlt':
                $statusMsgClass = 'alert-success';
                $statusMsg = 'Registro inhabilitado correctamente.';
                break;
            case 'errdlt':
                $statusMsgClass = 'alert-danger';
                $statusMsg = 'Ha ocurrido un error inhabilitando el registro.';
                break;    
            case 'pass':
                $statusMsgClass = 'alert-danger';
                $statusMsg = 'Las contraseñas no coinciden.';
                break;
            case 'passv':
                $statusMsgClass = 'alert-danger';
                $statusMsg = 'Contraseña Vieja Incorrecta.';
                break;
	        default:
	            $statusMsgClass = '';
	            $statusMsg = '';
	    }
	    
	}

    if($_SESSION['crmRanking']==3){
        $query=extraerProfesorUDT($_SESSION['crmProfesor'],$_SESSION['crmEmpresa']);
    }
    else{
        $query=extraerUsuarioUDT($_SESSION['crmEmpresa'],$_SESSION['crmUsername']);
    }
    // echo $sql;
    $row=$query->fetch_assoc();
	?>

<div class="content-wrapper" style="overflow:hidden;" >
    <br>

    <div class="content">
        <div class="container-fluid">
            
            <?php if(!empty($statusMsg)){
                echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
            } ?>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-user">
                        <div class="image">
                            <img src="https://ununsplash.imgix.net/photo-1498409785966-ab341407de6e?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."style="z-index: -1">
                        </div>
                        <div class="content">
                            <div class="author">
                                <div class="imagenn">            
                                    <img class="avatar border-white imagenb" src="https://ui-avatars.com/api/?name=<?php echo $_SESSION['crmUsername']; ?>&size=128&color=ffffff&background=1784c7" alt="..."/>  <br>
                                </div>
                                <?php if($_SESSION['crmRanking']==3): 
                                    $nombre=explode(' ',$row['nombre']);
                                    $nombre=$nombre[0];

                                    $apellido=explode(' ',$row['apellido']);
                                    $apellido=$apellido[0];
                                    ?>

                                    <h4 class="title"><?php echo $nombre.' '.$apellido; ?>
                                <?php else: ?>
                                    <h4 class="title"><?php echo $_SESSION['crmUsername']; ?>
                                <?php endif; ?>
                                <br />
                                   <small>@<?php echo $_SESSION['crmUsername']; ?></small>
                                </h4>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Información de Usuario</h4>
                        </div>
                        <div class="content">
                            <form autocomplete="off" action="php/usuario-registros.php?accion=UDT1" method="POST">
                            <?php if($_SESSION['crmRanking']==3): ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text"  class="form-control border-input" placeholder="Nombre"  value="<?php echo $row['nombre'] ?>" name='nombre'>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Apellido</label>
                                            <input type="text" class="form-control border-input" placeholder="apellido"  value="<?php echo $row['apellido'] ?>" name='apellido'>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Usuario</label>
                                            <input type="text" readonly="" class="form-control border-input" placeholder="Username" value="<?php echo $row['username'] ?>" name="username">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Correo Electrónico</label>
                                            <input type="email" name="email" class="form-control border-input" placeholder="Correo Electrónico" value="<?php echo $row['email'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <span style="font-size: 15px">Acceso</span>
                                    <hr style="margin-top: 0; padding-top: 0;">
                                </div>
                                <?php endif; ?>
                                    <label style="color: orange"><b>Nota:</b> Si no escribe ninguna contraseña se quedara la misma</label>

                                <div class="row">
                                 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nueva Contraseña</label>
                                            <input type="password" class="form-control border-input" placeholder="Nueva" name="pwn" <?php if ($_SESSION['crmRanking']<3){echo " required='' ";} ?>>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Repetir Contraseña</label>
                                            <input type="password" class="form-control border-input" placeholder="Repitir" name="pwnv" <?php if ($_SESSION['crmRanking']<3){echo " required='' ";} ?>>
                                        </div>
                                    </div>
                             
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contraseña Anterior</label>
                                            <input type="password" class="form-control border-input" placeholder="Vieja" name="pwv" <?php if ($_SESSION['crmRanking']<3){echo " required='' ";} ?>>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                <?php if ($_SESSION['crmRanking']<3): ?>
                                    <br>
                                <?php endif ?>
                                    <input  type="submit" class="btn btn-success btn-fill btn-wd" value="Actualizar">
                                </div>
                                <div class="clearfix"></div>
                                <?php if ($_SESSION['crmRanking']<3): ?>
                                    <br>
                                    <br>
                                    <br>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    

<?php include("php/pie.php");?>