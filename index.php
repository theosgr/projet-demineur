<?php

require "config/config.php";
require PATH_CONTROLEUR."/routeur.php";

$routeur=new Routeur();
$routeur->routerRequete();

?>