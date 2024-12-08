<?php

/**
 * cerrar la session y redirigirse al index.php
 */
session_start();

$_SESSION = array();

session_destroy();


header("Location: ../index.php");
