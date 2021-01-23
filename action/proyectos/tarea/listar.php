
<?php 
header('Access-Control-Allow-Origin:*');
$_POST = json_decode(file_get_contents("php://input"), true);

if(!isset($_POST['id']) || empty($_POST['id']))
{
    $result="El Campo ID es Invalido";
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
}

$task = new Task(new Connexion);
$task->setpk($_POST['id']);
$task = $task->getAllById();
$task = $task->fetch_array(MYSQLI_ASSOC);
print json_encode($task,JSON_UNESCAPED_UNICODE);
exit();
?>