<?php

require __DIR__ . "/../vendor/autoload.php";

$client = new Google\Client;

$client->setClientId("");
$client->setClientSecret("");
$client->setRedirectUri("http://localhost/index.php?ctrl=security&action=googleSignin");

$client->addScope("email");
$client->addScope("profile");

$url = $client->createAuthUrl();

?>