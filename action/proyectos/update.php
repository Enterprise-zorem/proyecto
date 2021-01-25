<?php

$a= new DateTime($_POST['proyecto_edit_start_date']);
$b= new DateTime($_POST['proyecto_edit_end_date']);
$a->format('Y-m-d');
$b->format('Y-m-d');

$res = ($a > $b) ? "mayor" : (($a < $b) ? "menor" : "igual");

if($res=="mayor")
{
    exit("La fecha de inicio no puede ser menor que la final");
}

//obtenemos los dias
$date1 = new DateTime($_POST['proyecto_edit_start_date']);
$date2 = new DateTime($_POST['proyecto_edit_end_date']);
$diff = $date1->diff($date2);


$proyecto=new proyecto(new Connexion);

$proyecto->setpk($_POST['proyecto_edit_pk_proyecto']);
$proyecto->setname($_POST['proyectos_edit_nombres']);
$proyecto->setdescripcion($_POST['proyecto_edit_descripcion']);
$proyecto->setstart_date($_POST['proyecto_edit_start_date']);
$proyecto->setpresupuesto($_POST['proyecto_edit_presupuesto']);
$proyecto->setfk_cliente($_POST['proyectos_edit_fk_cliente']);
$proyecto->setduration($diff->days);
$date=new DateTime();
$datetime=$date->format('Y-m-d H:i:s');
$proyecto->setupdated_at($datetime);
exit($proyecto->update());
?>