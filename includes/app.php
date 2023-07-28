<?php 

require 'funciones.php';
require 'config/database.php';
require 'api/paypal.php';
require __DIR__ . '/../vendor/autoload.php';


// conectarnos a la base de datos
$db = conectarDB();
//$token = tokenPayPal();

use Model\ActiveRecord;

ActiveRecord::setDB($db);
