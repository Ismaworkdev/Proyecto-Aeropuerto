<?php
<<<<<<< HEAD

function comprobarpost()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["user"];
        $password = $_POST["password"];
        comprobaruser($user, $password);
    }
}
comprobarpost();
=======
include('./Funciones/funciones_bd.php');
session_start();
>>>>>>> 350cbeac4f31d825c24ac0c0fe67b01c2fc09763
