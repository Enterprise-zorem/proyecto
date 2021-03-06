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
if(isset($_POST['area_insert_name']))
{
  if(empty($_POST['area_insert_name']))
  {
      exit("El nombre no puede ser Vacio");
  }
}
else
{
    exit("No POST");
}

$area=new area(new Connexion);
$area->setname($_POST['area_insert_name']);
$date=new DateTime();
$datetime=$date->format('Y-m-d H:i:s');
$area->setcreated_at($datetime);
$area->setupdated_at($datetime);
echo $area->insert();



} catch (Exception $th) {
    $incidencia=new incidencias(new Connexion);
    $incidencia->setname($th);
    $date=new DateTime();
    $datetime=$date->format('Y-m-d H:i:s');
    $incidencia->setcreated_at($datetime);
    $incidencia->insert();
}

restore_error_handler();

