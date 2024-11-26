<?php

function comprobarpost()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["user"];
        $password = $_POST["password"];
        comprobaruser($user, $password);
    }
}
comprobarpost();
