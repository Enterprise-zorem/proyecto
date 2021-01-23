<?php

if(empty($_POST['proyectos_delete_id']))
{
    exit("Empty");
}

$proyectos=new proyecto(new Connexion);
$proyectos->setpk($_POST['proyectos_delete_id']);
exit($proyectos->delete());