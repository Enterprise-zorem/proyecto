<?php 
header('Access-Control-Allow-Origin:*');
$_POST = json_decode(file_get_contents("php://input"), true);

if(!isset($_POST['id']) || empty($_POST['id']))
{
    $result="El Campo ID es Invalido";
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
}

$project = new proyecto(new Connexion); 
$project->setpk($_POST['id']);
$project = $project->getAllById();
$project = $project->fetch_array(MYSQLI_ASSOC);
print json_encode($project,JSON_UNESCAPED_UNICODE);
exit();
?>