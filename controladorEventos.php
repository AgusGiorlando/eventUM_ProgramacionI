<?php
session_start();

if(!$_SESSION['email']){
    header("Location: inicio_de_sesion.html");
}

?>