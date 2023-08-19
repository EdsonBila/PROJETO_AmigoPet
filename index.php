<?php
require './config/Config.php';
require './vendor/autoload.php';

use Config\ConfigController;

$Url = new ConfigController();
$Url->carregar();
