<?php 
include "view/body_header.php";
?>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content">
                
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Notificaciones</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Notificaciones</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <?php 
                $notificaiones=new notification(new Connexion);
                $notificaiones=$notificaiones->getAll();
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="activity">
                            <div class="activity-box">
                                <ul class="activity-list">
                                    <?php 
                                while ($row = mysqli_fetch_array($notificaiones,MYSQLI_ASSOC)) {
                                    if($row['is_active']=="all")
                                    {
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
                                                    </a >
                                            </li>
                                            <?php
                                    }
                                    else
                                    {
                                        $active=json_decode($row['is_active'],true);
                                        if(in_array($session,$active))
                                        {
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
                                                    </a >
                                            </li>
                                            <?php
                                        }
                                    }
                                    }                
                                ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->