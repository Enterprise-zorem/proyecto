<?php

$id=ID();
if(is_numeric($id))
{
    $notification=new notification(new Connexion);
    $notification->setpk($id);
    $notification=$notification->getAllById();
    if($notification){
        $notification=$notification->fetch_array(MYSQLI_ASSOC);
    }
    else
    {
        echo "<script>window.location.replace('".RUTA."')</script>";
    }

    $session=new Session();
    $session=$session->getValue('projects_id_user');
    $array= array();
    if(empty($notification['is_view']))
    {
        
        array_push($array,$session);
    }
    else
    {
        $array=json_decode($notification['is_view'], true);
        if(in_array($session,$array))
        {
            //ya exite en el array el usuario
        }
        else
        {
            array_push($array,$session);
        }
    }
    
    $array=json_encode($array);
    $not=new notification(new Connexion);
    $not->setpk($notification['pk_notification']);
    $not->setis_view($array);
    $not->update();

    echo "<script>window.location.replace('".RUTA.$notification['link']."')</script>";
    
}
