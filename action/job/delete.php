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
if(isset($_POST['job_delete_id']))
{
  if(empty($_POST['job_delete_id']))
  {
      exit("Nulo");
  }
}
else
{
    exit("No POST");
}

$job=new job(new Connexion);
$job->setpk($_POST['job_delete_id']);
echo $job->delete();



} catch (Exception $th) {
    $incidencia=new incidencias(new Connexion);
    $incidencia->setname($th);
    $date=new DateTime();
    $datetime=$date->format('Y-m-d H:i:s');
    $incidencia->setcreated_at($datetime);
    $incidencia->insert();
}

restore_error_handler();

