<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//get the id
$id = $_POST['id'];
$database = new PDO('mysql:host=127.0.0.1;dbname=h1rm1;Charset=UTF-8', "root", '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$sql = "UPDATE produits SET deleted = 1 WHERE id = " . $id;
$req = $database->prepare($sql);
$req->execute();
echo json_encode('true');
