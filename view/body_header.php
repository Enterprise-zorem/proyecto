<?php
$funciones=new funciones();
$session=new Session();
$session=$session->getValue('projects_id_user');

$usuario=new usuario(new Connexion);
$usuario->setpk($session);
$usuario=$usuario->getAllById();
if($usuario)
{
    $usuario=$usuario->fetch_array(MYSQLI_ASSOC);
}
else
{
    echo "<script>window.location.replace('".RUTA."process.php/login/logout/');</script>";
}

function contar($tabla,$session)
{   $contador=0;
    while ($row=mysqli_fetch_array($tabla,MYSQLI_ASSOC)) {
        if($row['is_active']=="all")
        {
            if(empty($row['is_view']))
            {
                $contador++;
            }   
            else
            {
                $array=json_decode($row['is_view'],true);
                if(!in_array($session,$array))
                {
                   $contador++;
                }
                
            }
        }
        else
        {
            $active=json_decode($row['is_active'],true);
            if(in_array($session,$active)){
                if(empty($row['is_view']))
                {
                    $contador++;
                }   
                else
                {
                    $array=json_decode($row['is_view'],true);
                    if(!in_array($session,$array))
                    {
                    $contador++;
                    }
                    
                }
            }

        }
    }
    return $contador;
}
?>
	<!-- Main Wrapper -->
    <div class="main-wrapper">
    
        <!-- Header -->
        <div class="header">
        
            <!-- Logo -->
            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="<?=RUTA_RES?>assets/img/logo.png" width="40" height="40" alt="">
                </a>
            </div>
            <!-- /Logo -->
            
            <a id="toggle_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            
            <!-- Header Title -->
            <div class="page-title-box">
                <h3>Kevinarnold.zorem</h3>
            </div>
            <!-- /Header Title -->
            
            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
            
            <!-- Header Menu -->
            <ul class="nav user-menu">
            
                <!-- Notifications -->
                <?php 
                $notificaiones=new notification(new Connexion);
                $notificaiones=$notificaiones->getAll();
                ?>
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i> <span class="badge badge-pill"><?=contar($notificaiones,$session);?></span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notificaciones</span>
                            <a href="<?=RUTA?>process.php/notification/clear/" class="clear-noti"> Borrar Todos </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                
                                <?php 
                                $notificaiones=new notification(new Connexion);
                                $notificaiones=$notificaiones->getAll();
                                while ($row = mysqli_fetch_array($notificaiones,MYSQLI_ASSOC)) {
                                    if($row['is_active']=="all")
                                    {
                                        //mostrar datos
                                        if(empty($row['is_view']))
                                        {
                                            //mostrar datos
                                            ?>
                                                <li class="notification-message">
                                                    <a href="<?=RUTA?>process.php/notification/<?=$row['pk_notification']?>">
                                                        <div class="media">
                                                        <span class="avatar">
                                                            <?php 
                                                            $image=new usuario(new Connexion);
                                                            $image->setpk($row['fk_usuario']);
                                                            $image=$image->getAllById();
                                                            if(mysqli_num_rows($image))
                                                            {
                                                                $image=$image->fetch_array(MYSQLI_ASSOC);
                                                                $image=$image['image'];
                                                            }
                                                            else
                                                            {
                                                                $image=RUTA."res/perfiles/default.gif";
                                                            }
                                                            ?>
                                                            <img alt="" src="<?=$image?>">
                                                            </span>
                                                            <div class="media-body">
                                                                <p class="noti-details"><?=$row['name']?></p>
                                                                <p class="noti-time"><span class="notification-time"><?=$funciones->time_elapsed_string($row['created_at'], true);?></span></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                        }
                                        else
                                        {
                                            //configurar solo para mostrar para los que aun no lo vieron
                                            $array=json_decode($row['is_view'],true);
                                            if(in_array($session,$array))
                                            {
                                                //el usuario ya se encuentra registrado, entonces no mostrar la notificacion
                                            }
                                            else
                                            {
                                                //mostrar la notificacion por que no se encuentra registrado en is_view
                                                ?>
                                                <li class="notification-message">
                                                    <a href="<?=RUTA?>process.php/notification/<?=$row['pk_notification']?>">
                                                        <div class="media">
                                                        <span class="avatar">
                                                            <?php 
                                                            $image=new usuario(new Connexion);
                                                            $image->setpk($row['fk_usuario']);
                                                            $image=$image->getAllById();
                                                            if(mysqli_num_rows($image))
                                                            {
                                                                $image=$image->fetch_array(MYSQLI_ASSOC);
                                                                $image=$image['image'];
                                                            }
                                                            else
                                                            {
                                                                $image=RUTA."res/perfiles/default.gif";
                                                            }
                                                            ?>
                                                            <img alt="" src="<?=$image?>">
                                                            </span>
                                                            <div class="media-body">
                                                                <p class="noti-details"><?=$row['name']?></p>
                                                                <p class="noti-time"><span class="notification-time"><?=$funciones->time_elapsed_string($row['created_at'], true);?></span></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                    else
                                    {
                                        //solo para algunos usuarios is_active/is_view
                                        $active=json_decode($row['is_active'],true);
                                        if(in_array($session,$active))
                                        {
                                            //se le puede mostrar la notificacion
                                            //verificamos si no lo ha visto 
                                            if(empty($row['is_view']))
                                            {
                                                //nadie lo vio, se le muestra la notificacion
                                                ?>
                                                <li class="notification-message">
                                                    <a href="<?=RUTA?>process.php/notification/<?=$row['pk_notification']?>">
                                                        <div class="media">
                                                        <span class="avatar">
                                                            <?php 
                                                            $image=new usuario(new Connexion);
                                                            $image->setpk($row['fk_usuario']);
                                                            $image=$image->getAllById();
                                                            if(mysqli_num_rows($image))
                                                            {
                                                                $image=$image->fetch_array(MYSQLI_ASSOC);
                                                                $image=$image['image'];
                                                            }
                                                            else
                                                            {
                                                                $image=RUTA."res/perfiles/default.gif";
                                                            }
                                                            ?>
                                                            <img alt="" src="<?=$image?>">
                                                            </span>
                                                            <div class="media-body">
                                                                <p class="noti-details"><?=$row['name']?></p>
                                                                <p class="noti-time"><span class="notification-time"><?=$funciones->time_elapsed_string($row['created_at'], true);?></span></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            else
                                            {
                                                $array=json_decode($row['is_view'],true);
                                                if(in_array($session,$array))
                                                {
                                                    //el usuario ya se encuentra registrado, entonces lo vio
                                                }
                                                else
                                                {   
                                                    //no lo vio
                                                    ?>
                                                <li class="notification-message">
                                                    <a href="<?=RUTA?>process.php/notification/<?=$row['pk_notification']?>">
                                                        <div class="media">
                                                        <span class="avatar">
                                                            <?php 
                                                            $image=new usuario(new Connexion);
                                                            $image->setpk($row['fk_usuario']);
                                                            $image=$image->getAllById();
                                                            if(mysqli_num_rows($image))
                                                            {
                                                                $image=$image->fetch_array(MYSQLI_ASSOC);
                                                                $image=$image['image'];
                                                            }
                                                            else
                                                            {
                                                                $image="res/perfiles/default.gif";
                                                            }
                                                            ?>
                                                            <img alt="" src="<?=RUTA?><?=$image?>">
                                                            </span>
                                                            <div class="media-body">
                                                                <p class="noti-details"><?=$row['name']?></p>
                                                                <p class="noti-time"><span class="notification-time"><?=$funciones->time_elapsed_string($row['created_at'], true);?></span></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                                }
                                            }
                                        }
                                    }
                                }                
                                ?>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="<?=RUTA?>notificaciones">Ver todas la Notificaciones</a>
                        </div>
                    </div>
                </li>
                <!-- /Notifications -->
              

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img src="<?=$usuario['image']?>" alt="">
                        <span class="status online"></span></span>
                        <span><?=$usuario['nombres']?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?=RUTA?>perfil">Mi Perfil</a>
                        <a class="dropdown-item" href="<?=RUTA?>config">Configuraciones</a>
                        <a class="dropdown-item" href="<?=RUTA?>process.php/login/logout/">Cerrar Sesion</a>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->
            
            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?=RUTA?>perfil">Mi Perfil</a>
                    <a class="dropdown-item" href="<?=RUTA?>config">Configuraciones</a>
                    <a class="dropdown-item" href="<?=RUTA?>process.php/login/logout/">Cerrar Sesion</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
            
        </div>
        <!-- /Header -->
        
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title"> 
                            <span>Principal</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="la la-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a <?php if("home"==View::ID() || " "==View::ID()){echo "class='active'";}?> href="<?=RUTA?>home">Admin Dashboard</a></li>
                                <li><a href="employee-dashboard.html">Employee Dashboard</a></li>
                            </ul>
                        </li>
                        <li <?php if("clientes"==View::ID()){echo "class='active'";}?>> 
							<a href="<?=RUTA?>clientes"><i class="la la-users"></i><span>Clientes</span></a>
						</li>
                        <li <?php if("proyectos"==View::ID()){echo "class='active'";}?>> 
							<a href="<?=RUTA?>proyectos"><i class="la la-rocket"></i><span>Proyectos</span></a>
						</li>
                        <li <?php if("usuarios"==View::ID()){echo "class='active'";}?>> 
							<a href="<?=RUTA?>usuarios"><i class="la la-users"></i><span>Usuarios</span></a>
						</li>
                        <li <?php if("roles"==View::ID()){echo "class='active'";}?>> 
							<a href="<?=RUTA?>roles"><i class="la la-users"></i><span>Roles</span></a>
						</li>
                        <li <?php if("areas"==View::ID()){echo "class='active'";}?>> 
							<a href="<?=RUTA?>areas"><i class="la la-users"></i><span>Areas</span></a>
						</li>
                        <li <?php if("job"==View::ID()){echo "class='active'";}?>> 
							<a href="<?=RUTA?>job"><i class="la la-users"></i><span>Profesion</span></a>
						</li>
                    </ul>
                </div>
            </div>
</div>
<!-- /Sidebar -->
        