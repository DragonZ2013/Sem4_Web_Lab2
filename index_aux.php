<?php
//session_start();
    if(isset($_SESSION["user"]) && isset($_SESSION["user_id"]) )
    {
        if(strlen($_SESSION["admin"])>0)
            include "index_admin.php";
        else
            include "index_private.php";
    }
    else
        include "index_public.php";
?>
<html>
</html>