<?php

$error = false;
function comprobarpost()
{
    global $error;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["user"]) && isset($_POST["password"])) {
            $user = $_POST["user"];
            $password = $_POST["password"];

            if (strlen($user) <= 20 && strlen($password) <= 20) {
                comprobaruser($user, $password);
                $error = false;
                $_SESSION["user"] = $_POST["user"];
                $_SESSION["password"] = $_POST["password"];
            } else {
                $error = true;
                echo "El usuario y la contraseña no deben superar los 10 caracteres.";
            }
        }
    }
}
comprobarpost();
function mostrarerrores()
{
    global $error;
    if ($error == false) {
        print "   <span class='error'>  </span>";
    } else {
        print "   <span class='error'>  Usuario o contraseña incorrectas . </span>";
    }
};
