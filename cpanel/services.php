<?php
// Param check
if (!empty($_POST)) {
    if (!isset($_POST['service'])) {
        echo json_encode(['err' => 'Empty service']);
    }

    if (!isset($_POST['command'])) {
        echo json_encode(['err' => 'Empty command']);
    }

    $service = $_POST['service'];
    $command = $_POST['command'];

    if (!in_array($command, ['start', 'stop', 'restart'])) {
        echo json_encode(['err' => 'Wrong command']);
    }
}

$fservices = '/home/privateness/services.json';

if (!file_exists($fservices)) {
    echo json_encode(['err' => 'Services file not exist']);
}

// Write to file
$services = json_decode(file_get_contents($fservices), true);

if (!empty($_POST)) {
    $services[$service]['command'] = $command;
    file_put_contents($fservices, json_encode($services, JSON_PRETTY_PRINT));
}

header('Content-type: application/json; charset=UTF-8');
echo file_get_contents($fservices);
