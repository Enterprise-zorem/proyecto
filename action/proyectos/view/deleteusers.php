<?php
$proyecto=new proyecto(new Connexion);
$proyecto->setpk($_POST['insert_id_proyecto']);
$proyecto=$proyecto->getAllById();
if(mysqli_num_rows($proyecto))
{
    $proyecto=$proyecto->fetch_array(MYSQLI_ASSOC);
}
else
{
    exit("Empty");
}

if($_POST['users_tipo']=="users")
{
    
    $array=json_decode($proyecto['fk_usuario'],true);

    if(in_array($_POST['users_delete_id'],$array))
    {
        //el elemento existe en el array
        //eliminar
        $array = array_diff($array, array($_POST['users_delete_id']));
        //guardamos el array
        $proyecto=new proyecto(new Connexion);
        $proyecto->setpk($_POST['insert_id_proyecto']);
        $proyecto->setfk_usuario(json_encode($array));
        exit($proyecto->update_users());
    }
    else
    {
        exit("empty user");
    }
}
else
{
    $array=json_decode($proyecto['fk_usuario_lider'],true);

    if(in_array($_POST['users_delete_id'],$array))
    {
        //el elemento existe en el array
        //eliminar
        $array = array_diff($array, array($_POST['users_delete_id']));
        //guardamos el array
        $proyecto=new proyecto(new Connexion);
        $proyecto->setpk($_POST['insert_id_proyecto']);
        $proyecto->setfk_usuario_lider(json_encode($array));
        exit($proyecto->update_liders());
    }
    else
    {
        exit("empty lider");
    }

}