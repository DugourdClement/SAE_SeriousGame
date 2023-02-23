<?php
require 'data/dataAccess.php';
require 'YearData.php';
require 'Choice.php';

echo json_encode(getData(1)); //faire une boucle