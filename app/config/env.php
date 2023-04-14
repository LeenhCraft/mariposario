<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . "/project/");
} else {
    define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . '/');
}

//Deliminadores decimal y millar Ej. 24,1989.00
const SPD = ".";
const SPM = ",";

//Simbolo de moneda
const SMONEY = "S/ ";

//Otros datos
const NOMBRE_EMPRESA = "Mariposario";
