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
$nombre = $_POST['registro__nombres'];
$email = $_POST['registro__email'];
$password = $_POST['registro__password'];
if (empty($email) || empty($password)|| empty($nombre)) {
    exit("Usuario o Contraseña o Nombre no Digitados");
}


function insert()
{  
    $cliente=new usuario(new Connexion);
    $cliente->setemail($_POST['registro__email']);
    $cliente=$cliente->getAllByEmail();
    $cliente=$cliente->fetch_array(MYSQLI_ASSOC);
    if($cliente)
    {
        //hay datos 
        return "El correo ya se encuentra registrado";
    }
    else
    {   //registrar cliente

       
        $cliente=new usuario(new Connexion);
        $cliente->setimage(RUTA.'res/perfiles/default.gif');
        $cliente->setnombres($_POST['registro__nombres']);
        $cliente->setemail($_POST['registro__email']);
        $cliente->setpassword($_POST['registro__password']);
        $date=new DateTime();
        $datetime=$date->format('Y-m-d H:i:s');
        $cliente->setcreated_at($datetime);
        $cliente->setupdated_at($datetime);
        $result=$cliente->insert();

        if(is_numeric($result))
        {
            //registrado correctamente
            $noti=new notification(new Connexion);
            $noti->setlink("perfil/".$result);
            $noti->setfkusuario($result);
            $noti->setname('<span class="noti-title">'.$_POST['registro__nombres'].'  </span><span class="noti-title">se ha registrado</span>');
            $noti->setcreated_at($datetime);
            $noti->insert();
            return "defaultValue";
        }
        else
        {
            return $result;
        }
    }

}

echo insert();

} catch (Exception $th) {
    $incidencia=new incidencias(new Connexion);
    $incidencia->setname($th);
    $date=new DateTime();
    $datetime=$date->format('Y-m-d H:i:s');
    $incidencia->setcreated_at($datetime);
    $incidencia->insert();
}

restore_error_handler();


