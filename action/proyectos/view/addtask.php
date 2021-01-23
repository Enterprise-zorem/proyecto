<?php
$task=new task(new Connexion);
$task->setname($_POST['new-task']);
$task->setfk_proyecto($_POST['fk_proyecto']);
$date=new DateTime();
$datetime=$date->format('Y-m-d H:i:s');
$task->setcreated_at($datetime);
$task->setupdated_at($datetime);
echo $task->insert();