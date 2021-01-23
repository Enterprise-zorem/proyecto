<?php
$session=new Session();
if(!$session->issetValue('projects_id_user'))
{
    echo "<script>window.location.replace('".RUTA."login'); </script>";
}

?>