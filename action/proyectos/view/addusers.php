<?php
//push array fk_usuario

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
//verificar
$array=array();
if(empty($proyecto['fk_usuario']) || $proyecto['fk_usuario']==" " || $proyecto['fk_usuario']==null)
{
    //sin datos
}
else
{   
    $array=json_decode($proyecto['fk_usuario'],true);
    foreach ($_POST['insert_users'] as $valor) {
        if(in_array($valor,$array))
        {
            //exite el elemento en el array no agregar
        }
        else
        {
            array_push($array,$valor);
        }
        
    }
}


$proyecto=new proyecto(new Connexion);
$proyecto->setpk($_POST['insert_id_proyecto']);
$proyecto->setfk_usuario(json_encode($array));
exit($proyecto->update_users());