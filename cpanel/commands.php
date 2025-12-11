<?php
// Param check
if (!empty($_POST)) {
    if (!isset($_POST['command'])) {
        echo json_encode(['err' => 'Empty command']);
    }

    $command = $_POST['command'];

    if (!in_array($command, ['source', 'sysupgrade', 'cert', 'backup', 'restore', 'userpass', 'rootpass'])) {
        echo json_encode(['err' => 'Wrong command']);
        die(1);
    }

    if (isset($_POST['param'])) {
        $param = $_POST['param'];
    } else {
        $param = '';
    }
}

$fcommands = '/home/privateness/commands.json';

if (!file_exists($fcommands)) {
    echo json_encode(['err' => 'Commands file not exist']);
}

// Write to file
$commands = json_decode(file_get_contents($fcommands), true);

// Write to file

if (!empty($_POST)) {
    $commands[$command]['status'] = 'launch';
    $commands[$command]['param'] = $param;
    file_put_contents($fcommands, json_encode($commands, JSON_PRETTY_PRINT));
}

header('Content-type: application/json; charset=UTF-8');
echo file_get_contents($fcommands);
