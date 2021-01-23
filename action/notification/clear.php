<?php
//Activamos todas las notificaciones de error posibles
error_reporting (E_ALL);
 
//Definimos el tratamiento de errores no controlados
set_error_handler(function () 
{
  throw new Exception('Error');
});

try {
    //code...
    $session=new Session();
    $session=$session->getValue('projects_id_user');

    $notification=new notification(new Connexion);
    $notification->setfkusuario($session);
    $notification->clear();
    echo "<script>window.location.replace('".RUTA."notificaciones')</script>";
    
    //code...
} catch (Exception $th) {
    $incidencia=new incidencias(new Connexion);
    $incidencia->setname($th);
    $date=new DateTime();
    $datetime=$date->format('Y-m-d H:i:s');
    $incidencia->setcreated_at($datetime);
    $incidencia->insert();
}

restore_error_handler();