<?php


//cambiando formato de la fecha
$fecha = date_create_from_format('d/m/Y', $_POST['tarea_insert_start_date']);
$start_date=date_format($fecha, 'Y-m-d');

$fecha = date_create_from_format('d/m/Y', $_POST['tarea_insert_end_date']);
$end_date=date_format($fecha, 'Y-m-d');

$a= new DateTime($start_date);
$b= new DateTime($end_date);
$a->format('Y-m-d');
$b->format('Y-m-d');

$res = ($a > $b) ? "mayor" : (($a < $b) ? "menor" : "igual");

if($res=="mayor")
{
    exit("La fecha de inicio no puede ser menor que la final");
}

//obtenemos los dias
$date1 = new DateTime($start_date);
$date2 = new DateTime($end_date);
$diff = $date1->diff($date2);


$task=new task(new Connexion);
$task->setfk_proyecto($_POST['tarea_insert_fk_proyecto']);
$task->setname($_POST['tarea_insert_name']);
$task->setdescripcion($_POST['tarea_insert_descripcion']);
$task->setstart_date($start_date);
$task->setduration($diff->days);
$date=new DateTime();
$datetime=$date->format('Y-m-d H:i:s');
$task->setcreated_at($datetime);
$task->setupdated_at($datetime);
$task->setfk_area($_POST['tarea_insert_fk_area']);
exit($task->insert());