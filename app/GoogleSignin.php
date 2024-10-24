<?php

require __DIR__ . "/../vendor/autoload.php";

$client = new Google\Client;

$client->setClientId("25074705049-el54ue23vdmsujr6ad281lj4hhjb2tjf.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost/rando/app/redirect.php");

$client->addScope("email");
$client->addScope("profile");

$url = $client->createAuthUrl();

?>