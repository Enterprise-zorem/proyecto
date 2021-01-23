<?php
if(empty($_POST['clientes_insert_nombres']) || empty($_POST['clientes_insert_email']) || empty($_POST['clientes_insert_password']))
{
    exit("No POST");
}

$cliente=new cliente(new Connexion);
    $cliente->setemail($_POST['clientes_insert_email']);
    $cliente=$cliente->getAllByEmail();
    $cliente=$cliente->fetch_array(MYSQLI_ASSOC);
    if($cliente)
    {
        //hay datos 
        exit("El correo ya se encuentra registrado");
    }
    else
    {   //registrar cliente

$cliente=new cliente(new Connexion);
$cliente->setnombres($_POST['clientes_insert_nombres']);
$cliente->setapellidos($_POST['clientes_insert_apellidos']);
$cliente->settelefono($_POST['clientes_insert_telefono']);
$cliente->setidentificacion($_POST['clientes_insert_identificacion']);
$cliente->setemail($_POST['clientes_insert_email']);
$cliente->setpassword($_POST['clientes_insert_password']);
$cliente->setimage(RUTA.'res/perfiles/default.gif');
$date=new DateTime();
$datetime=$date->format('Y-m-d H:i:s');
$cliente->setcreated_at($datetime);
$cliente->setupdated_at($datetime);
$result=$cliente->insert();
if(is_numeric($result))
        {   //que usuario esta realizando la accion
            $session=new Session();
            $session=$session->getValue('projects_id_user');
            $usuario=new usuario(new Connexion);
            $usuario->setpk($session);
            $usuario=$usuario->getAllById();
            $usuario=$usuario->fetch_array(MYSQLI_ASSOC);
            //registrado correctamente
            $noti=new notification(new Connexion);
            $noti->setlink("clientes/perfil/".$result);
            $noti->setfkusuario($usuario['pk_usuario']);
            $noti->setname('<span class="noti-title">'.$usuario['nombres'].'  </span><span class="noti-title">ha registrado un nuevo cliente</span>');
            $noti->setcreated_at($datetime);
            $noti->insert();
            echo "defaultValue";
        }
        else
        {
            echo $result;
        }
    }