<?php

if(empty($_POST['proyectos_insert_start_date']) || empty($_POST['proyectos_insert_name']) || empty($_POST['proyectos_insert_priority']) || empty($_POST['proyectos_insert_end_date']) || empty($_POST['proyectos_insert_fk_cliente']))
{
    exit("Campos Vacios");
}

//verificando fecha si no es menor
$a= new DateTime($_POST['proyectos_insert_start_date']);
$b= new DateTime($_POST['proyectos_insert_end_date']);
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


$proyecto=new proyecto(new Connexion);
$proyecto->setpresupuesto($_POST['proyectos_insert_presupuesto']);
$proyecto->setname($_POST['proyectos_insert_name']);
$proyecto->setdescripcion($_POST['proyectos_insert_descripcion']);
$proyecto->setstart_date($_POST['proyectos_insert_start_date']);
$proyecto->setduration($diff->days);
$proyecto->setpriority($_POST['proyectos_insert_priority']);
$proyecto->setfk_cliente($_POST['proyectos_insert_fk_cliente']);
$proyecto->setestado('creado');
$date=new DateTime();
$datetime=$date->format('Y-m-d H:i:s');
$proyecto->setcreated_at($datetime);
$proyecto->setupdated_at($datetime);
$id=$proyecto->insert();

if(!is_numeric($id))
{
    //fallo
    echo $id;
    exit;
}

 $directorio = 'res/proyectos/'.$id; //Declaramos un  variable con la ruta donde guardaremos los archivos

 if(file_exists($directorio))
 {
     //carpeta creada
 }
 else
 {
    if(!mkdir($directorio, 0777, true))
    {
        echo "Fallo al crear carpeta";
        exit;
    }
 }
$arrayName = array();
//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
foreach($_FILES["proyectos_insert_archivos"]['tmp_name'] as $key => $tmp_name)
{
    //Validamos que el archivo exista
    if($_FILES["proyectos_insert_archivos"]["name"][$key]) {
        $filename = $_FILES["proyectos_insert_archivos"]["name"][$key]; //Obtenemos el nombre original del archivo
        $source = $_FILES["proyectos_insert_archivos"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
        
        //Validamos si la ruta de destino existe, en caso de no existir la creamos
        if(!file_exists($directorio)){
            mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
        }
        
        $dir=opendir($directorio); //Abrimos el directorio de destino
        $target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
        
        //Movemos y validamos que el archivo se haya cargado correctamente
        //El primer campo es el origen y el segundo el destino
        if(move_uploaded_file($source, $target_path)) {	
            //echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
            array_push($arrayName, $target_path);
            } else {	
            //echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
            array_push($arrayName, "Ha ocurrido un error al subir la imagen");
        }
        closedir($dir); //Cerramos el directorio de destino
    }
}

//creamos la notificacion
$session=new Session();
$session=$session->getValue('projects_id_user');
//datos del usuario
$usuario=new usuario(new Connexion);
$usuario->setpk($session);
$usuario=$usuario->getAllById();
$usuario=$usuario->fetch_array(MYSQLI_ASSOC);
$noti=new notification(new Connexion);
            $noti->setlink("proyectos/view/".$id);
            $noti->setfkusuario($session);
            $noti->setname('<span class="noti-title">'.$usuario['nombres'].'  </span><span class="noti-title">ha registrado un nuevo proyecto</span>');
            $noti->setcreated_at($datetime);
            $noti->insert();

$proyecto=new proyecto(new Connexion);
$proyecto->setpk($id);
$proyecto->setarchivos(json_encode($arrayName));
exit($proyecto->update_archivos());



?>

