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
header('Access-Control-Allow-Origin:*');
$usuario = $_POST['login__email'];
$password = $_POST['login__password'];
if (empty($usuario) || empty($password)) {
    exit("Usuario o Contraseña no Digitados");
}

$login = new Login(new Connexion);
$login->setemail($usuario);
$login->setpasword($password);
$row = $login->signIn();

if ($row) {

    $session = new Session();
    $session->addValue('projects_id_user', $row['pk_usuario']);
    echo "defaultValue";

} else {
    echo "No existe registro";
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
