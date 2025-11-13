<?php
require 'calendar_actions.php';

$link = criarEvento(
    $service,
    $calendarId,
    $_POST['titulo'],
    $_POST['descricao'],
    date('c', strtotime($_POST['inicio'])),
    date('c', strtotime($_POST['fim']))
);

echo "Evento criado com sucesso! <a href='$link'>Ver no Google Calendar</a>";
$eventId = $eventoCriado->getId();
