<?php
//Activamos todas las notificaciones de error posibles
error_reporting (E_ALL);
 
//Definimos el tratamiento de errores no contjobados
set_error_handler(function () 
{
  throw new Exception('Error');
});
try {
    //code...

    header('Access-Control-Allow-Origin:*');
if(isset($_POST['job_edit_name']) && isset($_POST['job_edit_id']))
{
  if(empty($_POST['job_edit_name']) && empty($_POST['job_edit_id']))
  {
      exit("El nombre no puede ser Vacio");
  }
}
else
{
    exit("No POST");
}

$job=new job(new Connexion);
$job->setpk($_POST['job_edit_id']);
$job->setname($_POST['job_edit_name']);
$date=new DateTime();
$datetime=$date->format('Y-m-d H:i:s');
$job->setupdated_at($datetime);
echo $job->update();



} catch (Exception $th) {
    $incidencia=new incidencias(new Connexion);
    $incidencia->setname($th);
    $date=new DateTime();
    $datetime=$date->format('Y-m-d H:i:s');
    $incidencia->setcreated_at($datetime);
    $incidencia->insert();
}

restore_error_handler();

