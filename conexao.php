<?php
require("config.php");
date_default_timezone_set('Africa/Harare');
try {
    $pdo = new PDO("mysql:dbname=$bd;host=$host;utf8", "$usuario", "$senha");
} catch (\Exception $th) {
    //throw $th;
    echo "erro ao conectar com a base de dados".$th;
}