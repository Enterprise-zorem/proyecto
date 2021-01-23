<?php
//Activamos todas las notificaciones de error posibles
error_reporting (E_ALL);
 
//Definimos el tratamiento de errores no contusuarioados
set_error_handler(function () 
{
  throw new Exception('Error');
});
try {
    //code...

header('Access-Control-Allow-Origin:*');
if(isset($_POST['usuario_insert_nombres']) && isset($_POST['usuario_insert_email']) || isset($_POST['usuario_insert_password']))
{
  if(empty($_POST['usuario_insert_nombres']) || empty($_POST['usuario_insert_email']) || empty($_POST['usuario_insert_password']))
  {
      exit("Campos Vacios");
  }
}
else
{
    exit("No POST");
}

$usuario=new usuario(new Connexion);
$usuario->setemail($_POST['usuario_insert_email']);
$usuario=$usuario->getAllByEmail();
$usuario=$usuario->fetch_array(MYSQLI_ASSOC);
if($usuario)
{
   exit("Email ya se encuentra registrado");
}

$usuario=new usuario(new Connexion);
$usuario->setnombres($_POST['usuario_insert_nombres']);
$usuario->setemail($_POST['usuario_insert_email']);
$usuario->setpassword($_POST['usuario_insert_password']);
$usuario->setdni($_POST['usuario_insert_dni']);
$usuario->settelefono($_POST['usuario_insert_telefono']);
$usuario->setfkarea($_POST['usuario_insert_area']);
$usuario->setfkrol($_POST['usuario_insert_rol']);
$usuario->setimage(RUTA."res/perfiles/default.gif");
$usuario->setparent($_POST['usuario_insert_parent']);
$usuario->setfkjob($_POST['usuario_insert_job']);
$originalDate = $_POST['usuario_insert_birthdate'];
$newDate = date("Y-m-d", strtotime($originalDate));
$usuario->setbirthdate($newDate);
$date=new DateTime();
$datetime=$date->format('Y-m-d H:i:s');
$usuario->setcreated_at($datetime);
$usuario->setupdated_at($datetime);
$result =$usuario->insert();
if(is_numeric($result))
{
  echo "defaultValue";
}
else
{
  echo $result;
}



} catch (Exception $th) {
    $incidencia=new incidencias(new Connexion);
    $incidencia->setname($th);
    $date=new DateTime();
    $datetime=$date->format('Y-m-d H:i:s');
    $incidencia->setcreated_at($datetime);
    $incidencia->insert();
}

restore_error_handler();

