<?php
define("RUTA", "http://192.168.1.29/projects/");

date_default_timezone_set('America/Lima');

   function ID()
	{
		$url = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : "home";
		$url = explode("/", rtrim($url, "/"));

		$longitud = count($url);
		$i = $longitud - 1;

		return $url[$i];
	}

spl_autoload_register(function ($class) {
	if (file_exists("model/$class/$class.class.php")) {
		include_once "model/$class/$class.class.php";
	}
});

$url = $_SERVER["REQUEST_URI"]; //obtenemos la url
$url = explode("/", rtrim($url, "/")); //convertimos array manejable
$url = array_filter($url); //elimna los espacios
unset($url[1]); //elimina la url usuario 
unset($url[2]); //elimina la url process.php
$url = array_values($url); //reiniciamos el contador del array

$longitud = count($url);
$file = "action/";
for ($i = 0; $i < $longitud; $i++) {
	if (file_exists($file . $url[$i] . "/index.php")) {
		if(isset($url[$i+1]))
		{
			if(file_exists($file.$url[$i]."/".$url[$i+1].".php"))
			{
				$file=$file.$url[$i]."/".$url[$i+1]."";
				break;
			}
		}
		$file = $file . $url[$i] . "/";
	} else {
		break;
	}
}

if (file_exists($file."index.php")) {
	insert_vista($file);
	include $file."index.php";
} 
else if(file_exists($file.".php"))
{	insert_vista($file);
	include $file.".php";
}
else {
	echo "RUTA NO ACEPTADA";
}

function insert_vista($file)
{
	$vista=new vista(new Connexion);
        $vista->setvista($file);
        $vista=$vista->getAllByVista();
        if(mysqli_num_rows($vista))
        {
            //existen datos
        }
        else
        {
            $vista=new vista(new Connexion);
            $vista->setvista($file);
            $vista->settipo('proceso');
            $vista->insert();
        }
}