<?php
require __DIR__ . '/vendor/autoload.php';
session_start();

$client = new Google_Client();
$client->setAuthConfig('credentials.json');
$client->addScope(Google_Service_Calendar::CALENDAR);
$client->setAccessType('offline');
$client->setPrompt('select_account consent');
$client->setRedirectUri('http://localhost/google-calendar/callback.php');

if (isset($_SESSION['access_token'])) {
    $client->setAccessToken($_SESSION['access_token']);
} else {
    header('Location: connect.php');
    exit;
}

$service = new Google_Service_Calendar($client);
$calendarId = 'primary';

// ========== CRIAR EVENTO ==========
function criarEvento($service, $calendarId, $titulo, $descricao, $inicio, $fim) {
    $evento = new Google_Service_Calendar_Event([
        'summary' => $titulo,
        'description' => $descricao,
        'start' => ['dateTime' => $inicio, 'timeZone' => 'America/Sao_Paulo'],
        'end' => ['dateTime' => $fim, 'timeZone' => 'America/Sao_Paulo'],
    ]);

    $eventoCriado = $service->events->insert($calendarId, $evento);
    return $eventoCriado->htmlLink;
}

// ========== LISTAR EVENTOS ==========
function listarEventos($service, $calendarId) {
    $eventos = $service->events->listEvents($calendarId);
    return $eventos->getItems();
}

// ========== EDITAR EVENTO ==========
function editarEvento($service, $calendarId, $eventId, $titulo, $descricao, $inicio, $fim) {
    $evento = $service->events->get($calendarId, $eventId);
    $evento->setSummary($titulo);
    $evento->setDescription($descricao);
    $evento->setStart(new Google_Service_Calendar_EventDateTime(['dateTime' => $inicio]));
    $evento->setEnd(new Google_Service_Calendar_EventDateTime(['dateTime' => $fim]));

    $atualizado = $service->events->update($calendarId, $evento->getId(), $evento);
    return $atualizado->htmlLink;
}

// ========== EXCLUIR EVENTO ==========
function excluirEvento($service, $calendarId, $eventId) {
    $service->events->delete($calendarId, $eventId);
    return true;
}
