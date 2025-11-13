<?php
require __DIR__ . '/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig('credentials.json');
$client->setRedirectUri('http://localhost/google-calendar/callback.php');
$client->addScope(Google_Service_Calendar::CALENDAR);
$client->setAccessType('offline');

if (!isset($_GET['code'])) {
    header('Location: connect.php');
    exit;
} else {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token;
    header('Location: index.php');
}
