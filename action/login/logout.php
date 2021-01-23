<?php

$session = new Session();
if ($session->validateSession('projects_id_user')) {
    header("location: " . RUTA);
}

$session->destroySession();
header('location: ' . RUTA);