<?php
header('Access-Control-Allow-Origin:*');

if(empty($_POST['perfil_update_birth_date']) || empty($_POST['perfil_update_nombres']))
{
    exit("empty");
}

if(empty($_FILES['perfil_update_image']['name']))
{
    //exit("no image");
    
    $usuario=new usuario(new Connexion);
    $usuario->setpk($_POST['perfil_update_id']);
    $usuario->setnombres($_POST['perfil_update_nombres']);
    $usuario->setdni($_POST['perfil_update_dni']);
    $usuario->settelefono($_POST['perfil_update_telefono']);
    $usuario->setemail($_POST['perfil_update_email']);
    $usuario->setpassword($_POST['perfil_update_password']);
    $usuario->setbirthdate($_POST['perfil_update_birth_date']);
    $usuario->setfkarea($_POST['perfil_update_fk_area']);
    $usuario->setfkjob($_POST['perfil_update_fk_job']);
    exit($usuario->update_perfil());

}
else
{
    //subir imagen al servidor
    $target_path = 'res/perfiles/';
    $img1path = $target_path .  $_FILES['perfil_update_image']['name'];
    if(move_uploaded_file($_FILES['perfil_update_image']['tmp_name'], $img1path))
    {
        $img_ch = $_FILES['perfil_update_image']['name'];
    }
    
    $usuario=new usuario(new Connexion);
    $usuario->setpk($_POST['perfil_update_id']);
    $usuario->setnombres($_POST['perfil_update_nombres']);
    $usuario->setimage(RUTA.$target_path.$img_ch);
    $usuario->setdni($_POST['perfil_update_dni']);
    $usuario->settelefono($_POST['perfil_update_telefono']);
    $usuario->setemail($_POST['perfil_update_email']);
    $usuario->setpassword($_POST['perfil_update_password']);
    $usuario->setbirthdate($_POST['perfil_update_birth_date']);
    $usuario->setfkarea($_POST['perfil_update_fk_area']);
    $usuario->setfkjob($_POST['perfil_update_fk_job']);
    exit($usuario->update_perfil());
}



