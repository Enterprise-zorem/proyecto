<?php
//Activamos todas las notificaciones de error posibles
error_reporting (E_ALL);
 
//Definimos el tratamiento de errores no contareaados
set_error_handler(function () 
{
  throw new Exception('Error');
});
try {
    //code...
    
header('Access-Control-Allow-Origin:*');
if(isset($_POST['area_delete_id']))
{
  if(empty($_POST['area_delete_id']))
  {
      exit("Nulo");
  }
}
else
{
    exit("No POST");
}

$area=new area(new Connexion);
$area->setpk($_POST['area_delete_id']);
echo $area->delete();



} catch (Exception $th) {
    $incidencia=new incidencias(new Connexion);
    $incidencia->setname($th);
    $date=new DateTime();
    $datetime=$date->format('Y-m-d H:i:s');
    $incidencia->setcreated_at($datetime);
    $incidencia->insert();
}

restore_error_handler();

