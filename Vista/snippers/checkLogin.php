<?php
session_start();
if (empty($_SESSION['UserInSession'])){
    header("Location: http://".$_SERVER["HTTP_HOST"]."/spring_star/Vista/modules/persona/login.php?mensaje=loginError");
}
?>


