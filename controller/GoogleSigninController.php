<?php

require __DIR__ . "/../vendor/autoload.php";

$client = new Google\Client;

$client->setClientId("25074705049-g0ji4vqcveuufa8l2cnm6qvmpmo20c3p.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost/index.php?ctrl=security&action=googleSignin");

$client->addScope("email");
$client->addScope("profile");

$url = $client->createAuthUrl();

?>