<?php
    session_start();

    $params = isset($_GET["params"]) ? explode("/", $_GET["params"]) : [];
    $currentPage = isset($params[0]) ? $params[0] : "index"; 
?>