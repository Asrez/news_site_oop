<?php

spl_autoload_register("autoload");

function autoload($classname)
{
    if (file_exists("core" . DIRECTORY_SEPARATOR . $classname . ".php")) {
        require_once "core" . DIRECTORY_SEPARATOR . $classname . ".php";
    }

}

