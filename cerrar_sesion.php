<?php
session_start();
session_destroy();
header("Location: inicio_de_sesion.html");
