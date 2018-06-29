<?php
//Implement the header
require 'header.php';

//reset the database before insert the datas
$manager->deleteAll();
//This file contains the reader function to read the file_system file and insert the data into the database.
require 'file_reader.php';
//Open the file in "reader" mode
$file = fopen('file_system.txt', 'r');
//Call the recursive function with the first line of the file, the path setted to null and O indentation.
reader([], fgets($file));

require 'vues/form.php';
?>
