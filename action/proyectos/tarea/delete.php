<?php
$task=new task(new Connexion);
$task->setpk($_POST['tarea_delete_id']);
exit($task->delete());