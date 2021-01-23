<?php
if(empty($_POST['clientes_delete_id']))
{
    exit("Empty");
}
$cliente=new cliente(new Connexion);
$cliente->setpk($_POST['clientes_delete_id']);
exit($cliente->delete());