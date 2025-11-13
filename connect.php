<?php
require __DIR__ . '/vendor/autoload.php';

session_start();

// Caminho do JSON de credenciais
$client = new Google_Client();
$client->setAuthConfig('credentials.json');
$client->addScope(Google_Service_Calendar::CALENDAR);
$client->setRedirectUri('http://localhost/google-calendar/callback.php');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');

if (!isset($_SESSION['access_token'])) {
    $authUrl = $client->createAuthUrl();
    header('Location: ' . $authUrl);
    exit;
} else {
    $client->setAccessToken($_SESSION['access_token']);
}
